<?php
session_start();
/*
 * Eliminacion con dos opciones:
 * 1) Auto: borra segun una regla predefinida
 * 2) Manual: select de IDs existentes y borrado directo
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "producto";  // Nombre de tabla 
$dbActiva = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$detalle = "";
$error   = "";
$idsDisponibles = [];
$conexion = null;

if (!$dbActiva) { // No hay BD activa
    $error = "No hay BD activa. Pulsa Crear BD y Conectar antes de eliminar.";
} else {
    try { // Conexión a la BD
        $conexion = new PDO("mysql:host=$server;dbname=$dbActiva", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar que la tabla existe
        $check = $conexion->prepare("SHOW TABLES LIKE ?");
        $check->execute([$table]);
        if ($check->rowCount() === 0) {
            $error = "La tabla '$table' no existe en la BD '$dbActiva'. Crea la tabla antes de eliminar registros.";
        } else {
            // Cargar IDs para el select
            $stmtIds = $conexion->prepare("SELECT id, nombre, precio, cant FROM $table ORDER BY id");
            $stmtIds->execute();
            $idsDisponibles = $stmtIds->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) { // Error en la conexión
        $error = "No se pudo conectar a la BD '$dbActiva'. Crea la BD/tabla antes de eliminar. Error: " . $e->getMessage();
    }
}

if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'auto') {
        // Borra todos los registros y vacia la tabla.
        $sql = "DELETE FROM $table";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $eliminados = $stmt->rowCount();
        $mensaje = "Eliminacion automatica OK. Registros borrados: $eliminados";
        $detalle = "Regla usada: todos los registros. Cambia la condicion al enunciado si piden otra.";
    } elseif ($modo === 'manual') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            $mensaje = "Selecciona un ID valido";
        } else {
            $stmt = $conexion->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
                $mensaje = "Eliminacion manual OK para id $id";
            } else {
                $mensaje = "No se borro ningun registro (comprueba el ID).";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar datos - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Eliminar datos en <?php echo htmlspecialchars($table); ?></h1>
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
            <h2>Eliminacion automatica (regla predefinida)</h2>
            <form method="post">
                <input type="hidden" name="modo" value="auto">
                <button type="submit" class="btn btn-drop">Eliminar automaticamente</button>
            </form>
        </div>

        <div class="container">
            <h2>Eliminacion manual por ID</h2>
            <?php if (empty($idsDisponibles)): ?>
                <div class="warning-box">No hay registros. Inserta datos antes de eliminar.</div>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" name="modo" value="manual">
                    <label>ID a eliminar:
                        <select name="id" required>
                            <option value="">-- selecciona --</option>
                            <?php foreach ($idsDisponibles as $row): ?>
                                <option value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <?php echo htmlspecialchars($row['id'] . " - " . ($row['nombre'] ?? '') . " (" . ($row['precio'] ?? '') . " EUR, stock " . ($row['cant'] ?? '') . ")"); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label><br><br>
                    <button type="submit" class="btn btn-drop">Eliminar seleccionado</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>

</html>