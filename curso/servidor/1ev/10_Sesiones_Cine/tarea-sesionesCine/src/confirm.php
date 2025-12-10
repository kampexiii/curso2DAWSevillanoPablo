<?php
// Confirmación de pago (simulada): marca la butaca y guarda reserva
session_start();
require_once 'SessionManager.php';

// Validar login, selección temporal y confirmación POST
$current_session_id = $_COOKIE['cinema_session_id'] ?? null;
$is_logged_in = $current_session_id && SessionManager::isValidSession($current_session_id);

if (!$is_logged_in || !isset($_SESSION['temp_selection']) || !isset($_POST['confirm_purchase'])) {
    header('Location: ../index.php');
    exit;
}

// Comprobar timeout de 10 minutos
if (time() - $_SESSION['temp_selection']['timestamp'] > 600) {
    unset($_SESSION['temp_selection']);
    header('Location: ../index.php?error=timeout');
    exit;
}

$movieId = $_SESSION['temp_selection']['movie_id'];
$row = $_SESSION['temp_selection']['seat_row'];
$col = $_SESSION['temp_selection']['seat_col'];

// Marcar la butaca como ocupada en la sesión actual
$_SESSION['seats'][$movieId][$row][$col] = true;
// Incrementar contador global de reservas
$_SESSION['total_reservations']++;

// Borrar selección temporal
unset($_SESSION['temp_selection']);

// Redirigir con éxito
header('Location: ../index.php?success=1');
exit;
?>
