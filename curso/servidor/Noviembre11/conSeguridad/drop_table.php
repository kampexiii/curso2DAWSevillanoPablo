<?php
/**
 * Eliminar una tabla "DROP TABLE" con PDO y try-catch
 * Con seguridad - Eliminar tabla curso
 */

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $tabla = "curso"; // Nombre de la tabla a eliminar
    
    // Eliminar la tabla
    $sql = "DROP TABLE " . $tabla;
    $conexion->exec($sql);
    
    echo "✅ Tabla '" . $tabla . "' eliminada correctamente<br>";
    echo "⚠️ Todos los alumnos del curso han sido eliminados";
    
} catch(PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}

// Cerrar la conexión
$conexion = null;
?>
