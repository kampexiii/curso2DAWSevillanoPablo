<?php
session_start();
/*
 * Insercion segura usando PDO 
 */
$server = "localhost";
$user   = "root";
$pass   = "";
$table  = "producto";
$db     = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$detalle = "";
$error   = "";
$pdo = null;

if (!$db) {
    $error = "No hay BD activa. Conecta primero desde el menú.";
} else {
    try {
        // Conexión con PDO
        $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        // Configuramos PDO para que lance excepciones si hay error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Verificar tabla
        $stmt = $pdo->prepare("SHOW TABLES LIKE ?");
        $stmt->execute([$table]);
        if ($stmt->rowCount() === 0) {
            $error = "La tabla '$table' no existe en la BD '$db'.";
        }
    } catch (PDOException $e) {
        $error = "Error de conexión: " . $e->getMessage();
    }
}

if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'simple') {
        // INSERT simple con PDO
        try {
            // Preparamos la consulta con marcadores de posición (?)
            $stmt = $pdo->prepare("INSERT INTO $table (nombre, precio, cant) VALUES (?, ?, ?)");
            
            $nombre = "Portátil PDO";
            $precio = 850.50;
            $cantidad = 3;
            
            // Ejecutamos pasando un array con los valores
            $stmt->execute([$nombre, $precio, $cantidad]);
            
            $mensaje = "Inserción simple con PDO completada.";
            $detalle = htmlspecialchars("$nombre - $precio euros - stock $cantidad uds");
            
        } catch (PDOException $e) {
            $error = "Error insert simple PDO: " . $e->getMessage();
        }
        
    } elseif ($modo === 'multiple') {
        //  INSERT múltiple (lote) con PDO
        try {
            $stmt = $pdo->prepare("INSERT INTO $table (nombre, precio, cant) VALUES (:nombre, :precio, :cant)");
            
            // En PDO podemos usar nombres (:nombre) en vez de interrogaciones (?)
            
            
            $data = [
                ["nombre" => "Monitor PDO", "precio" => 210.00, "cant" => 10],
                ["nombre" => "Ratón PDO", "precio" => 25.99, "cant" => 25],
                ["nombre" => "Teclado PDO", "precio" => 95.00, "cant" => 8]
            ];
            
            $insertados = 0;
            foreach ($data as $producto) {
                // Vinculamos parámetros por nombre
                $stmt->bindParam(':nombre', $producto['nombre']);
                $stmt->bindParam(':precio', $producto['precio']);
                $stmt->bindParam(':cant', $producto['cant']);
                
                $stmt->execute();
                $insertados++;
                
                $detalle .= htmlspecialchars("{$producto['nombre']} - {$producto['precio']}€") . "<br>";
            }
            
            $mensaje = "Inserción múltiple PDO completada. Registros: $insertados";
            
        } catch (PDOException $e) {
            $error = "Error insert múltiple PDO: " . $e->getMessage();
        }
        
    } elseif ($modo === 'manual') {
        // Inserción manual
        try {
            $nombre = trim($_POST['nombre'] ?? '');
            $precio = trim($_POST['precio'] ?? '');
            $cant   = trim($_POST['cant'] ?? '');

            $errores = [];
            if ($nombre === '') $errores[] = "Nombre obligatorio";
            if ($precio === '' || !is_numeric($precio) || $precio <= 0) $errores[] = "Precio > 0";
            if ($cant === '' || !ctype_digit((string)$cant)) $errores[] = "Cantidad entera >= 0";

            if (empty($errores)) {
                // Preparamos
                $stmt = $pdo->prepare("INSERT INTO $table (nombre, precio, cant) VALUES (:n, :p, :c)");
                
                // Ejecutamos pasando array asociativo (muy cómodo)
                $stmt->execute([
                    ':n' => $nombre,
                    ':p' => (float)$precio,
                    ':c' => (int)$cant
                ]);
                
                $mensaje = "Inserción manual PDO OK";
                $detalle = htmlspecialchars("$nombre - $precio euros - stock $cant uds");
            } else {
                $mensaje = "Errores: " . implode("; ", $errores);
            }
        } catch (PDOException $e) {
            $error = "Error insert manual PDO: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar con PDO - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Insertar datos usando PDO (Seguro)</h1>
    <p><a href="menu.php" class="btn btn-refresh">Volver al menú</a></p>

    <div class="info-box">
        <strong>Ventajas de PDO:</strong><br>
        - Funciona con 12 tipos de bases de datos diferentes.<br>
        - Soporta parámetros con nombre (ej: <code>:nombre</code>).<br>
        - Puedes pasar el array de datos directamente al <code>execute()</code>.
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
            <h2>Ejemplo #1: Inserción simple (Marcadores ?)</h2>
            <form method="post">
                <input type="hidden" name="modo" value="simple">
                <button type="submit" class="btn btn-insert">Insertar simple PDO</button>
            </form>
            <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto;">
<code>$stmt = $pdo->prepare("INSERT INTO producto VALUES (?, ?, ?)");
$stmt->execute([$nombre, $precio, $cant]);</code></pre>
        </div>

        <div class="container">
            <h2>Ejemplo #2: Inserción múltiple (Parámetros con nombre)</h2>
            <form method="post">
                <input type="hidden" name="modo" value="multiple">
                <button type="submit" class="btn btn-insert">Insertar lote PDO</button>
            </form>
            <pre style="background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto;">
<code>$stmt = $pdo->prepare("INSERT INTO producto VALUES (:n, :p, :c)");
$stmt->bindParam(':n', $nombre);
// ...
$stmt->execute();</code></pre>
        </div>

        <div class="container">
            <h2>Inserción manual PDO</h2>
            <form method="post">
                <input type="hidden" name="modo" value="manual">
                <label>Nombre: <input type="text" name="nombre" required></label><br><br>
                <label>Precio: <input type="number" step="0.01" name="precio" required></label><br><br>
                <label>Cantidad: <input type="number" name="cant" required></label><br><br>
                <button type="submit" class="btn btn-create">Insertar (PDO)</button>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
