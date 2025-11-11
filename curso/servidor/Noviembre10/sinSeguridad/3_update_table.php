<?php
/**
 * 3.3. Actualizar una tabla "UPDATE"
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

// Insertar datos de ejemplo si la tabla está vacía
$result = mysqli_query($conexion, "SELECT COUNT(*) as total FROM usuarios");
$row = mysqli_fetch_assoc($result);

if ($row['total'] == 0) {
    mysqli_query($conexion, "INSERT INTO usuarios (name, email, active) VALUES ('Carlos García', 'carlos@gmail.com', 1)");
    mysqli_query($conexion, "INSERT INTO usuarios (name, email, active) VALUES ('María López', 'maria@gmail.com', 1)");
    mysqli_query($conexion, "INSERT INTO usuarios (name, email, active) VALUES ('Ana Sánchez', 'ana@gmail.com', 1)");
    echo "Datos de ejemplo insertados<br>";
}



$tabla = "asignaturas";
// Ejemplo de actualización: aumentar horas de todas las asignaturas en 1
$actualiza = "UPDATE " . $tabla . " SET horas = horas + 1";
if (!mysqli_query($conexion, $actualiza))
    die("No se puede actualizar la base de datos: " . $conexion->error);

$cantidad = mysqli_affected_rows($conexion);
printf("Se han actualizado " . $cantidad . " asignaturas<BR />");

// Añadir la asignatura SEO
mysqli_query($conexion, "INSERT INTO " . $tabla . " (nombre, profesor, horas) VALUES ('SEO', '', 2)");
echo "<br>✅ Asignatura añadida: SEO";

mysqli_close($conexion);
?>
