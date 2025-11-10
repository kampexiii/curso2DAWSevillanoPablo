# Ejercicio: Montador de menú rápido (nivel básico).
# Requisitos:
# 1) Flujo lineal: plato -> bebida -> complemento -> pago.
# 2) El usuario introduce números enteros para elegir opciones.
# 4) Mostrar un resumen del pedido con precios y total.
# 5) Elegir método de pago: efectivo o tarjeta y finalizar.


# Lee un int válido. Reintenta.
def leer_opcion_numerica(minimo, maximo):
    while True:
        texto_opcion = input("Opción: ").strip()
        if texto_opcion.isdigit():
            numero = int(texto_opcion)
            if numero >= minimo and numero <= maximo:
                return numero
        print("Elige un número entre", minimo, "y", maximo)


# Paso 1. Plato. Traduce número a nombre/precio. Con defecto.
def elegir_plato():
    print("\n== Elige PLATO ==")
    print("1) Hamburguesa (5.0€)")
    print("2) Perrito     (3.5€)")
    print("3) Pizza       (6.5€)")
    opcion_plato = leer_opcion_numerica(1, 3)

    nombre_plato = ""
    precio_plato = 0.0
    match opcion_plato:
        case 1:
            nombre_plato = "hamburguesa"
            precio_plato = 5.0
        case 2:
            nombre_plato = "perrito"
            precio_plato = 3.5
        case 3:
            nombre_plato = "pizza"
            precio_plato = 6.5
        case _:
            print("Pongo 'hamburguesa' por defecto, está riquísima. Confía.")
            nombre_plato = "hamburguesa"
            precio_plato = 5.0
    return nombre_plato, precio_plato


# Paso 2. Bebida. Igual. Con defecto simpático.
def elegir_bebida():
    print("\n== Elige BEBIDA ==")
    print("1) Agua     (1.2€)")
    print("2) Refresco (1.8€)")
    print("3) Cerveza  (2.0€)")
    opcion_bebida = leer_opcion_numerica(1, 3)

    nombre_bebida = ""
    precio_bebida = 0.0
    match opcion_bebida:
        case 1:
            nombre_bebida = "agua"
            precio_bebida = 1.2
        case 2:
            nombre_bebida = "refresco"
            precio_bebida = 1.8
        case 3:
            nombre_bebida = "cerveza"
            precio_bebida = 2.0
        case _:
            print("Añadiendo alcoholetilla: 'cerveza' por defecto. Confía.")
            nombre_bebida = "cerveza"
            precio_bebida = 2.0
    return nombre_bebida, precio_bebida


# Paso 3. Complemento. Igual. Con defecto crujiente.
def elegir_complemento():
    print("\n== Elige COMPLEMENTO ==")
    print("1) Patatas  (2.0€)")
    print("2) Ensalada (1.8€)")
    print("3) Nuggets  (2.5€)")
    opcion_complemento = leer_opcion_numerica(1, 3)

    nombre_complemento = ""
    precio_complemento = 0.0
    match opcion_complemento:
        case 1:
            nombre_complemento = "patatas"
            precio_complemento = 2.0
        case 2:
            nombre_complemento = "ensalada"
            precio_complemento = 1.8
        case 3:
            nombre_complemento = "nuggets"
            precio_complemento = 2.5
        case _:
            txt = "Pongo 'patatas' por defecto porque crujen. Confía."
            print(txt)
            nombre_complemento = "patatas"
            precio_complemento = 2.0
    return nombre_complemento, precio_complemento


# Pago. Muestra total y método. Cierra.
def pagar(total_pedido):
    print("\n== Método de pago ==")
    print("1) Efectivo")
    print("2) Tarjeta")
    opcion_pago = leer_opcion_numerica(1, 2)

    if opcion_pago == 1:
        texto = "\nPagado en efectivo: " + "{:.2f}".format(total_pedido) + "€"
        print(texto)
    else:
        texto = "\nPagado con tarjeta: " + "{:.2f}".format(total_pedido) + "€"
        print(texto)
    print("Gracias por tu compra.")


# Orquesta. Flujo completo. Resume. Llama a pagar().
def main():
    print("Bienvenido. Montamos tu pedido paso a paso.")

    nombre_plato, precio_plato = elegir_plato()
    nombre_bebida, precio_bebida = elegir_bebida()
    nombre_complemento, precio_complemento = elegir_complemento()

    total_pedido = precio_plato + precio_bebida + precio_complemento

    print("\n--- RESUMEN ---")
    print("Plato:" + nombre_plato + "-" + "{:.2f}".format(precio_plato) + "€")
    print(
        "Bebida      : "
        + nombre_bebida
        + "  -  "
        + "{:.2f}".format(precio_bebida)
        + "€"
    )
    print(
        "Complemento : "
        + nombre_complemento
        + "  -  "
        + "{:.2f}".format(precio_complemento)
        + "€"
    )
    print("TOTAL       : " + "{:.2f}".format(total_pedido) + "€")

    pagar(total_pedido)


if __name__ == "__main__":
    main()
