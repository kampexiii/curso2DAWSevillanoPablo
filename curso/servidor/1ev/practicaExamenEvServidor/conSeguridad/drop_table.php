<?php
session_start();
/**
 * Borra la tabla (por defecto 'curso') de la BD activa.
 * - Cambia $table si usas otro nombre de tabla.
 * - Muestra mensajes claros si no hay BD/tabla.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "curso";     // Nombre de la tabla a eliminar
$db     = $_SESSION['db_activa'] ?? null;

if (!$db) {
    die("No hay BD activa. Pulsa Crear BD y Conectar antes de borrar la tabla.");
}

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si la tabla existe
    $check = $conexion->prepare("SHOW TABLES LIKE ?");
    $check->execute([$table]);
    if ($check->rowCount() === 0) {
        die("La tabla '$table' no existe en la BD '$db'. Crea la tabla antes de intentar borrarla.");
    }

    $sql = "DROP TABLE $table";
    $conexion->exec($sql);

    echo "Tabla '$table' eliminada correctamente de '$db'.";
} catch(PDOException $e) {
    die("No se pudo borrar la tabla. Error: " . $e->getMessage());
}

$conexion = null;
?>
