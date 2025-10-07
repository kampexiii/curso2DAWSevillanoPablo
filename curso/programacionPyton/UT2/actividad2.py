# -*- coding: utf-8 -*-
"""
Ejercicios (comentados) - Condicionales y Excepciones 2
Curso: Programación en Python 25/26 - IES Infanta Elena
Formato:
- Solo comentarios y docstrings explicativos (sin resolver).
- Líneas ≤ 79 caracteres.
- Indican claramente qué validar y qué excepciones capturar.
- Español, completo y explicativo.
"""

# -----------------------------------------------------------------------------
# Ejercicio 1: Verificación de número primo con control de errores
# -----------------------------------------------------------------------------
"""
Descripción:
Pide al usuario un número entero positivo y determina si es primo.

Requisitos y pautas:
- Validar que la entrada sea un entero. Usar int(...) dentro de try/except.
- Validar que el entero sea positivo (> 0). Si no, lanzar ValueError.
- Si la entrada no es convertible a entero, capturar ValueError/TypeError.
- Comprobar primalidad de forma eficiente (p. ej. hasta sqrt(n)).
- Si no es primo, indicar un divisor que demuestre por qué no lo es.
- Devolver o imprimir mensajes claros explicando el motivo.
- Documentar las excepciones que la función/Programa puede lanzar.
"""

# -----------------------------------------------------------------------------
# Ejercicio 2: Conversor de divisas con control de errores
# -----------------------------------------------------------------------------
"""
Descripción:
Convierte una cantidad en euros a USD, GBP o JPY según selección del usuario.

Requisitos y pautas:
- Recibir la cantidad en euros y la divisa destino (cadena).
- Validar que la cantidad sea un número (float/int) positivo.
  * Usar float(...) dentro de try/except para capturar errores.
- Normalizar la divisa (strip().upper()) y validar que esté permitida.
  * Si la divisa no es válida, lanzar ValueError con mensaje claro.
- Usar tasas estáticas de ejemplo o indicar que se debe usar API externa.
- Manejar excepciones de entrada, y documentar posibles errores.
- Informar la conversión con formato legible (número redondeado).
"""

# -----------------------------------------------------------------------------
# Ejercicio 3: Cálculo de raíces reales de una ecuación cuadrática
# -----------------------------------------------------------------------------
"""
Descripción:
Solicita coeficientes a, b, c de ax^2 + bx + c = 0 y calcula raíces reales.

Requisitos y pautas:
- Convertir a, b, c a float dentro de try/except; capturar errores.
- Validar que 'a' != 0; si a == 0 lanzar ValueError (no es cuadrática).
- Calcular discriminante D = b**2 - 4*a*c.
- Si D < 0, lanzar excepción (ValueError) indicando ausencia de raíces
  reales; documentar el caso.
- Si D >= 0, calcular y mostrar las raíces reales (raíz simple o doble).
- Manejar precisión y presentación de resultados (formatos).
"""

# -----------------------------------------------------------------------------
# Ejercicio 4: Simulador de cajero automático
# -----------------------------------------------------------------------------
"""
Descripción:
Simula retirar dinero de una cuenta mostrando el saldo restante.

Requisitos y pautas:
- Pedir saldo inicial y cantidad a retirar.
- Convertir ambos valores a float dentro de try/except.
- Validar que saldo >= 0 y cantidad > 0; si no, lanzar ValueError.
- Si cantidad > saldo, lanzar excepción (p. ej. RuntimeError o
  ValueError) indicando fondos insuficientes.
- Si retirada válida, calcular saldo_final = saldo - cantidad y mostrarlo.
- Documentar claramente los errores que pueden producirse.
"""

# -----------------------------------------------------------------------------
# Ejercicio 5: Calculadora de operaciones con manejo múltiple de excepciones
# -----------------------------------------------------------------------------
"""
Descripción:
Calculadora básica que recibe dos números y una operación (+, -, *, /).

Requisitos y pautas:
- Convertir operandos a float dentro de try/except; capturar errores.
- Validar que la operación esté entre las reconocidas (+ - * /).
  * Si no, lanzar ValueError indicando operación desconocida.
- Manejar división por cero: detectar y lanzar ZeroDivisionError o
  devolver mensaje claro sin excepción no controlada.
- Estructura sugerida: try para conversión, otro try/except para ejecutar
  la operación y capturar ZeroDivisionError y errores inesperados.
- Documentar cada excepción posible y cómo se comunica al usuario.
"""
