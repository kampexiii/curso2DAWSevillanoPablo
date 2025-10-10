# -----------------------------------------------------------------------------
# Ejercicio 1:
# Programa que pide números por pantalla hasta que el usuario introduce 0.
# Al introducir 0, el bucle se rompe y
# el programa finaliza mostrando un mensaje.
# -----------------------------------------------------------------------------
print("Ejercicio 1:")
# Bucle infinito que se rompe cuando se introduce 0
while True:
    # Pido al usuario que introduzca un número
    numero = int(input("Introduce un número (Negativo para salir): "))

    # Si el número es 0, se rompe el bucle
    if numero < 0:
        print("Has introducido un numero negativo. El programa ha finalizado.")
        break
    if numero == 0:
        continue

    # Si no es 0, se muestra el número introducido
    print(f"Has introducido el número: {numero}")


print("---------------------------------------------------------------------")

# -----------------------------------------------------------------------------
# Ejercicio 2:
# Calcular la media de las 6 asignaturas del módulo
# -----------------------------------------------------------------------------
print("Ejercicio 2:")
notasModulo = [8, 9, 10, 6, 8, 8]

# Inicializo acumulador y contador
sumaTotal = 0
contador = 0

# Recorro todas las notas del módulo
for nota in notasModulo:
    sumaTotal += nota  # acumulo cada nota
    contador += 1  # incremento el número de notas

# Calculo la media del grado
media = sumaTotal / contador

# Muestro el resultado final
print("La media del grado  es: ", media)

print("---------------------------------------------------------------------")
