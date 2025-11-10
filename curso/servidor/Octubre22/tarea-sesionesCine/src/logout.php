<?php
// Logout: elimina la sesión activa del archivo, borra la cookie y destruye la sesión PHP
session_start();
require_once 'SessionManager.php';

// Obtener el session id desde la cookie
$current_session_id = $_COOKIE['cinema_session_id'] ?? null;

if ($current_session_id) {
    // Quitar sesión del almacenamiento persistente
    SessionManager::removeSession($current_session_id);
    
    // Borrar la cookie (mismos parámetros que al crearla)
    setcookie('cinema_session_id', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
}

// Limpiar datos de sesión PHP y redirigir
session_unset();
session_destroy();

header('Location: ../index.php');
exit;
?>
