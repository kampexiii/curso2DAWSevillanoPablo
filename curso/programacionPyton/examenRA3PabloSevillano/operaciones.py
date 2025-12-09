# aqui las funciones

# Ejercicio1

# Define tres funciones que puedan recibir un numero indeterminado de numeros:


# info_argumentos(*args): devuelve el numero de argumentos recibidos e imprime cada uno de ellos. No se podra utilizar la funcion len()


def info_argumento(*args):
    contador = 0
    for arg in args:
        contador += 1
        print(arg)
    return contador


# divisibles3(*args): imprime los numeros que son divisibles por 3
def divisibles3(*args):
    for arg in args:
        if arg % 3 == 0:
            print(arg)


# historiograma(*args): imprime por pantalla la representacion de los numeros que introducimos en forma de historiograma, de manera que cada numero
#    se representa con una lnea formada por asteriscos como valor de dicho numero
#    ejemplo: historiograma(4, 9, 7)
#    ***
#    *********
#    *******


def historiograma(*args):
    for arg in args:
        print("*" * arg)


# Ejercicio2

#    """ Correos nos ha pedido una funcion (coste_envio) para calcular de manera eficaz el coste del envio de cualquier paquete.
#    Nos indica que el coste se calcula a partir de una tarifa base, que por defecto es 5 euros, incrementandola en 2 euros por cada kilo de peso (empezando directamente ya por el primer kilo (1kg)), mas el recargo si corresponde.
#    Se debe aplicar un recargo del 30% en el caso de envio urgente, si no se indica nada, se cosiderara envio no urgente."""


def coste_envio(peso, urgente=False, tarifaBase=5):
    # definimos si su peso llega a 1kg, si no llega no se le aplica el recargo de los 2 euros
    if peso < 1:
        peso = 0
    # definimos el recargo por kilo, solo  se incrementa al llegar al kilo nuevo, por lo tanto redondeamos quitando decimales hacia abajo.
    recargoKilo = int(peso) * 2
    # sumamos el recargo al precio base
    coste = tarifaBase + recargoKilo

    # si es urgente, se le aplica el recargo del 30%
    if urgente:
        coste = coste * 1.3
    return coste

    # Ejercicio3

    # Se n ecesita una funcion que calcule la cantidad de segundos dada una hora valida (una hora valida es la que se ve por el reloj en formato 24h), en horas, minutos y segundos.
    # Se considera una hora valida, la que podrias ver en un reloj digital que muestra la hora en formato 24horas.

    # Hay que tener en cuenta control de errores (no se refiere a excepciones) y solo llamar a la funcion cuando los datos introducidos son correctos (numeros validos).

    # La llamada a la funcion desde el programa principal debe ser obligatoriamente:
    # op.convertir_segundos(horas. minutos, segundos)"""

    # "ejemplo de ejecucion: (tu programa debe mostrar esta misma salida para las mismas entradas)

    # introduce las horas: 2
    # introduce los minutos: 2
    # introduce los segundos: 2
    # Total  en segundos: 7322 segundos"""


def convertir_segundos(horas, minutos, segundos):
    # comprobamos que las horas , minutos y segundos estan dentro de los rangos validos
    if horas < 0 or horas > 23:
        return "Error: las horas deben estar entre 0 y 23."
    if minutos < 0 or minutos > 59:
        return "Error: los minutos deben estar entre 0 y 59."
    if segundos < 0 or segundos > 59:
        return "Error: los segundos deben estar entre 0 y 59."
    # calculamos el total de segundos
    total_segundos = horas * 3600 + minutos * 60 + segundos
    return total_segundos
