<?php
/**
 * Introducir datos en una tabla "INSERT INTO" con PDO y try-catch
 * Con seguridad usando prepared statements - Insertar alumno en curso
 */

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Eliminar todos los registros existentes
    $conexion->exec("DELETE FROM curso");

    // Insertar los alumnos especificados
    $alumnos = [
        ["Pablo", "Sevillano", "pablo@sevillano.es", 21, 9.2, 1],
        ["Alejandro", "Pacheco", "alejandro@pacheco.es", 22, 8.7, 1],
        ["Alejandro", "Malpelo", "alejandro@malpelo.es", 20, 7.5, 1],
        ["David", "Bermejo", "david@bermejo.es", 23, 8.0, 1],
        ["Sandra", "Garcia", "sandra@garcia.es", 21, 9.0, 1]
    ];

    foreach ($alumnos as $alumno) {
        $sql = "INSERT INTO curso (nombre, apellidos, email, edad, nota, activo) VALUES ('{$alumno[0]}', '{$alumno[1]}', '{$alumno[2]}', {$alumno[3]}, {$alumno[4]}, {$alumno[5]})";
        $conexion->exec($sql);
        echo "✅ Alumno insertado correctamente en el curso: {$alumno[0]} {$alumno[1]}<br>";
    }
    // Mostrar resumen
    echo "<br>Alumnos insertados: " . count($alumnos);
    
} catch(PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}

// Cerrar la conexión
$conexion = null;
?>
