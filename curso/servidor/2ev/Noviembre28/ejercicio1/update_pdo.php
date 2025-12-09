<?php
session_start();
/*
 * Actualizar datos con seguridad usando PDO
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
$pdo = null;

if (!$db) {
    $error = "No hay BD activa. Conecta primero desde el menú.";
} else {
    try {
        $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Verificar tabla
        $stmt = $pdo->prepare("SHOW TABLES LIKE ?");
        $stmt->execute([$table]);
        if ($stmt->rowCount() === 0) {
            $error = "La tabla '$table' no existe en la BD '$db'.";
        } else {
            // Cargar IDs
            $stmt = $pdo->query("SELECT id, nombre, precio, cant FROM $table ORDER BY id");
            $idsDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        $error = "Error conexión PDO: " . $e->getMessage();
    }
}

if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'auto') {
        // Actualización automática
        try {
            // Usamos marcador de posición ?
            $sql = "UPDATE $table SET precio = ROUND(precio * 1.05, 2) WHERE cant > ?";
            $stmt = $pdo->prepare($sql);
            
            $stockMinimo = 10;
            // En PDO se pasa el valor en execute() o con bindParam()
            $stmt->execute([$stockMinimo]);
            
            $cantidad = $stmt->rowCount();
            $mensaje = "Actualización automática PDO lista. Filas afectadas: $cantidad";
            $detalle = "Subido 5% a productos con stock > $stockMinimo";
            
        } catch (PDOException $e) {
            $error = "Error update auto PDO: " . $e->getMessage();
        }
        
    } elseif ($modo === 'manual') {
        // Actualización manual
        try {
            $id     = (int)($_POST['id'] ?? 0);
            $nombre = trim($_POST['nombre'] ?? '');
            $precio = trim($_POST['precio'] ?? '');
            $cant   = trim($_POST['cant'] ?? '');

            $errores = [];
            if ($id <= 0) $errores[] = "ID inválido";
            if ($nombre === '') $errores[] = "Nombre obligatorio";
            if ($precio === '' || !is_numeric($precio) || $precio <= 0) $errores[] = "Precio > 0";
            if ($cant === '' || !ctype_digit((string)$cant)) $errores[] = "Cantidad entera >= 0";

            if (empty($errores)) {
                // Usamos parámetros con nombre (:param)
                $sql = "UPDATE $table SET nombre = :nom, precio = :pre, cant = :can WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                
                // Vinculamos parámetros (opcional, se puede pasar directo al execute)
                $stmt->bindParam(':nom', $nombre);
                $stmt->bindParam(':pre', $precio);
                $stmt->bindParam(':can', $cant);
                $stmt->bindParam(':id', $id);
                
                $stmt->execute();
                
                if ($stmt->rowCount() > 0) {
                    $mensaje = "Update manual PDO OK para ID $id";
                    $detalle = htmlspecialchars("$nombre - $precio euros - stock $cant uds");
                } else {
                    $mensaje = "No se modificó nada (datos idénticos o ID no encontrado)";
                }
                
                // Recargar IDs
                $stmt = $pdo->query("SELECT id, nombre, precio, cant FROM $table ORDER BY id");
                $idsDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            } else {
                $mensaje = "Errores: " . implode("; ", $errores);
            }
        } catch (PDOException $e) {
            $error = "Error update manual PDO: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar con PDO - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Actualizar datos usando PDO</h1>
    <p><a href="menu.php" class="btn btn-refresh">Volver al menú</a></p>

    <div class="info-box">
        <strong>Seguridad con PDO</strong><br>
        Usa <code>prepare()</code> y marcadores como <code>:nombre</code> o <code>?</code>.<br>
        Es la forma moderna y recomendada de trabajar con bases de datos en PHP.
    </div>

    <?php if ($error): ?> <div class="warning-box"><?php echo $error; ?></div> <?php endif; ?>
    <?php if ($mensaje): ?> 
        <div class="info-box">
            <?php echo $mensaje; ?><br>
            <?php if ($detalle) echo $detalle; ?>
        </div> 
    <?php endif; ?>

    <?php if (!$error): ?>
        <div class="container">
            <h2>Actualización automática (Lote)</h2>
            <form method="post">
                <input type="hidden" name="modo" value="auto">
                <button type="submit" class="btn btn-update">Ejecutar actualización masiva (PDO)</button>
            </form>
            <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto;">
<code>$stmt = $pdo->prepare("UPDATE producto SET ... WHERE cant > ?");
$stmt->execute([10]);</code></pre>
        </div>

        <div class="container">
            <h2>Actualización manual por ID</h2>
            <?php if (empty($idsDisponibles)): ?>
                <div class="warning-box">No hay datos.</div>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" name="modo" value="manual">
                    <label>ID: 
                        <select name="id" required>
                            <option value="">-- selecciona --</option>
                            <?php foreach ($idsDisponibles as $row): ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo htmlspecialchars($row['id'] . " - " . $row['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label><br><br>
                    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
                    <label>Precio: <input type="number" step="0.01" name="precio" required></label><br><br>
                    <label>Cantidad: <input type="number" name="cant" required></label><br><br>
                    <button type="submit" class="btn btn-create">Actualizar (PDO)</button>
                </form>
                <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto;">
<code>$sql = "UPDATE producto SET nombre=:n ... WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':n'=>$nombre, ':id'=>$id ...]);</code></pre>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>
