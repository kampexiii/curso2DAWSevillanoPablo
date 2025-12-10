def computePay(horas, tarifa):
    if horas > 40:
        horasExtras = horas - 40
        salario = (horasExtras * (tarifa * 1.5)) + ((horas - horasExtras) * tarifa)
        print(f"Tu salario es de: {salario}")
    else:
        salario = horas * tarifa
        print(f"tu salario es de: {salario}")


horasUsu = int(input("Escriba cuantas horas trabaja por favor: \n"))
tarifaUsu = int(input("Escribe a cuanto te pagan la hora porfavor: \n"))

computePay(horasUsu, tarifaUsu)
