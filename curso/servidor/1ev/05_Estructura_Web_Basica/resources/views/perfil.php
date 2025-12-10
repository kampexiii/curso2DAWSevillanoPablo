<?php
// Archivo: Octubre1/resources/views/perfil.php
// Este archivo solo se encarga de mostrar el bloque de perfil:
// la imagen del usuario y el texto "Mi cuenta / My account".

// Guardo la ruta de la imagen en una variable. Al estar en "assets/img",
// basta con poner la ruta relativa desde index.php.
$avatar = 'assets/img/usuario1.JPG';
?>

<div class="perfil">
    <?php 
    // Imagen del usuario. El alt es importante para accesibilidad.
    ?>
    <a href="#"><img src="<?php echo $avatar; ?>" alt="usuario"></a>
    
    <?php 
    // Texto debajo de la foto. Viene de la constante NAVBAR_TITLE,
    // que cambia según el idioma cargado (spain.php o english.php).
    ?>
    <a href="#" class="perfil-nombre"><?php echo NAVBAR_TITLE; ?></a>
</div>
