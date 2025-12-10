<?php
/**
 * 3.5. Introducir datos en una tabla "INSERT INTO"
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

// Primero, crear la tabla si no existe
$sql_create = "CREATE TABLE IF NOT EXISTS usuarios (
               id INT AUTO_INCREMENT PRIMARY KEY,
               name VARCHAR(100) NOT NULL,
               email VARCHAR(100) NOT NULL,
               active TINYINT(1) DEFAULT 1,
               created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
               )";
mysqli_query($conexion, $sql_create);



$tabla = "asignaturas";
// Eliminar todos los registros existentes
mysqli_query($conexion, "DELETE FROM " . $tabla);

// Insertar las asignaturas del curso 2º DAW
$asignaturas = [
    ["Servidor", "", 6],
    ["Cliente", "", 6],
    ["Python", "", 4],
    ["Sostenibilidad", "", 2],
    ["Digitalización", "", 2]
];

foreach ($asignaturas as $asig) {
    mysqli_query($conexion, "INSERT INTO " . $tabla .
        " (nombre, profesor, horas) VALUES('{$asig[0]}','{$asig[1]}', {$asig[2]})");
}

echo "Asignaturas insertadas correctamente: " . count($asignaturas);

mysqli_close($conexion);
?>
