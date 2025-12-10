# Ejercicio 2: Comparar dos listas de nombres
def comparar_listas(nombres1, nombres2):
    """Compara dos listas de nombres y devuelve el contador"""
    # contador de nombres mostrados
    contador = 0

    # recorro ambas listas al mismo tiempo
    for i in range(len(nombres1)):
        try:
            nombre1 = nombres1[i]
            nombre2 = nombres2[i]

            # compruebo si es "Infanta Elena"
            if nombre1 == "Infanta Elena" or nombre2 == "Infanta Elena":
                print(f"  -> {nombre1} / {nombre2} : Nombre del instituto!")
                continue

            # compruebo si los nombres son iguales
            if nombre1 == nombre2:
                print(f"  -> {nombre1} / {nombre2} : Nombres iguales")
                continue

            # si llego aqui, muestro los nombres y cuento
            print(f"  {nombre1} / {nombre2}")
            contador += 1

        except Exception:
            print("Error al procesar nombres")

    return contador


def pedir_cantidad_listas():
    """Pide una cantidad de nombres valida"""
    while True:
        try:
            print("Cuantos nombres quieres introducir en cada lista")
            cantidad = int(input("Cantidad: "))
            if cantidad <= 0:
                print("Error: La cantidad debe ser mayor que 0")
            else:
                return cantidad
        except ValueError:
            print("Error: Debes introducir un numero entero")


def pedir_nombres(cantidad, numero_lista):
    """Pide una lista de nombres por consola"""
    lista = []
    print(f"Introduce los nombres de la lista {numero_lista}")
    for i in range(cantidad):
        nombre = input(f"Nombre {i + 1}: ")
        lista.append(nombre)
    return lista


if __name__ == "__main__":
    print("COMPARAR LISTAS DE NOMBRES")
    cantidad = pedir_cantidad_listas()
    lista1 = pedir_nombres(cantidad, 1)
    lista2 = pedir_nombres(cantidad, 2)
    print("\nComparando listas:")
    total = comparar_listas(lista1, lista2)
    print(f"\nTotal de nombres mostrados: {total}")
