# DAW RA4: Ejercicios Cadenas Python

# -----------------------------------------------------------------------------
# Ejercicio 1 (Sebastian Becerra)
# -----------------------------------------------------------------------------
"""
Modifica la cadena “               este ejercicio es muy complicado            ” 
para que el ejercicio sea facilísimo y cada una de las palabras comience en 
mayúsculas y sin espacios y luego imprimelo invertido, ademas busca el indice 
de la palabra complicado.
"""
solucion:


# -----------------------------------------------------------------------------
# Ejercicio 2 (Ana López)
# -----------------------------------------------------------------------------
"""
Vamos a definir una cadena y la vamos a pasar a minúsculas, eliminar los espacios
y las letras pares las vamos a cambiar por asteriscos
"""
solucion:


# -----------------------------------------------------------------------------
# EJERCICIO 3 (Alejandro Malpelo): Clasificador de palabras
# -----------------------------------------------------------------------------
"""
Escribe un programa en Python que pida al usuario un texto y clasifique sus 
palabras según estas reglas:
- Palabras que empiezan por vocal.
- Palabras que terminan en consonante.
- Palabras que contienen algún número.

El programa debe:
- Separar el texto en palabras.
- Detectar cuáles cumplen cada condición.
- Guardarlas en un diccionario con tres listas.
- Mostrar un informe final indicando las palabras encontradas en cada categoría
  y cuántas hay en cada una.
"""
solucion:


# -----------------------------------------------------------------------------
# EJERCICIO 4 (Mónica Cortés)
# -----------------------------------------------------------------------------
"""
Crea una función que reciba un argumento string y compruebe si todos los 
caracteres son mayúsculas
"""
solucion:


# -----------------------------------------------------------------------------
# EJERCICIO 5 (Alejandro Pacheco)
# -----------------------------------------------------------------------------
"""
A través de una función, introduciendo una cadena por parámetro, devolver la 
longitud, devolver la cadena en minúsculas y devolver las ultimas 5 letras de 
la cadena.
"""
solucion:


# -----------------------------------------------------------------------------
# EJERCICIO 6 (Alberto Llera)
# -----------------------------------------------------------------------------
"""
Recoger un email por consola introducido por el usuario. En una función se debe 
comprobar que el correo introducido por el usuario contenga “@” y acabe en 
“.com” o “.es”. Además, el usuario solo tendrá tres oportunidades para validar 
el correo.
"""
solucion:


# -----------------------------------------------------------------------------
# EJERCICIO 7 (Manuel Moreno)
# -----------------------------------------------------------------------------
"""
Pedir por teclado una cadena de texto y “analizarla” con distintas funciones.
Deberá contar la longitud total, contar las letras (mirar str.isaplha()), 
contar los números, contar los caracteres especiales y contar los espacios
"""
solucion:


# -----------------------------------------------------------------------------
# EJERCICIO 8 (Rafael Cosquillo)
# -----------------------------------------------------------------------------
"""
Pida al usuario una frase.
Elimine los espacios al inicio y al final (strip()).
Muestre: 
- La frase en minúsculas (lower()).
- La frase en mayúsculas (upper()).
- La frase con la primera letra en mayúscula (capitalize()).
- Reemplace todas las comas por puntos (replace()).
- Cuente cuántas veces aparece una palabra que el usuario ingresa (count()).
- Verifique si la frase empieza con una vocal (startswith()).
- Muestre cuántas palabras tiene la frase (split()).
"""
solucion:


# -----------------------------------------------------------------------------
# EJERCICIO 9 (Franco Benavides)
# -----------------------------------------------------------------------------
"""
Volviendo a Messenger
Pide al usuario una oración completa y el programa debe averiguar cuántas 
palabras tiene esa oración.
Si ese número es par, convierte las letras pares a mayúsculas y las impares a 
minúsculas y devuelve esa frase convertida.
Si el número es impar, devuelve la frase con las palabras con el orden invertido.
Modulen pls

frase = "Estoy estudiando Python y no quiero suspender"
"""
solucion:


# -----------------------------------------------------------------------------
# EJERCICIO 10 (Carlos Garrido)
# -----------------------------------------------------------------------------
"""
Recibir dos cadenas de caracteres y contar sus vocales para después sumarlas.
por otra parte combinar las dos cadenas y remplazar cada carácter que este en 
una posición impar por una “C”.
"""
solucion:


# -----------------------------------------------------------------------------
# Ejercicio 11 (Pablo Sevillano)
# -----------------------------------------------------------------------------
"""
Crear una función que reciba un DNI por parámetro y valide si es correcto.
El DNI debe tener 8 números y 1 letra, y la letra debe coincidir con la letra 
oficial obtenida con la fórmula del DNI (número % 23 usando la cadena 
"TRWAGMYFPDXBNJZSQVHLCKE").
La función debe devolver True si el DNI es válido y False si no lo es.
Después, probar la función con varios DNIs.
"""

def validar_dni(dni):
    letras = "TRWAGMYFPDXBNJZSQVHLCKE"
    dni = dni.upper().strip()
    
    # Comprobamos longitud
    if len(dni) != 9:
        return False
        
    numero = dni[:-1]
    letra = dni[-1]
    
    # Si son numeros y la letra es correcta
    if numero.isdigit() and letras[int(numero) % 23] == letra:
        return True
        
    return False

# Pruebas
if __name__ == "__main__":
    print(validar_dni("12345678Z")) # True
    print(validar_dni("12345678A")) # False


# -----------------------------------------------------------------------------
# Ejercicio 12 FINAL (solo profesionales) (David Bermejo Cristóbal)
# -----------------------------------------------------------------------------
"""
Enunciado:
Crear una funcion que cuente el numero de letras que tiene un string, el numero 
de numeros y el numero de espacios.
La funcion debe devolver un string con el siguiente formato:
"tienes X letras, Y numeros y Z espacios"
"""
solucion:
