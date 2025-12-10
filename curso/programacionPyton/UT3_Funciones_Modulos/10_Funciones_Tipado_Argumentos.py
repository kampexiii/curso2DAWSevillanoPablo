"""
Ejercicio 1: Saludo personalizado
Crea una función llamada saludar que reciba dos argumentos por palabra clave:
- nombre (str)
- saludo (str), con valor por defecto "Hola"
La función debe devolver una cadena con el saludo seguido del nombre

"""


def saludar(*, nombre: str, saludo: str = "Hola") -> str:
    return f"{saludo}, {nombre}!"


# Ejemplo
print(saludar(nombre="Ana"))  # Salida: "Hola, Ana!"


"""
Ejercicio 2: Cálculo de precio con IVA
Crea una función llamada `calcular_precio` que reciba:
- precio_base (float)
- iva (float), como argumento por palabra clave, con valor por defecto 21
La función debe devolver el precio final con el IVA aplicado.
"""


def calcular_precio(precio_base: float, *, iva: float = 21) -> float:
    return precio_base * (1 + iva / 100)


# Ejemplo
print(calcular_precio(100))  # Salida: 121.0


"""
Ejercicio 3: Crear usuario con lista
Crea una función llamada `crear_usuario` que reciba los siguientes argumentos por palabra
clave:
- nombre (str)
- email (str)
- activo (bool), con valor por defecto True
La función debe devolver una lista sólo de los usuarios activos con los datos del usuario en
el orden: [nombre, email, activo].

"""


def crear_usuario(nombre: str, email: str, activo: bool = True) -> list:
    if activo:
        return [nombre, email, activo]
    return []


# Ejemplo
print(
    crear_usuario(nombre="Juan", email="juan@example.com")
)  # Salida: ["Juan", "juan@example.com", True]


"""
Ejercicio 4: Formatear nombre completo
Crea una función llamada `formatear_nombre` que reciba:
- nombre (str)
- apellido (str)
- orden (str), con valor por defecto "nombre_apellido" (el otro valor que podría tomar sería
apellido_nombre)
La función debe devolver el nombre completo en el orden indicado.

"""


def formatear_nombre(nombre: str, apellido: str, orden: str = "nombre_apellido") -> str:
    if orden == "apellido_nombre":
        return f"{apellido} {nombre}"
    return f"{nombre} {apellido}"


# Ejemplos de uso
print(formatear_nombre("Luis", "Martínez"))  # Salida: "Luis Martínez"
print(
    formatear_nombre("Luis", "Martínez", orden="apellido_nombre")
)  # Salida: "Martínez Luis"


"""
Ejercicio 5: Calcular descuento
Crea una función llamada `calcular_descuento` que reciba:
- precio_original (float)
- descuento (float), como argumento por palabra clave, con valor por defecto 10
La función debe devolver el precio final tras aplicar el descuento.
"""


def calcular_descuento(precio_original: float, descuento: float = 10) -> float:
    return precio_original * (1 - descuento / 100)


# Ejemplo
print(calcular_descuento(200))  # Salida: 180.0
print(calcular_descuento(200, descuento=20))  # Salida: 160.0


"""
Ejercicio 7: Filtrar números pares
Crea una función llamada `filtrar_pares` que reciba una lista de números enteros y devuelva
una nueva lista solo con los números pares.
Programación en Python Curso 25/26
IES Infanta Elena
"""


def filtrar_pares(numeros: list[int]) -> list[int]:
    return [num for num in numeros if num % 2 == 0]


# Ejemplo
print(filtrar_pares([1, 2, 3, 4, 5, 6]))  # Salida: [2, 4, 6]


"""
Ejercicio 8: Generar tabla de multiplicar
Crea una función llamada `tabla_multiplicar` que reciba:
- numero (int)
- hasta (int), como argumento por palabra clave, con valor por defecto 10
La función debe devolver una lista con la tabla de multiplicar del número hasta el valor
indicado.
"""


def tabla_multiplicar(numero: int, hasta: int = 10) -> list[int]:
    return [numero * i for i in range(1, hasta + 1)]


# Ejemplo
print(tabla_multiplicar(5))  # Salida: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50]
print(tabla_multiplicar(3, hasta=5))  # Salida: [3, 6, 9, 12, 15]
