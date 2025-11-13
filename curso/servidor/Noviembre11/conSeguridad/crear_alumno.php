<?php
// ===========================================
// Página para crear un nuevo alumno
// ===========================================
// Página dedicada a la creación de nuevos alumnos en la tabla 'curso'
// Incluye formulario con validaciones de seguridad y ejemplo de consulta SQL

include 'funciones_bd.php'; // Funciones comunes del sistema

mostrarHeader("Crear Alumno");

// Si se envió el formulario, procesamos la creación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql_query'])) {
    $sql_query = trim($_POST['sql_query']);

    // Validaciones de seguridad usando la función común
    $errores = validarConsultaSQL($sql_query, 'INSERT');

    if (count($errores) > 0) {
        mostrarResultado('error', 'Error de validación', implode(' ', $errores));
    } else {
        try {
            // Conectamos con la base de datos usando PDO
            $conexion = conectarBD();
            // Ejecutamos la consulta SQL proporcionada por el usuario
            $stmt = $conexion->prepare($sql_query);
            $stmt->execute();

            // Obtenemos el ID del nuevo alumno insertado
            $nuevoId = $conexion->lastInsertId();
            mostrarResultado('success', 'Alumno creado', "Alumno creado correctamente con ID: $nuevoId.");
        } catch (PDOException $e) {
            mostrarResultado('error', 'Error al crear alumno', "Error al ejecutar la consulta: " . $e->getMessage());
        }
    }
}
?>

<div class="container">
    <h2>Crear Nuevo Alumno</h2>
    <p>Escribe la consulta SQL INSERT para crear un nuevo alumno en la tabla 'curso'.</p>

    <form method="POST" action="">
        <div class="form-group">
            <label for="sql_query">Consulta SQL:</label>
            <textarea id="sql_query" name="sql_query" rows="6" required
                      placeholder="Escribe aquí tu consulta SQL INSERT..."></textarea>
        </div>

        <button type="submit" class="btn">Crear Alumno</button>
    </form>

    <h3>Ejemplo del Script SQL que puedes usar:</h3>
    <div class="code-example">
        <pre><code>INSERT INTO curso (nombre, apellidos, email, edad, nota, activo)
VALUES ('Sandra', 'García Almeida', 'sandra.garcia@email.com', 35, 8.5, 1);</code></pre>
    </div>

    <div class="info-box">
        <h3>ℹ️ Información importante:</h3>
        <ul>
            <li>La consulta debe ser un <code>INSERT INTO curso</code></li>
            <li>No se permiten URLs, scripts o JavaScript</li>
            <li>No se permiten operaciones peligrosas como DROP, DELETE, etc.</li>
            <li>Los valores deben estar correctamente escapados</li>
            <li>El campo <code>fecha_matricula</code> se establece automáticamente</li>
        </ul>
    </div>

    <p><a href="EjercicioBaseDatosSevillanoPablo.php" class="btn-link">← Volver al panel principal</a></p>
</div>

<?php
mostrarFooter();
?>
