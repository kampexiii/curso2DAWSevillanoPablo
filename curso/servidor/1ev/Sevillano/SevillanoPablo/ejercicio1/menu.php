<?php
session_start();
/*
 * Menu principal CRUD.
 */
$server = "localhost";
$user   = "root";
$pass   = "";
$dbDefault = "examen"; // nombre por defecto de la BD
$dbActiva  = $_SESSION['db_activa'] ?? null; // la BD en uso (guardada en sesion)
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control CRUD - Base de Datos</title>
    <link rel="stylesheet" href="style.css">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            ['msgBD', 'msgTabla'].forEach(id => {
                const elem = document.getElementById(id);
                if (!elem) return;
                const saved = localStorage.getItem(id);
                if (saved) {
                    elem.innerHTML = saved;
                    localStorage.removeItem(id);
                }
            });
        });

        //  crear/borrar BD, crear/borrar tabla
        function ejecutarOperacion(archivo, destino) {
            const target = document.getElementById(destino);
            if (target) {
                target.textContent = "Ejecutando " + archivo + "...";
            }
            fetch(archivo, {
                    cache: 'no-store'
                })
                .then(r => r.text())
                .then(txt => {
                    if (target) target.innerHTML = txt;
                    if (destino) localStorage.setItem(destino, txt);
                })
                .catch(err => {
                    const msg = "Error: " + err;
                    if (target) target.textContent = msg;
                    if (destino) localStorage.setItem(destino, msg);
                })
                .finally(() => {
                    setTimeout(() => location.reload(), 900);
                });
        }
    </script>
</head>

<body>
    <h1>Panel de Control CRUD - Base de Datos</h1>
    <div class="info-box">
        <strong>Panel generico para pruebas CRUD</strong><br>
        BD por defecto: <code><?php echo $dbDefault; ?></code>. Cambiala en este archivo si el enunciado pide otro nombre o usa ?db=NombreBD.
    </div>

    <div class="container">
        <h2>Base de datos y conexion</h2>
        <div class="button-container">
            <button class="btn btn-create" onclick="ejecutarOperacion('create_database.php', 'msgBD')">
                Crear BD
            </button>
            <button class="btn btn-drop" onclick="if(confirm('Seguro que quieres eliminar la BD activa?')) ejecutarOperacion('drop_database.php', 'msgBD')">
                Borrar BD
            </button>
            <button class="btn btn-refresh" onclick="ejecutarOperacion('conexion.php?accion=conectar', 'msgBD')">
                Conectar
            </button>
            <button class="btn btn-refresh" onclick="ejecutarOperacion('conexion.php?accion=desconectar', 'msgBD')">
                Desconectar
            </button>
            <span class="status-badge <?php echo $dbActiva ? '' : 'off'; ?>">
                <?php echo $dbActiva ? "Conectado a '$dbActiva'" : "Sin conexion activa"; ?>
            </span>
        </div>
        <p>Truco examen: tambien puedes pasar ?db=NombreBD en crear/conectar si te piden un nombre distinto.</p>
        <div class="info-box" id="msgBD">Esperando accion de base de datos...</div>
    </div>

    <div class="container">
        <h2>Tabla principal</h2>
        <div class="button-container">
            <button class="btn btn-create" onclick="ejecutarOperacion('create_table.php', 'msgTabla')">
                Crear tabla
            </button>
            <button class="btn btn-insert" onclick="window.location='insert_into.php'">
                Insertar datos
            </button>
            <button class="btn btn-update" onclick="window.location='update_table.php'">
                Actualizar datos
            </button>
            <button class="btn btn-drop" onclick="window.location='delete_from.php'">
                Eliminar datos
            </button>
            <button class="btn btn-drop" onclick="if(confirm('Seguro que quieres eliminar toda la tabla?')) ejecutarOperacion('drop_table.php', 'msgTabla')">
                Drop tabla
            </button>
            <button class="btn btn-refresh" onclick="location.reload()">
                Refresh
            </button>
        </div>
        <div class="info-box" id="msgTabla">Usa los botones para abrir los formularios de insertar/actualizar/eliminar. Los botones Drop/Refresh siguen aqui.</div>
    </div>

    <?php
    // Resumen de estado actual
    echo "<div class='container'>";
    echo "<h2>Estado actual de la base de datos</h2>";

    if ($dbActiva) {
        try {
            $conexion = new PDO("mysql:host=$server;dbname=$dbActiva", $user, $pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SHOW TABLES LIKE 'producto'";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $tablaExiste = $stmt->rowCount() > 0;

            echo "<p><strong>BD activa:</strong> $dbActiva</p>";

            if ($tablaExiste) {
                echo "<div class='info-box'>Tabla 'producto' disponible en '$dbActiva'</div>";

                $sql_count = "SELECT COUNT(*) as total FROM producto";
                $stmt_count = $conexion->prepare($sql_count);
                $stmt_count->execute();
                $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
                $total = $row_count ? $row_count['total'] : 0;
                echo "<p><strong>Total de registros:</strong> $total</p>";

                $sql_select = "SELECT * FROM producto ORDER BY nombre";
                $stmt_select = $conexion->prepare($sql_select);
                $stmt_select->execute();
                $stmt_select->setFetchMode(PDO::FETCH_ASSOC);

                if ($total > 0) {
                    echo "<h3>Listado de productos</h3>";
                    echo "<table>";
                    echo "<tr>
                      <th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th>
                      </tr>";
                    while ($fila = $stmt_select->fetch()) {
                        echo "<tr>";
                        echo "<td>" . $fila['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                        echo "<td>" . number_format((float)$fila['precio'], 2) . "</td>";
                        echo "<td>" . (int)$fila['cant'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='warning-box'>La tabla existe pero esta vacia. Usa INSERTAR DATOS.</div>";
                }
            } else {
                echo "<div class='warning-box'>";
                echo "La tabla 'producto' no existe en '$dbActiva'. Usa el boton CREAR TABLA.";
                echo "</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='warning-box'>";
            echo "No se pudo acceder a la BD '$dbActiva'. Error: " . $e->getMessage();
            echo "</div>";
        }
    } else {
        echo "<div class='warning-box'>";
        echo "Sin conexion a BD. Usa los botones Conectar o Crear BD para empezar.";
        echo "</div>";
    }

    if (isset($conexion)) {
        $conexion = null;
    }
    echo "</div>";
    ?>

    <iframe id="operacionFrame" name="operacionFrame"></iframe>

</body>

</html>