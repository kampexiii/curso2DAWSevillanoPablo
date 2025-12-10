def fibonacci(cantidad):
    """Muestra por pantalla la serie de Fibonacci"""
    if cantidad < 1:
        print("No hay numeros para mostrar")
        return

    num1 = 0
    num2 = 1
    contador = 0

    # genero y muestro cada numero de la serie
    while contador < cantidad:
        print(num1)
        num3 = num1 + num2
        num1 = num2
        num2 = num3
        contador = contador + 1


def pedir_cantidad():
    """Pide la cantidad de terminos a generar"""
    while True:
        try:
            print("Cuantos numeros de Fibonacci quieres generar")
            cantidad = int(input("Cantidad: "))
            if cantidad >= 0:
                return cantidad
            print("Error: La cantidad no puede ser negativa")
        except ValueError:
            # aviso si no es entero
            print("Error: Debes introducir un numero entero")


cantidad = pedir_cantidad()
print("Secuencia de Fibonacci:")
fibonacci(cantidad)
