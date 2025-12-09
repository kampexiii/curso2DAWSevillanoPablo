<?php
/**
 * Página para crear la base de datos
 * Permite crear la BD especificada en la configuración con formulario y ejemplo
 */

require_once 'funciones_bd.php';

// Procesar el formulario si se envió
$mensaje = "";
if (isset($_POST['crear_bd'])) {
    try {
        // Conectar sin especificar BD para poder crearla
        $conexion = new PDO("mysql:host=$server", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Crear la base de datos con configuración UTF8
        $sql = "CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        $conexion->exec($sql);

        $mensaje = "success";
        $detalles = "Base de datos '$db' creada correctamente.";

    } catch (PDOException $e) {
        $mensaje = "error";
        $detalles = "Error al crear la base de datos: " . htmlspecialchars($e->getMessage());
    }
}

// Mostrar la página
mostrarHeader("Crear Base de Datos");
?>

<div class="info-box">
    <p><strong>🗄️ Crear Base de Datos</strong></p>
    <p>Esta operación crea la base de datos especificada en la configuración del sistema.</p>
</div>

<!-- Ejemplo del script -->
<div class="info-box">
    <h3>📝 Ejemplo del Script PHP:</h3>
    <pre><code>&lt;?php
// Configuración de conexión
$server = "localhost";
$user = "root";
$pass = "";

// Conectar al servidor MySQL (sin especificar BD)
$conexion = new PDO("mysql:host=$server", $user, $pass);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Crear la base de datos
$sql = "CREATE DATABASE IF NOT EXISTS `test`
        CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
$conexion->exec($sql);

echo "✅ Base de datos creada correctamente";
?&gt;</code></pre>
</div>

<!-- Formulario para ejecutar la operación -->
<form method="POST" action="">
    <div class="info-box">
        <h3>⚙️ Configuración Actual:</h3>
        <p><strong>Servidor:</strong> <?php echo htmlspecialchars($server); ?></p>
        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($user); ?></p>
        <p><strong>Base de datos a crear:</strong> <?php echo htmlspecialchars($db); ?></p>
    </div>

    <button type="submit" name="crear_bd" class="btn btn-primary">
        🚀 Crear Base de Datos "<?php echo htmlspecialchars($db); ?>"
    </button>
</form>

<?php
// Mostrar resultado si se ejecutó la operación
if ($mensaje) {
    mostrarResultado($mensaje, $mensaje === "success" ? "Base de datos creada" : "Error al crear base de datos", $detalles);
}
?>

<div class="info-box">
    <h3>ℹ️ Información:</h3>
    <ul>
        <li>Esta operación crea la base de datos si no existe</li>
        <li>Si la base de datos ya existe, no se modifica</li>
        <li>Se configura con charset UTF8MB4 para soporte completo de caracteres Unicode</li>
    </ul>
</div>

<?php
mostrarFooter();
?>
