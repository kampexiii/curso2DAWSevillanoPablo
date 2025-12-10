<?php
// dashboard.php — protegida (como se pide en el enunciado: zona solo accesible con sesión activa)
session_start();

// Nota: evito caché para que al volver atrás tras logout no se muestre el dashboard.
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

if (!isset($_SESSION['user'])) {
    // Nota: si no hay sesión, redirijo a login como dice el ejercicio.
    header('Location: index.php?msg=' . urlencode('Inicia sesión para continuar.'));
    exit;
}

// --- Control de tiempo (20s) como se pide ---
$timeout = 20; // segundos por defecto
// Nota: permito override por query ?t=5 para demostrar la expiración (lo que “hay que modificar”).
if (isset($_GET['t']) && ctype_digit($_GET['t'])) {
    $timeout = max(1, (int)$_GET['t']);
}

$loginAt = (int)($_SESSION['user']['login_at'] ?? 0);
$now = time();
$elapsed = $now - $loginAt;

if ($elapsed > $timeout) {
    // Nota: expulsión por timeout y delego el guardado JSON en logout.php (como se pide).
    header('Location: logout.php?reason=timeout');
    exit;
}

$remaining = max(0, $timeout - $elapsed);
$username  = $_SESSION['user']['username'] ?? '(desconocido)';

// Cookies visibles (como dice el ejercicio: mostrar PHPSESSID y cookie propia)
$cookieUser = $_COOKIE['user_name'] ?? '(sin cookie)';
$cookieSess = $_COOKIE[session_name()] ?? '(sin cookie)';

// --- Datos “hard-coded” del alumno (sin BBDD) como se pide ---
$alumno = [
    // Nota: nombre completo tal cual.
    'nombre' => 'Pablo Sevillano Aparicio',

    // Nota: por defecto cargo la foto genérica del alumno; si no existe, caeré al logo del sitio.
    'foto'   => 'assets/img/welcome/alumno_generico.png',

    // Nota: lista de asignaturas, notas aprobadas y faltas moderadas (como se pide).
    'asignaturas' => [
        ['nombre' => 'Desarrollo en Entorno Servidor', 'nota' => 7.8, 'faltas' => 3],
        ['nombre' => 'Desarrollo en Entorno Cliente',  'nota' => 7.2, 'faltas' => 4],
        ['nombre' => 'SEO',                            'nota' => 8.1, 'faltas' => 2],
        ['nombre' => 'Programación en Python',         'nota' => 7.5, 'faltas' => 5],
        ['nombre' => 'Digitalización',                 'nota' => 8.3, 'faltas' => 1],
        ['nombre' => 'Sostenibilidad',                 'nota' => 7.9, 'faltas' => 2],
    ],

    // Nota: mensaje de bienvenida personalizado para el usuario que se registró (como se pide).
    'bienvenida' => '¡Bienvenido, ' . htmlspecialchars($username) . '! Tu registro se completó correctamente. Este es tu panel de estudiante.',
];

// Nota: calculo medias y totales para mostrar un pequeño resumen (como dice el ejercicio).
$totalNotas   = 0.0;
$totalFaltas  = 0;
$cnt          = count($alumno['asignaturas']);
foreach ($alumno['asignaturas'] as $asig) {
    $totalNotas  += (float)$asig['nota'];
    $totalFaltas += (int)$asig['faltas'];
}
$media = $cnt > 0 ? round($totalNotas / $cnt, 2) : 0.0;

// Nota: fallback de imagen si no existe la foto indicada (primero placeholder de alumno, luego logo).
$fotoRuta = $alumno['foto'];
if (!file_exists($fotoRuta)) {
    $placeholderAlumno = 'assets/img/welcome/alumno_generico.png';
    $fotoRuta = file_exists($placeholderAlumno) ? $placeholderAlumno : 'assets/img/logo/logo.png';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aula Básica — Panel del estudiante</title>
    <!-- Nota: estilos base del proyecto -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Nota: estilos específicos del dashboard (como se pide, CSS fuera) -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
  <div class="card">
    <!-- Nota: logo del centro, centrado y pequeño (como se pide). -->
    <div class="logo-wrap">
      <img src="assets/img/logo/logo.png" alt="Logo del centro" class="site-logo">
    </div>

    <div class="header">
      <img src="<?= htmlspecialchars($fotoRuta) ?>" alt="Foto del alumno" class="avatar">
      <div>
        <h1>Panel del estudiante</h1>
        <p class="muted small"><?= $alumno['bienvenida'] ?></p>
      </div>
    </div>

    <!-- Nota: bloque de sesión y temporizador como se pide (20s) -->
    <div class="row">
      <div class="kv">
        <div>Estudiante:</div><div><span class="pill"><?= htmlspecialchars($alumno['nombre']) ?></span></div>
        <div>Usuario (login):</div><div><?= htmlspecialchars($username) ?></div>
        <div>Login a las:</div><div><?= date('H:i:s', $loginAt) ?></div>
        <div>Segundos transcurridos:</div><div><?= (int)$elapsed ?></div>
        <div>Segundos restantes:</div><div><?= (int)$remaining ?></div>
      </div>
    </div>

    <!-- Nota: muestro también las 2 variables sueltas (como se pide en el enunciado) -->
    <div class="row">
      <div class="kv">
        <div>Curso:</div><div><span class="pill"><?= htmlspecialchars($_SESSION['curso'] ?? '—') ?></span></div>
        <div>Turno:</div><div><span class="pill"><?= htmlspecialchars($_SESSION['turno'] ?? '—') ?></span></div>
      </div>
    </div>

    <div class="grid-2">
      <!-- Nota: tabla de asignaturas con notas y faltas (como se pide en el ejercicio) -->
      <div class="section">
        <h2>Asignaturas, notas y faltas</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Asignatura</th>
              <th>Nota</th>
              <th>Faltas</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($alumno['asignaturas'] as $asig): ?>
            <?php
              // Nota: todas son aprobadas (>=5) como pediste.
              $aprobada = ((float)$asig['nota']) >= 5.0;
              // Nota: marco aviso “faltas” si pasa de 4 (moderado, sin alarmas).
              $tieneFaltas = ((int)$asig['faltas']) >= 5;
            ?>
            <tr>
              <td><?= htmlspecialchars($asig['nombre']) ?></td>
              <td><?= number_format((float)$asig['nota'], 1, ',', '') ?></td>
              <td><?= (int)$asig['faltas'] ?></td>
              <td>
                <?php if ($aprobada): ?>
                  <span class="badge-ok">Aprobada</span>
                <?php endif; ?>
                <?php if ($tieneFaltas): ?>
                  &nbsp;<span class="badge-warn">Revisar faltas</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>

        <div class="row">
          <div class="kv">
            <div>Media actual:</div><div><strong><?= number_format($media, 2, ',', '') ?></strong></div>
            <div>Faltas totales:</div><div><strong><?= (int)$totalFaltas ?></strong></div>
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>
</body>
</html>
