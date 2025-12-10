<?php
session_start();
/*
 * Insercion con dos opciones:
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "producto";  // Nombre de tabla
$db     = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$detalle = "";
$error   = "";
$conexion = null;

if (!$db) {
    $error = "No hay BD activa. Pulsa Crear BD y Conectar en el menu antes de insertar.";
} else {
    try { //conexion exitosa
        $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar que la tabla existe antes de operar
        $check = $conexion->prepare("SHOW TABLES LIKE ?");
        $check->execute([$table]);
        if ($check->rowCount() === 0) {
            $error = "La tabla '$table' no existe en la BD '$db'. Crea la tabla antes de insertar.";
        }
    } catch (PDOException $e) { //conexion fallida
        $error = "No se pudo conectar a la BD '$db'. Crea la BD y la tabla antes de insertar. Error: " . $e->getMessage();
    }
}
// Procesar formulario si no hay error y se ha enviado
if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'auto') {


        // Lote predefinido: cambia los valores segun el enunciado
        $productos = [
            ["Portatil X1", 799.99, 5],
            ["Monitor 27\"", 199.90, 12],
            ["Raton inalambrico", 24.50, 30]
        ];
        $stmt = $conexion->prepare("INSERT INTO $table (nombre, precio, cant) VALUES (?, ?, ?)");
        foreach ($productos as $p) {
            $stmt->execute($p);
            $detalle .= htmlspecialchars("{$p[0]} - {$p[1]} euros - stock {$p[2]} uds") . "<br>";
        }
        $mensaje = "Insercion automatica completada. Registros: " . count($productos);
    } elseif ($modo === 'manual') {
        // Validacion basica del formulario manual
        $nombre = trim($_POST['nombre'] ?? '');
        $precio = trim($_POST['precio'] ?? '');
        $cant   = trim($_POST['cant'] ?? '');

        $errores = [];
        if ($nombre === '') $errores[] = "Nombre obligatorio";
        if ($precio === '' || !is_numeric($precio) || $precio <= 0) $errores[] = "Precio debe ser numero > 0";
        if ($cant === '' || !ctype_digit((string)$cant)) $errores[] = "Cantidad debe ser entero >= 0";
        // Insertar si no hay errores
        if (empty($errores)) {
            $stmt = $conexion->prepare("INSERT INTO $table (nombre, precio, cant) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, (float)$precio, (int)$cant]);
            $mensaje = "Insert manual OK";
            $detalle = htmlspecialchars("$nombre - $precio euros - stock $cant uds");
        } else {
            // Mostrar errores de validacion
            $mensaje = "Errores: " . implode("; ", $errores);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar datos - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Insertar datos en <?php echo htmlspecialchars($table); ?></h1>
    <p><a href="menu.php" class="btn btn-refresh">Volver al menu</a></p>

    <?php if ($error): ?>
        <!--  Mostrar error de conexion o tabla no existente -->
        <div class="warning-box"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($mensaje): ?>
        <!-- Mostrar mensaje de exito o errores de validacion -->
        <div class="info-box">
            <?php echo $mensaje; ?><br>
            <?php if ($detalle) echo $detalle; ?>
        </div>
    <?php endif; ?>


    <?php if (!$error): ?>
        <!-- Dos formas de insercion: automatica y manual -->
        <!-- Insercion automatica: lote predefinido -->
        <div class="container">
            <h2>Insercion automatica (lote predefinido)</h2>
            <form method="post">
                <input type="hidden" name="modo" value="auto">
                <button type="submit" class="btn btn-insert">Insertar lote</button>
            </form>
        </div>
        <!-- Insercion manual: formulario con validacion basica -->
        <div class="container">
            <h2>Insercion manual</h2>
            <form method="post">
                <input type="hidden" name="modo" value="manual">
                <label>Nombre: <input type="text" name="nombre" required></label><br><br>
                <label>Precio: <input type="number" step="0.01" min="0.01" name="precio" required></label><br><br>
                <label>Cantidad: <input type="number" min="0" step="1" name="cant" required></label><br><br>
                <button type="submit" class="btn btn-create">Insertar manualmente</button>
            </form>
        </div>
    <?php endif; ?>
</body>

</html>