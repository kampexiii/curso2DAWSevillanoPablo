<?php
// Página de selección de asientos
session_start();
require_once 'SessionManager.php';

// Comprobar cookie y validar sesión contra el archivo de sesiones
$current_session_id = $_COOKIE['cinema_session_id'] ?? null;
$is_logged_in = $current_session_id && SessionManager::isValidSession($current_session_id);

// Si no está logeado, redirigir al inicio
if (!$is_logged_in) {
    header('Location: ../index.php');
    exit;
}

if (!isset($_GET['movie'])) {
    header('Location: ../index.php');
    exit;
}

$movieId = (int)$_GET['movie'];

// Sample movies
$movies = [
    1 => 'El Padrino',
    2 => 'Pulp Fiction',
    3 => 'Matrix',
    4 => 'El Señor de los Anillos',
    5 => 'Star Wars'
];

if (!isset($movies[$movieId])) {
    header('Location: ../index.php');
    exit;
}

// Initialize seats if not in session (5x5 = 25 seats)
if (!isset($_SESSION['seats'][$movieId])) {
    $_SESSION['seats'][$movieId] = array_fill(0, 5, array_fill(0, 5, false));
}

// Contar asientos ocupados
$occupied = 0;
foreach ($_SESSION['seats'][$movieId] as $row) {
    foreach ($row as $seat) {
        if ($seat) $occupied++;
    }
}

// Si la sala está llena, redirigir
if ($occupied >= 25) {
    header('Location: ../index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Asientos - <?php echo htmlspecialchars($movies[$movieId]); ?></title>
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Selección de Asientos: <?php echo htmlspecialchars($movies[$movieId]); ?></h1>
    
    <div class="screen">PANTALLA</div>

    <form action="extras.php" method="post">
        <input type="hidden" name="movie_id" value="<?php echo $movieId; ?>">
        <div class="seats-grid">
            <?php for($i = 0; $i < 5; $i++): ?>
                <?php for($j = 0; $j < 5; $j++): ?>
                    <?php 
                    $seatId = $i * 5 + $j;
                    $isOccupied = $_SESSION['seats'][$movieId][$i][$j];
                    ?>
                    <div class="seat <?php echo $isOccupied ? 'occupied' : ''; ?>">
                        <?php if (!$isOccupied): ?>
                            <input type="radio" name="seat" value="<?php echo $seatId; ?>" required>
                        <?php endif; ?>
                        <?php echo chr(65 + $i) . ($j + 1); ?>
                    </div>
                <?php endfor; ?>
            <?php endfor; ?>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <button type="submit">Continuar a Extras</button>
            <a href="../index.php">Volver</a>
        </div>
    </form>
</body>
</html>
