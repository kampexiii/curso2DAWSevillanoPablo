#examenPabloSevillano.py


print("Ejercicio 1")

#llamar a la funcion info_argumentos con varios argumentos de prueba desde un archivo python diferente,
#este se llama operaciones.py
print("Probando la funcion info_argumentos")
import operaciones as ej1
ej1.info_argumento(10, 20, 30, 40)

print("Probando la funcion divisibles3")
ej1.divisibles3(1, 3, 10, 15, 22, 33, 42, 55, 60)

print("Probando la funcion historiograma")
ej1.historiograma(4, 9, 7)


print("---------------------------------------------------------------------------------------------------------------")

print("Ejercicio 2")

import operaciones as ej2

#probando precio sin recargo y sin ser urgente.  5
print(ej2.coste_envio(0.5))

#probando precio con recargo pero sin ser urgente  7
print(ej2.coste_envio(1.5))

#probando precio con recargo y siendo urgente  9
print(ej2.coste_envio(2.5, urgente=True))


print("---------------------------------------------------------------------------------------------------------------")

print("Ejercicio 3")

import operaciones as ej3

# introduce las horas
hora = int(input("introduce las horas: "))
# introduce los minutos
minuto = int(input("introduce los minutos: "))
# introduce los segundos:
segundo = int(input("introduce los segundos: "))

# llamamos a la funcion op.convertir_segundos(horas. minutos, segundos)
total_segundos = ej3.convertir_segundos(hora, minuto, segundo)
print("Total  en segundos:", total_segundos, "segundos")