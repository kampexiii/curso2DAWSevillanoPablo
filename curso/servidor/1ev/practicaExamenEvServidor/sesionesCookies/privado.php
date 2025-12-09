<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión, redirigir al login
    header("Location: login.php?redirigido=1");
    exit;
}

// Obtengo el usuario de la sesión
$usuario_actual = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Privada - Examen Sesiones y Cookies</title>
    <!-- Enlace al archivo CSS externo para los estilos -->
    <link rel="stylesheet" href="estilos_privado.css">
</head>

<body>
    <div class="container">
        <h1>Zona Privada</h1>

        <!-- Contenido principal: bienvenida del usuario -->
        <div class="contenido">
            <p>
                <strong>
                    Bienvenido, <?php echo htmlspecialchars($usuario_actual); ?>
                </strong>
            </p>
            <p>Esta es una zona privada solo para usuarios autenticados.</p>
        </div>

        <?php
        // Si existe la cookie de recordación, la muestro
        if (isset($_COOKIE['usuarioRecordado'])) {
            echo "<div class='info-cookie'>";
            echo "<p>";
            echo "Te tengo guardado en la cookie como: <strong>";
            echo htmlspecialchars($_COOKIE['usuarioRecordado']);
            echo "</strong>";
            echo "</p>";
            echo "</div>";
        }
        ?>

        <!-- Enlace para cerrar sesión -->
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>

</html>