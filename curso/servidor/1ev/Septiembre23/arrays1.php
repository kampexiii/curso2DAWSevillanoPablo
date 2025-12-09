<?php
/**
 * ----------------------------
 * Ejercicio: Arrays en PHP
 * ----------------------------
 * Declaración, acceso, modificación y recorrido con foreach.
 */

// -------------------
// Array indexado (claves numéricas)
// -------------------
$arr1 = [
    0 => 444,
    1 => 222,
    2 => 333,
];

echo "<h2>Array indexado</h2>";
echo "<pre>";
print_r($arr1);
echo "</pre>";

echo "Posición 0: " . $arr1[0] . "<br>";

$arr1[0] = 555;
echo "Array tras modificar posición 0:<br>";
echo "<pre>";
print_r($arr1);
echo "</pre>";

// -------------------
// Array asociativo (claves de texto)
// -------------------
$arr2 = array(
    "1111A" => "Juan Vera Ochoa",
    "1112A" => "Maria Mesa Cabeza",
    "1113A" => "Ana Puertas Peral"
);

echo "<h2>Array asociativo</h2>";
echo "<pre>";
print_r($arr2);
echo "</pre>";

$arr2["1113A"] = "Ana Puertas Segundo";

echo "Array tras modificar la clave '1113A':<br>";
echo "<pre>";
print_r($arr2);
echo "</pre>";

// -------------------
// Recorrer arrays con foreach
// -------------------
echo "<h2>Recorrer con foreach (solo valores)</h2>";
foreach ($arr2 as $nombre) {
    echo "$nombre <br>";
}

echo "<h2>Recorrer con foreach (clave => valor)</h2>";
foreach ($arr2 as $codigo => $nombre) {
    echo "Código: $codigo - Nombre: $nombre <br>";
}

// -------------------
// Modificar arrays con foreach y referencias
// -------------------
echo "<h2>Modificar valores en foreach</h2>";

$arr3 = array(
    "Viernes" => 22,
    "Sábado"  => 34
);

// Primer bucle: sin referencias (NO modifica el array)
foreach ($arr3 as $cantidad) {
    $cantidad = $cantidad * 2;
}
echo "Array sin modificar (foreach sin referencias):<br>";
echo "<pre>";
print_r($arr3);
echo "</pre>";

// Segundo bucle: con referencias (SÍ modifica el array)
foreach ($arr3 as &$cantidad) {
    $cantidad = $cantidad * 2;
}
echo "Array modificado (foreach con referencias):<br>";
echo "<pre>";
print_r($arr3);
echo "</pre>";
