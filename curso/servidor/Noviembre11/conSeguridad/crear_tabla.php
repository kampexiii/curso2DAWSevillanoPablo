<?php
/**
 * Página para crear la tabla curso
 * Permite crear la tabla de alumnos con formulario y ejemplo del script
 */

require_once 'funciones_bd.php';

// Procesar el formulario si se envió
$mensaje = "";
if (isset($_POST['crear_tabla'])) {
    $conexion = conectarBD();
    if ($conexion) {
        try {
            // Crear la tabla curso
            $sql = "CREATE TABLE curso (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    apellidos VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    edad INT(3),
                    nota DECIMAL(4,2),
                    activo TINYINT(1) DEFAULT 1,
                    fecha_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";

            $conexion->exec($sql);
            $mensaje = "success";
            $detalles = "Tabla 'curso' creada correctamente con todos los campos necesarios.";

        } catch (PDOException $e) {
            // Verificar si la tabla ya existe
            if (strpos($e->getMessage(), 'already exists') !== false ||
                strpos($e->getMessage(), 'Table \'curso\' already exists') !== false) {
                $mensaje = "warning";
                $detalles = "La tabla 'curso' ya existe. No se ha modificado.";
            } else {
                $mensaje = "error";
                $detalles = "Error al crear la tabla: " . htmlspecialchars($e->getMessage());
            }
        }
    } else {
        $mensaje = "error";
        $detalles = "No se pudo conectar a la base de datos '$db'.";
    }
}

// Mostrar la página
mostrarHeader("Crear Tabla");
?>

<div class="info-box">
    <p><strong>➕ Crear Tabla 'curso'</strong></p>
    <p>Esta operación crea la tabla de alumnos con todos los campos necesarios para el sistema.</p>
</div>

<!-- Ejemplo del script -->
<div class="info-box">
    <h3>📝 Ejemplo del Script PHP:</h3>
    <pre><code>&lt;?php
// Conectar a la base de datos
$conexion = new PDO("mysql:host=localhost;dbname=test", "root", "");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Crear la tabla curso
$sql = "CREATE TABLE curso (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        apellidos VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        edad INT(3),
        nota DECIMAL(4,2),
        activo TINYINT(1) DEFAULT 1,
        fecha_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

$conexion->exec($sql);
echo "✅ Tabla 'curso' creada correctamente";
?&gt;</code></pre>
</div>

<!-- Formulario para ejecutar la operación -->
<form method="POST" action="">
    <div class="info-box">
        <h3>📋 Estructura de la Tabla:</h3>
        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <th>Campo</th>
                <th>Tipo</th>
                <th>Descripción</th>
            </tr>
            <tr>
                <td><code>id</code></td>
                <td>INT AUTO_INCREMENT PRIMARY KEY</td>
                <td>ID único del alumno</td>
            </tr>
            <tr>
                <td><code>nombre</code></td>
                <td>VARCHAR(100) NOT NULL</td>
                <td>Nombre del alumno</td>
            </tr>
            <tr>
                <td><code>apellidos</code></td>
                <td>VARCHAR(100) NOT NULL</td>
                <td>Apellidos del alumno</td>
            </tr>
            <tr>
                <td><code>email</code></td>
                <td>VARCHAR(100) NOT NULL</td>
                <td>Email del alumno</td>
            </tr>
            <tr>
                <td><code>edad</code></td>
                <td>INT(3)</td>
                <td>Edad del alumno</td>
            </tr>
            <tr>
                <td><code>nota</code></td>
                <td>DECIMAL(4,2)</td>
                <td>Nota del alumno</td>
            </tr>
            <tr>
                <td><code>activo</code></td>
                <td>TINYINT(1) DEFAULT 1</td>
                <td>Estado del alumno (1=activo, 0=inactivo)</td>
            </tr>
            <tr>
                <td><code>fecha_matricula</code></td>
                <td>TIMESTAMP DEFAULT CURRENT_TIMESTAMP</td>
                <td>Fecha de matrícula automática</td>
            </tr>
        </table>
    </div>

    <button type="submit" name="crear_tabla" class="btn btn-primary">
        🚀 Crear Tabla "curso"
    </button>
</form>

<?php
// Mostrar resultado si se ejecutó la operación
if ($mensaje) {
    $titulo = "";
    if ($mensaje === "success") $titulo = "Tabla creada";
    elseif ($mensaje === "warning") $titulo = "Tabla ya existe";
    else $titulo = "Error al crear tabla";

    mostrarResultado($mensaje, $titulo, $detalles);
}
?>

<div class="info-box">
    <h3>ℹ️ Información:</h3>
    <ul>
        <li>La tabla se crea solo si no existe previamente</li>
        <li>El campo <code>id</code> es la clave primaria con auto-incremento</li>
        <li>Los campos <code>nombre</code>, <code>apellidos</code> y <code>email</code> son obligatorios</li>
        <li>El campo <code>activo</code> por defecto es 1 (activo)</li>
        <li>La <code>fecha_matricula</code> se establece automáticamente</li>
    </ul>
</div>

<?php
mostrarFooter();
?>
