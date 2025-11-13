<?php
/**
 * Página para borrar la tabla curso
 * Permite eliminar la tabla de alumnos con confirmación y ejemplo del script
 */

require_once 'funciones_bd.php';

// Procesar el formulario si se envió
$mensaje = "";
if (isset($_POST['borrar_tabla'])) {
    $conexion = conectarBD();
    if ($conexion) {
        try {
            // Verificar si la tabla existe antes de borrarla
            $sql_check = "SHOW TABLES LIKE 'curso'";
            $stmt = $conexion->prepare($sql_check);
            $stmt->execute();
            $existe = $stmt->rowCount() > 0;

            if ($existe) {
                // Borrar la tabla
                $sql = "DROP TABLE curso";
                $conexion->exec($sql);
                $mensaje = "success";
                $detalles = "Tabla 'curso' eliminada correctamente. Todos los datos se han perdido permanentemente.";
            } else {
                $mensaje = "warning";
                $detalles = "La tabla 'curso' no existe, por lo que no se puede borrar.";
            }

        } catch (PDOException $e) {
            $mensaje = "error";
            $detalles = "Error al borrar la tabla: " . htmlspecialchars($e->getMessage());
        }
    } else {
        $mensaje = "error";
        $detalles = "No se pudo conectar a la base de datos '$db'.";
    }
}

// Mostrar la página
mostrarHeader("Borrar Tabla");
?>

<div class="info-box">
    <p><strong>🗑️ Borrar Tabla 'curso'</strong></p>
    <p>Esta operación elimina completamente la tabla de alumnos y todos sus datos. <strong>¡Esta acción no se puede deshacer!</strong></p>
</div>

<!-- Ejemplo del script -->
<div class="info-box">
    <h3>📝 Ejemplo del Script PHP:</h3>
    <pre><code>&lt;?php
// Conectar a la base de datos
$conexion = new PDO("mysql:host=localhost;dbname=test", "root", "");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Borrar la tabla si existe
$sql = "DROP TABLE IF EXISTS curso";
$conexion->exec($sql);

echo "✅ Tabla 'curso' borrada correctamente";
?&gt;</code></pre>
</div>

<!-- Formulario para ejecutar la operación -->
<form method="POST" action="" onsubmit="return confirm('¿Estás seguro de que quieres borrar la tabla \'curso\'? Se perderán todos los datos permanentemente.');">
    <div class="warning-box">
        <h3>⚠️ ¡Advertencia!</h3>
        <p>Esta operación eliminará:</p>
        <ul>
            <li>La tabla 'curso' completa</li>
            <li>Todos los alumnos registrados</li>
            <li>Todas las notas y datos asociados</li>
        </ul>
        <p><strong>Esta acción es irreversible.</strong></p>
    </div>

    <div class="info-box">
        <h3>🔍 Verificación previa:</h3>
        <p>Antes de borrar, el sistema verifica que la tabla existe.</p>
        <p>Si la tabla no existe, se muestra un mensaje informativo.</p>
    </div>

    <button type="submit" name="borrar_tabla" class="btn btn-danger">
        🗑️ Borrar Tabla "curso" (Irreversible)
    </button>
</form>

<?php
// Mostrar resultado si se ejecutó la operación
if ($mensaje) {
    $titulo = "";
    if ($mensaje === "success") $titulo = "Tabla borrada";
    elseif ($mensaje === "warning") $titulo = "Tabla no existe";
    else $titulo = "Error al borrar tabla";

    mostrarResultado($mensaje, $titulo, $detalles);
}
?>

<div class="info-box">
    <h3>ℹ️ Información:</h3>
    <ul>
        <li>Se verifica que la tabla existe antes de intentar borrarla</li>
        <li>Si la tabla no existe, no se produce ningún error</li>
        <li>Esta operación elimina todos los datos permanentemente</li>
        <li>Después de borrar, necesitarás crear la tabla nuevamente para poder añadir alumnos</li>
    </ul>
</div>

<?php
mostrarFooter();
?>
