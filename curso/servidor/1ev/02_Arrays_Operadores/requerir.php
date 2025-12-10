<?php
/**
 * ----------------------------
 * Script principal (requerir.php)
 * ----------------------------
 * Aquí declaramos variables y usamos `require` para incluir otro archivo.
 * `require` se asegura de que si el archivo no existe → lanza un error fatal
 * y detiene la ejecución del programa.
 */

// Definimos una variable en el script principal
$a = "variable del principal";

// Incluimos el archivo externo (ejerequerido.php)
require "ejerequerido.php";

// Definimos otra variable DESPUÉS de hacer el require
$b = "otra variable del principal";

// Mostramos un mensaje del script principal
echo "En el script principal";
