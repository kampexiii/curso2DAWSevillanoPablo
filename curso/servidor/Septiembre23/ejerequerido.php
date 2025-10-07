<?php
/**
 * ----------------------------
 * Script requerido (ejerequerido.php)
 * ----------------------------
 * Este archivo se ejecuta en el momento en que se hace `require` en el principal.
 * Puede acceder a las variables definidas en el principal, 
 * pero OJO: solo a las que estén definidas antes del require.
 */

// Mensaje para indicar que estamos dentro del fichero requerido
echo "En el fichero requerido <br>";

// Mostramos la variable $a (existe en el script principal ANTES del require)
echo $a . "<br>";

// Intentamos mostrar $b (todavía NO está definida en el principal en este punto)
echo $b . "<br>";  // Esto generará un Notice: Undefined variable
