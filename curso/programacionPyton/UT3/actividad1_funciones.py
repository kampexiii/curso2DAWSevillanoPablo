# ---------------------------------------------------------------------------
# Ejercicios UT2 - Actividad 1 con FUNCIONES (VERSION SIMPLIFICADA)
# ---------------------------------------------------------------------------


def verificar_edad():
    """
    Ejercicio 1: Verificación de edad
    Pide al usuario que introduzca su edad y determina si es mayor o menor de edad.
    """
    try:
        # pido la edad y la convierto a entero directamente
        edad = int(input("Introduce tu edad: "))

        # compruebo que no me metan números negativos o cero
        if edad <= 0:
            print("La edad debe ser un número positivo.")
            return  # salgo de la función aquí mismo

        # verifico si es mayor de edad (18 o más)
        if edad >= 18:
            print("Eres mayor de edad.")
        else:
            print("Eres menor de edad.")
    except ValueError:
        # si meten letras o algo raro, capturo el error
        print("Error: Debes introducir un número entero válido.")


def comparar_numeros():
    """
    Ejercicio 2: Comparación de dos números
    Solicita dos números y muestra cuál es mayor, menor o si son iguales.
    """
    try:
        # recojo dos números del usuario
        num1 = int(input("Introduce el primer número: "))
        num2 = int(input("Introduce el segundo número: "))

        # simple comparación, primero veo si el primero es más grande
        if num1 > num2:
            print(f"{num1} es mayor que {num2}")
        # si no, miro si es más pequeño
        elif num1 < num2:
            print(f"{num1} es menor que {num2}")
        # si no es ni mayor ni menor, son iguales
        else:
            print("Ambos números son iguales")
    except ValueError:
        # control de errores por si meten texto o algo así
        print("Error: Debes introducir números enteros válidos.")


def validar_nota():
    """
    Ejercicio 3: Validación de nota
    Pide una nota entre 0 y 10 y la clasifica.
    """
    try:
        # uso float porque las notas pueden ser 7.5, 8.2, etc
        nota = float(input("Introduce una nota (0-10): "))

        # primero valido que esté en rango correcto
        if nota < 0 or nota > 10:
            print("Error: La nota debe estar entre 0 y 10.")
            return  # si no está bien, corto aquí

        # ahora clasifico la nota según los rangos
        # menos de 5 = suspenso
        if nota < 5.0:
            print("Suspenso")
        # entre 5 y menos de 7 = aprobado
        elif nota < 7.0:
            print("Aprobado")
        # entre 7 y menos de 9 = notable
        elif nota < 9.0:
            print("Notable")
        # 9 o más = sobresaliente
        else:
            print("Sobresaliente")
    except ValueError:
        # por si meten letras en vez de números
        print("Error: Debes introducir un número válido.")


def verificar_clave():
    """
    Ejercicio 4: Acceso con clave
    Verifica si la clave introducida es correcta.
    """
    # defino la clave correcta (en mayúsculas porque es constante)
    CLAVE_CORRECTA = "python123"
    # pido la clave al usuario
    clave = input("Introduce la clave: ")

    # comparo directamente las cadenas de texto
    if clave == CLAVE_CORRECTA:
        print("Acceso concedido")
    else:
        print("Acceso denegado")


def menu_seleccion():
    """
    Ejercicio 5: Menú de selección
    Muestra un menú y ejecuta la opción seleccionada.
    """
    # imprimo las opciones del menú
    print("\n--- MENÚ ---")
    print("1. Ver perfil")
    print("2. Editar perfil")
    print("3. Salir")

    try:
        # recojo la opción del usuario
        opcion = int(input("Selecciona una opción: "))

        # dependiendo del número que elija, hago una cosa u otra
        if opcion == 1:
            print("Mostrando perfil...")
        elif opcion == 2:
            print("Editando perfil...")
        elif opcion == 3:
            print("Saliendo del sistema...")
        else:
            # si mete un número pero no es 1, 2 o 3
            print("Error: Opción no válida. Debe ser 1, 2 o 3.")
    except ValueError:
        # por si meten texto en vez de número
        print("Error: Debes introducir un número.")


def verificar_par_impar():
    """
    Ejercicio 6: Validación de número par o impar
    Determina si un número es par o impar.
    """
    try:
        numero = int(input("Introduce un número entero: "))

        # uso el módulo (%) para ver si el resto de dividir entre 2 es 0
        # si el resto es 0, es par
        if numero % 2 == 0:
            print(f"{numero} es par")
        else:
            # si no, es impar
            print(f"{numero} es impar")
    except ValueError:
        print("Error: Debes introducir un número entero válido.")


def verificar_permisos_conducir():
    """
    Ejercicio 7: Verificación de permisos para conducir según edad
    Muestra qué vehículos puede conducir según la edad.
    """
    try:
        edad = int(input("Introduce tu edad: "))

        # validación básica, no puede ser negativo
        if edad < 0:
            print("Error: La edad no puede ser negativa.")
            return

        # voy comprobando por rangos de edad
        # menos de 14 años = nada
        if edad < 14:
            print("No puedes conducir ningún vehículo.")
        # entre 14 y 15 = motos pequeñas
        elif edad < 16:
            print("Puedes conducir motos de poca cilindrada.")
        # entre 16 y 17 = motos grandes
        elif edad < 18:
            print("Puedes conducir motos de gran cilindrada.")
        # 18 o más = todo
        else:
            print("Puedes conducir coches y motos.")
    except ValueError:
        print("Error: Debes introducir un número entero válido.")


# llamo a cada función para probar
print("=== Ejercicio 1: Verificación de edad ===")
verificar_edad()

print("\n=== Ejercicio 2: Comparación de números ===")
comparar_numeros()

print("\n=== Ejercicio 3: Validación de nota ===")
validar_nota()

print("\n=== Ejercicio 4: Acceso con clave ===")
verificar_clave()

print("\n=== Ejercicio 5: Menú de selección ===")
menu_seleccion()

print("\n=== Ejercicio 6: Par o impar ===")
verificar_par_impar()

print("\n=== Ejercicio 7: Permisos para conducir ===")
verificar_permisos_conducir()
