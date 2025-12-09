<?php
session_start();
/**
 * Crea la BD (drop + create).
 * - Param opcional ?db=NombreBD para usar otro nombre.
 * - Cambia $dbDefault si el enunciado pide otra BD.
 */
$server = "localhost"; // Servidor MySQL (cambiar si te dan otro host)
$user   = "root";      // Usuario MySQL (cambiar si te dan otro)
$pass   = "";          // Password MySQL (cambiar si te dan otro)
$dbDefault = "pruebas"; // NOMBRE DE LA BD QUE PIDA EL EXAMEN
$targetDb = $_GET['db'] ?? $dbDefault;

try {
    // Conecta SIN BD para poder crearla
    $conexion = new PDO("mysql:host=$server", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si existe, la elimina para recrearla limpia (lo que pidio el enunciado)
    $conexion->exec("DROP DATABASE IF EXISTS `$targetDb`");

    $sql = "CREATE DATABASE IF NOT EXISTS `$targetDb` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $conexion->exec($sql);

    $_SESSION['db_activa'] = $targetDb;
    echo "BD '$targetDb' recreada (drop + create)" . "<br>";
    echo "BD activa: '$targetDb'";
} catch(PDOException $e) {
    echo "Error al crear la BD: " . $e->getMessage();
}

$conexion = null;
?>
