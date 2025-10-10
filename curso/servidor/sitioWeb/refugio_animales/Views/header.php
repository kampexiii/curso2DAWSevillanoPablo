<?php
// Detectar el nivel de la página para ajustar rutas (index.php o Pages/)
$nivel = '';
if (basename(dirname($_SERVER['SCRIPT_FILENAME'])) === 'Pages') {
    $nivel = '../';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Meta esenciales -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- SEO básico -->
    <title>Refugio de Animales | Un hogar para ellos</title>
    <meta name="description" content="Refugio de animales dedicado a rescatar y encontrar hogares responsables para perros y gatos. Adopta, dona o colabora como voluntario." />
    <meta name="keywords" content="refugio, adopción, perros, gatos, voluntariado, donaciones, cuidado animal" />
    <meta name="author" content="Refugio de Animales" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $nivel ?>Resources/assets/img/logo.png">

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="<?= $nivel ?>Resources/css/style.css" />
    <link rel="stylesheet" href="<?= $nivel ?>Resources/css/navbar.css" />
    <link rel="stylesheet" href="<?= $nivel ?>Resources/css/main-adopta.css" />


    
    <!-- Scripts JS -->
    <script defer src="<?= $nivel ?>Resources/js/main.js"></script>
</head>
<body>
<header class="site-header">
    <!-- Navbar -->
    <?php include __DIR__ . '/Partials/navbar.php'; ?>

    <!-- Hero -->
    <div class="header-hero">
        <div class="header-text">
            <h1>Un hogar para ellos</h1>
            <p>Rescatamos, cuidamos y buscamos familias responsables para nuestros animales.</p>
        </div>
    </div>
</header>

<main class="site-main container">
