<?php
session_start();
/**
 * Crea la tabla (drop + create).
 * - Cambia el nombre de la tabla y las columnas segun el enunciado.
 * - Requiere BD activa en sesion.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$db     = $_SESSION['db_activa'] ?? null;

if (!$db) {
    die("No hay BD activa. Pulsa Crear BD y Conectar antes de crear la tabla.");
}

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si existe, la elimina para recrearla limpia (lo que piden)
    $conexion->exec("DROP TABLE IF EXISTS curso");

    // CAMBIA la siguiente definicion a la tabla que pidan:
    //  - Cambia el nombre 'curso' por el nombre de tabla que pida el examen
    //  - Ajusta las columnas a las que indiquen (tipos, longitudes, constraints)
    // Ejemplo para tabla aula(id, nombre, capacidad, edificio):
    // $sql = "CREATE TABLE aula (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     nombre VARCHAR(100) NOT NULL,
    //     capacidad INT,
    //     edificio VARCHAR(50)
    // )";
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
        echo "Tabla 'curso' recreada (drop + create) en '$db'" . "<br>";
        echo "Estructura: id, nombre, apellidos, email, edad, nota, activo, fecha_matricula";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'already exists') !== false || strpos($e->getMessage(), 'existente') !== false) {
            echo "La tabla 'curso' ya existe en '$db'. No se ha modificado." . "<br>";
        } else {
            throw $e;
        }
    }
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}

$conexion = null;
?>
