# Calculadora
def sumar(a, b):
    return a + b


def restar(a, b):
    return a - b


def multiplicar(a, b):
    return a * b


def dividir(a, b):
    if b == 0:
        return "Error: División por cero"
    return a / b


def potencia(a, b):
    return a**b


def raiz_cuadrada(a):
    if a < 0:
        return "Error: Raíz cuadrada de número negativo"
    return a**0.5


def saludar(nombre):
    return f"Hola, {nombre}!"
