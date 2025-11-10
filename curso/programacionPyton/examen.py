# Ejercicio 1:
# Fibonacci
# 0, 1, 1, 2, 3, 5, 8, 13, 21, 34

var1 = 0
var2 = 1
var3 = 0

for i in range(0, 10):
    print(var1)
    var3 = var1 + var2
    var1 = var2
    var2 = var3


# Ejercicio 2:
# Recorrer 2 listas con funciones y excepciones,
# Si el nombre coincide con infanta elena, salta la excepcion diciendo algo asi como "nombre del instituto"
# si el nombre1 coincide con el nombre 2 salta la excepcion diciendo "nombres iguales" y que no cuente ni se muestre.
# mostrar el resto de nombres.
# al finalizar mostrar un contador de nombres mostrados.


# Ejercicio 3:
# Introducir numeros por pantalla, hasta introducir 9999.99, que finaliza el programa.
# solo acepta numeros mayor o igual a 0.
# Solo se añaden para la media numeros mayores o igual a 10.
# numeros deben ser float.
# Al finalizar, mostrar la media de los numeros introducidos


try:
    
    numeroIntroducido = float(input("Introduce un numero para la media (9999.99 para finalizar): "))

