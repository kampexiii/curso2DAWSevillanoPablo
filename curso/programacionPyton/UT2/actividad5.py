# menu de inventario de peras manzanas y platanos.
platanos = 0
manzanas = 0
peras = 0

print("Bienvenido a la TIENDA.")

encendida = 1


def nom_fruta(txt):
    n = txt.strip().lower()
    if n in ("platano", "platanos"):
        return "platanos"
    if n in ("manzana", "manzanas"):
        return "manzanas"
    if n in ("pera", "peras"):
        return "peras"
    return ""


eleccionTienda = input("Accion [comprar|vender|mostrar|salir]: ").strip().lower()

fruta_eleccion = input("Fruta [platano|manzana|pera]: ").strip().lower()
fruta = nom_fruta(fruta_eleccion)

cantidad_txt = ""
if eleccionTienda in ("comprar", "vender"):
    cantidad_txt = input("Cantidad: ").strip()


def accion(accion_txt, fruta_txt, cantidad_str):
    global platanos, manzanas, peras

    match accion_txt:
        case "comprar":
            if not cantidad_str.isdigit() or not fruta_txt:
                print("Datos no validos.")
                return
            u = int(cantidad_str)
            if fruta_txt == "platanos":
                platanos += u
            elif fruta_txt == "manzanas":
                manzanas += u
            elif fruta_txt == "peras":
                peras += u
            print("Compra registrada.")

        case "vender":
            if not cantidad_str.isdigit() or not fruta_txt:
                print("Datos no validos.")
                return
            u = int(cantidad_str)
            disp = (
                platanos
                if fruta_txt == "platanos"
                else (
                    manzanas
                    if fruta_txt == "manzanas"
                    else peras if fruta_txt == "peras" else 0
                )
            )
            if disp <= 0:
                print("No hay stock de esa fruta.")
                return
            if u > disp:
                print("No puedes vender mas de lo disponible.")
                return
            if fruta_txt == "platanos":
                platanos -= u
            elif fruta_txt == "manzanas":
                manzanas -= u
            elif fruta_txt == "peras":
                peras -= u
            print("Venta registrada.")

        case "mostrar":
            if fruta_txt == "platanos":
                print(f"Platanos: {platanos}")
            elif fruta_txt == "manzanas":
                print(f"Manzanas: {manzanas}")
            elif fruta_txt == "peras":
                print(f"Peras: {peras}")
            else:
                print("Fruta no valida.")

        case "salir":
            print("Hasta pronto.")

        case _:
            print("Accion no reconocida.")


accion(eleccionTienda, fruta, cantidad_txt)
