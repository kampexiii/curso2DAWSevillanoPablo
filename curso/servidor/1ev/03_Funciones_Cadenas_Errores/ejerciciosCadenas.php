<?php
/**
 * Archivo: ejerciciosCadenas.php
 * Descripción: Lista de ejercicios de funciones de variables, cadenas y arrays en PHP.
 * Formato: Explicación → Ejemplo resuelto (con caso TRUE y caso FALSE) → Ejercicio propuesto
 */

/* ===============================
   FUNCIONES DE VARIABLES
   =============================== */

// isset()
echo "<h2>isset(\$var)</h2>";
echo "Explicación: Devuelve TRUE si la variable está inicializada y no es NULL.<br>";
$nombre = "Pablo";
$sinDefinir = NULL;
echo "Ejemplo 1 (se cumple): isset(\$nombre) → " . (isset($nombre) ? "TRUE" : "FALSE") . "<br>";
echo "Ejemplo 2 (no se cumple): isset(\$sinDefinir) → " . (isset($sinDefinir) ? "TRUE" : "FALSE") . "<br>";
echo "Ejercicio: Crea una variable \$curso y comprueba con isset().<br><br>";
$curso = "2ºDAW";
echo "Resolucion del ejercicio: ". (isset($curso) ? "TRUE" : "FALSE" . "<br><br>");


// is_null()
echo "<h2>is_null(\$var)</h2>";
echo "Explicación: Devuelve TRUE si la variable es NULL.<br>";
$varNull = NULL;
$varTexto = "Hola";
echo "Ejemplo 1 (se cumple): is_null(\$varNull) → " . (is_null($varNull) ? "TRUE" : "FALSE") . "<br>";
echo "Ejemplo 2 (no se cumple): is_null(\$varTexto) → " . (is_null($varTexto) ? "TRUE" : "FALSE") . "<br>";
echo "Ejercicio: Declara una variable sin valor y verifica si es NULL.<br><br>";


// empty()
echo "<h2>empty(\$var)</h2>";
echo "Explicación: Devuelve TRUE si la variable no está inicializada o es FALSE/0/''.<br>";
$vacio = "";
$lleno = "PHP";
echo "Ejemplo 1 (se cumple): empty('') → " . (empty($vacio) ? "TRUE" : "FALSE") . "<br>";
echo "Ejemplo 2 (no se cumple): empty('PHP') → " . (empty($lleno) ? "TRUE" : "FALSE") . "<br>";
echo "Ejercicio: Crea una variable \$numero = 0 y comprueba con empty().<br><br>";


// is_int(), is_float(), is_bool(), is_array()
echo "<h2>is_int, is_float, is_bool, is_array</h2>";
echo "Explicación: Comprueban el tipo de dato de una variable.<br>";
$edad = 25;
$texto = "25";
echo "Ejemplo 1 (se cumple): is_int(25) → " . (is_int($edad) ? "TRUE" : "FALSE") . "<br>";
echo "Ejemplo 2 (no se cumple): is_int(\"25\") → " . (is_int($texto) ? "TRUE" : "FALSE") . "<br>";
echo "Ejercicio: Declara una variable booleana y verifica si es de tipo booleano.<br><br>";


// intval(), floatval(), boolval(), strval()
echo "<h2>intval, floatval, boolval, strval</h2>";
echo "Explicación: Devuelven el valor convertido a otro tipo de dato.<br>";
$numCadena = "123";
$decimal = "12.7";
echo "Ejemplo 1: intval(\"123\") → " . intval($numCadena) . "<br>";
echo "Ejemplo 2: floatval(\"12.7\") → " . floatval($decimal) . "<br>";
echo "Ejercicio: Convierte el número decimal 12.7 en entero con intval().<br><br>";



/* ===============================
   FUNCIONES DE CADENAS
   =============================== */

// strlen()
echo "<h2>strlen(\$cad)</h2>";
echo "Explicación: Devuelve la longitud de la cadena.<br>";
$cadena = "Hola Mundo";
$cadenaVacia = "";
echo "Ejemplo 1: strlen(\"Hola Mundo\") → " . strlen($cadena) . "<br>";
echo "Ejemplo 2: strlen(\"\") → " . strlen($cadenaVacia) . "<br>";
echo "Ejercicio: Calcula la longitud de tu nombre completo.<br><br>";


// explode()
echo "<h2>explode(\$token, \$cad)</h2>";
echo "Explicación: Divide una cadena en un array según el separador.<br>";
$texto = "rojo,verde,azul";
$texto2 = "uno-dos-tres";
echo "Ejemplo 1: explode(\",\", \"rojo,verde,azul\") → ";
echo implode(" | ", explode(",", $texto)) . "<br>";
echo "Ejemplo 2: explode(\"-\", \"uno-dos-tres\") → ";
echo implode(" | ", explode("-", $texto2)) . "<br>";
echo "Ejercicio: Divide una lista de palabras separadas por ';'.<br><br>";


// implode()
echo "<h2>implode(\$token, \$array)</h2>";
echo "Explicación: Une elementos de un array en una cadena.<br>";
$colores = ["rojo", "verde", "azul"];
$numeros = [1, 2, 3];
echo "Ejemplo 1: implode('-', [rojo,verde,azul]) → " . implode("-", $colores) . "<br>";
echo "Ejemplo 2: implode('/', [1,2,3]) → " . implode("/", $numeros) . "<br>";
echo "Ejercicio: Une un array de 4 números con separador '/'.<br><br>";


