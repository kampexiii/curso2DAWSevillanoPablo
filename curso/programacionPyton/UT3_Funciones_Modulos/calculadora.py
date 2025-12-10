# Calculadora


# funcion para pedir numeros
def pedir_numero(prompt):
    while True:
        try:
            numero = float(input(prompt))
            return numero
        except ValueError:
            print("Error: Por favor, introduce un número válido.")


# funcion para pedir la operacion
def pedir_operacion():
    operaciones_validas = ["+", "-", "*", "/"]
    while True:
        operacion = input("Introduce la operación (+, -, *, /): ")
        if operacion in operaciones_validas:
            return operacion
        else:
            print("Error: Operación no válida. Inténtalo de nuevo.")


# funcion de suma
def sumar(a, b):
    return a + b


# funcion de resta
def restar(a, b):
    return a - b


# funcion de multiplicacion
def multiplicar(a, b):
    return a * b


# funcion de division con validacion
def dividir(a, b):
    if b != 0:
        return a / b
    else:
        return "Error: División por cero no permitida."


# funcion principal de la calculadora con match-case
def calculadora():
    print("=== Calculadora Simple ===")
    num1 = pedir_numero("Introduce el primer número: ")
    operacion = pedir_operacion()
    num2 = pedir_numero("Introduce el segundo número: ")

    match operacion:
        case "+":
            resultado = sumar(num1, num2)
        case "-":
            resultado = restar(num1, num2)
        case "*":
            resultado = multiplicar(num1, num2)
        case "/":
            resultado = dividir(num1, num2)

    print(f"El resultado de {num1} {operacion} {num2} es: {resultado}")


# llamo a la funcion principal
calculadora()
