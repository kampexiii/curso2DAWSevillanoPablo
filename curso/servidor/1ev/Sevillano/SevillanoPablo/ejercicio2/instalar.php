<?php
require __DIR__ . '/conexion.php';
//este php se utiliza para crear la base de datos, las tablas y cargar las pelis
//asi podras usar mi misma base de datos para corregir el examen sara.
//un saludo!

function installDatabase(): void
{
    global $dbHost, $dbName, $dbUser, $dbPass;

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $rootPdo = new PDO("mysql:host={$dbHost};charset=utf8mb4", $dbUser, $dbPass, $options);
    $rootPdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    $dbDsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dbDsn, $dbUser, $dbPass, $options);
    ensureSchema($pdo);
}

function ensureSchema(PDO $pdo): void
{
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(50) NOT NULL UNIQUE,
            contrasena VARCHAR(50) NOT NULL
        )"
    );

    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS peliculas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            sillas_total INT NOT NULL,
            sillas_reservadas INT DEFAULT 0
        )"
    );

    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS reservas (
            id INT PRIMARY KEY,
            usuario_id INT NOT NULL,
            pelicula_id INT NOT NULL,
            sillas_reservadas INT NOT NULL,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
            FOREIGN KEY (pelicula_id) REFERENCES peliculas(id)
        )"
    );

    seedUsuarios($pdo);
    seedPeliculas($pdo);
}

function seedUsuarios(PDO $pdo): void
{
    $usuarios = [
        ['admin', 'admin'],
        ['cliente1', '1234'],
        ['cliente2', '1234'],
    ];

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE usuario = ?');
    $insert = $pdo->prepare('INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)');

    foreach ($usuarios as [$user, $pass]) {
        $stmt->execute([$user]);
        if ((int)$stmt->fetchColumn() === 0) {
            $insert->execute([$user, $pass]);
        }
    }
}

function seedPeliculas(PDO $pdo): void
{
    if ((int)$pdo->query('SELECT COUNT(*) FROM peliculas')->fetchColumn() > 0) {
        return;
    }

    $peliculas = [
        ['La Novena Puerta', 90],
        ['El Senor de los Anillos - Maraton', 180],
        ['Jurassic Park', 120],
    ];

    $stmt = $pdo->prepare('INSERT INTO peliculas (nombre, sillas_total, sillas_reservadas) VALUES (?, ?, 0)');
    foreach ($peliculas as [$nombre, $total]) {
        $stmt->execute([$nombre, $total]);
    }
}

$feedback = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Procesar el formulario de instalacion
    try {
        installDatabase();
        $feedback = [
            'type' => 'ok',
            'text' => 'Base de datos y tablas listas. Usuarios y pelis insertados si no existian.',
        ];
    } catch (Throwable $e) { // Captura cualquier error y lo muestra como feedback
        $feedback = ['type' => 'error', 'text' => $e->getMessage()];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cine Pablo Sevillano</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="layout">
        <div class="actions">
            <a href="cine.php">Ir a la cartelera</a>
            <a href="login.php">Login</a>
        </div>
        <h1>Instalar base de datos</h1>
        <p>Al pulsar el boton se crea la base de datos <strong>cine</strong>, las tablas y se cargan mis pelis favoritas.</p>

        <?php if ($feedback): ?>
            <div class="message <?= $feedback['type'] ?>"><?= htmlspecialchars($feedback['text'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <div class="card">
            <h3>Este php es para facilitarte mi correccion</h3>
            <ul>
                <li>Este php se utiliza para crear la base de datos, las tablas y cargar las pelis</li>
                <li>Asi podras usar mi misma base de datos para corregir el examen Sarah. </li>
                <li>Peliculas que se insertan (mi gusto): La Novena Puerta, maraton de El Senor de los Anillos y Jurassic Park.</li>
                <li>un saludo!</li>
            </ul>
            <form method="post" class="button-container">
                <button type="submit" class="btn btn-create" name="instalar" value="1">Hacer Magia</button> <!-- Pulsar para instalar -->
            </form>
        </div>
    </div>
</body>

</html>
