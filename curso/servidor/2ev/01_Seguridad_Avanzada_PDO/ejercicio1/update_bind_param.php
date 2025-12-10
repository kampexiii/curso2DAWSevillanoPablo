<?php
session_start();
/*
 * Actualizar datos con seguridad maxima usando bind_param
 */
$server = "localhost";
$user   = "root";
$pass   = "";
$table  = "producto";
$db     = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$detalle = "";
$error   = "";
$idsDisponibles = [];
$mysqli = null;

// Activamos reportes de error para mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$db) {
    $error = "No hay BD activa. Tienes que conectar primero desde el menú.";
} else {
    try {
        // Conectamos
        $mysqli = new mysqli($server, $user, $pass, $db);
        
        // Comprobamos que la tabla existe
        $result = $mysqli->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows === 0) {
            $error = "La tabla '$table' no existe en la BD '$db'. Crea la tabla antes de actualizar nada.";
        } else {
            // Obtenemos los IDs para rellenar el desplegable de edición
            $resultado = $mysqli->query("SELECT id, nombre, precio, cant FROM $table ORDER BY id");
            while ($fila = $resultado->fetch_assoc()) {
                $idsDisponibles[] = $fila;
            }
        }
    } catch (mysqli_sql_exception $e) {
        $error = "No se pudo conectar a la BD '$db'. Error: " . $e->getMessage();
    }
}

// Si enviamos el formulario
if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'auto') {
        // Actualizacion automatica - subir 5% el precio a productos con stock > 10
        try {
            // Preparamos la consulta. aqui no hay datos de usuario directamente
            // pero usamos prepare por costumbre y seguridad
            $stmt = $mysqli->prepare("UPDATE $table SET precio = ROUND(precio * 1.05, 2) WHERE cant > ?");
            
            $stockMinimo = 10;
            // Enlazamos el parametro... i es integer
            $stmt->bind_param("i", $stockMinimo);
            
            $stmt->execute();
            
            // Vemos cuantas filas han cambiado
            $cantidad = $stmt->affected_rows;
            
            $mensaje = "Actualización automática lista. Se han tocado $cantidad registros.";
            $detalle = "Hemos subido un 5% el precio a los productos con stock mayor a $stockMinimo.";
            
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            $error = "Fallo en la actualización automática: " . $e->getMessage();
        }
        
    } elseif ($modo === 'manual') {
        // Actualizacion manual - validamos lo que nos manda el usuario
        try {
            $id     = (int)($_POST['id'] ?? 0);
            $nombre = trim($_POST['nombre'] ?? '');
            $precio = trim($_POST['precio'] ?? '');
            $cant   = trim($_POST['cant'] ?? '');

            $errores = [];
            if ($id <= 0) $errores[] = "Elige un ID válido, por favor";
            if ($nombre === '') $errores[] = "El nombre no puede estar vacío";
            if ($precio === '' || !is_numeric($precio) || $precio <= 0) {
                $errores[] = "El precio tiene que ser un número positivo";
            }
            if ($cant === '' || !ctype_digit((string)$cant)) {
                $errores[] = "La cantidad tiene que ser un número entero";
            }

            if (empty($errores)) {
                // Todo correcto... preparamos el UPDATE con bind_param
                $stmt = $mysqli->prepare("UPDATE $table SET nombre=?, precio=?, cant=? WHERE id=?");
                
                // Convertimos tipos...
                $precio = (float)$precio;
                $cant = (int)$cant;
                
                // "sdii" -> string, double, integer, integer (el id)
                $stmt->bind_param("sdii", $nombre, $precio, $cant, $id);
                
                $stmt->execute();
                
                if ($stmt->affected_rows > 0) {
                    $mensaje = "Actualización manual OK para el ID $id.";
                    $detalle = htmlspecialchars("$nombre - $precio euros - stock $cant uds");
                } else {
                    // A veces no cambia nada si los datos son iguales a los que habia
                    $mensaje = "No se ha modificado nada (quizás los datos eran iguales o el ID no existe).";
                }
                $stmt->close();
                
                // Recargamos la lista de IDs por si cambiamos algun nombre
                $idsDisponibles = [];
                $resultado = $mysqli->query("SELECT id, nombre, precio, cant FROM $table ORDER BY id");
                while ($fila = $resultado->fetch_assoc()) {
                    $idsDisponibles[] = $fila;
                }
                
            } else {
                $mensaje = "Hay errores en el formulario: " . implode("; ", $errores);
            }
        } catch (mysqli_sql_exception $e) {
            $error = "Error al actualizar manualmente: " . $e->getMessage();
        }
    }
}

// Cerramos el chiringuito...
if ($mysqli) {
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar con bind_param() - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Actualizar datos usando bind_param()</h1>
    <p><a href="menu.php" class="btn btn-refresh">Volver al menú</a></p>

    <div class="info-box">
        <strong>Seguridad en UPDATE</strong><br>
        Igual que en el INSERT, usamos <code>bind_param()</code> para que los datos del formulario no rompan la consulta SQL.<br>
        Ejemplo: <code>$stmt->bind_param("sdii", $nombre, $precio, $cant, $id);</code>
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
        <!-- Actualizacion automatica -->
        <div class="container">
            <h2>Actualización automática (Lote)</h2>
            <p>Sube un 5% el precio a productos con stock > 10.</p>
            <form method="post">
                <input type="hidden" name="modo" value="auto">
                <button type="submit" class="btn btn-update">Ejecutar actualización masiva</button>
            </form>
            <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto; margin-top: 10px;">
<code>$stmt = $mysqli->prepare("UPDATE producto SET precio = ROUND(precio * 1.05, 2) WHERE cant > ?");
$stock = 10;
$stmt->bind_param("i", $stock);
$stmt->execute();</code></pre>
        </div>

        <!-- Actualizacion manual -->
        <div class="container">
            <h2>Actualización manual por ID</h2>
            <?php if (empty($idsDisponibles)): ?>
                <div class="warning-box">No hay productos para actualizar. Inserta algo primero.</div>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" name="modo" value="manual">
                    <label>Elige el producto a editar:
                        <select name="id" required>
                            <option value="">-- selecciona uno --</option>
                            <?php foreach ($idsDisponibles as $row): ?>
                                <option value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <?php echo htmlspecialchars($row['id'] . " - " . ($row['nombre'] ?? '') . " (" . ($row['precio'] ?? '') . "€)"); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label><br><br>
                    <label>Nuevo Nombre: <input type="text" name="nombre" required></label><br><br>
                    <label>Nuevo Precio: <input type="number" step="0.01" min="0.01" name="precio" required></label><br><br>
                    <label>Nueva Cantidad: <input type="number" min="0" step="1" name="cant" required></label><br><br>
                    <button type="submit" class="btn btn-create">Actualizar datos</button>
                </form>
                <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto; margin-top: 10px;">
<code>$stmt = $mysqli->prepare("UPDATE producto SET nombre=?, precio=?, cant=? WHERE id=?");
$stmt->bind_param("sdii", $nombre, $precio, $cant, $id);
$stmt->execute();</code></pre>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>

</html>
