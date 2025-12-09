<?php
require __DIR__ . '/conexion.php'; // Asegura la conexión a la base de datos
requireCookiesAccepted(); // Asegura que las cookies han sido aceptadas
session_start(); // Inicia la sesión para manejar usuarios

$feedback = null;

if (isset($_GET['msg'])) { // Mensaje de confirmación desde otra página
    $feedback = ['type' => 'ok', 'text' => $_GET['msg']];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try { // Procesar el formulario de login
        $usuario = trim($_POST['usuario'] ?? '');
        $contrasena = trim($_POST['contrasena'] ?? '');

        if ($usuario === '' || $contrasena === '') { // Validación básica de campos vacíos
            throw new InvalidArgumentException('El usuario y contraseña son obligatorios.');
        }

        $pdo = getPdo();
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?');
        $stmt->execute([$usuario, $contrasena]);
        $user = $stmt->fetch();

        if (!$user) { // Usuario no encontrado o credenciales incorrectas
            throw new RuntimeException('Credenciales invalidas o el usuario no existe.');
        }

        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario'] = $user['usuario'];
        $contadorActual = getSessionCount() + 1; // Persiste el total con cookie para no perderlo al cerrar sesión
        $_SESSION['contador_sesiones'] = $contadorActual;
        setcookie('cine_sesiones_iniciadas', (string)$contadorActual, time() + 86400 * 30, '/');

        header('Location: cine.php');
        exit;
    } catch (Throwable $e) { // Captura cualquier error y lo muestra como feedback
        $feedback = ['type' => 'error', 'text' => $e->getMessage()];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login cine</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="layout">
        <h1>Login</h1>
        <p>Inicia sesión para acceder a la web de cine.</p>
        <?php if ($feedback): ?>
            <div class="message <?= $feedback['type'] ?>"><?= htmlspecialchars($feedback['text'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <div class="card">
            <form method="post" novalidate>
                <div>
                    <label for="usuario">Usuario</label>
                    <input id="usuario" name="usuario" required>
                </div>
                <div>
                    <label for="contrasena">Contraseña</label>
                    <input id="contrasena" name="contrasena" type="password" required>
                </div>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>
</body>

</html>
