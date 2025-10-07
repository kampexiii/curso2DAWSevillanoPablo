<?php
$arr1 = array(
    1 => "3000",
    2 => "4000",
);

$arr2 = array(
    1 => 3000,
    2 => 4000,
);

$arr3 = array(
    2 => "4000",
    1 => "3000",
);

if ($arr1 == $arr2) {
    echo "arr1 y arr2 son iguales <br>";
} else {
    echo "arr1 y arr2 no son iguales <br>";
}

if ($arr1 == $arr3) {
    echo "arr1 y arr3 son iguales <br>";
} else {
    echo "arr1 y arr3 no son iguales <br>";
}

if ($arr1 === $arr2) {
    echo "arr1 y arr2 son idénticos <br>";
} else {
    echo "arr1 y arr2 no son idénticos <br>";
}

if ($arr1 === $arr3) {
    echo "arr1 y arr3 son idénticos <br>";
} else {
    echo "arr1 y arr3 no son idénticos <br>";
}
?>

/**
 * 📌 Explicación:
 * - Con == se comparan claves y valores, pero el orden no importa.
 * - Con === además del contenido se compara también el orden de las claves.
 * - En el libro aparecía que $arr1 === $arr3 son idénticos,
 *   pero en PHP actual se tiene en cuenta el orden:
 *   $arr1 está en orden 1,2 y $arr3 en orden 2,1 → ya no son idénticos.
 */
