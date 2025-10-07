<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tipos de Variables en PHP</title>
</head>
<body>
  <?php
    /** ------------------------------
     * Declaración de variables simples
     * ------------------------------ */
    $entero = 4;
    $numero = 4.5;
    $cadena = "cadena";
    $bool   = TRUE;

    echo $entero . "<br>";
    echo $numero . "<br>";
    echo $cadena . "<br>";
    echo $bool   . "<br>";   // Muestra "1" porque TRUE se imprime como 1

    echo "<hr>";

    /** ------------------------------
     * Uso de gettype() y cambio de valor
     * ------------------------------ */
    $a = 5;
    echo "<b>Tipo de 'entero': </b>" . gettype($entero) . "<br>";
    echo "<b>Valor de 'a': </b>" . $a . "<br>";

    $a = "Hola Mundo";
    echo "<b>Tipo de 'entero': </b>" . gettype($entero) . "<br>";
    echo "<b>Nuevo valor de 'a': </b>" . $a . "<br>";

    echo "<hr>";

    /** ------------------------------
     * Redefinición de variables
     * ------------------------------ */
    $entero = 13;
    $numero = 0.05;
    $cadena = "NUEVA CADENA";
    $bool   = false;   // false no imprime nada con echo

    echo "<b>Entero: </b>" . $entero . "<br>";
    echo "<b>Decimal: </b>" . $numero . "<br>";
    echo "<b>Cadena: </b>" . $cadena . "<br>";
    echo "<b>Booleano: </b>" . var_export($bool, true) . "<br>"; 
    // Usamos var_export para que muestre "false" en pantalla

    echo "<hr>";

    /** ------------------------------
     * Definir una referencia a una variable con el operador ampersand (&)
     * ------------------------------ */
    $var1 = 100;
    $var2 =& $var1;   // $var2 es una referencia a $var1
    $var3 = $var1;    // $var3 es una copia de $var1

    echo "<b>Valor inicial de var1: </b>" . $var1 . "<br>";
    echo "<b>Valor inicial de var2 (referencia a var1): </b>" . $var2 . "<br>";
    echo "<b>Valor inicial de var3 (copia de var1): </b>" . $var3 . "<br>";

    // Si cambiamos var2, también cambia var1
    $var2 = 300;
    echo "<b>Nuevo valor de var1 tras modificar var2: </b>" . $var1 . "<br>";
    echo "<b>Valor actual de var2: </b>" . $var2 . "<br>";
    echo "<b>Valor de var3 (no cambia porque es copia): </b>" . $var3 . "<br>";

  ?>
</body>
</html>
