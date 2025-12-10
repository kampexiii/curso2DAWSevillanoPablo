<?php
// Archivo: Octubre1/pie.php
// Este archivo genera el pie de página de la web.

// Uso la función date('Y') para obtener el año actual automáticamente.
// Así el © se actualiza solo cada año sin que yo tenga que cambiar el código.
$year = date('Y');
?>
<footer>
  <?php 
  // Primera parte: texto con el año y el nombre de la "marca".
  // FOOTER_ITEM1 viene del archivo de idioma (spain.php o english.php).
  ?>
  <p>&copy; <?php echo $year; ?> <?php echo FOOTER_ITEM1; ?></p>

  <?php 
  // Segunda parte: lista de enlaces. El texto de cada <a>
  // también viene de las constantes de idioma.
  ?>
  <ul>
    <li><a href="/acerca-de"><?php echo FOOTER_ITEM2; ?></a></li>
    <li><a href="/conectar"><?php echo FOOTER_ITEM3; ?></a></li>
    <li><a href="/rrss"><?php echo FOOTER_ITEM4; ?></a></li>
  </ul>
</footer>
