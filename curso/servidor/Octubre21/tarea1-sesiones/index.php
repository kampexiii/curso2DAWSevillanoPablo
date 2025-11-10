<?php
// index.php — login básico sin JS
// Nota: inicio sesión para poder leer estado actual y mensajes (?msg=...), como se pide.
session_start();

// Nota: evito caché para no reutilizar esta vista tras cerrar sesión.
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

// Nota: si ya hay usuario en sesión, redirijo al dashboard directamente (evito repetir login).
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$msg = $_GET['msg'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Tarea 1 (Sesiones)</title>
    <!-- Nota: estilos base globales del proyecto (CSS externo, nada inline). -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
  <div class="card">
    <!-- Nota: logo del centro, centrado y pequeño (como se pide). -->
    <div class="logo-wrap">
      <img src="assets/img/logo/logo.png" alt="Logo del centro" class="site-logo">
    </div>

    <h1>Aula Básica — Acceso estudiantes</h1>
    <p class="muted small">
      Sesión + cookie. Expulsión automática a los <strong>20s</strong> (como dice el ejercicio).
      <br>Credenciales de prueba: <code>usuario</code> o <code>alumno</code> · clave <code>alumno</code>.
    </p>

    <?php if ($msg): ?>
      <!-- Nota: muestro mensajes de retorno (logout, timeout, etc.). -->
      <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <!-- Nota: formulario mínimo, sin BBDD ni JS, como se pide. -->
    <form action="login.php" method="post" autocomplete="off">
      <div class="row">
        <label for="username">Usuario</label>
        <!-- Nota: guío la prueba con placeholder coherente con las credenciales de demo. -->
        <input id="username" name="username" required placeholder="usuario o alumno" autofocus>
      </div>
      <div class="row">
        <label for="password">Contraseña</label>
        <!-- Nota: contraseña de prueba 'alumno' (el ejercicio no valida contra BBDD). -->
        <input id="password" name="password" type="password" required placeholder="alumno">
      </div>
      <div class="row">
        <button class="btn" type="submit">Entrar</button>
      </div>
    </form>

  </div>
</body>
</html>
