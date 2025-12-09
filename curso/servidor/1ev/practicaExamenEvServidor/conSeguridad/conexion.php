<?php
session_start();
/**
 * Conecta o desconecta de una BD.
 * - Cambia $dbDefault si necesitas otro nombre.
 * - Param ?db=NombreBD para conectar a otra BD en el momento.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$dbDefault = "pruebas"; // NOMBRE DE LA BD POR DEFECTO (cambiar por la que pida el examen)
$db     = $_GET['db'] ?? ($_SESSION['db_activa'] ?? $dbDefault);
$accion = $_GET['accion'] ?? 'conectar';

if ($accion === 'desconectar') {
    unset($_SESSION['db_activa']);
    echo "Conexion cerrada. No conectado a ninguna BD";
    exit;
}

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $_SESSION['db_activa'] = $db;
    echo "Conectado exitosamente a la BD '$db'";
} catch(PDOException $e) {
    unset($_SESSION['db_activa']);
    echo "No se pudo conectar a la BD '$db'. Crea la BD antes de conectar o usa ?db=NombreBD. Error: " . $e->getMessage();
}
?>
