<?php
session_start();
require 'datos_usuarios.php';

// Si no viene por POST, vuelvo al login
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

// Recojo los datos del formulario
$usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$clave = isset($_POST['clave']) ? trim($_POST['clave']) : '';

// Validar que no estén vacíos
if (empty($usuario) || empty($clave)) {
    header("Location: login.php?error=1");
    exit;
}

// Validar longitud máxima
if (strlen($usuario) > 50 || strlen($clave) > 50) {
    header("Location: login.php?error=1");
    exit;
}


// Verificar usuario y contraseña
if (isset($usuarios_validos[$usuario]) && $usuarios_validos[$usuario] === $clave) {
    // Login correcto
    $_SESSION['usuario'] = $usuario;

    // Gestionar cookie de recordar usuario
    if (isset($_POST['recordar']) && $_POST['recordar'] == 1) {
        // Crear cookie que dura 7 días
        setcookie('usuarioRecordado', $usuario, time() + (7 * 24 * 60 * 60));
    } else {
        // Si no quiere recordar, borro la cookie si existe
        if (isset($_COOKIE['usuarioRecordado'])) {
            setcookie('usuarioRecordado', '', time() - 3600);
        }
    }

    header("Location: privado.php");
    exit;
} else {
    // Credenciales incorrectas
    header("Location: login.php?error=1");
    exit;
}
