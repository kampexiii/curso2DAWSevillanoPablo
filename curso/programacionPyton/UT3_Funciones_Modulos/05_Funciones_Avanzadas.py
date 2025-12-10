# -----------------------------------------------------------------------------
# Ejercicios con ARRAYS (listas) - VERSION SIMPLE
# -----------------------------------------------------------------------------


def sumar_lista():
    """Suma todos los números de una lista"""
    numeros = [5, 10, 15, 20, 25]
    print(f"Lista: {numeros}")

    # sumo todos los elementos con un bucle
    suma = 0
    for num in numeros:
        suma += num

    print(f"Suma total: {suma}")


def buscar_mayor():
    """Encuentra el número mayor de una lista"""
    numeros = [3, 45, 12, 78, 23, 9]
    print(f"Lista: {numeros}")

    # empiezo suponiendo que el primero es el mayor
    mayor = numeros[0]

    # recorro todos y voy comparando
    for num in numeros:
        if num > mayor:
            mayor = num

    print(f"El mayor es: {mayor}")


def contar_pares():
    """Cuenta cuántos números pares hay en una lista"""
    numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    print(f"Lista: {numeros}")

    # contador de pares
    pares = 0

    # recorro y cuento los que son pares
    for num in numeros:
        if num % 2 == 0:  # si el resto es 0, es par
            pares += 1

    print(f"Hay {pares} números pares")


def crear_lista_cuadrados():
    """Crea una lista con los cuadrados de 1 al 10"""
    cuadrados = []

    # genero cuadrados del 1 al 10
    for i in range(1, 11):
        cuadrados.append(i**2)  # i**2 es i al cuadrado

    print(f"Cuadrados: {cuadrados}")


def invertir_lista():
    """Invierte una lista"""
    frutas = ["manzana", "pera", "platano", "naranja"]
    print(f"Lista original: {frutas}")

    # invierto la lista
    frutas_invertidas = []

    # recorro desde el final hacia el principio
    for i in range(len(frutas) - 1, -1, -1):
        frutas_invertidas.append(frutas[i])

    print(f"Lista invertida: {frutas_invertidas}")


def promedio_notas():
    """Calcula el promedio de una lista de notas"""
    notas = [7.5, 8.0, 6.5, 9.0, 7.0]
    print(f"Notas: {notas}")

    # sumo todas las notas
    suma = 0
    for nota in notas:
        suma += nota

    # calculo el promedio
    promedio = suma / len(notas)
    print(f"Promedio: {promedio:.2f}")


def buscar_en_lista():
    """Busca si un elemento está en la lista"""
    nombres = ["Juan", "María", "Pedro", "Ana", "Luis"]
    print(f"Lista de nombres: {nombres}")

    buscar = input("¿Qué nombre buscas? ")

    # busco el nombre
    encontrado = False
    for nombre in nombres:
        if nombre.lower() == buscar.lower():
            encontrado = True
            break

    if encontrado:
        print(f"✓ {buscar} está en la lista")
    else:
        print(f"✗ {buscar} NO está en la lista")


# ejecuto todas las funciones
print("=== 1. Sumar lista ===")
sumar_lista()

print("\n=== 2. Buscar el mayor ===")
buscar_mayor()

print("\n=== 3. Contar pares ===")
contar_pares()

print("\n=== 4. Cuadrados del 1 al 10 ===")
crear_lista_cuadrados()

print("\n=== 5. Invertir lista ===")
invertir_lista()

print("\n=== 6. Promedio de notas ===")
promedio_notas()

print("\n=== 7. Buscar en lista ===")
buscar_en_lista()
