<?php
require __DIR__ . '/conexion.php';
requireLogin();

$feedback = null;
$detalle = null;
$contadorSesiones = getSessionCount();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Procesar reserva
    try {
        $peliculaId = (int)($_POST['pelicula_id'] ?? 0);
        $sillas = (int)($_POST['sillas'] ?? 0);

        if ($peliculaId <= 0) { // ID inválido
            throw new InvalidArgumentException('Selecciona una película válida.');
        }
        if ($sillas <= 0) { // Cantidad inválida
            throw new InvalidArgumentException('Las sillas deben ser mayores que 0.');
        }

        $pdo = getPdo();
        $pdo->beginTransaction();

        $stmt = $pdo->prepare('SELECT * FROM peliculas WHERE id = ? FOR UPDATE');
        $stmt->execute([$peliculaId]);
        $pelicula = $stmt->fetch();
        if (!$pelicula) { // Película no encontrada
            throw new RuntimeException('La película no existe.');
        }

        $disponibles = (int)$pelicula['sillas_total'] - (int)$pelicula['sillas_reservadas'];
        if ($sillas > $disponibles) { // No hay suficientes sillas
            throw new RuntimeException('No hay suficientes sillas disponibles.');
        }

        $nextId = (int)$pdo->query('SELECT IFNULL(MAX(id), 0) + 1 FROM reservas')->fetchColumn();

        $insert = $pdo->prepare(
            'INSERT INTO reservas (id, usuario_id, pelicula_id, sillas_reservadas) VALUES (?, ?, ?, ?)'
        );
        $insert->execute([$nextId, $_SESSION['usuario_id'], $peliculaId, $sillas]);

        $update = $pdo->prepare('UPDATE peliculas SET sillas_reservadas = sillas_reservadas + ? WHERE id = ?');
        $update->execute([$sillas, $peliculaId]);

        $pdo->commit();

        $saldo = $disponibles - $sillas; // Sillas restantes después de la reserva
        $feedback = ['type' => 'ok', 'text' => 'Reserva realizada.']; // Éxito
        $detalle = [ // Detalles de la reserva
            'pelicula' => $pelicula['nombre'],
            'reservadas' => $sillas,
            'libres' => $saldo,
        ];
    } catch (Throwable $e) { // Manejo de errores
        if (isset($pdo) && $pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $feedback = ['type' => 'error', 'text' => $e->getMessage()];
    }
} else { // Acceso inválido
    $feedback = ['type' => 'error', 'text' => 'Acceso inválido. Usa el formulario de la cartelera.'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reserva</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="layout">
        <div class="actions">
            <a href="cine.php">Volver al cine</a>
            <a href="logout.php">Cerrar sesión</a>
        </div>
        <h1>Resultado de la reserva</h1>
        <p>Sesiones iniciadas: <?= (int)$contadorSesiones ?></p>
        <?php if ($feedback): ?>
            <div class="message <?= $feedback['type'] ?>"><?= htmlspecialchars($feedback['text'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <?php if ($detalle): ?>
            <div class="card">
                <p>Película: <strong><?= htmlspecialchars($detalle['pelicula'], ENT_QUOTES, 'UTF-8') ?></strong></p>
                <p>Sillas reservadas: <?= (int)$detalle['reservadas'] ?></p>
                <p>Sillas libres restantes: <?= (int)$detalle['libres'] ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
