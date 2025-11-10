# -----------------------------------------------------------------------------
# Sistema de Inventario SIMPLE - Versión con FUNCIONES BASICAS
# -----------------------------------------------------------------------------

# array simple para el inventario: [platanos, manzanas, peras]
inventario = [0, 0, 0]


def mostrar_inventario():
    """Muestra el stock actual"""
    print("\n--- INVENTARIO ---")
    print(f"Plátanos: {inventario[0]}")
    print(f"Manzanas: {inventario[1]}")
    print(f"Peras: {inventario[2]}")


def comprar_fruta():
    """Añade frutas al inventario"""
    print("\n¿Qué fruta quieres comprar?")
    print("1. Plátanos")
    print("2. Manzanas")
    print("3. Peras")

    try:
        # pido qué fruta
        opcion = int(input("Opción (1-3): "))
        # y cuánta cantidad
        cantidad = int(input("Cantidad: "))

        # valido que sea positiva
        if cantidad <= 0:
            print("Error: La cantidad debe ser positiva.")
            return

        # añado según la opción
        if opcion == 1:
            inventario[0] += cantidad
            print(f"✓ Añadidos {cantidad} plátanos")
        elif opcion == 2:
            inventario[1] += cantidad
            print(f"✓ Añadidas {cantidad} manzanas")
        elif opcion == 3:
            inventario[2] += cantidad
            print(f"✓ Añadidas {cantidad} peras")
        else:
            print("Opción no válida")
    except ValueError:
        print("Error: Introduce números válidos")


def vender_fruta():
    """Quita frutas del inventario"""
    print("\n¿Qué fruta quieres vender?")
    print("1. Plátanos")
    print("2. Manzanas")
    print("3. Peras")

    try:
        opcion = int(input("Opción (1-3): "))
        cantidad = int(input("Cantidad: "))

        if cantidad <= 0:
            print("Error: La cantidad debe ser positiva.")
            return

        # verifico stock y vendo
        if opcion == 1:
            if inventario[0] >= cantidad:
                inventario[0] -= cantidad
                print(f"✓ Vendidos {cantidad} plátanos")
            else:
                print(f"Error: Solo hay {inventario[0]} plátanos")
        elif opcion == 2:
            if inventario[1] >= cantidad:
                inventario[1] -= cantidad
                print(f"✓ Vendidas {cantidad} manzanas")
            else:
                print(f"Error: Solo hay {inventario[1]} manzanas")
        elif opcion == 3:
            if inventario[2] >= cantidad:
                inventario[2] -= cantidad
                print(f"✓ Vendidas {cantidad} peras")
            else:
                print(f"Error: Solo hay {inventario[2]} peras")
        else:
            print("Opción no válida")
    except ValueError:
        print("Error: Introduce números válidos")


# programa principal simple
print("=== TIENDA DE FRUTAS ===")

# muestro inventario inicial
mostrar_inventario()

# hago una compra
print("\n--- COMPRAR FRUTAS ---")
comprar_fruta()

# muestro inventario después de comprar
mostrar_inventario()

# hago una venta
print("\n--- VENDER FRUTAS ---")
vender_fruta()

# muestro inventario final
mostrar_inventario()
