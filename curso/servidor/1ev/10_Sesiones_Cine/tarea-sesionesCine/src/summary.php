<?php
// Resumen de compra: muestra precio y tiempo restante de la reserva
session_start();
require_once 'SessionManager.php';

// Validar login y selección temporal
$current_session_id = $_COOKIE['cinema_session_id'] ?? null;
$is_logged_in = $current_session_id && SessionManager::isValidSession($current_session_id);

if (!$is_logged_in || !isset($_SESSION['temp_selection'])) {
    header('Location: ../index.php');
    exit;
}

// Comprobar timeout de 10 minutos para la reserva temporal
if (time() - $_SESSION['temp_selection']['timestamp'] > 600) {
    unset($_SESSION['temp_selection']);
    header('Location: ../index.php?error=timeout');
    exit;
}

$movieId = $_SESSION['temp_selection']['movie_id'];
$row = $_SESSION['temp_selection']['seat_row'];
$col = $_SESSION['temp_selection']['seat_col'];

// Sample movies
$movies = [
    1 => 'El Padrino',
    2 => 'Pulp Fiction',
    3 => 'Matrix',
    4 => 'El Señor de los Anillos',
    5 => 'Star Wars'
];

// Calculate prices
$seatPrice = 8; // Base price for seat
$extras = $_POST['extras'] ?? [];
$extrasPrice = 0;

foreach ($extras as $extra) {
    if ($extra === 'popcorn') $extrasPrice += 5;
    if ($extra === 'drink') $extrasPrice += 3;
}

$totalPrice = $seatPrice + $extrasPrice;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Compra</title>
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>
    <div class="container">
        <div class="summary">
        <h1>Resumen de tu reserva</h1>
        
        <h2><?php echo htmlspecialchars($movies[$movieId]); ?></h2>
        <p>Asiento: <?php echo chr(65 + $row) . ($col + 1); ?></p>
        
        <div class="price-breakdown">
            <div class="price-item">
                <span>Entrada</span>
                <span><?php echo $seatPrice; ?>€</span>
            </div>
            <?php if (in_array('popcorn', $extras)): ?>
            <div class="price-item">
                <span>Palomitas</span>
                <span>5€</span>
            </div>
            <?php endif; ?>
            <?php if (in_array('drink', $extras)): ?>
            <div class="price-item">
                <span>Bebida</span>
                <span>3€</span>
            </div>
            <?php endif; ?>
            <div class="price-item total">
                <span>Total</span>
                <span><?php echo $totalPrice; ?>€</span>
            </div>
        </div>

        <form action="confirm.php" method="post">
            <input type="hidden" name="confirm_purchase" value="1">
            <div style="margin-top: 20px;">
                <button type="submit">Pagar ahora</button>
                <a href="extras.php">Volver</a>
            </div>
        </form>
        
        <p><small>Tu reserva expirará en <?php echo ceil((600 - (time() - $_SESSION['temp_selection']['timestamp'])) / 60); ?> minutos</small></p>
    </div>
</body>
</html>
