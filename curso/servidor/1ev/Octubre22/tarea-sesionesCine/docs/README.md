Proyecto: Tarea — Reservas de Cine (sesiones, butacas y extras)

- Hice una pequeña aplicación PHP para gestionar reservas de butacas en un cine.
- Uso sesiones, cookies y un fichero JSON (persistente) para contar sesiones activas por navegador.
- Index queda en la raíz del proyecto y el resto de archivos PHP están organizados en `src/`.
- Las sesiones activas se guardan en `data/active_sessions.json`.

Estructura de carpetas

- index.php -> Página principal (en la raíz)
- src/ -> Código PHP ordenado
  - SessionManager.php -> Lógica de sesiones en JSON
  - login.php -> Procesa login y crea cookie
  - logout.php -> Elimina sesión y cookie
  - seats.php -> Muestra cuadrícula de butacas
  - extras.php -> Selección de palomitas/bebida
  - summary.php -> Resumen y precio
  - confirm.php -> Confirma la reserva (simulado)
- resources/css/style.css -> Estilos básicos
- assets/img/ -> Imágenes (posters) si quieres añadir
- data/active_sessions.json -> Almacén persistente de sesiones activas

Cómo funciona

1. Inicio y usuarios de prueba

- Tengo usuarios predefinidos: `usuario`, `alumno`, `profesor`, `pablo`, `admin`.
- La contraseña es igual que el nombre de usuario para facilitar pruebas.

2. Login

- Cuando inicio sesión (form en `index.php`) envío los datos a `src/login.php`.
- `login.php` valida las credenciales y, si son correctas, genera un `session_id` único con `uniqid()`.
- Guardo ese `session_id` en una cookie segura llamada `cinema_session_id` (24 h).
- También registro la sesión en `data/active_sessions.json` usando `SessionManager::addSession()`.

3. Contar sesiones activas

- En `index.php` llamo a `SessionManager::cleanExpiredSessions()` para limpiar sesiones >24h.
- Luego muestro `count($active_sessions)` como número de sesiones activas.
- Como las sesiones se guardan en JSON, si me conecto desde Chrome y Brave se crean dos sesiones distintas y las cuento correctamente.

4. Selección de butaca

- Desde `index.php` elijo una película y voy a `src/seats.php?movie=ID`.
- Veo una cuadrícula 10x10. Las butacas ocupadas se marcan y no son seleccionables.
- Al seleccionar una butaca se envía el formulario a `src/extras.php`.

5. Extras y resumen

- En `src/extras.php` elijo palomitas y/o bebida. La selección se guarda temporalmente en `$_SESSION['temp_selection']` con un timestamp.
- `src/summary.php` muestra el resumen con precios (entrada 8€, palomitas 5€, bebida 3€) y tiempo restante de la reserva (10 min).

6. Confirmación (pago simulado)

- Al pulsar "Pagar ahora" se manda a `src/confirm.php` que marca la butaca como ocupada en `$_SESSION['seats']` y aumenta el contador de reservas `$_SESSION['total_reservations']`.

Detalles técnicos y decisiones

- Cookies

  - Uso una cookie `cinema_session_id` por navegador para identificar sesiones distintas desde distintos navegadores.
  - La cookie se crea con flags `secure`, `httponly` y `samesite=Strict`.

- Almacenamiento de sesiones activas

  - Uso `data/active_sessions.json` para tener persistencia entre reinicios de PHP.
  - `SessionManager` se encarga de leer, escribir, limpiar y validar sesiones.

- Seguridad y simplicidad
  - No usé base de datos para mantener el proyecto simple para clase.
  - Para producción usaría HTTPS obligatorio, hashing de contraseñas y una base de datos.

Cómo probarlo localmente

1. Asegúrate de tener PHP y un servidor local (XAMPP está listo según mi entorno).
2. Coloca todo en `htdocs` o el directorio público de tu servidor.
3. Abre `http://localhost/<ruta>/index.php`.
4. Inicia sesión con `usuario/usuario` en un navegador y `alumno/alumno` en otro. Deberías ver 2 sesiones activas.
