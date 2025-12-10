# Llmar a modulo calculos, en el estaran 3 fucnciones area circulo, area cuadrado
# y area triangulo, si no se ha introducido uno de los valores necesarios, valor por defecto 8 en todos.

import modulosArea.funcionesAreas

resultado_area_circulo = modulosArea.funcionesAreas.area_circulo()
print(f"El área del círculo con radio 8 es: {resultado_area_circulo}")
resultado_area_circulo = modulosArea.funcionesAreas.area_circulo(4)
print(f"El área del círculo con radio 4 es: {resultado_area_circulo}")


resultado_area_cuadrado = modulosArea.funcionesAreas.area_cuadrado()
print(f"El área del cuadrado con base 8 y altura 8 es: {resultado_area_cuadrado}")
resultado_area_cuadrado = modulosArea.funcionesAreas.area_cuadrado(4)
print(f"El área del cuadrado con base 4 y altura 4 es: {resultado_area_cuadrado}")


resultado_area_triangulo = modulosArea.funcionesAreas.area_triangulo()
print(f"El área del triángulo con base 8 y altura 8 es: {resultado_area_triangulo}")
resultado_area_triangulo = modulosArea.funcionesAreas.area_triangulo(6, 8)
print(f"El área del triángulo con base 6 y altura 8 es: {resultado_area_triangulo}")
