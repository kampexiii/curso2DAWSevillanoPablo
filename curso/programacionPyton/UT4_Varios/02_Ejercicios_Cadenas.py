"""
DAW RA4: Ejercicios Cadenas Python

Ejercicio 1 (Sebastian Becerra)
Modifica la cadena “               este ejercicio es muy complicado            ” para que el ejercicio sea facilísimo  y cada una de las palabras comience en mayúsculas y sin espacios y luego imprimelo invertido, ademas busca el indice de la palabra complicado.

Ejercicio 2  (Ana López)
Vamos a definir una cadena y la vamos a pasar a minúsculas, eliminar los espacios
y las letras pares las vamos a cambiar por asteriscos

EJERCICIO 3 (Alejandro Malpelo): Clasificador de palabras
Escribe un programa en Python que pida al usuario un texto y clasifique sus palabras según estas reglas:
- Palabras que empiezan por vocal.
- Palabras que terminan en consonante.
- Palabras que contienen algún número.
El programa debe:
- Separar el texto en palabras.
- Detectar cuáles cumplen cada condición.
- Guardarlas en un diccionario con tres listas.
- Mostrar un informe final indicando las palabras encontradas en cada categoría
  y cuántas hay en cada una.

EJERCICIO 4 (Mónica Cortés):
Crea una función que reciba un argumento string y compruebe si todos los caracteres son mayúsculas

EJERCICIO 5 (Alejandro Pacheco):
A través de una función, introduciendo una cadena por parámetro, devolver la longitud, devolver la cadena en minúsculas y devolver las ultimas 5 letras de la cadena.

EJERCICIO 6 (Alberto Llera):
Recoger un email por consola introducido por el usuario. En una función se debe comprobar que el correo introducido por el usuario contenga “@” y acabe en “.com” o “.es”.  Además, el usuario solo tendrá tres oportunidades para validar el correo.

EJERCICIO 7 (Manuel Moreno)
Pedir por teclado una cadena de texto y “analizarla” con distintas funciones.
Deberá contar la longitud total, contar las letras (mirar str.isaplha()), contar los números, contar los caracteres especiales y contar los espacios

EJERCICIO 8 (Rafael Cosquillo)
Pida al usuario una frase.
Elimine los espacios al inicio y al final (strip()).
 Muestre: La frase en minúsculas (lower()).
La frase en mayúsculas (upper()).
La frase con la primera letra en mayúscula (capitalize()).
Reemplace todas las comas por puntos (replace()).
Cuente cuántas veces aparece una palabra que el usuario ingresa (count()).
Verifique si la frase empieza con una vocal (startswith()).
Muestre cuántas palabras tiene la frase (split()).

EJERCICIO 9 (Franco Benavides)
'''Volviendo a Messenger
Pide al usuario una oración completa y el programa debe averiguar cuántas palabras tiene esa oración.
Si ese número es par, convierte las letras pares a mayúsculas y las impares a minúsculas y devuelve esa frase convertida.
Si el número es impar, devuelve la frase con las palabras con el orden invertido.
Modulen pls
frase = "Estoy estudiando Python y no quiero suspender'''

EJERCICIO 10 (Carlos Garrido)
Recibir dos cadenas de caracteres y contar sus vocales para después sumarlas.
por otra parte combinar las dos cadenas y remplazar cada carácter que este en una posición impar por una “C”.

Ejercicio 11 (Pablo Sevillano)
Crear una función que reciba un DNI por parámetro y valide si es correcto.
El DNI debe tener 8 números y 1 letra, y la letra debe coincidir con la letra oficial obtenida con la fórmula del DNI (número % 23 usando la cadena "TRWAGMYFPDXBNJZSQVHLCKE").
La función debe devolver True si el DNI es válido y False si no lo es.
Después, probar la función con varios DNIs.

Ejercicio  12 FINAL (solo profesionales) ( David Bermejo Cristóbal)
##Enunciado:
#Crear una funcion que cuente el numero de letras que tiene un string, el numero de numeros y el numero de espacios.
#La funcion debe devolver un string con el siguiente formato:
#"tienes X letras, Y numeros y Z espacios"
"""

# -----------------------------------------------------------------------------
# Resolución Ejercicio 11 (Pablo Sevillano)
# -----------------------------------------------------------------------------


def validar_dni(dni):
    """
    Valida si un DNI es correcto.
    El DNI debe tener 8 números y 1 letra.
    La letra debe coincidir con la fórmula: número % 23.
    """
    # Letras del DNI ordenadas según el resto de la división por 23
    letras_dni = "TRWAGMYFPDXBNJZSQVHLCKE"

    # Convertir a mayúsculas y eliminar espacios por si acaso
    dni = dni.strip().upper()

    # Comprobar longitud (debe ser 9 caracteres: 8 números + 1 letra)
    if len(dni) != 9:
        return False

    # Separar número y letra
    numero_str = dni[:-1]
    letra = dni[-1]

    # Comprobar que los primeros 8 caracteres son dígitos
    if not numero_str.isdigit():
        return False

    # Comprobar que el último caracter es una letra
    if not letra.isalpha():
        return False

    # Calcular la letra correcta
    numero = int(numero_str)
    resto = numero % 23
    letra_correcta = letras_dni[resto]

    # Comparar letra calculada con la letra proporcionada
    return letra == letra_correcta


# Pruebas de la función
if __name__ == "__main__":
    print("--- Probando validador de DNI ---")

    dnis_prueba = [
        "12345678Z",  # DNI válido (ejemplo teórico)
        "00000000T",  # DNI válido (0 % 23 = 0 -> T)
        "12345678A",  # Letra incorrecta
        "1234567A",  # Longitud incorrecta
        "123456789",  # Sin letra
        "ABCDEFGHZ",  # Sin números
    ]

    for dni in dnis_prueba:
        es_valido = validar_dni(dni)
        estado = "VÁLIDO" if es_valido else "INVÁLIDO"
        print(f"DNI: {dni} -> {estado}")
