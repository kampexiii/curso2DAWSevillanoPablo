<?php
/**
 * Mostrar los datos / Ver la tabla "SELECT" con PDO y try-catch
 * Con seguridad - Listar alumnos del curso
 */

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL para seleccionar alumnos del curso
    $sql = "SELECT * FROM curso ORDER BY apellidos, nombre";
    
    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    
    // Configurar el modo de fetch
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    echo "<h3>📋 Listado de Alumnos del Curso</h3>";
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #4CAF50; color: white;'>
          <th>ID</th><th>Nombre Completo</th><th>Email</th><th>Edad</th><th>Nota</th><th>Estado</th><th>Fecha Matrícula</th>
          </tr>";
    
    // Mostrar los resultados
    while ($fila = $stmt->fetch()) {
        $estado = $fila['activo'] ? '✅ Activo' : '❌ Inactivo';
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['nombre'] . " " . $fila['apellidos'] . "</td>";
        echo "<td>" . $fila['email'] . "</td>";
        echo "<td>" . $fila['edad'] . "</td>";
        echo "<td>" . $fila['nota'] . "</td>";
        echo "<td>" . $estado . "</td>";
        echo "<td>" . $fila['fecha_matricula'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch(PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}

// Cerrar la conexión
$conexion = null;
?>
