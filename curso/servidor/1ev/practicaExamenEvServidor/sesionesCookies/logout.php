<?php
session_start();

// Destruir la sesión
$_SESSION = array();
session_unset();
session_destroy();

// Borrar la cookie si existe
if (isset($_COOKIE['usuarioRecordado'])) {
    setcookie('usuarioRecordado', '', time() - 3600);
}

// Redirigir al login
header("Location: login.php");
exit;
