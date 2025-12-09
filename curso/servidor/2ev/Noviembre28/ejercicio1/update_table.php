<?php
session_start();
/*
 * Actualizacion con dos opciones:
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "producto";  // Nombre de tabla 
$db     = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$detalle = "";
$error   = "";
$idsDisponibles = [];
$conexion = null;

if (!$db) {
    $error = "No hay BD activa. Pulsa Crear BD y Conectar antes de actualizar.";
} else {
    try { //conexion exitosa
        $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar que la tabla existe
        $check = $conexion->prepare("SHOW TABLES LIKE ?");
        $check->execute([$table]);
        if ($check->rowCount() === 0) { //tabla no existe
            $error = "La tabla '$table' no existe en la BD '$db'. Crea la tabla antes de actualizar.";
        } else { //tabla existe
            // Cargar IDs para el select (se muestra id y nombre si existen esos campos)
            $stmtIds = $conexion->prepare("SELECT id, nombre, precio, cant FROM $table ORDER BY id");
            $stmtIds->execute();
            $idsDisponibles = $stmtIds->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) { //conexion fallida
        $error = "No se pudo conectar a la BD '$db'. Crea la BD/tabla antes de actualizar. Error: " . $e->getMessage();
    }
}

if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'auto') {
        // pongo este ejempo de actualizacion global para los que cumplan las condiciones - 5% el precio a productos con stock > 10
        $sql = "UPDATE $table SET precio = ROUND(precio * 1.05, 2) WHERE cant > 10";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $cantidad = $stmt->rowCount();
        $mensaje = "Actualizacion automatica OK. Filas afectadas: $cantidad";
        $detalle = "Regla aplicada: +5% a precio cuando cant > 10. Ajusta la condicion al enunciado si necesitas otra.";
    } elseif ($modo === 'manual') { //actualizacion por ID
        // Validacion basica del formulario manual
        $id     = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $precio = trim($_POST['precio'] ?? '');
        $cant   = trim($_POST['cant'] ?? '');

        $errores = [];
        if ($id <= 0) $errores[] = "Selecciona un ID valido";
        if ($nombre === '') $errores[] = "Nombre obligatorio";
        if ($precio === '' || !is_numeric($precio) || $precio <= 0) $errores[] = "Precio debe ser numero > 0";
        if ($cant === '' || !ctype_digit((string)$cant)) $errores[] = "Cantidad debe ser entero >= 0";

        if (empty($errores)) { //sin errores, hacemos update
            $stmt = $conexion->prepare("UPDATE $table SET nombre=?, precio=?, cant=? WHERE id=?");
            $stmt->execute([$nombre, (float)$precio, (int)$cant, $id]);
            if ($stmt->rowCount() > 0) {
                $mensaje = "Update manual OK para id $id";
                $detalle = htmlspecialchars("$nombre - $precio euros - stock $cant uds");
            } else { //ningun registro modificado
                $mensaje = "No se actualizo ningun registro (comprueba el ID).";
            }
        } else { //mostrar errores de validacion
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
    <title>Actualizar datos - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Actualizar datos en <?php echo htmlspecialchars($table); ?></h1>
    <p><a href="menu.php" class="btn btn-refresh">Volver al menu</a></p>

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
        <div class="container">
            <h2>Actualizacion automatica (regla predefinida)</h2>
            <form method="post">
                <input type="hidden" name="modo" value="auto">
                <button type="submit" class="btn btn-update">Actualizar automaticamente</button>
            </form>
        </div>

        <div class="container">
            <h2>Actualizacion manual por ID</h2>
            <?php if (empty($idsDisponibles)): ?>
                <div class="warning-box">No hay registros. Inserta datos antes de actualizar.</div>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" name="modo" value="manual">
                    <label>ID a actualizar:
                        <select name="id" required>
                            <option value="">-- selecciona --</option>
                            <?php foreach ($idsDisponibles as $row): ?>
                                <option value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <?php echo htmlspecialchars($row['id'] . " - " . ($row['nombre'] ?? '') . " (" . ($row['precio'] ?? '') . " EUR, stock " . ($row['cant'] ?? '') . ")"); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label><br><br>
                    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
                    <label>Precio: <input type="number" step="0.01" min="0.01" name="precio" required></label><br><br>
                    <label>Cantidad: <input type="number" min="0" step="1" name="cant" required></label><br><br>
                    <button type="submit" class="btn btn-create">Actualizar manualmente</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>

</html>