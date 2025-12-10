<?php
// Defino mi propio manejador de errores
function manejadorErrores($errno, $str, $file, $line) {
    echo "<strong>⚠️ Ha ocurrido un error</strong><br>";
    echo "Número de error: $errno <br>";
    echo "Descripción: $str <br>";
    echo "Archivo: $file <br>";
    echo "Línea: $line <br>";
    echo "<hr>";
}

// Le digo a PHP que use mi función en lugar de la suya
set_error_handler("manejadorErrores");

// Provoco un error: $b no está definida
$a = $b;
?>
