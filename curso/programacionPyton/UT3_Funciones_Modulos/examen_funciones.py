# EXAMEN con FUNCIONES - Argumentos y Return


# Ejercicio 1: Fibonacci
def fibonacci(cantidad):
    """Genera una lista con los primeros N numeros de Fibonacci"""
    # si la cantidad es menor que 1, devuelvo lista vacia
    if cantidad < 1:
        return []

    # lista para guardar los resultados
    resultado = []

    # empiezo con los dos primeros numeros
    var1 = 0
    var2 = 1

    # genero la cantidad de numeros pedidos
    for i in range(cantidad):
        resultado.append(var1)
        # calculo el siguiente sumando los dos anteriores
        var3 = var1 + var2
        # actualizo las variables para la siguiente vuelta
        var1 = var2
        var2 = var3

    return resultado


# Ejercicio 2: Recorrer listas con excepciones
def comparar_listas(nombres1, nombres2):
    """Compara dos listas de nombres y devuelve el contador"""
    # contador de nombres mostrados
    contador = 0

    # recorro ambas listas al mismo tiempo
    for i in range(len(nombres1)):
        try:
            nombre1 = nombres1[i]
            nombre2 = nombres2[i]

            # compruebo si es "Infanta Elena"
            if nombre1 == "Infanta Elena" or nombre2 == "Infanta Elena":
                print(f"  -> {nombre1} / {nombre2} : Nombre del instituto!")
                continue

            # compruebo si los nombres son iguales
            if nombre1 == nombre2:
                print(f"  -> {nombre1} / {nombre2} : Nombres iguales")
                continue

            # si llego aqui, muestro los nombres y cuento
            print(f"  {nombre1} / {nombre2}")
            contador += 1

        except Exception:
            print("Error al procesar nombres")

    return contador


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


# programa principal
print("EXAMEN - Ejercicios con funciones\n")

# ejercicio 1 - Fibonacci
print("=== Fibonacci ===")
try:
    cantidad = int(input("Cuantos numeros de Fibonacci quieres generar? "))
    lista_fib = fibonacci(cantidad)
    print(f"\nPrimeros {cantidad} numeros de Fibonacci:")
    for numero in lista_fib:
        print(numero)
except ValueError:
    print("Error: Debes introducir un numero entero")

# ejercicio 2 - Comparar listas
print("\n=== Comparar listas de nombres ===")
print("Introduce los nombres de la primera lista (5 nombres):")
nombres1 = []
for i in range(5):
    nombre = input(f"Nombre {i+1}: ")
    nombres1.append(nombre)

print("\nIntroduce los nombres de la segunda lista (5 nombres):")
nombres2 = []
for i in range(5):
    nombre = input(f"Nombre {i+1}: ")
    nombres2.append(nombre)

print("\nComparando listas:")
total = comparar_listas(nombres1, nombres2)
print(f"\nTotal de nombres mostrados: {total}")

# ejercicio 3 - Media de numeros
print("\n=== Calcular media de numeros ===")
numeros = pedir_numeros()
media = calcular_media_lista(numeros)
if media > 0:
    print(f"\nMedia de los numeros >= 10: {media:.2f}")
else:
    print("\nNo se introdujeron numeros >= 10")

print("\n=== FIN DEL PROGRAMA ===")
