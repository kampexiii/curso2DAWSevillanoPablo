<?php
session_start();
/*
 * Actualizacion con dos opciones:
 * 1) Auto: aplica un UPDATE predefinido (ajusta la sentencia al enunciado)
 * 2) Manual: formulario con select de IDs existentes y validacion basica
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "curso";     // Nombre de tabla (cambia si la llamas distinto)
$db     = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$detalle = "";
$error   = "";
$idsDisponibles = [];
$conexion = null;

if (!$db) {
    $error = "No hay BD activa. Pulsa Crear BD y Conectar antes de actualizar.";
} else {
    try {
        $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar que la tabla existe
        $check = $conexion->prepare("SHOW TABLES LIKE ?");
        $check->execute([$table]);
        if ($check->rowCount() === 0) {
            $error = "La tabla '$table' no existe en la BD '$db'. Crea la tabla antes de actualizar.";
        } else {
            // Cargar IDs para el select (se muestra id y nombre si existen esos campos)
            $stmtIds = $conexion->prepare("SELECT id, nombre, apellidos FROM $table ORDER BY id");
            $stmtIds->execute();
            $idsDisponibles = $stmtIds->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch(PDOException $e) {
        $error = "No se pudo conectar a la BD '$db'. Crea la BD/tabla antes de actualizar. Error: " . $e->getMessage();
    }
}

if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'auto') {
        // CAMBIA este UPDATE a lo que pida el examen
        $sql = "UPDATE $table 
            SET nota = nota + 1.0
            WHERE INSTR(LCASE(email), 'gmail.com') > 0 AND nota <= 9.0";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $cantidad = $stmt->rowCount();
        $mensaje = "Actualizacion automatica OK. Filas afectadas: $cantidad";
        $detalle = "Regla aplicada: +1 a notas con email Gmail (<=9). Cambia la regla al enunciado.";

        // INSERT opcional al final: adapta o elimina si no lo necesitas
        $sqlInsert = "INSERT INTO $table (nombre, apellidos, email, edad, nota, activo) VALUES ('Marcos', 'Rozalen', 'marcos@rozalen.es', 24, 8.8, 1)";
        $conexion->exec($sqlInsert);
        $detalle .= "<br>Registro añadido (opcional): Marcos Rozalen";
    } elseif ($modo === 'manual') {
        $id        = (int)($_POST['id'] ?? 0);
        $nombre    = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $edad      = trim($_POST['edad'] ?? '');
        $nota      = trim($_POST['nota'] ?? '');
        $activo    = isset($_POST['activo']) ? 1 : 0;

        $errores = [];
        if ($id <= 0) $errores[] = "Selecciona un ID valido";
        if ($nombre === '')    $errores[] = "Nombre obligatorio";
        if ($apellidos === '')  $errores[] = "Apellidos obligatorios";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email no valido";
        if (!is_numeric($edad) || $edad < 0 || $edad > 120) $errores[] = "Edad debe ser numero entre 0 y 120";
        if (!is_numeric($nota) || $nota < 0 || $nota > 10)  $errores[] = "Nota entre 0 y 10";

        if (empty($errores)) {
            $stmt = $conexion->prepare("UPDATE $table SET nombre=?, apellidos=?, email=?, edad=?, nota=?, activo=? WHERE id=?");
            $stmt->execute([$nombre, $apellidos, $email, (int)$edad, (float)$nota, $activo, $id]);
            if ($stmt->rowCount() > 0) {
                $mensaje = "Update manual OK para id $id";
                $detalle = htmlspecialchars("$nombre $apellidos ($email), edad $edad, nota $nota, activo $activo");
            } else {
                $mensaje = "No se actualizo ningun registro (comprueba el ID).";
            }
        } else {
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
            <p>Cambia la sentencia UPDATE en el PHP segun el enunciado.</p>
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
                            <?php echo htmlspecialchars($row['id'] . " - " . ($row['nombre'] ?? '') . " " . ($row['apellidos'] ?? '')); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br><br>
            <label>Nombre: <input type="text" name="nombre" required></label><br><br>
            <label>Apellidos: <input type="text" name="apellidos" required></label><br><br>
            <label>Email: <input type="email" name="email" required></label><br><br>
            <label>Edad: <input type="number" name="edad" min="0" max="120" required></label><br><br>
            <label>Nota: <input type="number" step="0.01" name="nota" min="0" max="10" required></label><br><br>
            <label><input type="checkbox" name="activo" value="1" checked> Activo</label><br><br>
            <button type="submit" class="btn btn-create">Actualizar manualmente</button>
        </form>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</body>
</html>