// strcmp()
echo "<h2>strcmp(\$cad1, \$cad2)</h2>";
echo "Explicación: Compara dos cadenas (0 si iguales, -1 si menor, 1 si mayor).<br>";
echo "Ejemplo 1: strcmp(\"hola\", \"hola\") → " . strcmp("hola", "hola") . "<br>";
echo "Ejemplo 2: strcmp(\"abc\", \"xyz\") → " . strcmp("abc", "xyz") . "<br>";
echo "Ejercicio: Compara las cadenas 'php' y 'PHP'.<br><br>";


// strtolower(), strtoupper()
echo "<h2>strtolower, strtoupper</h2>";
echo "Explicación: Convierte una cadena a minúsculas o mayúsculas.<br>";
echo "Ejemplo 1: strtoupper(\"php\") → " . strtoupper("php") . "<br>";
echo "Ejemplo 2: strtolower(\"PHP\") → " . strtolower("PHP") . "<br>";
echo "Ejercicio: Convierte tu apellido a minúsculas.<br><br>";


// strpos()
echo "<h2>strpos(\$cad1, \$cad2)</h2>";
echo "Explicación: Busca la primera ocurrencia de una cadena dentro de otra.<br>";
echo "Ejemplo 1: strpos(\"Hola Mundo\", \"Mundo\") → " . strpos("Hola Mundo", "Mundo") . "<br>";
echo "Ejemplo 2: strpos(\"Hola Mundo\", \"PHP\") → " . (strpos("Hola Mundo", "PHP") === false ? "FALSE" : "TRUE") . "<br>";
echo "Ejercicio: Busca la posición de la palabra 'web' en 'desarrollo web en PHP'.<br><br>";



/* ===============================
   FUNCIONES DE ARRAYS
   =============================== */

// ksort(), krsort()
echo "<h2>ksort(), krsort()</h2>";
echo "Explicación: Ordenan un array por sus claves (ascendente o descendente).<br>";
$personas = ["z" => "Ana", "a" => "Luis", "m" => "Juan"];
$personas2 = $personas;
ksort($personas);
krsort($personas2);
echo "Ejemplo 1: ksort → " . implode(", ", $personas) . "<br>";
echo "Ejemplo 2: krsort → " . implode(", ", $personas2) . "<br>";
echo "Ejercicio: Ordena por clave descendente un array de países.<br><br>";
$paises = ["13" => "ESPAÑA", "2" => "BRASIL", "25" => "FRANCIA" , "88" => "ALEMANIA"];
$paises2 = $paises;
$paises3 = $paises;
ksort($paises3);
krsort($paises2);
echo "Ejemplo 1: sin ksort → " . implode(", ", $paises) . "<br>";
echo "Ejemplo 1: ksort → " . implode(", ", $paises2) . "<br>";
echo "Ejemplo 2: krsort → " . implode(", ", $paises3) . "<br>";



// sort(), rsort()
echo "<h2>sort(), rsort()</h2>";
echo "Explicación: Ordenan un array por valores (ascendente o descendente).<br>";
$nums = [3, 1, 2];
$nums2 = [3, 1, 2];
sort($nums);
rsort($nums2);
echo "Ejemplo 1: sort([3,1,2]) → " . implode(", ", $nums) . "<br>";
echo "Ejemplo 2: rsort([3,1,2]) → " . implode(", ", $nums2) . "<br>";
echo "Ejercicio: Ordena de forma descendente los números [10,5,8].<br><br>";


// array_values(), array_keys()
echo "<h2>array_values(), array_keys()</h2>";
echo "Explicación: Obtienen todos los valores o todas las claves de un array.<br>";
$frutas = ["a" => "manzana", "b" => "pera"];
echo "Ejemplo 1: array_values → " . implode(", ", array_values($frutas)) . "<br>";
echo "Ejemplo 2: array_keys → " . implode(", ", array_keys($frutas)) . "<br>";
echo "Ejercicio: Muestra todas las claves de un array de 3 ciudades.<br><br>";


// array_key_exists()
echo "<h2>array_key_exists(\$cla, \$arr)</h2>";
echo "Explicación: Devuelve TRUE si una clave existe en el array.<br>";
echo "Ejemplo 1 (se cumple): array_key_exists('a', frutas) → " . (array_key_exists("a", $frutas) ? "TRUE" : "FALSE") . "<br>";
echo "Ejemplo 2 (no se cumple): array_key_exists('c', frutas) → " . (array_key_exists("c", $frutas) ? "TRUE" : "FALSE") . "<br>";
echo "Ejercicio: Comprueba si existe la clave 'id' en un array asociativo de usuario.<br><br>";


// count()
echo "<h2>count(\$arr)</h2>";
echo "Explicación: Devuelve el número de elementos de un array.<br>";
$nums = [1, 2, 3, 4];
$nums2 = [];
echo "Ejemplo 1: count([1,2,3,4]) → " . count($nums) . "<br>";
echo "Ejemplo 2: count([]) → " . count($nums2) . "<br>";
echo "Ejercicio: Cuenta los elementos de un array con los días de la semana.<br><br>";

?>
