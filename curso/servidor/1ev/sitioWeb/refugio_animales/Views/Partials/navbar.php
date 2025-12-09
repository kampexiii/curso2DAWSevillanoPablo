<?php
// Detectar el nivel de la página para ajustar rutas
$nivel = '';
if (basename(dirname($_SERVER['SCRIPT_FILENAME'])) === 'Pages') {
    $nivel = '../';
}
?>

<div class="navbar-container">
    <div class="navbar-logo">
        <!-- Logo -->
        <img src="<?= $nivel ?>Resources/assets/img/logo.png" alt="Refugio de Animales - Un hogar para ellos" />
        <!-- Título -->
        <h1 class="site-title">
            <a href="<?= $nivel ?>index.php">Refugio de Animales</a>
            <small>— Un hogar para ellos</small>
        </h1>
    </div>

    <nav class="navbar-menu" aria-label="Navegación principal">
        <!-- Rutas con nivel dinámico -->
        <a href="<?= $nivel ?>index.php">Inicio</a>
        <a href="<?= $nivel ?>Pages/adopta.php">Adopta</a>
        <a href="<?= $nivel ?>Pages/requisitos-adopcion.php">Requisitos</a>
        <a href="<?= $nivel ?>Pages/voluntariado.php">Voluntariado</a>
        <a href="<?= $nivel ?>Pages/donaciones.php">Donaciones</a>
        <a href="<?= $nivel ?>Pages/sobre-nosotros.php">Sobre nosotros</a>
        <a href="<?= $nivel ?>Pages/contacto.php">Contacto</a>

        <!-- Botón toggle tema claro/oscuro -->
        <button id="theme-toggle" class="theme-toggle" aria-pressed="false" title="Cambiar tema (modo claro/oscuro)">
            ☀️ Claro
        </button>
    </nav>
</div>
