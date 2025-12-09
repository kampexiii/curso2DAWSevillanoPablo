<?php
require __DIR__ . '/conexion.php';

$feedback = null;

if (!empty($_COOKIE['cine_cookies_aceptadas'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Procesar formulario
    if (isset($_POST['aceptar'])) { // Aceptar cookies 
        setcookie('cine_cookies_aceptadas', '1', time() + 604800, '/'); // 1 semana de validez
        header('Location: login.php'); // Redirigir al login
        exit;
    } else { // Rechazar
        $feedback = ['type' => 'error', 'text' => 'Debes aceptar las cookies para poder continuar y acceder a nuestro cine.'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>cookies</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="layout">
        <h1>Cookies</h1> <!-- Aviso de cookies -->
        <p>Debes aceptar las cookies para poder continuar y acceder a nuestro cine. <br> Al aceptar, permites el uso de cookies según nuestra política de privacidad (que más adelante podrás consultar en nuestra página web).</p>
        <?php if ($feedback): ?>
            <div class="message <?= $feedback['type'] ?>"><?= htmlspecialchars($feedback['text'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <div class="card">
            <form method="post">
                <div class="actions">
                    <button type="submit" name="aceptar" value="1">Aceptar</button>
                    <button type="submit" name="rechazar" value="0">Rechazar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>