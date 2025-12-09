<?php
// Manejo del login: valida POST, crea cookie de sesión y registra sesión activa
session_start();
require_once 'SessionManager.php';

// Si viene un POST procesamos el login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Usuarios predefinidos (usuario == contraseña)
    $users = [
        'usuario' => 'usuario',
        'alumno' => 'alumno',
        'profesor' => 'profesor',
        'pablo' => 'pablo',
        'admin' => 'admin'
    ];

    // Validar credenciales
    if (isset($users[$username]) && $users[$username] === $password) {
        // Generar ID único para esta sesión de navegador
        $session_id = uniqid('session_', true);
        
        // Crear cookie segura (24h)
        setcookie('cinema_session_id', $session_id, [
            'expires' => time() + 86400,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        
        // Registrar sesión en el archivo (persistente)
        SessionManager::addSession($session_id, $username);
        
        // Guardado local para uso rápido dentro de la sesión PHP
        $_SESSION['user_data'] = [
            'username' => $username,
            'session_id' => $session_id
        ];
        
        // Redirigir al índice ya logeado
        header('Location: ../index.php');
        exit;
    } else {
        // Credenciales incorrectas -> volver al index con error
        header('Location: ../index.php?error=1');
        exit;
    }
}

// Si se accede directamente, ir al index
header('Location: ../index.php');
exit;
?>
