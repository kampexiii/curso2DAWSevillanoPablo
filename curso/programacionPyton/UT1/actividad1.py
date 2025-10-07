# UT1 EJERCICIOS

# 1. La suma de dos números
# 2. Calcular el área de un círculo
# 3. Convertir grados Celsius a Fahrenheit
# 4. Calcular el doble y el triple de un número
# 5. Calcular la media de tres números
# 6. Multiplicar dos números
# 7. Concatenar dos cadenas de texto
# 8. Mostrar un número repetido varias veces
# 9. Calcular el área de un rectángulo
# 10. Calcular el perímetro de un rectángulo

salir = 0

while salir == 0:

    print("MENÚ DE EJERCICIOS")
    print("1) La suma de dos números")
    print("2) Calcular el área de un círculo")
    print("3) Convertir grados Celsius a Fahrenheit")
    print("4) Calcular el doble y el triple de un número")
    print("5) Calcular la media de tres números")
    print("6) Multiplicar dos números")
    print("7) Concatenar dos cadenas de texto")
    print("8) Mostrar un número repetido varias veces")
    print("9) Calcular el área de un rectángulo")
    print("10) Calcular el perímetro de un rectángulo")
    print("11) Salir")

    opcion = input("Elige un ejercicio (1-11): ")

    match opcion:
        case "1":
            print("Ejercicio 1: La suma de dos números")
            num1 = int(input("Introduce el primer número: "))
            num2 = int(input("Introduce el segundo número: "))
            print("El primer número a sumar es:", num1)
            print("El segundo número a sumar es:", num2)
            print("El resultado de la suma es:", num1 + num2)

        case "2":
            print("Ejercicio 2: Calcular el área de un círculo")
            radio = int(input("Introduce el valor del radio: "))
            pi = 3.14
            area = pi * (radio**2)
            print("El área del círculo es:", area)

        case "3":
            print("Ejercicio 3: Convertir grados Celsius a Fahrenheit")
            celsius = int(input("Introduce la temperatura en ºC: "))
            fahrenheit = (9 / 5) * celsius + 32
            print(celsius, "ºC son:", fahrenheit, "ºF")

        case "4":
            print("Ejercicio 4: Calcular el doble y el triple de un número")
            n = int(input("Introduce un número: "))
            print("El doble de", n, "es:", n * 2)
            print("El triple de", n, "es:", n * 3)

        case "5":
            print("Ejercicio 5: Calcular la media de tres números")
            n1 = int(input("Introduce el primer número: "))
            n2 = int(input("Introduce el segundo número: "))
            n3 = int(input("Introduce el tercer número: "))
            if all(0 <= n <= 10 for n in (n1, n2, n3)):
                media = (n1 + n2 + n3) / 3
                print("La media es:", media)
            else:
                print("Los valores introducidos son incorrectos")

        case "6":
            print("Ejercicio 6: Multiplicar dos números")
            n1 = int(input("Introduce el primer número: "))
            n2 = int(input("Introduce el segundo número: "))
            print("El resultado de la multiplicación es:", n1 * n2)

        case "7":
            print("Ejercicio 7: Concatenar dos cadenas de texto")
            t1 = input("Introduce la primera frase: ")
            t2 = input("Introduce la segunda frase: ")
            print("Resultado:", t1 + t2)

        case "8":
            print("Ejercicio 8: Mostrar un número repetido varias veces")
            num = input("Introduce el número: ")
            veces = int(input("¿Cuántas veces?: "))
            if veces >= 1:
                for i in range(veces):
                    print(num)
                print("El número", num, "se repitió", veces, "veces")

        case "9":
            print("Ejercicio 9: Calcular el área de un rectángulo")
            base = int(input("Introduce la base: "))
            altura = int(input("Introduce la altura: "))
            if altura >= 1 and base >= 1:
                print("El área del rectángulo es:", base * altura)

        case "10":
            print("Ejercicio 10: Calcular el perímetro de un rectángulo")
            base = int(input("Introduce la base: "))
            altura = int(input("Introduce la altura: "))
            if altura >= 1 and base >= 1:
                perimetro = 2 * (base + altura)
                print("El perímetro del rectángulo es:", perimetro)

        case "11":
            print("Programa cerrado.")
            salir = 1

        case _:
            print("Opción no válida.")
