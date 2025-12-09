<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Examen Sesiones y Cookies</title>
    <!-- Enlace al archivo CSS externo para los estilos -->
    <link rel="stylesheet" href="estilos_login.css">
</head>

<body>
    <div class="container">
        <h1>Login - Examen Sesiones y Cookies</h1>

        <?php
        // Mostrar mensaje de error si existe
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<p class='mensaje-error'>Usuario o contraseña incorrectos.</p>";
        }

        // Mostrar mensaje si fue redirigido por falta de sesión
        if (isset($_GET['redirigido']) && $_GET['redirigido'] == 1) {
            echo "<p class='mensaje-info'>Debes iniciar sesión para acceder a la zona privada.</p>";
        }
        ?>

        <!-- Formulario de login -->
        <form method="POST" action="procesar_login.php">

            <!-- Campo de usuario -->
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required
                    <?php
                    // Si hay cookie, relleno el campo automáticamente
                    if (isset($_COOKIE['usuarioRecordado'])) {
                        echo "value='" . htmlspecialchars($_COOKIE['usuarioRecordado']) . "'";
                    }
                    ?>>
            </div>

            <!-- Campo de contraseña -->
            <div class="form-group">
                <label for="clave">Contraseña:</label>
                <input type="password" id="clave" name="clave" required>
            </div>

            <!-- Checkbox para recordar usuario -->
            <div class="checkbox-group">
                <input type="checkbox" id="recordar" name="recordar" value="1">
                <label for="recordar" style="display: inline; font-weight: normal;">Recordar usuario</label>
            </div>

            <!-- Botón de envío del formulario -->
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>

</html>