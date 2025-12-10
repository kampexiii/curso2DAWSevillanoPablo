# -----------------------------------------------------------------------------
# Ejercicios UT2 - Actividad 3 con FUNCIONES (Bucles) - VERSION SIMPLIFICADA
# -----------------------------------------------------------------------------


def pedir_numeros_hasta_negativo():
    """
    Ejercicio 1: Programa que pide números por pantalla hasta que
    el usuario introduce un número negativo.
    """
    print("Introduce números (número negativo para salir):")

    # bucle infinito que solo se rompe con break
    while True:
        try:
            numero = int(input("Introduce un número: "))

            # si es negativo, salgo del bucle
            if numero < 0:
                print("Has introducido un número negativo. El programa ha finalizado.")
                break  # rompo el bucle aquí

            # si es 0, uso continue para saltar esta iteración
            if numero == 0:
                print("Has introducido 0, continuando...")
                continue  # vuelvo al inicio del while sin ejecutar lo de abajo

            # si llego aquí es que el número es positivo y no es 0
            print(f"Has introducido el número: {numero}")
        except ValueError:
            print("Error: Introduce un número entero válido.")


def calcular_media_notas():
    """
    Ejercicio 2: Calcular la media de las 6 asignaturas del módulo
    Puede recibir una lista de notas o pedirlas al usuario.
    """
    print("\n¿Cómo quieres introducir las notas?")
    print("1. Usar notas predefinidas [8, 9, 10, 6, 8, 8]")
    print("2. Introducir notas manualmente")

    try:
        opcion = int(input("Elige una opción: "))

        # dependiendo de la opción, uso notas fijas o pido al usuario
        if opcion == 1:
            notas_modulo = [8, 9, 10, 6, 8, 8]
            print(f"Usando notas predefinidas: {notas_modulo}")
        elif opcion == 2:
            notas_modulo = []  # lista vacía para ir añadiendo
            num_asignaturas = int(input("¿Cuántas asignaturas? "))

            # recorro con for para pedir cada nota
            for i in range(num_asignaturas):
                nota = float(input(f"Nota de la asignatura {i+1}: "))
                notas_modulo.append(nota)  # añado la nota a la lista
        else:
            print("Opción no válida. Usando notas predefinidas.")
            notas_modulo = [8, 9, 10, 6, 8, 8]

        # ahora calculo la media recorriendo la lista
        suma_total = 0
        contador = 0

        for nota in notas_modulo:
            suma_total += nota  # voy sumando cada nota
            contador += 1  # cuento cuántas notas hay

        # si hay notas, calculo la media (suma / cantidad)
        if contador > 0:
            media = suma_total / contador
            print(f"\nLa media del módulo es: {media:.2f}")
        else:
            print("No hay notas para calcular la media.")

    except ValueError:
        print("Error: Introduce valores numéricos válidos.")


def calcular_media_alternativa(notas):
    """
    Función auxiliar para calcular la media de una lista de notas.

    Args:
        notas (list): Lista de notas numéricas

    Returns:
        float: Media de las notas
    """
    # si la lista está vacía, devuelvo 0
    if not notas:
        return 0

    # uso sum() que es más directo que hacer un bucle
    return sum(notas) / len(notas)


def ejercicio_bucles_completo():
    """
    Ejercicio combinado que permite al usuario ejecutar
    diferentes operaciones con bucles.
    """
    print("\n--- Ejercicio de Bucles ---")
    print("1. Contador regresivo")
    print("2. Suma de números hasta límite")
    print("3. Tabla de multiplicar")

    try:
        opcion = int(input("Elige una opción: "))

        if opcion == 1:
            # cuenta atrás desde un número hasta 0
            inicio = int(input("Número inicial: "))
            # range(inicio, 0, -1) va desde inicio hasta 1, de uno en uno hacia atrás
            for i in range(inicio, 0, -1):
                print(i, end=" ")  # end=" " para que no haga salto de línea
            print("\n¡Despegue!")

        elif opcion == 2:
            # suma todos los números desde 1 hasta el límite
            limite = int(input("Introduce un límite: "))
            suma = 0
            for i in range(1, limite + 1):
                suma += i  # voy acumulando
            print(f"La suma de 1 hasta {limite} es: {suma}")

        elif opcion == 3:
            # tabla de multiplicar clásica
            numero = int(input("¿Tabla de multiplicar de qué número? "))
            for i in range(1, 11):  # del 1 al 10
                print(f"{numero} x {i} = {numero * i}")

        else:
            print("Opción no válida.")

    except ValueError:
        print("Error: Introduce un número válido.")


# pruebo las funciones
print("=== Ejercicio 1: Números hasta negativo ===")
pedir_numeros_hasta_negativo()

print("\n=== Ejercicio 2: Media de notas ===")
calcular_media_notas()

print("\n=== Ejercicio 3: Más ejercicios con bucles ===")
ejercicio_bucles_completo()
