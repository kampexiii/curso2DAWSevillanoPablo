<?php
/**
 * Plantilla base para páginas de operaciones CRUD
 * Contiene header, footer y estilos comunes
 */

// Configuración de la base de datos - igual en todas las páginas
$server = "localhost";
$user = "root";
$pass = "";
$db = "test";

// Función para mostrar el header
function mostrarHeader($titulo) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($titulo); ?> - Sistema de Gestión de Alumnos</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <script src="assets/js/scripts.js"></script>
    </head>

    <body>
        <!-- Cabecera -->
        <header>
            <div>
                <h1>🎓 Sistema de Gestión de Alumnos</h1>
                <span><?php echo htmlspecialchars($titulo); ?> - Pablo Sevillano Aparicio - 2º DAW</span>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="EjercicioBaseDatosSevillanoPablo.php" class="btn btn-primary">🏠 Volver al Inicio</a>
                <button class="btn-toggle-mode" onclick="toggleMode()">🌙/☀️</button>
            </div>
        </header>

        <!-- Contenedor principal -->
        <div class="container">
            <h1><?php echo htmlspecialchars($titulo); ?></h1>
    <?php
}

// Función para mostrar el footer
function mostrarFooter() {
    ?>
        </div>

        <!-- Footer -->
        <footer>
            <span>© 2025 Sistema de Gestión de Alumnos - Pablo Sevillano Aparicio - 2º DAW</span>
        </footer>

        <script src="assets/js/scripts.js"></script>
    </body>
    </html>
    <?php
}

// Función para conectar a la BD
function conectarBD() {
    global $server, $user, $pass, $db;
    try {
        $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        return false;
    }
}

// Función para validar consultas SQL y prevenir inyección maliciosa
function validarConsultaSQL($sql, $tipoOperacion) {
    $errores = [];

    // Verificar que no contenga URLs o scripts maliciosos
    if (preg_match('/https?:\/\//i', $sql)) {
        $errores[] = 'No se permiten URLs en la consulta SQL.';
    }

    if (preg_match('/<script/i', $sql)) {
        $errores[] = 'No se permiten scripts en la consulta SQL.';
    }

    if (preg_match('/javascript:/i', $sql)) {
        $errores[] = 'No se permite JavaScript en la consulta SQL.';
    }

    // Verificar el tipo de operación
    switch ($tipoOperacion) {
        case 'INSERT':
            if (!preg_match('/^INSERT\s+INTO\s+curso\s+/i', $sql)) {
                $errores[] = 'La consulta debe ser un INSERT INTO curso válido.';
            }
            $palabras_prohibidas = ['DROP', 'DELETE', 'UPDATE', 'ALTER', 'CREATE', 'TRUNCATE', 'EXEC', 'EXECUTE'];
            break;
        case 'UPDATE':
            if (!preg_match('/^UPDATE\s+curso\s+/i', $sql)) {
                $errores[] = 'La consulta debe ser un UPDATE curso válido.';
            }
            $palabras_prohibidas = ['DROP', 'DELETE', 'INSERT', 'ALTER', 'CREATE', 'TRUNCATE', 'EXEC', 'EXECUTE'];
            break;
        case 'DELETE':
            if (!preg_match('/^DELETE\s+FROM\s+curso\s+/i', $sql)) {
                $errores[] = 'La consulta debe ser un DELETE FROM curso válido.';
            }
            $palabras_prohibidas = ['DROP', 'INSERT', 'UPDATE', 'ALTER', 'CREATE', 'TRUNCATE', 'EXEC', 'EXECUTE'];
            break;
        default:
            $errores[] = 'Tipo de operación no válido.';
            return $errores;
    }

    // Verificar que no contenga palabras peligrosas
    foreach ($palabras_prohibidas as $palabra) {
        if (preg_match('/\b' . $palabra . '\b/i', $sql)) {
            $errores[] = "No se permite la palabra '$palabra' en la consulta.";
            break;
        }
    }

    return $errores;
}

// Función para mostrar mensajes de resultado
function mostrarResultado($tipo, $mensaje, $detalles = "") {
    $clase = "info-box";
    $icono = "ℹ️";

    switch ($tipo) {
        case "success":
            $clase = "info-box";
            $icono = "✅";
            break;
        case "error":
            $clase = "warning-box";
            $icono = "❌";
            break;
        case "warning":
            $clase = "warning-box";
            $icono = "⚠️";
            break;
    }

    echo "<div class='$clase'>";
    echo "<h3>$icono $mensaje</h3>";
    if ($detalles) {
        echo "<p>$detalles</p>";
    }
    echo "</div>";
}
?>