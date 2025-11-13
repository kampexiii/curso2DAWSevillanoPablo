# Ejemplo de función con argumento variable con animales de un continente
def ejemplo(continente, *animales):
    print(f"En el continente {continente} hay los siguientes animales:")
    for animal in animales:
        print(animal)


ejemplo("Africa", "león", "elefante", "jirafa")


def sumaNotas(*notas):
    total = 0
    for nota in notas:
        print(f"Nota: {nota}")
        total += nota
    print(f"La suma de las notas es: {total}")


sumaNotas(7, 8, 9, 6)
sumaNotas()


def localizarMaximo(*numeros):
    if numeros:
        maximo = max(numeros)
        print(f"El número máximo es: {maximo}")
    else:
        print("No se proporcionaron números.")


localizarMaximo(3, 5, 13, 8, 1)
localizarMaximo()
