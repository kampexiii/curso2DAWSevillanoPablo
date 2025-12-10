<?php
/**
 * Crear una tabla "CREATE TABLE" con PDO y try-catch
 * Con seguridad - CRUD de alumnos en curso
 */

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Intentar crear la tabla
    $sql = "CREATE TABLE curso (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            apellidos VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            edad INT(3),
            nota DECIMAL(4,2),
            activo TINYINT(1) DEFAULT 1,
            fecha_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    try {
        $conexion->exec($sql);
        echo "✅ Tabla 'curso' creada correctamente<br>";
        echo "Estructura: id, nombre, apellidos, email, edad, nota, activo, fecha_matricula";
    } catch (PDOException $e) {
        // Si el error es que la tabla ya existe
        if (strpos($e->getMessage(), 'already exists') !== false || strpos($e->getMessage(), 'existente') !== false) {
            echo "⚠️ La tabla 'curso' ya existe. No se ha modificado.<br>";
        } else {
            throw $e;
        }
    }
} catch(PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}

// Cerrar la conexión
$conexion = null;
?>
