# ---------------------------------------------------------------------------
# Ejercicio 1: Verificación de edad
# ---------------------------------------------------------------------------
"""
Pide al usuario que introduzca su edad. Valida que sea un número entero
positivo. Si la edad es mayor o igual a 18, muestra un mensaje indicando
que es mayor de edad. Si no, indica que es menor de edad.

- Usar try/except para capturar errores de conversión.
- Validar que el número no sea negativo ni cero.
- Comparar edad >= 18 para determinar el mensaje.
"""


# ---------------------------------------------------------------------------
# Ejercicio 2: Comparación de dos números
# ---------------------------------------------------------------------------
"""
Solicita al usuario dos números enteros. Muestra cuál es mayor, cuál es 
menor o si son iguales.

- Convertir ambos valores dentro de un bloque try/except.
- Comparar con >, < y == para determinar el resultado.
- Imprimir mensaje correspondiente para cada caso.
"""

# ---------------------------------------------------------------------------
# Ejercicio 3: Validación de nota
# ---------------------------------------------------------------------------
"""
Pide al usuario una nota numérica entre 0 y 10. Valida que sea un número 
decimal válido y esté dentro del rango.

Clasificación:
- 0.0 - 4.9  : Suspenso
- 5.0 - 6.9  : Aprobado
- 7.0 - 8.9  : Notable
- 9.0 - 10.0 : Sobresaliente

- Usar float dentro de try/except.
- Validar rango con condicionales.
- Imprimir la categoría adecuada según el valor.
"""

# ---------------------------------------------------------------------------
# Ejercicio 4: Acceso con clave
# ---------------------------------------------------------------------------
"""
Pide al usuario que introduzca una clave. Si la clave coincide con 
"python123", muestra un mensaje de acceso concedido. Si no, muestra 
"acceso denegado".

- Comparar la cadena introducida con la clave establecida.
- No es necesario conversión numérica.
- Puedes usar condicional simple if/else.
"""

# ---------------------------------------------------------------------------
# Ejercicio 5: Menú de selección
# ---------------------------------------------------------------------------
"""
Muestra un menú con tres opciones:
1. Ver perfil
2. Editar perfil
3. Salir

Pide al usuario que introduzca el número de la opción. Muestra un mensaje 
según la opción elegida. Si introduce un valor no válido, muestra un 
mensaje de error.

- Usar int dentro de try/except para la opción.
- Usar if/elif/else para controlar cada caso.
- Validar que la opción esté entre 1 y 3.
"""

# ---------------------------------------------------------------------------
# Ejercicio 6: Validación de número par o impar
# ---------------------------------------------------------------------------
"""
Solicita al usuario un número entero. Valida que sea correcto. Muestra si 
el número es par o impar.

- Convertir a int dentro de try/except.
- Usar el operador % para determinar la paridad.
- Imprimir el mensaje correspondiente.
"""

# ---------------------------------------------------------------------------
# Ejercicio 7: Verificación de permisos para conducir según edad
# ---------------------------------------------------------------------------
"""
Solicita al usuario su edad. Según la edad, muestra qué tipo de vehículo 
puede conducir:

- Menor de 14: no puede conducir
- 14 o más   : moto de poca cilindrada
- 16 o más   : moto de gran cilindrada
- 18 o más   : coche

- Convertir la edad dentro de try/except.
- Comprobar condiciones en orden descendente o adecuado.
- Mostrar el mensaje correspondiente a cada rango.
"""
