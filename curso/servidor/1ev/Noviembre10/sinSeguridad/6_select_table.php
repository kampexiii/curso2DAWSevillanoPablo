<?php
/**
 * 3.6. Mostrar los datos / Ver la tabla "SELECT"
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


$sql_create = "CREATE TABLE IF NOT EXISTS asignaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    profesor VARCHAR(100),
    horas INT(2),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conexion, $sql_create);

$tabla = "asignaturas";
$resultado = mysqli_query($conexion, "SELECT * FROM " . $tabla . " ORDER BY nombre");

if ($resultado) {
    echo "Consulta realizada correctamente<br>";
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #ff9800; color: white;'>
            <th>ID</th><th>Nombre</th><th>Profesor</th><th>Horas</th><th>Fecha Creación</th>
          </tr>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['profesor']) . "</td>";
        echo "<td>" . $fila['horas'] . "</td>";
        echo "<td>" . $fila['fecha_creacion'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    die("Error en la consulta: " . mysqli_error($conexion));
}

mysqli_close($conexion);
?>
