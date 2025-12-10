<?php
// login.php — procesa login básico
// Nota: solo acepto usuarios 'usuario' o 'alumno' con contraseña 'alumno' (para pruebas), como se pide.
session_start();

// Nota: obligo método POST; si no, regreso al login.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: index.php?msg=' . urlencode('Acceso inválido. Usa el formulario.'));
    exit;
}

// Nota: leo y normalizo credenciales.
$u = isset($_POST['username']) ? trim($_POST['username']) : '';
$p = isset($_POST['password']) ? trim($_POST['password']) : '';
$u = mb_strtolower(mb_substr($u, 0, 64)); // Nota: bajo a minúsculas para evitar líos de casing.
$p = mb_substr($p, 0, 64);

// Nota: reglas de acceso para pruebas: user ∈ {usuario, alumno} y pass = alumno.
$usuariosPermitidos = ['usuario', 'alumno'];
if ($u === '' || $p === '') {
    header('Location: index.php?msg=' . urlencode('Rellena usuario y contraseña.'));
    exit;
}
if (!in_array($u, $usuariosPermitidos, true) || $p !== 'alumno') {
    header('Location: index.php?msg=' . urlencode('Credenciales no válidas para la demo.'));
    exit;
}

// Nota: reinicio la sesión y regenero el ID antes de fijar datos (prevención de fijación).
$_SESSION = [];
session_regenerate_id(true);

// Nota: guardo datos mínimos del usuario y timestamp para el control de 20s.
$_SESSION['user'] = [
    'username' => $u,
    'login_at' => time(), // control de timeout (20s)
    'ip'       => $_SERVER['REMOTE_ADDR'] ?? null,
    'ua'       => $_SERVER['HTTP_USER_AGENT'] ?? null,
];

// Nota: variables sueltas adicionales (como se pide: 2 variables extra en la sesión).
$_SESSION['curso'] = 'DAW 2º';
$_SESSION['turno'] = 'Mañana';

// Nota: cookie informativa adicional a PHPSESSID.
setcookie('user_name', $u, [
    'expires'  => time() + 3600, // 1h
    'path'     => '/',
    'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
    'httponly' => true,
    'samesite' => 'Lax',
]);

header('Location: dashboard.php');
exit;
