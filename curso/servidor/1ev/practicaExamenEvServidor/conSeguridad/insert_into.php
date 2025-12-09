<?php
session_start();
/*
 * Insercion con dos opciones:
 * 1) Auto: inserta un lote predefinido (modifica el array $alumnos)
 * 2) Manual: formulario con validacion basica
 * Cambia host/usuario/pass/tabla/columnas si el examen lo pide.
 */
$server = "localhost"; // Servidor MySQL
$user   = "root";      // Usuario MySQL
$pass   = "";          // Password MySQL
$table  = "curso";     // Nombre de tabla (cambia si la llamas distinto)
$db     = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$detalle = "";
$error   = "";
$conexion = null;

if (!$db) {
    $error = "No hay BD activa. Pulsa Crear BD y Conectar en el menu antes de insertar.";
} else {
    try {
        $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar que la tabla existe antes de operar
        $check = $conexion->prepare("SHOW TABLES LIKE ?");
        $check->execute([$table]);
        if ($check->rowCount() === 0) {
            $error = "La tabla '$table' no existe en la BD '$db'. Crea la tabla antes de insertar.";
        }
    } catch(PDOException $e) {
        $error = "No se pudo conectar a la BD '$db'. Crea la BD y la tabla antes de insertar. Error: " . $e->getMessage();
    }
}

if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'auto') {
        // Borra todo para dejar la tabla limpia antes de insertar el lote
        $conexion->exec("DELETE FROM $table");

        // Lote predefinido: cambia los valores segun el enunciado
        $alumnos = [
            ["Pablo", "Sevillano", "pablo@sevillano.es", 21, 9.2, 1],
            ["Alejandro", "Pacheco", "alejandro@pacheco.es", 22, 8.7, 1],
            ["Alejandro", "Malpelo", "alejandro@malpelo.es", 20, 7.5, 1],
            ["David", "Bermejo", "david@bermejo.es", 23, 8.0, 1],
            ["Sandra", "Garcia", "sandra@garcia.es", 21, 9.0, 1]
        ];
        $stmt = $conexion->prepare("INSERT INTO $table (nombre, apellidos, email, edad, nota, activo) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($alumnos as $a) {
            $stmt->execute($a);
            $detalle .= htmlspecialchars("{$a[0]} {$a[1]} ({$a[2]}), edad {$a[3]}, nota {$a[4]}, activo {$a[5]}") . "<br>";
        }
        $mensaje = "Insercion automatica completada. Registros: " . count($alumnos);
    } elseif ($modo === 'manual') {
        // Validacion basica del formulario manual
        $nombre    = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $edad      = trim($_POST['edad'] ?? '');
        $nota      = trim($_POST['nota'] ?? '');
        $activo    = isset($_POST['activo']) ? 1 : 0;

        $errores = [];
        if ($nombre === '')    $errores[] = "Nombre obligatorio";
        if ($apellidos === '')  $errores[] = "Apellidos obligatorios";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email no valido";
        if (!is_numeric($edad) || $edad < 0 || $edad > 120) $errores[] = "Edad debe ser numero entre 0 y 120";
        if (!is_numeric($nota) || $nota < 0 || $nota > 10)  $errores[] = "Nota entre 0 y 10";

        if (empty($errores)) {
            $stmt = $conexion->prepare("INSERT INTO $table (nombre, apellidos, email, edad, nota, activo) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $apellidos, $email, (int)$edad, (float)$nota, $activo]);
            $mensaje = "Insert manual OK";
            $detalle = htmlspecialchars("$nombre $apellidos ($email), edad $edad, nota $nota, activo $activo");
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
    <title>Insertar datos - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Insertar datos en <?php echo htmlspecialchars($table); ?></h1>
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
        <h2>Insercion automatica (lote predefinido)</h2>
        <form method="post">
            <input type="hidden" name="modo" value="auto">
            <button type="submit" class="btn btn-insert">Insertar lote</button>
            <p>Reemplaza el array en el PHP si necesitas otros registros.</p>
        </form>
    </div>

    <div class="container">
        <h2>Insercion manual</h2>
        <form method="post">
            <input type="hidden" name="modo" value="manual">
            <label>Nombre: <input type="text" name="nombre" required></label><br><br>
            <label>Apellidos: <input type="text" name="apellidos" required></label><br><br>
            <label>Email: <input type="email" name="email" required></label><br><br>
            <label>Edad: <input type="number" name="edad" min="0" max="120" required></label><br><br>
            <label>Nota: <input type="number" step="0.01" name="nota" min="0" max="10" required></label><br><br>
            <label><input type="checkbox" name="activo" value="1" checked> Activo</label><br><br>
            <button type="submit" class="btn btn-create">Insertar manualmente</button>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>
