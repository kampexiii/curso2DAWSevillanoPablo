<?php
session_start();
/*
 * Lista los productos de la tabla producto en la BD.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "producto";
$db     = $_SESSION['db_activa'] ?? null;

if (!$db) { // No hay BD activa
    die("No hay BD activa. Pulsa Conectar antes de listar productos.");
}

try { // Conexión a la BD
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM $table ORDER BY nombre";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "<h3>Listado de productos ($db)</h3>";
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #4CAF50; color: white;'>
          <th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th>
          </tr>";

    while ($fila = $stmt->fetch()) { // Recorre los resultados
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
        echo "<td>" . number_format((float)$fila['precio'], 2) . "</td>";
        echo "<td>" . (int)$fila['cant'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) { // Error en la conexión o consulta
    die("Error: " . $e->getMessage());
}

$conexion = null;
