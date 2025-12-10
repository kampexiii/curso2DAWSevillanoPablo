<?php
session_start();
/*
 * Insercion segura usando mysqli y bind_param()
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "producto";  // Nombre de tabla
$db     = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$detalle = "";
$error   = "";
$mysqli = null;

// Configuramos para que nos diga los errores de mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$db) {
    $error = "No hay BD activa. Pulsa Crear BD y Conectar en el menú antes de insertar.";
} else {
    try {
        // Conectamos con mysqli...
        $mysqli = new mysqli($server, $user, $pass, $db);
        
        // Miramos si la tabla esta o no...
        $result = $mysqli->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows === 0) {
            $error = "La tabla '$table' no existe en la BD '$db'. Crea la tabla antes de insertar.";
        }
    } catch (mysqli_sql_exception $e) {
        $error = "No se pudo conectar a la BD '$db'. Error: " . $e->getMessage();
    }
}

// Si le damos al boton y no hay fallos... procesamos
if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'simple') {
        // Ejemplo #1: INSERT prepara una vez, ejecuta una vez... lo basico
        try {
            // Consulta preparada, paso 1: Preparacion...
            $stmt = $mysqli->prepare("INSERT INTO $table (nombre, precio, cant) VALUES (?, ?, ?)");
            
            // Consulta preparada, paso 2: Enlaza los valores y ejecuta...
            $nombre = "Portátil X1";
            $precio = 799.99;
            $cantidad = 5;
            
            // "sdi" = string, double, integer
            $stmt->bind_param("sdi", $nombre, $precio, $cantidad);
            
            // Consulta preparada, paso 3: Ejecuta la consulta y listo
            $stmt->execute();
            
            $mensaje = "Inserción simple completada exitosamente.";
            $detalle = htmlspecialchars("$nombre - $precio euros - stock $cantidad uds");
            
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            $error = "Error en inserción simple: " . $e->getMessage();
        }
        
    } elseif ($modo === 'multiple') {
        // Ejemplo #2: INSERT prepara una vez y ejecuta varias veces mas eficiente
        try {
            // Consulta preparada, paso 1: Prepparacion
            $stmt = $mysqli->prepare("INSERT INTO $table (nombre, precio, cant) VALUES (?, ?, ?)");
            
            if (!$stmt) {
                throw new Exception("Fallo durante la preparación: (" . $mysqli->errno . ") " . $mysqli->error);
            }
            
            // Consulta preparada, paso 2: Enlaza variables
            $stmt->bind_param("sdi", $nombre, $precio, $cantidad);
            
            // Datos que vamos a meter
            $data = [
                ["nombre" => "Monitor 27\"", "precio" => 199.90, "cant" => 12],
                ["nombre" => "Ratón inalámbrico", "precio" => 24.50, "cant" => 30],
                ["nombre" => "Teclado mecánico", "precio" => 89.99, "cant" => 15]
            ];
            
            $insertados = 0;
            foreach ($data as $producto) {
                // Le damos valor a las variables enlazadas
                $nombre = $producto['nombre'];
                $precio = $producto['precio'];
                $cantidad = $producto['cant'];
                
                // Ejecutamos de nuevo con los nuevos datos
                $stmt->execute();
                $insertados++;
                
                $detalle .= htmlspecialchars("$nombre - $precio euros - stock $cantidad uds") . "<br>";
            }
            
            $mensaje = "Inserción múltiple completada. Registros insertados: $insertados";
            
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            $error = "Error en inserción múltiple: " . $e->getMessage();
        }
        
    } elseif ($modo === 'manual') {
        // Insercion manual con bind_param
        try {
            $nombre = trim($_POST['nombre'] ?? '');
            $precio = trim($_POST['precio'] ?? '');
            $cant   = trim($_POST['cant'] ?? '');

            $errores = [];
            if ($nombre === '') $errores[] = "Nombre obligatorio";
            if ($precio === '' || !is_numeric($precio) || $precio <= 0) {
                $errores[] = "Precio debe ser número > 0";
            }
            if ($cant === '' || !ctype_digit((string)$cant)) {
                $errores[] = "Cantidad debe ser entero >= 0";
            }

            if (empty($errores)) {
                // Preparamos la consulta con bind_param
                $stmt = $mysqli->prepare("INSERT INTO $table (nombre, precio, cant) VALUES (?, ?, ?)");
                
                // Convertimos los tipos para asegurar
                $precio = (float)$precio;
                $cant = (int)$cant;
                
                // "sdi" = string, double, integer
                $stmt->bind_param("sdi", $nombre, $precio, $cant);
                $stmt->execute();
                
                $mensaje = "Inserción manual OK (usando bind_param)";
                $detalle = htmlspecialchars("$nombre - $precio euros - stock $cant uds");
                
                $stmt->close();
            } else {
                $mensaje = "Errores: " . implode("; ", $errores);
            }
        } catch (mysqli_sql_exception $e) {
            $error = "Error en inserción manual: " . $e->getMessage();
        }
    }
}

// Cerramos al terminar
if ($mysqli) {
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar con bind_param() - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Insertar datos usando bind_param() (mysqli)</h1>
    <p><a href="menu.php" class="btn btn-refresh">Volver al menú</a></p>

    <div class="info-box">
        <strong>Protección contra inyección SQL</strong><br>
        Este ejemplo usa <code>mysqli</code> con <code>bind_param()</code> para insertar datos de forma segura.<br>
        <strong>Tipos de datos:</strong>
        <ul style="margin: 5px 0; padding-left: 20px;">
            <li><code>i</code> - integer (entero)</li>
            <li><code>d</code> - double (número decimal)</li>
            <li><code>s</code> - string (cadena de texto)</li>
            <li><code>b</code> - blob (datos binarios)</li>
        </ul>
        Ejemplo: <code>bind_param("sdi", $nombre, $precio, $cantidad)</code>
    </div>

    <?php if ($error): ?>
        <div class="warning-box"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($mensaje): ?>
        <div class="info-box">
            <?php echo $mensaje; ?><br>
            <?php if ($detalle) echo $detalle; ?>
        </div>
    <?php endif; ?>

    <?php if (!$error): ?>
        <!-- Ejemplo #1: INSERT prepara una vez, ejecuta una vez -->
        <div class="container">
            <h2>Ejemplo #1: Inserción simple (prepara una vez, ejecuta una vez)</h2>
            <p>Inserta un único producto predefinido usando consulta preparada.</p>
            <form method="post">
                <input type="hidden" name="modo" value="simple">
                <button type="submit" class="btn btn-insert">Insertar producto simple</button>
            </form>
            <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto;">
<code>$stmt = $mysqli->prepare("INSERT INTO producto(nombre, precio, cant) VALUES (?, ?, ?)");
$nombre = "Portátil X1";
$precio = 799.99;
$cantidad = 5;
$stmt->bind_param("sdi", $nombre, $precio, $cantidad); // s=string, d=double, i=integer
$stmt->execute();</code></pre>
        </div>

        <!-- Ejemplo #2: INSERT prepara una vez y ejecuta varias veces -->
        <div class="container">
            <h2>Ejemplo #2: Inserción múltiple (prepara una vez, ejecuta varias veces)</h2>
            <p>Inserta varios productos usando la misma consulta preparada (más eficiente).</p>
            <form method="post">
                <input type="hidden" name="modo" value="multiple">
                <button type="submit" class="btn btn-insert">Insertar lote de productos</button>
            </form>
            <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto;">
<code>$stmt = $mysqli->prepare("INSERT INTO producto(nombre, precio, cant) VALUES (?, ?, ?)");
$stmt->bind_param("sdi", $nombre, $precio, $cantidad);

$data = [
    ["nombre" => "Monitor 27\"", "precio" => 199.90, "cant" => 12],
    ["nombre" => "Ratón inalámbrico", "precio" => 24.50, "cant" => 30],
    // ... más productos
];

foreach ($data as $producto) {
    $nombre = $producto['nombre'];
    $precio = $producto['precio'];
    $cantidad = $producto['cant'];
    $stmt->execute(); // Reutiliza la misma consulta preparada
}</code></pre>
        </div>

        <!-- Inserción manual con bind_param -->
        <div class="container">
            <h2>Inserción manual con bind_param()</h2>
            <p>Formulario que usa consulta preparada para proteger contra inyección SQL.</p>
            <form method="post">
                <input type="hidden" name="modo" value="manual">
                <label>Nombre: <input type="text" name="nombre" required></label><br><br>
                <label>Precio: <input type="number" step="0.01" min="0.01" name="precio" required></label><br><br>
                <label>Cantidad: <input type="number" min="0" step="1" name="cant" required></label><br><br>
                <button type="submit" class="btn btn-create">Insertar manualmente</button>
            </form>
            <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto; margin-top: 10px;">
<code>// El valor del usuario se trata como dato, NO como código SQL
$stmt = $mysqli->prepare("INSERT INTO producto(nombre, precio, cant) VALUES (?, ?, ?)");
$stmt->bind_param("sdi", $nombre, $precio, $cantidad);
$stmt->execute();</code></pre>
        </div>

        <!-- Explicación de seguridad -->
        <div class="container">
            <h2>¿Por qué es seguro?</h2>
            <div class="info-box">
                <ul style="text-align: left; margin: 10px 0;">
                    <li>✅ El valor del usuario se enlaza como parámetro, no se inserta directamente en la cadena SQL</li>
                    <li>✅ El servidor trata el valor como <strong>dato</strong>, no como <strong>código</strong></li>
                    <li>✅ No importa lo que el usuario escriba, no puede alterar la lógica de la consulta</li>
                    <li>✅ Protección automática contra inyección SQL</li>
                    <li>✅ Mayor eficiencia cuando se ejecuta la misma consulta múltiples veces</li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>
