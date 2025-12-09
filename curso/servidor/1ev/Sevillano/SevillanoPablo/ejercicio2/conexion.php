<?php


$dbHost = 'localhost';
$dbName = 'cine';
$dbUser = 'root';
$dbPass = '';

function getPdo(): PDO
{
    static $pdo = null;
    global $dbHost, $dbName, $dbUser, $dbPass;

    if ($pdo === null) {
        $dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
    }

    return $pdo;
}

function requireCookiesAccepted(): void
{
    if (empty($_COOKIE['cine_cookies_aceptadas'])) {
        header('Location: cookies.php');
        exit;
    }
}

function requireLogin(): void
{
    session_start();
    requireCookiesAccepted();
    if (empty($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Devuelve cuántas sesiones se han iniciado en este navegador.
 * Se almacena en la sesión y se persiste en una cookie para no perder el conteo al cerrar sesión.
 */
function getSessionCount(): int
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['contador_sesiones'])) {
        return (int)$_SESSION['contador_sesiones'];
    }

    return (int)($_COOKIE['cine_sesiones_iniciadas'] ?? 0);
}
