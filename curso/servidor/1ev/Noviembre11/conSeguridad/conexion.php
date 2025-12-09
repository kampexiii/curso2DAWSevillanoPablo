<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conexión a la base de datos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
// Conexión a PHP-BBDD con seguridad usando PDO y try-catch
$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    // Configurar el modo de error de PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<div class='info-box' style='margin:40px auto;max-width:600px;'>Conectado exitosamente con PDO</div>";
} catch(PDOException $e) {
    echo "<div class='warning-box' style='margin:40px auto;max-width:600px;'>Conexión fallida: " . $e->getMessage() . "</div>";
}
?>
</body>
</html>
