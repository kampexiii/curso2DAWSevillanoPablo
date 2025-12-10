<?php
session_start();
/**
 * Conecta o desconecta de una BD.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$dbDefault = "examen";
$db     = $_GET['db'] ?? ($_SESSION['db_activa'] ?? $dbDefault);
$accion = $_GET['accion'] ?? 'conectar';

if ($accion === 'desconectar') { // Desconectar
    unset($_SESSION['db_activa']);
    echo "Conexion cerrada. No conectado a ninguna BD";
    exit;
}

try { // Conexión a la BD
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $_SESSION['db_activa'] = $db;
    echo "Conectado exitosamente a la BD '$db'";
} catch (PDOException $e) { // Error en la conexión
    unset($_SESSION['db_activa']);
    echo "No se pudo conectar a la BD '$db'. Crea la BD antes de conectar o usa ?db=NombreBD. Error: " . $e->getMessage();
}
