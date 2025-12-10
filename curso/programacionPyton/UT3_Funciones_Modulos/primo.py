# Comprobar si el numero es primo
def es_primo(numero):
    if numero <= 1:
        return False
    # comprobamos el numero de divisores que tiene el numero introducido
    for i in range(2, int(numero**0.5) + 1):
        if numero % i == 0:
            return False
    return True


def pedir_numero():
    while True:
        try:
            numero = int(input("Introduce un numero entero positivo: "))
            if numero < 0:
                print("Error: El numero debe ser positivo.")
            else:
                return numero
        except ValueError:
            print("Error: Debes introducir un numero entero valido.")
