<?php
session_start();
/**
 * Borra la BD activa (o la BD por defecto si no hay sesion).
 * - Si no existe, mostramos un mensaje claro.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$dbDefault = "examen";  // Nombre  de la BD
$targetDb = $_SESSION['db_activa'] ?? $dbDefault;

try { //conectar sin BD
    $conexion = new PDO("mysql:host=$server", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DROP DATABASE IF EXISTS `$targetDb`";
    $conexion->exec($sql);
    // Si la BD eliminada era la activa en sesion, la limpiamos
    if (isset($_SESSION['db_activa']) && $_SESSION['db_activa'] === $targetDb) {
        unset($_SESSION['db_activa']);
    }

    echo "BD '$targetDb' eliminada (si existia)";
} catch (PDOException $e) { //error
    echo "Error al eliminar la BD: " . $e->getMessage();
}

$conexion = null;
