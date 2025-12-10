<?php
// ===========================================
// Página para editar los datos de un alumno
// ===========================================
// Página dedicada a la edición de datos de alumnos por ID
// Incluye formulario con validaciones de seguridad y ejemplo de consulta SQL

include 'funciones_bd.php'; // Funciones comunes del sistema

mostrarHeader("Editar Alumno");

// Si se envió el formulario, procesamos la edición
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql_query'])) {
    $sql_query = trim($_POST['sql_query']);

    // Validaciones de seguridad usando la función común
    $errores = validarConsultaSQL($sql_query, 'UPDATE');

    if (count($errores) > 0) {
        mostrarResultado('error', 'Error de validación', implode(' ', $errores));
    } else {
        try {
            // Conectamos con la base de datos usando PDO
            $conexion = conectarBD();
            // Ejecutamos la consulta SQL proporcionada por el usuario
            $stmt = $conexion->prepare($sql_query);
            $stmt->execute();
            // Comprobamos si se actualizó algún registro
            if ($stmt->rowCount() > 0) {
                mostrarResultado('success', 'Alumno actualizado', "Datos del alumno actualizados correctamente.");
            } else {
                mostrarResultado('warning', 'Sin cambios', "No existe alumno con ese ID o no se realizaron cambios.");
            }
        } catch (PDOException $e) {
            mostrarResultado('error', 'Error al actualizar', "Error al ejecutar la consulta: " . $e->getMessage());
        }
    }
}
?>

<div class="container">
    <h2>Editar Datos de un Alumno</h2>
    <p>Escribe la consulta SQL UPDATE para modificar los datos de un alumno existente en la tabla 'curso'.</p>

    <form method="POST" action="">
        <div class="form-group">
            <label for="sql_query">Consulta SQL:</label>
            <textarea id="sql_query" name="sql_query" rows="6" required
                      placeholder="Escribe aquí tu consulta SQL UPDATE..."></textarea>
        </div>

        <button type="submit" class="btn">Actualizar Alumno</button>
    </form>

    <h3>Ejemplo del Script SQL que puedes usar:</h3>
    <div class="code-example">
        <pre><code>UPDATE curso SET nombre='Sandra', apellidos='García Almeida',
      email='sandra.garcia@email.com', edad=35, nota=8.5, activo=1
WHERE id=1;</code></pre>
    </div>

    <div class="info-box">
        <h3>ℹ️ Información importante:</h3>
        <ul>
            <li>La consulta debe ser un <code>UPDATE curso</code></li>
            <li>Incluye siempre la condición <code>WHERE id=...</code> para especificar qué alumno editar</li>
            <li>No se permiten URLs, scripts o JavaScript</li>
            <li>No se permiten operaciones peligrosas como DROP, DELETE, etc.</li>
            <li>Los valores deben estar correctamente escapados</li>
        </ul>
    </div>

    <p><a href="EjercicioBaseDatosSevillanoPablo.php" class="btn-link">← Volver al panel principal</a></p>
</div>

<?php
mostrarFooter();
?>
