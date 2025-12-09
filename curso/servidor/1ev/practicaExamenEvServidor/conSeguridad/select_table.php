<?php
session_start();
/*
 * Lista los alumnos de la tabla curso en la BD activa (opcional, no obligatorio para el menu).
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$db     = $_SESSION['db_activa'] ?? null;

if (!$db) {
    die("No hay BD activa. Pulsa Conectar antes de listar alumnos.");
}

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // CAMBIA SELECT y columnas al nombre de tabla/campos que tengas
    $sql = "SELECT * FROM curso ORDER BY apellidos, nombre";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    echo "<h3>Listado de Alumnos del Curso ($db)</h3>";
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #4CAF50; color: white;'>
          <th>ID</th><th>Nombre Completo</th><th>Email</th><th>Edad</th><th>Nota</th><th>Estado</th><th>Fecha Matricula</th>
          </tr>";
    
    while ($fila = $stmt->fetch()) {
        $estado = $fila['activo'] ? 'Activo' : 'Inactivo';
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
    die("Error: " . $e->getMessage());
}

$conexion = null;
?>
