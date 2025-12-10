# Crea una funcion que calcule el precio de una entrada  precioEntrada(), sabiendo que para ello
# debe conocer aparte del precio de la entrada, que por defecto el precio sera 10, la edad del que la compra y si es o no estidiante
# ya que enca so de ser menor de 18 o estudiante, tendra un descuento del 50%
# descuento no acumulable


def precioEntrada(edad, esEstudiante, precio=10):
    descuento = 0
    if edad < 18 or esEstudiante:
        descuento = 50
        precioFinal = precio * descuento / 100
    else:
        precioFinal = precio
    return precioFinal


precioPablo = precioEntrada(35, True, 12)
print(f"El precio de la entrada de Pablo es: {precioPablo} euros")


precioSandra = precioEntrada(35, False, 12)
print(f"El precio de la entrada de Sandra es: {precioSandra} euros")
