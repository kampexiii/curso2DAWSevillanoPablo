# funcion ganador, devuelve el ganador entre varios jugadores aleatoriamente
import random


def ganador(*jugadores):
    if not jugadores:
        print("No hay jugadores para elegir ganador.")
        return

    numeroParticipantes = len(jugadores)
    numeroGanador = random.randint(0, numeroParticipantes - 1)

    ganadorElegido = jugadores[numeroGanador]
    print(f"El ganador es: {ganadorElegido}")

    return ganadorElegido


ganador("Pablo", "Sandra", "Marcos", "Ana")
