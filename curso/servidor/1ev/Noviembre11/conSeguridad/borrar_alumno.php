<?php
/**
 * Página para borrar un alumno por ID
 * Permite eliminar un alumno específico con formulario y validación
 */

require_once 'funciones_bd.php';

// Procesar el formulario si se envió
$mensaje = "";
$alumno_info = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql_query'])) {
    $sql_query = trim($_POST['sql_query']);

    // Validaciones de seguridad usando la función común
    $errores = validarConsultaSQL($sql_query, 'DELETE');

    if (count($errores) > 0) {
        $mensaje = "error";
        $detalles = implode(' ', $errores);
    } else {
        $conexion = conectarBD();
        if ($conexion) {
            try {
                // Ejecutar la consulta SQL proporcionada por el usuario
                $stmt = $conexion->prepare($sql_query);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $mensaje = "success";
                    $detalles = "Alumno(s) eliminado(s) correctamente. Filas afectadas: " . $stmt->rowCount();
                } else {
                    $mensaje = "warning";
                    $detalles = "No se encontraron alumnos que coincidan con los criterios especificados.";
                }

            } catch (PDOException $e) {
                $mensaje = "error";
                $detalles = "Error al ejecutar la consulta: " . htmlspecialchars($e->getMessage());
            }
        } else {
            $mensaje = "error";
            $detalles = "No se pudo conectar a la base de datos '$db'.";
        }
    }
}

// Mostrar la página
mostrarHeader("Borrar Alumno");
?>

<div class="info-box">
    <p><strong>❌ Borrar Alumno por ID</strong></p>
    <p>Esta operación elimina un alumno específico de la base de datos usando su ID único.</p>
</div>

<!-- Ejemplo del script -->
<div class="info-box">
    <h3>📝 Ejemplo del Script PHP:</h3>
    <pre><code>&lt;?php
// Conectar a la base de datos
$conexion = new PDO("mysql:host=localhost;dbname=test", "root", "");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ID del alumno a borrar
$id = 5; // Cambia este ID

// Preparar y ejecutar la consulta DELETE
$sql = "DELETE FROM curso WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);

// Verificar si se borró algo
if ($stmt->rowCount() > 0) {
    echo "✅ Alumno borrado correctamente";
} else {
    echo "⚠️ No existe alumno con ese ID";
}
?&gt;</code></pre>
</div>

<!-- Formulario para ejecutar la operación -->
<form method="POST" action="">
    <div class="form-group">
        <label for="sql_query">Consulta SQL:</label>
        <textarea id="sql_query" name="sql_query" rows="4" required
                  placeholder="Escribe aquí tu consulta SQL DELETE..."></textarea>
    </div>

    <div class="warning-box">
        <h3>⚠️ ¡Advertencia!</h3>
        <p>Esta operación eliminará permanentemente los alumnos que coincidan con los criterios.</p>
        <p>Asegúrate de que la consulta WHERE es correcta antes de confirmar.</p>
    </div>

    <button type="submit" class="btn btn-danger"
            onclick="return confirm('¿Estás seguro de que quieres ejecutar esta consulta DELETE?');">
        ❌ Ejecutar DELETE
    </button>
</form>

<?php
// Mostrar resultado si se ejecutó la operación
if ($mensaje) {
    $titulo = "";
    if ($mensaje === "success") $titulo = "Consulta ejecutada";
    elseif ($mensaje === "warning") $titulo = "No se encontraron registros";
    else $titulo = "Error en la consulta";

    mostrarResultado($mensaje, $titulo, $detalles);
}
?>

<h3>Ejemplo del Script SQL que puedes usar:</h3>
<div class="code-example">
    <pre><code>DELETE FROM curso WHERE id = 1;</code></pre>
</div>

<div class="info-box">
    <h3>ℹ️ Información importante:</h3>
    <ul>
        <li>La consulta debe ser un <code>DELETE FROM curso</code></li>
        <li>Incluye siempre una condición <code>WHERE</code> para evitar borrar todos los registros</li>
        <li>No se permiten URLs, scripts o JavaScript</li>
        <li>No se permiten operaciones peligrosas como DROP, INSERT, etc.</li>
        <li>Esta operación es irreversible</li>
    </ul>
</div>

<?php
mostrarFooter();
?>
