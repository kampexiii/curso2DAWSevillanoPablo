<?php
// Página principal: lista películas, login y estadísticas
session_start();
require_once __DIR__ . '/src/SessionManager.php';

// Inicializamos contador de reservas si no existe
if (!isset($_SESSION['total_reservations'])) {
    $_SESSION['total_reservations'] = 0;
}

// Limpiamos sesiones expiradas y recuperamos las activas (archivo JSON)
$active_sessions = SessionManager::cleanExpiredSessions();

// Comprobamos cookie para saber si este navegador está logeado
$current_session_id = $_COOKIE['cinema_session_id'] ?? null;
$is_logged_in = $current_session_id && SessionManager::isValidSession($current_session_id);

// Nombre de usuario actual si está logeado
$current_username = $is_logged_in ? SessionManager::getUsername($current_session_id) : null;

// Predefined users (username => password)
$users = [
    'usuario' => 'usuario',
    'alumno' => 'alumno',
    'profesor' => 'profesor',
    'pablo' => 'pablo',
    'admin' => 'admin'
];

// Sample movies
$movies = [
    1 => 'El Padrino',
    2 => 'Pulp Fiction',
    3 => 'Matrix',
    4 => 'El Señor de los Anillos',
    5 => 'Star Wars'
];

// Función para contar asientos ocupados de una película
function countOccupiedSeats($movieId) {
    if (!isset($_SESSION['seats'][$movieId])) {
        return 0;
    }
    $count = 0;
    foreach ($_SESSION['seats'][$movieId] as $row) {
        foreach ($row as $seat) {
            if ($seat) $count++;
        }
    }
    return $count;
}

// Total de asientos por sala
define('TOTAL_SEATS', 25); // 5x5

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema - Inicio</title>
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido a nuestro Cine</h1>
        
        <?php if($is_logged_in): ?>
            <div class="message success">
                <p>Bienvenido, <?php echo htmlspecialchars($current_username); ?>!</p>
            </div>
            <div class="nav-links">
                <a href="src/logout.php">Cerrar sesión</a>
            </div>
        <?php endif; ?>

    <div class="movie-list">
        <?php foreach($movies as $id => $title): ?>
            <?php 
            $occupied = countOccupiedSeats($id);
            $isFull = $occupied >= TOTAL_SEATS;
            ?>
            <div class="movie-card">
                <h3><?php echo htmlspecialchars($title); ?></h3>
                <?php if($isFull): ?>
                    <p class="full-message" style="color: #ff4444; font-weight: bold; margin: 10px 0;">¡SALA LLENA!</p>
                    <p style="color: #666; font-size: 0.9em;">Todas las butacas están reservadas (<?php echo $occupied; ?>/<?php echo TOTAL_SEATS; ?>)</p>
                <?php else: ?>
                    <p style="color: #666; font-size: 0.9em;">Butacas disponibles: <?php echo (TOTAL_SEATS - $occupied); ?>/<?php echo TOTAL_SEATS; ?></p>
                    <?php if($is_logged_in): ?>
                        <a href="src/seats.php?movie=<?php echo $id; ?>">Seleccionar asientos</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if(!$is_logged_in): ?>
        <div class="form-container">
            <h2>Iniciar sesión</h2>
            <form action="src/login.php" method="post">
                <div>
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div style="text-align: center; margin-top: 15px;">
                    <button type="submit">Iniciar sesión</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <div class="stats">
            <h3>Estadísticas</h3>
            <p>Sesiones activas: <?php echo count($active_sessions); ?></p>
            <p>Butacas reservadas: <?php echo $_SESSION['total_reservations']; ?></p>
            
            <div class="movie-stats" style="margin-top: 15px; padding: 10px; background: white; border-radius: 5px;">
                <h4>Reservas por película:</h4>
                <ul style="list-style: none; padding-left: 0;">
                    <?php foreach($movies as $id => $title): ?>
                        <?php $occupied = countOccupiedSeats($id); ?>
                        <li style="margin: 5px 0; padding: 5px; border-left: 3px solid <?php echo $occupied >= TOTAL_SEATS ? '#ff5252' : '#2196F3'; ?>;">
                            <strong><?php echo htmlspecialchars($title); ?>:</strong> 
                            <?php echo $occupied; ?>/<?php echo TOTAL_SEATS; ?> butacas
                            <?php if($occupied >= TOTAL_SEATS): ?>
                                <span style="color: #ff5252; font-weight: bold;"> (COMPLETA)</span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php if($is_logged_in && isset($active_sessions) && count($active_sessions) > 0): ?>
                <div class="active-users">
                    <h4>Usuarios activos:</h4>
                    <ul>
                    <?php foreach($active_sessions as $sid => $session): ?>
                        <li><?php echo htmlspecialchars($session['username']); ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if($is_logged_in && $current_username === 'admin'): ?>
                <div class="admin-panel" style="margin-top: 20px; padding: 15px; border: 2px solid #ff4444; border-radius: 5px;">
                    <h4 style="color: #ff4444;">Panel de Administración</h4>
                    <form action="src/admin_clear.php" method="post" onsubmit="return confirm('¿Estás seguro? Esto borrará TODAS las reservas.');">
                        <input type="hidden" name="clear_all" value="1">
                        <button type="submit" style="background-color: #ff4444; color: white; border: none; padding: 10px 15px; border-radius: 3px; cursor: pointer;">
                            Borrar todas las reservas
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>