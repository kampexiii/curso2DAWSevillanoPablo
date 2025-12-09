<?php
require __DIR__ . '/conexion.php';
requireLogin(); // Asegura que el usuario esté logueado


$pdo = getPdo(); // Obtener la conexión PDO
$peliculas = $pdo->query('SELECT * FROM peliculas ORDER BY id')->fetchAll();
$contadorSesiones = getSessionCount();
$feedback = null;

if (isset($_GET['msg'])) { // Mensaje de feedback
    $feedback = ['type' => 'ok', 'text' => $_GET['msg']];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cartelera - Cines Pablo Sevillano</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="layout">
        <div class="actions">
            <span class="muted">Usuario: <?= htmlspecialchars($_SESSION['usuario'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            <a href="sesiones.php">Ver sesiones iniciadas</a>
            <a href="logout.php">Cerrar sesión</a>
        </div>
        <h1>Web de cine</h1>
        <p>Reserva tus entradas. Sesiones iniciadas: <?= (int)$contadorSesiones ?></p>
        <div class="info-box">
            <div class="button-container">
                <span class="muted">Sarah, pulsa aqui si es la primera vez que entras en mi ejercicio, pulsa para crear la base de datos, las tablas y cargar las pelis: La Novena Puerta, maraton de El Senor de los Anillos y Jurassic Park.</span>
                <form method="post" action="instalar.php">
                    <button type="submit" class="btn btn-create" name="instalar" value="1">Crear base y pelis</button>
                </form>
            </div>
        </div>
        <?php if ($feedback): ?>
            <div class="message <?= $feedback['type'] ?>"><?= htmlspecialchars($feedback['text'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <div class="card"><!-- Cartelera -->
            <h3>Cartelera</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Película</th>
                        <th>Total sillas</th>
                        <th>Reservadas</th>
                        <th>Disponibles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peliculas as $p): // Calcular sillas disponibles
                        $disponibles = (int)$p['sillas_total'] - (int)$p['sillas_reservadas'];
                    ?>
                        <tr>
                            <td><?= (int)$p['id'] ?></td>
                            <td><?= htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= (int)$p['sillas_total'] ?></td>
                            <td><?= (int)$p['sillas_reservadas'] ?></td>
                            <td><?= $disponibles ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3>Reservar</h3>
            <form method="post" action="reservar.php" novalidate> <!-- Formulario de reserva -->
                <div>
                    <label for="pelicula_id">Película</label>
                    <select id="pelicula_id" name="pelicula_id" required>
                        <option value="">Selecciona</option>
                        <?php foreach ($peliculas as $p): ?> <!-- Mostrar opciones de películas -->
                            <option value="<?= (int)$p['id'] ?>"><?= htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="sillas">Sillas a reservar</label> <!-- Campo para número de sillas -->
                    <input id="sillas" name="sillas" type="number" min="1" required> <!-- Sillas mínimas 1 -->
                </div>
                <button type="submit">Confirmar reserva</button>
            </form>
        </div>
    </div>
</body>

</html>