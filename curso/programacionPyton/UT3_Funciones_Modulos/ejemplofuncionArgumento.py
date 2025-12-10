# Ejemplo de función con argumento variable con animales de un continente
import random


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


def multiplicaSumaTotal(multiplicador, *numeros):
    suma = sum(numeros)
    resultado = suma * multiplicador
    print(f"La suma de los números es: {suma}")
    print(f"El resultado de la suma multiplicada por {multiplicador} es: {resultado}")


multiplicaSumaTotal(2, 4, 5, 6)


def multiplicarTodosLosNumeros(multiplicador, *numeros):
    total = 0
    for numero in numeros:
        resultado = numero * multiplicador
        print(f"{numero} multiplicado por {multiplicador} es {resultado}")
        total += resultado
    print(f"La suma total de los resultados es: {total}")


multiplicarTodosLosNumeros(3, 2, 4, 6)


def hacer_pizza(tamaño=1, *ingredientes):
    if ingredientes:
        print(
            f"Su pizza de {tamaño} porciones esta en el  horno con los siguientes ingredientes:"
        )
        for ingrediente in ingredientes:
            print(f"- {ingrediente}")
    else:
        print("No se han proporcionado ingredientes para la pizza.")


hacer_pizza(8, "jamon", "champiñones", "pimientos asados")
hacer_pizza(4)
hacer_pizza()


# funcion ganador, devuelve el ganador entre varios jugadores aleatoriamente


def ganador(*jugadores):
    if not jugadores:
        print("No hay jugadores para elegir ganador.")
        return

    jugadoresLista = []

    for jugador in jugadores:
        print(f"Jugador participante: {jugador}")
        jugadoresLista.append(jugador)

    numeroParticipantes = len(jugadoresLista)
    numeroGanador = random.randint(0, numeroParticipantes - 1)

    ganadorElegido = jugadoresLista[numeroGanador]
    print(f"El ganador es: {ganadorElegido}")

    return ganadorElegido


ganador("Pablo", "Sandra", "Marcos", "Ana")
