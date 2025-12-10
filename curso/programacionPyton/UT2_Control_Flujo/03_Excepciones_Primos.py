# -*- coding: utf-8 -*-
"""
Ejercicios resueltos - Condicionales y Excepciones 2
Curso: Programación en Python 25/26 - IES Infanta Elena
"""

import math

# -----------------------------------------------------------------------------
# Ejercicio 1: Verificación de número primo con control de errores
# -----------------------------------------------------------------------------
try:
    n = int(input("Introduce un número entero positivo: "))
    if n <= 0:
        raise ValueError("El número debe ser entero y positivo.")
    if n == 1:
        print("1 no es primo ni compuesto.")
    else:
        es_primo = True
        for i in range(2, int(math.sqrt(n)) + 1):
            if n % i == 0:
                es_primo = False
                print(f"No es primo porque es divisible por {i}.")
                break
        if es_primo:
            print(f"{n} es primo.")
except ValueError as ve:
    print("Error:", ve)
except TypeError:
    print("Error: Entrada no válida.")

# -----------------------------------------------------------------------------
# Ejercicio 2: Conversor de divisas con control de errores
# -----------------------------------------------------------------------------
tasas = {"USD": 1.08, "GBP": 0.88, "JPY": 144.5}
try:
    euros = float(input("\nIntroduce cantidad en euros: "))
    if euros < 0:
        raise ValueError("La cantidad debe ser positiva.")
    divisa = input("Introduce divisa destino (USD, GBP, JPY): ")
    divisa = divisa.strip().upper()
    if divisa not in tasas:
        raise ValueError("Divisa no permitida.")
    convertido = euros * tasas[divisa]
    print(f"{euros} € equivalen a {convertido:.2f} {divisa}.")
except ValueError as ve:
    print("Error:", ve)
except TypeError:
    print("Error: Entrada no válida.")

# -----------------------------------------------------------------------------
# Ejercicio 3: Cálculo de raíces reales de una ecuación cuadrática
# -----------------------------------------------------------------------------
try:
    a = float(input("\nCoeficiente a: "))
    b = float(input("Coeficiente b: "))
    c = float(input("Coeficiente c: "))
    if a == 0:
        raise ValueError("a no puede ser 0; no es cuadrática.")
    D = b**2 - 4 * a * c
    if D < 0:
        raise ValueError("No existen raíces reales.")
    elif D == 0:
        x = -b / (2 * a)
        print(f"Raíz doble: x = {x:.2f}")
    else:
        x1 = (-b + math.sqrt(D)) / (2 * a)
        x2 = (-b - math.sqrt(D)) / (2 * a)
        print(f"Raíces reales: x1 = {x1:.2f}, x2 = {x2:.2f}")
except ValueError as ve:
    print("Error:", ve)
except TypeError:
    print("Error: Coeficientes no válidos.")

# -----------------------------------------------------------------------------
# Ejercicio 4: Simulador de cajero automático
# -----------------------------------------------------------------------------
try:
    saldo = float(input("\nIntroduce saldo inicial: "))
    retiro = float(input("Introduce cantidad a retirar: "))
    if saldo < 0 or retiro <= 0:
        raise ValueError("Saldo y retiro deben ser positivos.")
    if retiro > saldo:
        raise RuntimeError("Fondos insuficientes.")
    saldo_final = saldo - retiro
    print(f"Retirada realizada. Saldo restante: {saldo_final:.2f} €")
except ValueError as ve:
    print("Error:", ve)
except RuntimeError as re:
    print("Error:", re)
except TypeError:
    print("Error: Entrada no válida.")

# -----------------------------------------------------------------------------
# Ejercicio 5: Calculadora de operaciones con manejo múltiple de excepciones
# -----------------------------------------------------------------------------
try:
    num1 = float(input("\nIntroduce primer número: "))
    num2 = float(input("Introduce segundo número: "))
    op = input("Introduce operación (+, -, *, /): ").strip()
    if op not in ("+", "-", "*", "/"):
        raise ValueError("Operación no reconocida.")
    try:
        if op == "+":
            resultado = num1 + num2
        elif op == "-":
            resultado = num1 - num2
        elif op == "*":
            resultado = num1 * num2
        elif op == "/":
            if num2 == 0:
                raise ZeroDivisionError("División por cero.")
            resultado = num1 / num2
        print(f"Resultado: {resultado}")
    except ZeroDivisionError as zde:
        print("Error:", zde)
    except Exception as e:
        print("Error inesperado:", e)
except ValueError as ve:
    print("Error:", ve)
except TypeError:
    print("Error: Entrada no válida.")
