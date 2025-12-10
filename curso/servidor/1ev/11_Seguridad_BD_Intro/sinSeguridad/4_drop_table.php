<?php
/**
 * 3.4. Eliminar una tabla "DROP TABLE"
 * Sin seguridad - sin PDO - sin try-catch
 */

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {
    die("Conexion Fallida" . $conexion->connect_errno);
}


$tabla = "asignaturas";
if (!mysqli_query($conexion, "DROP TABLE IF EXISTS " . $tabla)) {
    die("No se puede eliminar la tabla: " . $conexion->error);
}
echo "Tabla 'asignaturas' eliminada correctamente";

mysqli_close($conexion);
?>
