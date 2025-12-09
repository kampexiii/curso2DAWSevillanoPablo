<?php
// Función calculador: recibe el nombre de la operación y dos números.
// Llama dinámicamente a la función que corresponda (sumar, restar, etc.)
function calculador($operacion, $numa, $numb) {
    // Valido: si la operación es "dividir" y el divisor es 0 → error
    if ($operacion === "dividir" && $numb == 0) {
        return "Error: no se puede dividir entre 0";
    }

    // Compruebo que exista la función
    if (function_exists($operacion)) {
        return $operacion($numa, $numb);
    } else {
        return "Error: operación no válida";
    }
}

// Defino mis operaciones básicas
function sumar($a, $b) {
    return $a + $b;
}

function restar($a, $b) {
    return $a - $b;
}

function multiplicar($a, $b) {
    return $a * $b;
}

function dividir($a, $b) {
    // Validación interna extra (por si llaman a dividir() directamente)
    if ($b == 0) {
        return "Error: no se puede dividir entre 0";
    }
    return $a / $b;
}

// Ejemplos de uso en navegador
$a = 10;
$b = 2;

echo "Sumar $a + $b = " . calculador("sumar", $a, $b) . "<br>";
echo "Restar $a - $b = " . calculador("restar", $a, $b) . "<br>";
echo "Multiplicar $a x $b = " . calculador("multiplicar", $a, $b) . "<br>";
echo "Dividir $a / $b = " . calculador("dividir", $a, $b) . "<br>";

// Ejemplo con error (división entre 0)
echo "Dividir $a / 0 = " . calculador("dividir", $a, 0) . "<br>";

// Ejemplo llamando a dividir() directamente (también controlado)
echo "Llamada directa dividir(5,0) = " . dividir(5,0) . "<br>";

// Ejemplo con operación inválida
echo "Operación inventada = " . calculador("potencia", $a, $b) . "<br>";
?>
