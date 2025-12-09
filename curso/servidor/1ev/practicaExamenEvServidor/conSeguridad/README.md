# Panel CRUD rapido (PHP + PDO)

Instrucciones cortas para adaptar el menu cuando te pidan una BD/tablas distintas o te entreguen un .sql.

## Uso basico
- Abre `menu.php` en el navegador.
- Flujo tipico: Crear BD -> Conectar -> Crear tabla -> Insertar datos -> (Actualizar/Eliminar) -> Refresh.
- Puedes pasar `?db=NombreBD` en crear/conectar para usar otro nombre sin tocar codigo.
- BD por defecto en los scripts: `pruebas` (cambiala en `$dbDefault` si el enunciado lo pide).
- Si conectas o intentas insertar/actualizar/eliminar sin BD/tabla creada, veras mensajes claros que piden crear primero la BD/tabla.

## Si te dan un nombre de BD y campos
1) Cambia el nombre por defecto en `menu.php`, `create_database.php`, `drop_database.php` y `conexion.php` (variable `$dbDefault`).
2) Ajusta `create_table.php` a la estructura pedida (nombres y tipos de columnas).
3) Ajusta datos de prueba en `insert_into.php` para que coincidan con los campos.
4) Ajusta las reglas de actualizacion/eliminacion en `update_table.php` y `delete_from.php` segun el enunciado.
5) Si cambias el nombre de la tabla, sustituye `curso` por el nuevo nombre en todos los scripts.

## Si te dan un archivo .sql
1) Crea la BD con el nombre que indiquen (usa crear BD o `?db=NombreBD`).
2) Importa el .sql desde phpMyAdmin o consola MySQL apuntando a esa BD.
3) Pulsa Conectar en `menu.php` (usa `?db=NombreBD` si cambiaste el nombre).
4) Usa los botones de tabla/datos solo si el esquema importado coincide; si no, adapta los scripts como en el punto anterior.

## Notas rapidas
- El estado de la BD activa se guarda en sesion (`$_SESSION['db_activa']`).
- Todos los scripts usan PDO y se conectan con las credenciales definidas al inicio de cada archivo.
- El listado de datos en `menu.php` muestra las columnas que tengas en la tabla; ajusta HTML si cambias columnas.

## Que tocar en cada script (resumen rapido)
### menu.php
- Cambia `$dbDefault` si piden otro nombre de BD o usa `?db=NombreBD`.
- Ajusta los textos y las columnas del listado: modifica la fila de `<th>` y los campos mostrados en el bucle si cambias la tabla o columnas. Ejemplo: si la tabla nueva es `aula(id, nombre, capacidad, edificio)`, usa esos campos en los `<th>` y en las celdas.
- Si renombras la tabla, cambia `curso` en las consultas de estado/listado (SHOW TABLES LIKE y SELECT ... FROM).

### create_database.php
- Cambia `$dbDefault` al nombre de BD que pida el enunciado. El script hace drop + create.
- Puedes usar `?db=NombreBD` para crear otra sin tocar codigo.

### drop_database.php
- Usa el mismo `$dbDefault` que el resto.
- Borra la BD activa (o la por defecto si no hay sesion).
 - Si no existe, muestra mensaje amigable.

### conexion.php
- Usa el mismo `$dbDefault` y permite `?db=OtraBD` para conectar a otra.
- Mantiene la BD activa en `$_SESSION['db_activa']`.

### create_table.php
- Define el nombre de la tabla (ahora `curso`) y cambia la estructura a la pedida (columnas y tipos).
- Ejemplo: si piden tabla `aula` con `id` AUTOINCREMENT, `nombre` VARCHAR(100), `capacidad` INT, `edificio` VARCHAR(50): haz DROP TABLE IF EXISTS aula; CREATE TABLE aula (...).
- Si renombras la tabla, cambia `curso` por el nuevo nombre en todos los scripts.

### insert_into.php
- Cambia los INSERT por los datos/campos exactos que pidan. Asegurate de que coinciden con las columnas de la tabla.
- Ejemplo: con tabla `aula` anterior, cada INSERT debe ser `INSERT INTO aula (nombre, capacidad, edificio) VALUES (...)` (sin el id autoincremental).
- Puedes usar placeholders/prepared si prefieres.
- Incluye dos modos: auto (lote predefinido) y manual (formulario con validacion). Si no hay BD/tabla, muestra mensaje y no ejecuta.

### update_table.php
- Ajusta el `UPDATE` (las columnas y condiciones) segun el enunciado.
- Ejemplo: si piden subir capacidad +5 en aulas del edificio A, usa `UPDATE aula SET capacidad = capacidad + 5 WHERE edificio = 'A';`.
- Si dejas el insert extra al final, adapta los valores o elimina esa parte si no la necesitas.
- Tiene modo auto (regla predefinida) y manual (formulario con select de IDs existentes). Si falta BD/tabla, muestra mensaje y no ejecuta.

### delete_from.php
- Cambia la condicion del `DELETE` para que elimine los registros que pidan (ej., por columna/valor).
- Ejemplo: borrar aulas con capacidad < 10 -> `DELETE FROM aula WHERE capacidad < 10;`.
- Tiene modo auto (regla predefinida) y manual (select de IDs existentes). Si falta BD/tabla, muestra mensaje y no ejecuta.

### drop_table.php
- Usa el nombre de tabla que definas en create_table. Comprueba si existe antes de borrar y muestra mensaje claro si no existe.

### select_table.php (opcional)
- Si usas este script para listar fuera del menu, ajusta columnas y nombre de tabla igual que en `menu.php`.
