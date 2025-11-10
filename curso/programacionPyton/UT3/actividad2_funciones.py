# -----------------------------------------------------------------------------
# Ejercicios UT2 - Actividad 2 con FUNCIONES (VERSION SIMPLIFICADA)
# -----------------------------------------------------------------------------


def verificar_numero_primo():
    """
    Ejercicio 1: Verificación de número primo
    Verifica si un número es primo.
    """
    try:
        n = int(input("Introduce un número entero positivo: "))
        if n <= 0:
            print("Error: El número debe ser positivo.")
            return

        # caso especial: el 1 no es primo
        if n == 1:
            print("1 no es primo ni compuesto.")
            return

        # voy a comprobar si es divisible por algún número del 2 hasta n-1
        es_primo = True
        for i in range(2, n):
            if n % i == 0:  # si es divisible, no es primo
                es_primo = False
                print(f"No es primo. Divisible entre {i}.")
                break

        if es_primo:
            print(f"{n} es primo.")
    except ValueError:
        print("Error: Debes introducir un número entero.")


def convertir_divisas():
    """
    Ejercicio 2: Conversor de divisas simple
    Convierte euros a dólares, libras o yenes.
    """
    try:
        # pido la cantidad en euros
        euros = float(input("Introduce cantidad en euros: "))
        if euros < 0:
            print("Error: La cantidad debe ser positiva.")
            return

        # muestro las opciones
        print("1. Dólares (USD)")
        print("2. Libras (GBP)")
        print("3. Yenes (JPY)")
        opcion = int(input("Elige una opción (1-3): "))

        # convierto según la opción
        if opcion == 1:
            convertido = euros * 1.08
            print(f"{euros} € son {convertido:.2f} USD")
        elif opcion == 2:
            convertido = euros * 0.88
            print(f"{euros} € son {convertido:.2f} GBP")
        elif opcion == 3:
            convertido = euros * 144.5
            print(f"{euros} € son {convertido:.2f} JPY")
        else:
            print("Opción no válida.")
    except ValueError:
        print("Error: Entrada no válida.")


def calcular_raices_cuadraticas():
    """
    Ejercicio 3: Ecuación cuadrática simple
    Resuelve ax² + bx + c = 0
    """
    try:
        # pido los coeficientes
        a = float(input("Coeficiente a: "))
        b = float(input("Coeficiente b: "))
        c = float(input("Coeficiente c: "))

        if a == 0:
            print("Error: 'a' no puede ser 0.")
            return

        # calculo el discriminante
        D = b**2 - 4 * a * c

        # veo si tiene soluciones reales
        if D < 0:
            print("No hay raíces reales.")
        elif D == 0:
            # una sola solución
            x = -b / (2 * a)
            print(f"Raíz doble: x = {x:.2f}")
        else:
            # dos soluciones - calculo raíz cuadrada "a mano"
            # usando potencia: D**0.5 es lo mismo que raíz cuadrada de D
            raiz_D = D**0.5
            x1 = (-b + raiz_D) / (2 * a)
            x2 = (-b - raiz_D) / (2 * a)
            print(f"Raíces: x1 = {x1:.2f}, x2 = {x2:.2f}")
    except ValueError:
        print("Error: Introduce números válidos.")


def simular_cajero():
    """
    Ejercicio 4: Cajero automático simple
    Simula un retiro de efectivo.
    """
    try:
        # pido el saldo inicial
        saldo = float(input("Introduce saldo inicial: "))
        # y cuánto quiere sacar
        retiro = float(input("Introduce cantidad a retirar: "))

        # validaciones
        if saldo < 0 or retiro <= 0:
            print("Error: Saldo debe ser >= 0 y retiro > 0.")
            return

        # compruebo si tiene suficiente dinero
        if retiro > saldo:
            print("Error: Fondos insuficientes.")
            return

        # calculo el saldo final
        saldo_final = saldo - retiro
        print(f"Retirada exitosa. Saldo restante: {saldo_final:.2f} €")
    except ValueError:
        print("Error: Introduce números válidos.")


def calculadora_operaciones():
    """
    Ejercicio 5: Calculadora simple
    Suma, resta, multiplica o divide dos números.
    """
    try:
        # pido los dos números
        num1 = float(input("Introduce primer número: "))
        num2 = float(input("Introduce segundo número: "))
        # y la operación
        op = input("Introduce operación (+, -, *, /): ")

        # hago la operación según lo que eligió
        if op == "+":
            resultado = num1 + num2
            print(f"Resultado: {resultado}")
        elif op == "-":
            resultado = num1 - num2
            print(f"Resultado: {resultado}")
        elif op == "*":
            resultado = num1 * num2
            print(f"Resultado: {resultado}")
        elif op == "/":
            if num2 == 0:
                print("Error: No se puede dividir entre cero.")
            else:
                resultado = num1 / num2
                print(f"Resultado: {resultado}")
        else:
            print("Error: Operación no válida.")
    except ValueError:
        print("Error: Introduce números válidos.")


# llamo a cada función para probarlas
print("=== Ejercicio 1: Número primo ===")
verificar_numero_primo()

print("\n=== Ejercicio 2: Conversor de divisas ===")
convertir_divisas()

print("\n=== Ejercicio 3: Ecuación cuadrática ===")
calcular_raices_cuadraticas()

print("\n=== Ejercicio 4: Cajero automático ===")
simular_cajero()

print("\n=== Ejercicio 5: Calculadora ===")
calculadora_operaciones()
