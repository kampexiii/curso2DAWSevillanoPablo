<?php
session_start();
/**
 * Crea la tabla (drop + create).
 * - Requiere BD activa en sesion.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "producto";  // Nombre de tabla
$db     = $_SESSION['db_activa'] ?? null;

if (!$db) {
    die("No hay BD activa. Pulsa Crear BD y Conectar antes de crear la tabla.");
}

try { // Conexión a la BD
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si existe, la elimina para recrearla limpia
    $conexion->exec("DROP TABLE IF EXISTS $table");

    // Con esto creamos la tabla 'producto'
    $sql = "CREATE TABLE $table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        precio DECIMAL(6,2) UNSIGNED NOT NULL,
        cant INT UNSIGNED NOT NULL
    )";
    try { // Intentar crear la tabla
        $conexion->exec($sql);
        echo "Tabla '$table' recreada (drop + create) en '$db'" . "<br>";
        echo "Estructura: id, nombre, precio, cant";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'already exists') !== false || strpos($e->getMessage(), 'existente') !== false) {
            echo "La tabla '$table' ya existe en '$db'. No se ha modificado." . "<br>";
        } else {
            throw $e;
        }
    }
} catch (PDOException $e) { // Error en la conexión o consulta
    die("Error: " . $e->getMessage());
}

$conexion = null; // Cerrar conexión
