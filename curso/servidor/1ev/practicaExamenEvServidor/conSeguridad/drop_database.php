<?php
session_start();
/**
 * Borra la BD activa (o la BD por defecto si no hay sesion).
 * - Cambia $dbDefault al nombre que uses.
 * - Si no existe, muestra mensaje amigable.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$dbDefault = "pruebas"; // mismo nombre que uses como base
$targetDb = $_SESSION['db_activa'] ?? $dbDefault;

try {
    $conexion = new PDO("mysql:host=$server", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DROP DATABASE IF EXISTS `$targetDb`";
    $conexion->exec($sql);

    if (isset($_SESSION['db_activa']) && $_SESSION['db_activa'] === $targetDb) {
        unset($_SESSION['db_activa']);
    }

    echo "BD '$targetDb' eliminada (si existia)";
} catch(PDOException $e) {
    echo "Error al eliminar la BD: " . $e->getMessage();
}

$conexion = null;
?>
