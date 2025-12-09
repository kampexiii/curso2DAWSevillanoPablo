<?php
session_start();
/*
 * Select segura con bind_param
 */
$server = "localhost";
$user   = "root";
$pass   = "";
$table  = "producto";
$db     = $_SESSION['db_activa'] ?? null;

$mensaje = "";
$resultados = [];
$error   = "";
$mysqli = null;

// Configuramos errores
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$db) {
    $error = "No hay BD activa. Conecta primero desde el menú.";
} else {
    try {
        // Conectamos
        $mysqli = new mysqli($server, $user, $pass, $db);
        
        // Comprobamos tabla
        $result = $mysqli->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows === 0) {
            $error = "La tabla '$table' no existe en la BD '$db'.";
        }
    } catch (mysqli_sql_exception $e) {
        $error = "No se pudo conectar a la BD '$db'. Error: " . $e->getMessage();
    }
}

// Procesar consulta si no hay error
if (!$error && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo = $_POST['modo'] ?? '';

    if ($modo === 'buscar_nombre') {
        // Busqueda por nombre... protegida contra inyeccion SQL
        try {
            $nombre = trim($_POST['nombre'] ?? '');
            
            if ($nombre === '') {
                $mensaje = "Por favor, introduce un nombre para buscar.";
            } else {
                // Preparamos el select
                $stmt = $mysqli->prepare("SELECT * FROM $table WHERE nombre LIKE ?");
                
                // Ponemos los % para el like
                $patron = "%$nombre%";
                
                // Enlazamos el parametro... s es string
                $stmt->bind_param("s", $patron);
                
                // Ejecutamos
                $stmt->execute();
                
                // Tomamos los resultados
                $result = $stmt->get_result();
                
                while ($fila = $result->fetch_assoc()) {
                    $resultados[] = $fila;
                }
                
                if (count($resultados) > 0) {
                    $mensaje = "Encontrados " . count($resultados) . " producto(s) que contienen '$nombre'";
                } else {
                    $mensaje = "No se encontraron productos con '$nombre'";
                }
                
                $stmt->close();
            }
        } catch (mysqli_sql_exception $e) {
            $error = "Error en la búsqueda: " . $e->getMessage();
        }
        
    } elseif ($modo === 'buscar_precio') {
        // Busqueda por rango de precio... protegida contra inyeccion SQL
        try {
            $precio_min = trim($_POST['precio_min'] ?? '');
            $precio_max = trim($_POST['precio_max'] ?? '');
            
            if ($precio_min === '' || $precio_max === '') {
                $mensaje = "Por favor, introduce precio mínimo y máximo.";
            } else {
                // Preparamos con varios parametros
                $stmt = $mysqli->prepare("SELECT * FROM $table WHERE precio BETWEEN ? AND ? ORDER BY precio");
                
                // Pasamos a double
                $precio_min = (float)$precio_min;
                $precio_max = (float)$precio_max;
                
                // Enlazamos los parametros... dd son dos doubles
                $stmt->bind_param("dd", $precio_min, $precio_max);
                
                // Ejecutamos
                $stmt->execute();
                
                // Tomamos los resultados
                $result = $stmt->get_result();
                
                while ($fila = $result->fetch_assoc()) {
                    $resultados[] = $fila;
                }
                
                if (count($resultados) > 0) {
                    $mensaje = "Encontrados " . count($resultados) . " producto(s) entre $precio_min y $precio_max euros";
                } else {
                    $mensaje = "No se encontraron productos en ese rango de precio";
                }
                
                $stmt->close();
            }
        } catch (mysqli_sql_exception $e) {
            $error = "Error en la búsqueda: " . $e->getMessage();
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
    <title>SELECT con bind_param() - <?php echo htmlspecialchars($table); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Consultas SELECT seguras</h1>
    <p><a href="menu.php" class="btn btn-refresh">Volver</a></p>

    <?php if ($error): ?>
        <div class="warning-box"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($mensaje): ?>
        <div class="info-box"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <?php if (!$error): ?>
        <!-- Búsqueda por nombre -->
        <div class="container">
            <h2>Buscar por nombre</h2>
            <form method="post">
                <input type="hidden" name="modo" value="buscar_nombre">
                <label>Producto: <input type="text" name="nombre" required></label>
                <button type="submit" class="btn btn-create">Buscar</button>
            </form>
        </div>

        <!-- Búsqueda por rango de precio -->
        <div class="container">
            <h2>Buscar por precio</h2>
            <form method="post">
                <input type="hidden" name="modo" value="buscar_precio">
                <label>Min: <input type="number" step="0.01" min="0" name="precio_min" value="0" required></label>
                <label>Max: <input type="number" step="0.01" min="0" name="precio_max" value="1000" required></label>
                <button type="submit" class="btn btn-create">Buscar</button>
            </form>
        </div>

        <!-- Mostrar resultados -->
        <?php if (count($resultados) > 0): ?>
            <div class="container">
                <h2>Resultados</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                    <?php foreach ($resultados as $fila): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['id']); ?></td>
                            <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                            <td><?php echo number_format((float)$fila['precio'], 2); ?> €</td>
                            <td><?php echo (int)$fila['cant']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>
