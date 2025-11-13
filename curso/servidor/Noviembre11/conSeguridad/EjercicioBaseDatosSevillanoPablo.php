<?php
/**
 * Sistema de gestión de alumnos
 * Aplicación web con operaciones CRUD sobre base de datos MySQL
 * Incluye control de conexión y panel de operaciones
 */

// Inicio de sesión para control de estado
session_start();

// Configuración de base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "test";

// Control de conexión a BD
if (!isset($_SESSION['conexion_on'])) {
    $_SESSION['conexion_on'] = true;
}

// Procesamiento de parámetros de conexión
if (isset($_GET['conexion'])) {
    if ($_GET['conexion'] === 'off') {
        $_SESSION['conexion_on'] = false;
    } elseif ($_GET['conexion'] === 'on') {
        $_SESSION['conexion_on'] = true;
    }
}

// Verificación de conexión a BD
$conexion_ok = false;
if ($_SESSION['conexion_on']) {
    try {
        $conexion_test = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $conexion_test->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion_ok = true;
    } catch (PDOException $e) {
        $conexion_ok = false;
        error_log("Error de conexión: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Alumnos - Sevillano Pablo</title>
    <!-- Enlazo el CSS externo  -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- JavaScript  -->
    <script src="assets/js/scripts.js"></script>
</head>

<body>
    <!-- Cabecera con el título y los controles -->
    <header>
        <div>
            <h1>🎓 Sistema de Gestión de Alumnos</h1>
            <span>Desarrollado por Pablo Sevillano Aparicio - 2º DAW</span>
        </div>
        <div style="display: flex; align-items: center; gap: 12px;">
            <?php
            // Aquí muestro el indicador de conexión según el estado
            // Lo hice con colores para que se vea rápido si está conectado o no
            if ($_SESSION['conexion_on']) {
                if ($conexion_ok) {
                    // Conectado y BD OK - muestro verde
                    echo '<span class="status-indicator status-ok" title="Conexión OK"></span>';
                    echo '<span class="status-text">Conexión con BD "' . htmlspecialchars($db) . '" establecida</span>';
                    echo '<button onclick="cambiarConexion(\'off\')" class="btn btn-danger">Desconectar</button>';
                } else {
                    // Conectado pero BD falla - muestro rojo
                    echo '<span class="status-indicator status-error" title="Sin conexión"></span>';
                    echo '<span class="status-text status-error-text">Sin conexión con BD "' . htmlspecialchars($db) . '"</span>';
                    echo '<button onclick="cambiarConexion(\'off\')" class="btn btn-danger">Desconectar</button>';
                }
            } else {
                // Desconectado manualmente - muestro gris
                echo '<span class="status-indicator status-off" title="Conexión desactivada"></span>';
                echo '<span class="status-text status-off-text">Conexión desactivada</span>';
                echo '<button onclick="cambiarConexion(\'on\')" class="btn btn-success">Conectar</button>';
            }
            ?>
            <!-- Botón del modo oscuro/claro -->
            <button class="btn-toggle-mode" onclick="toggleMode()">🌙/☀️</button>
        </div>
    </header>

    <!-- Información del sistema -->
    <div class="info-box">
        <strong>🎓 Sistema de Gestión de Alumnos</strong><br>
        Utiliza los botones para ejecutar operaciones CRUD sobre la base de datos <code><?php echo htmlspecialchars($db); ?></code> y la tabla <code>curso</code>.
    </div>

    <!-- Layout principal - diseño centrado para mejor visualización -->
    <div class="main-content">

    <!-- Panel de operaciones -->
    <div class="container">
        <h2>⚙️ Panel de Operaciones</h2>
        <div class="button-container">
            <?php if ($_SESSION['conexion_on']): ?>
            <a href="crear_bd.php" class="btn btn-create">🗄️ Crear Base de Datos</a>
            <a href="crear_tabla.php" class="btn btn-create">➕ Crear Tabla</a>
            <a href="borrar_tabla.php" class="btn btn-drop">🗑️ Borrar Tabla</a>
            <a href="borrar_alumno.php" class="btn btn-drop">❌ Borrar Alumno por ID</a>
            <a href="editar_alumno.php" class="btn btn-update">✏️ Editar Alumno por ID</a>
            <a href="crear_alumno.php" class="btn btn-insert">📝 Crear Alumno</a>
            <button class="btn btn-select" onclick="location.reload()">🔄 Mostrar Tabla Actualizada</button>
            <?php else: ?>
            <div class="info-box">
                <p>🔌 <strong>Operaciones no disponibles</strong></p>
                <p>Las operaciones de base de datos están desactivadas. Reactiva la conexión para poder usar estas funciones.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    // Estado actual de la base de datos y tabla
    echo "<div class='container'>";
    echo "<h2>📊 Estado Actual de la Base de Datos</h2>";

    if ($_SESSION['conexion_on']) {
        try {
            $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verificar existencia de tabla
            $sql = "SHOW TABLES LIKE 'curso'";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $tabla_existe = $stmt->rowCount() > 0;

            if ($tabla_existe) {
                echo "<div class='info-box'>✅ <strong>Tabla 'curso' existe</strong></div>";

                // Contar alumnos
                $sql_count = "SELECT COUNT(*) as total FROM curso";
                $stmt_count = $conexion->prepare($sql_count);
                $stmt_count->execute();
                $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
                $total = $row_count ? $row_count['total'] : 0;
                echo "<p><strong>Total de alumnos:</strong> $total</p>";

                if ($total > 0) {
                    echo "<h3>👥 Listado de Alumnos</h3>";
                    echo "<table>";
                    echo "<tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Edad</th>
                            <th>Nota</th>
                            <th>Activo</th>
                            <th>Fecha Matrícula</th>
                          </tr>";

                    // Obtener alumnos ordenados
                    $sql_select = "SELECT * FROM curso ORDER BY apellidos, nombre";
                    $stmt_select = $conexion->prepare($sql_select);
                    $stmt_select->execute();

                    $rowIndex = 0;
                    while ($fila = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
                        $rowIndex++;
                        $bg = ($rowIndex % 2 == 0) ? "even" : "odd";
                        $estado = $fila['activo'] ? '<span class="status-active">✔ Activo</span>' : '<span class="status-inactive">✖ Inactivo</span>';
                        echo "<tr class='$bg'>";
                        echo "<td>" . htmlspecialchars($fila['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['apellidos']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['edad']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nota']) . "</td>";
                        echo "<td style='text-align: center;'>" . $estado . "</td>";
                        echo "<td>" . htmlspecialchars($fila['fecha_matricula']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='warning-box'>⚠️ La tabla existe pero está <strong>vacía</strong>. Usa el botón <strong>Crear Alumno</strong> para añadir datos.</div>";
                }
            } else {
                echo "<div class='warning-box'>⚠️ <strong>La tabla 'curso' no existe</strong><br>Usa el botón <strong>Crear Tabla</strong> para crearla.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='warning-box'>⚠️ <strong>Error de conexión</strong><br>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
        }

        $conexion = null;
    } else {
        echo "<div class='info-box'>🔌 <strong>Conexión desactivada</strong><br>La conexión con la base de datos está desactivada. Haz clic en <strong>Conectar</strong> para reactivarla.</div>";
    }
    echo "</div>";
    ?>
    </div>

    <!-- Footer -->
    <footer>
        <span>© 2025 Sistema de Gestión de Alumnos - Pablo Sevillano Aparicio - 2º DAW</span>
    </footer>
</body>
</html>