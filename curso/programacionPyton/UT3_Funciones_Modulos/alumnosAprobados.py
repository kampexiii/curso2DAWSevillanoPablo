# pedir el numero de alumnos
# introducir la nota al alumnos
# devolver cuantos alumnos han aprobado


def pedir_cantidad():
    cantidad = int(input("Introduce la cantidad de alumnos: "))
    return cantidad


def introducir_notas(cantidad):
    notas = []
    for i in range(cantidad):
        nota = float(input(f"Introduce la nota del alumno {i + 1}: "))
        notas.append(nota)
    return notas


def contar_aprobados(notas):
    aprobados = 0
    for nota in notas:
        if nota >= 5:
            aprobados += 1
    return aprobados


# probarlo
cantidad = pedir_cantidad()
notas = introducir_notas(cantidad)
aprobados = contar_aprobados(notas)
print(f"Cantidad de alumnos aprobados: {aprobados}")
