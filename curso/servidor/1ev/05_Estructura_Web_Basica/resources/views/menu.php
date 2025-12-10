<?php
// Archivo: Octubre1/resources/views/menu.php
// Este archivo genera la lista de enlaces del menú de navegación.
// El contenido de cada enlace viene de un array $MENU que se carga
// desde el archivo de idioma correspondiente (spain.php o english.php).
?>
<ul>
<?php 
// Recorro el array asociativo $MENU con foreach.
// $key sería el índice ("menu_item1", "menu_item2", ...)
// $label es el texto que se mostrará ("Enlace 1", "Link 1", etc.)
foreach ($MENU as $key => $label): ?>
    <li><a href="#"><?php echo $label; ?></a></li>
<?php endforeach; ?>
</ul>
