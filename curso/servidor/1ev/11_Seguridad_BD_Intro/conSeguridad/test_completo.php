<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control CRUD - Curso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }
        h2 {
            color: #4CAF50;
            margin-top: 20px;
        }
        .button-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 20px 0;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .btn-create {
            background-color: #4CAF50;
            color: white;
        }
        .btn-insert {
            background-color: #2196F3;
            color: white;
        }
        .btn-select {
            background-color: #FF9800;
            color: white;
        }
        .btn-update {
            background-color: #9C27B0;
            color: white;
        }
        .btn-drop {
            background-color: #f44336;
            color: white;
        }
        .btn-refresh {
            background-color: #607D8B;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .info-box {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #2196F3;
            margin: 20px 0;
        }
        .warning-box {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }
        iframe {
            display: none;
        }
    </style>
    <script>
        function ejecutarOperacion(archivo) {
            // Ejecutar la operación en un iframe oculto
            document.getElementById('operacionFrame').src = archivo;
            
            // Esperar un momento y luego recargar los datos
            setTimeout(function() {
                location.reload();
            }, 500);
        }
    </script>
</head>
<body>
    <h1>🎛️ Panel de Control CRUD - Gestión de Alumnos</h1>
    <div class="info-box">
        <strong>📚 Sistema de Gestión de Alumnos en Curso</strong><br>
        Utiliza los botones para ejecutar operaciones CRUD sobre la tabla <code>curso</code>
    </div>

    <div class="container">
        <h2>🎛️ Panel de Operaciones</h2>
        <div class="button-container">
            <button class="btn btn-create" onclick="ejecutarOperacion('2_create_table.php')">
                ➕ CREATE TABLE
            </button>
            <button class="btn btn-insert" onclick="ejecutarOperacion('5_insert_into.php')">
                📝 INSERT (Añadir Alumno)
            </button>
            <button class="btn btn-select" onclick="location.reload()">
                🔄 REFRESH (Actualizar Vista)
            </button>
            <button class="btn btn-update" onclick="ejecutarOperacion('3_update_table.php')">
                ✏️ UPDATE (Actualizar Notas)
            </button>
            <button class="btn btn-drop" onclick="if(confirm('¿Seguro que quieres eliminar toda la tabla?')) ejecutarOperacion('4_drop_table.php')">
                🗑️ DROP TABLE
            </button>
        </div>
    </div>

<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "test";

echo "<div class='container'>";
echo "<h2>📊 Estado Actual de la Base de Datos</h2>";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si la tabla existe
    $sql = "SHOW TABLES LIKE 'curso'";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $tabla_existe = $stmt->rowCount() > 0;

    // Si se ha solicitado crear la tabla (por GET)
    if (isset($_GET['accion']) && $_GET['accion'] === 'create') {
        $sql_create = "CREATE TABLE curso (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            apellidos VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            edad INT(3),
            nota DECIMAL(4,2),
            activo TINYINT(1) DEFAULT 1,
            fecha_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        try {
            $conexion->exec($sql_create);
            echo "<div class='info-box'>✅ Tabla 'curso' creada correctamente.</div>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'already exists') !== false || strpos($e->getMessage(), 'existente') !== false) {
                echo "<div class='warning-box'>⚠️ La tabla 'curso' ya existe. No se ha modificado.</div>";
            } else {
                echo "<div class='warning-box'>❌ Error: " . $e->getMessage() . "</div>";
            }
        }
        // Actualizar estado
        $sql = "SHOW TABLES LIKE 'curso'";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $tabla_existe = $stmt->rowCount() > 0;
    }

    if ($tabla_existe) {
        echo "<div class='info-box'>";
        echo "✅ <strong>Tabla 'curso' existe</strong>";
        echo "</div>";

        // Mostrar el número de alumnos
        $sql_count = "SELECT COUNT(*) as total FROM curso";
        $stmt_count = $conexion->prepare($sql_count);
        $stmt_count->execute();
        $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
        $total = $row_count ? $row_count['total'] : 0;
        echo "<p><strong>Total de alumnos:</strong> $total</p>";

        // Mostrar la tabla de alumnos
        $sql_select = "SELECT * FROM curso ORDER BY apellidos, nombre";
        $stmt_select = $conexion->prepare($sql_select);
        $stmt_select->execute();
        $stmt_select->setFetchMode(PDO::FETCH_ASSOC);

        if ($total > 0) {
            echo "<h3>👥 Listado de Alumnos</h3>";
            echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
            echo "<tr style='background-color: #4CAF50; color: white;'>
                  <th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Edad</th><th>Nota</th><th>Activo</th><th>Fecha Matrícula</th>
                  </tr>";
            while ($fila = $stmt_select->fetch()) {
                $estado = $fila['activo'] ? '✅ Activo' : '❌ Inactivo';
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['apellidos']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
                echo "<td>" . $fila['edad'] . "</td>";
                echo "<td>" . $fila['nota'] . "</td>";
                echo "<td>" . $estado . "</td>";
                echo "<td>" . $fila['fecha_matricula'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='warning-box'>⚠️ La tabla existe pero está <strong>vacía</strong>. Usa el botón <strong>INSERT</strong> para añadir datos.</div>";
        }
    } else {
        echo "<div class='warning-box'>";
        echo "⚠️ <strong>La tabla 'curso' no existe</strong><br>";
        echo "Usa el botón <strong>CREATE TABLE</strong> para crearla.";
        echo "</div>";
    }
} catch(PDOException $e) {
    echo "<div class='warning-box'>";
    echo "⚠️ <strong>Base de datos 'test' no existe o no se puede conectar</strong><br>";
    echo "Error: " . $e->getMessage();
    echo "</div>";
}

$conexion = null;
echo "</div>";
?>

<iframe id="operacionFrame" name="operacionFrame"></iframe>

</body>
</html>
