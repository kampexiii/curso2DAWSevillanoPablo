<?php
// Página de selección de extras (palomitas, bebida)
session_start();
require_once 'SessionManager.php';

// Validar que venga de selección de butaca y que el usuario esté logeado
$current_session_id = $_COOKIE['cinema_session_id'] ?? null;
$is_logged_in = $current_session_id && SessionManager::isValidSession($current_session_id);

if (!$is_logged_in || !isset($_POST['movie_id']) || !isset($_POST['seat'])) {
    // Redirigir si no hay datos o no está autenticado
    header('Location: ../index.php');
    exit;
}

$movieId = (int)$_POST['movie_id'];
$seatId = (int)$_POST['seat'];

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

// Calculate seat position (5x5 grid)
$row = floor($seatId / 5);
$col = $seatId % 5;

// Store temporary selection
$_SESSION['temp_selection'] = [
    'movie_id' => $movieId,
    'seat_row' => $row,
    'seat_col' => $col,
    'timestamp' => time()
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extras - <?php echo htmlspecialchars($movies[$movieId]); ?></title>
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Selección de Extras</h1>
    
    <div class="extras-form">
        <h2>Película: <?php echo htmlspecialchars($movies[$movieId]); ?></h2>
        <p>Asiento: <?php echo chr(65 + $row) . ($col + 1); ?></p>
        
        <form action="summary.php" method="post">
            <div class="extras-item">
                <label>
                    <input type="checkbox" name="extras[]" value="popcorn"> Palomitas (+5€)
                </label>
            </div>
            <div class="extras-item">
                <label>
                    <input type="checkbox" name="extras[]" value="drink"> Bebida (+3€)
                </label>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit">Ver resumen</button>
                <a href="seats.php?movie=<?php echo $movieId; ?>">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
