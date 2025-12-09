import modulos.mymodule

# suma
resultado_suma = modulos.mymodule.sumar(5, 3)
print(f"Suma: 5 + 3 = {resultado_suma}")


# saludo
mensaje_saludo = modulos.mymodule.saludar("Pablo")
print(mensaje_saludo)


from modulos.mymodule import restar

resta = restar(5, 3)
print(f"Resta: 5 - 3 = {resta}")
