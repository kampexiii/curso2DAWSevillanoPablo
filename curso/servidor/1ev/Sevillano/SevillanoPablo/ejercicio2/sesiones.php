<?php
require __DIR__ . '/conexion.php';
requireLogin();

$contador = getSessionCount();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sesiones iniciadas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="layout">
        <div class="actions">
            <a href="cine.php">Volver</a>
            <a href="logout.php">Cerrar sesión</a>
        </div>
        <h1>Sesiones iniciadas</h1>
        <div class="card"> <!-- Mostrar contador de sesiones -->
            <p>Total de sesiones iniciadas en esta sesión de usuario: <strong><?= (int)$contador ?></strong></p>
        </div>
    </div>
</body>

</html>
