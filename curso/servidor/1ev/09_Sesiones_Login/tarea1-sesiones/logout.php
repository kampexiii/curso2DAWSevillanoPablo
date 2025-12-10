<?php
// logout.php — guarda sesión en JSON y destruye
session_start();

// Nota: razón opcional (timeout, logout, etc.) saneada para evitar caracteres raros.
$reasonRaw = $_GET['reason'] ?? 'logout';
$reason = preg_replace('/[^a-zA-Z0-9_-]/', '_', $reasonRaw);

// Nota: preparo carpeta de volcado de sesiones en JSON.
$baseDir = __DIR__ . '/sesiones';
if (!is_dir($baseDir)) {
    // Nota: intento crear la carpeta con permisos básicos; si falla, sigo sin romper cierre.
    mkdir($baseDir, 0777, true);
}

// Nota: si hay usuario en sesión, construyo el objeto a guardar.
if (isset($_SESSION['user'])) {
    $data = [
        'ended_at'   => date('c'),
        'reason'     => $reason,
        'session_id' => session_id(),
        'user'       => $_SESSION['user'],
        'cookies'    => [
            session_name() => $_COOKIE[session_name()] ?? null,
            'user_name'    => $_COOKIE['user_name'] ?? null,
        ],
        'server'     => [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
            'ua' => $_SERVER['HTTP_USER_AGENT'] ?? null,
        ],
    ];

    // Nota: nombre de archivo seguro por usuario + timestamp.
    $safeUser = preg_replace('/[^a-zA-Z0-9_-]/', '_', $_SESSION['user']['username'] ?? 'anon');
    $file = $baseDir . '/' . date('Ymd_His') . '_' . $safeUser . '.json';

    // Nota: solo intento escribir si la carpeta existe y es escribible.
    if (is_dir($baseDir) && is_writable($baseDir)) {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // Nota: si fallase la escritura, no interrumpo el cierre de sesión.
        file_put_contents($file, $json);
    } else {
        // Nota: si no puedo escribir, al menos dejo constancia en error_log (no crítico para el ejercicio).
        error_log('logout.php: No se pudo escribir en ' . $baseDir);
    }
}

// Nota: limpio datos de sesión.
$_SESSION = [];

// Nota: invalido cookie de sesión si está activa.
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();

    // Sintaxis moderna con opciones (PHP >= 7.3).
    setcookie(session_name(), '', [
        'expires'  => time() - 42000,
        'path'     => $params['path'] ?? '/',
        'domain'   => $params['domain'] ?? '',
        'secure'   => $params['secure'] ?? false,
        'httponly' => $params['httponly'] ?? true,
        'samesite' => 'Lax',
    ]);

}

// Nota: destruyo la sesión en servidor.
session_destroy();

// Nota: borro cookie propia 'user_name'.
setcookie('user_name', '', [
    'expires'  => time() - 3600,
    'path'     => '/',
    'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
    'httponly' => true,
    'samesite' => 'Lax',
]);



header('Location: index.php?msg=' . urlencode('Sesión cerrada.'));
exit;
