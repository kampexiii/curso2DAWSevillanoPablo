<?php
/**
 * 3.2. Crear una tabla "CREATE TABLE"
 * Sin seguridad - sin PDO - sin try-catch
 */

$server = "localhost";

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

$conexion = new mysqli($server, $user, $pass, $db);
if ($conexion->connect_errno) {
    die("No se puede conectar a la base de datos: " . $conexion->connect_error);
}



// Comprobar si la tabla ya existe
$result = mysqli_query($conexion, "SHOW TABLES LIKE 'asignaturas'");
if (mysqli_num_rows($result) > 0) {
    echo "⚠️ La tabla 'asignaturas' ya existe. No se ha modificado.";
} else {
    $sql = "CREATE TABLE asignaturas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        profesor VARCHAR(100),
        horas INT(2),
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if (!mysqli_query($conexion, $sql)) {
        die("No se puede crear la tabla: " . $conexion->error);
    }
    echo "✅ Tabla 'asignaturas' creada correctamente";
}

mysqli_close($conexion);
?>

