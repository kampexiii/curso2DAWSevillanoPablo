# Ejercicio 3: Media de numeros
def calcular_media_lista(numeros):
    """Calcula la media de los numeros >= 10 de una lista"""
    # acumuladores
    suma = 0
    contador = 0

    # recorro la lista de numeros
    for numero in numeros:
        # solo cuento para la media si es >= 10
        if numero >= 10:
            suma += numero
            contador += 1

    # calculo la media si hay numeros
    if contador > 0:
        media = suma / contador
        return media
    else:
        return 0


# funcion auxiliar para pedir numeros
def pedir_numeros():
    """Pide numeros hasta que se introduce 9999.99"""
    lista_numeros = []

    print("Introduce numeros (9999.99 para finalizar)")
    print("Solo se cuentan para la media los numeros >= 10")

    # bucle infinito hasta que meta 9999.99
    while True:
        try:
            numero = float(input("\nIntroduce un numero: "))

            # si es 9999.99, termino
            if numero == 9999.99:
                print("Finalizando...")
                break

            # solo acepto numeros >= 0
            if numero < 0:
                print("Error: El numero debe ser mayor o igual a 0")
                continue

            # añado el numero a la lista
            lista_numeros.append(numero)

        except ValueError:
            print("Error: Debes introducir un numero valido")
        except Exception:
            print("Error desconocido")

    return lista_numeros


if __name__ == "__main__":
    print("MEDIA DE NUMEROS")
    numeros = pedir_numeros()
    media = calcular_media_lista(numeros)
    if media > 0:
        print(f"\nMedia de los numeros >= 10: {media:.2f}")
    else:
        print("\nNo se introdujeron numeros suficientes para la media")
