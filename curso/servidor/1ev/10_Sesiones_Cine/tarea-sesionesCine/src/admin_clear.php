<?php
// Panel de administración - Borrar todas las reservas
session_start();
require_once 'SessionManager.php';

// Verificar que sea el admin
$current_session_id = $_COOKIE['cinema_session_id'] ?? null;
$current_username = SessionManager::getUsername($current_session_id);

if (!$current_session_id || $current_username !== 'admin') {
    header('Location: ../index.php?error=unauthorized');
    exit;
}

// Limpiar todas las reservas si viene del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_all'])) {
    // Obtener todas las sesiones activas
    $sessions = SessionManager::getActiveSessions();
    
    // Actualizar cada sesión para limpiar sus reservas
    foreach ($sessions as $sessionId => &$session) {
        $session['seats'] = [];
        $session['total_reservations'] = 0;
    }
    
    // Guardar las sesiones actualizadas
    file_put_contents(__DIR__ . '/../data/active_sessions.json', json_encode($sessions, JSON_PRETTY_PRINT));
    
    // Limpiar también la sesión actual del admin
    $_SESSION['seats'] = [];
    $_SESSION['total_reservations'] = 0;
    
    header('Location: ../index.php?success=cleared');
    exit;
}

header('Location: ../index.php');
exit;