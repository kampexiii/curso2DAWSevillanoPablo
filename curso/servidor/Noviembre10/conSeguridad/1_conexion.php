<?php
/**
 * Conexión a PHP-BBDD con seguridad
 * Usando PDO y try-catch
 */

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    
    // Configurar el modo de error de PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conectado exitosamente con PDO";
    
} catch(PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>
