<?php
/**
 * Actualizar una tabla "UPDATE" con PDO y try-catch
 * Con seguridad - Actualizar notas de alumnos con email de gmail
 */

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Actualizar notas de alumnos con email de gmail (sumarles 1 punto extra)
    $sql = "UPDATE curso 
        SET nota = nota + 1.0
        WHERE INSTR(LCASE(email), 'gmail.com') > 0 AND nota <= 9.0";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $cantidad = $stmt->rowCount();
    echo "✅ Se han actualizado las notas de $cantidad alumnos con email de Gmail<br>";
    echo "Se les ha sumado 1 punto extra por usar Gmail";

    // Añadir a Marcos Rozalen
    $sqlInsert = "INSERT INTO curso (nombre, apellidos, email, edad, nota, activo) VALUES ('Marcos', 'Rozalen', 'marcos@rozalen.es', 24, 8.8, 1)";
    $conexion->exec($sqlInsert);
    echo "<br>✅ Alumno añadido: Marcos Rozalen";
    
} catch(PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}

// Cerrar la conexión
$conexion = null;
?>
