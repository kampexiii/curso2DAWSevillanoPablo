# Apuntes UT3 + UT3.1 (Servidor, PHP)

## 1. PASO DE PARÁMETROS (GET / POST)
GET

Parámetros en la URL: `pagina.php?nombre=Ana&edad=20`

Se leen con `$_GET['nombre']`.

POST

Se usa para formularios.

Se leen con `$_POST['campo']`.

Ejemplo:
```php
<?php echo $_GET['nombre']; ?>
```

Errores típicos:

- Acceder a un índice sin comprobar `isset()`.
- Confundir GET y POST.

## 2. FORMULARIOS EN PHP
Estructura base:
```html
<form action="procesar.php" method="POST">
    <input type="text" name="usuario">
    <input type="password" name="clave">
    <input type="submit">
</form>
```

Recogida:
```php
$usuario = $_POST['usuario'];
```

Validación mínima:
```php
if(empty($_POST['usuario'])) { echo "Falta usuario"; }
```

Procesamiento en un solo fichero (muy típico):
```php
<?php if($_SERVER['REQUEST_METHOD']=="POST") { ... } ?>
```

## 3. COOKIES (UT3 – Tema 3.3)
Crear cookie (antes del HTML):
```php
setcookie("idioma", "es", time()+3600*24);
```

Leer cookie:
```php
echo $_COOKIE["idioma"];
```

Borrar cookie:
```php
setcookie("idioma","",time()-3600);
```

⚠️ Importante: después de crear una cookie NO aparece en `$_COOKIE` hasta la siguiente petición.

Ejemplo típico de examen: contador de visitas
```php
if(!isset($_COOKIE['visitas'])){
    setcookie('visitas','1',time()+86400);
    echo "Bienvenido por primera vez";
} else {
    $v = (int)$_COOKIE['visitas'] + 1;
    setcookie('visitas',$v,time()+86400);
    echo "Visita número: $v";
}
```

## 4. SESIONES (UT3 – Tema 3.4)
Abrir/continuar sesión:
```php
session_start();
```

Crear variable de sesión:
```php
$_SESSION['usuario'] = "Pablo";
```

Comprobar login:
```php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: login.php?redirigido=1");
    exit;
}
```

Cerrar sesión:
```php
session_start();
$_SESSION = [];
session_destroy();
setcookie(session_name(), '', time()-3600);
header("Location: login.php");
```

## 5. LOGIN — El ejemplo exacto del libro (simplificado)
`comprobar_usuario()`
```php
function comprobar_usuario($u,$c){
    if($u=="usuario" && $c=="1234"){
        return ["nombre"=>"usuario","rol"=>0];
    }
    if($u=="admin" && $c=="1234"){
        return ["nombre"=>"admin","rol"=>1];
    }
    return false;
}
```

`login.php` (resumen operativo)

- Formulario POST.
- Mensajes con `?redirigido` y `?error=1`.
- Autorellenar usuario si hay cookie.

`procesar_login.php`
```php
session_start();
$usu = comprobar_usuario($_POST['usuario'],$_POST['clave']);
if($usu==false){
    header("Location: login.php?error=1");
    exit;
}
$_SESSION['usuario'] = $usu['nombre'];
header("Location: privado.php");
```

`privado.php`
```php
session_start();
if(!isset($_SESSION['usuario'])) header("Location: login.php?redirigido=1");
echo "Bienvenido ".$_SESSION['usuario'];
```

## 6. BASES DE DATOS (UT3.1 – mysqli)
Conectar
```php
$conexion = mysqli_connect("localhost","root","","miBD");
if(!$conexion){ die("Error conexión"); }
```

Crear tabla
```php
$sql = "CREATE TABLE ejemplo(id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(50))";
mysqli_query($conexion,$sql);
```

Insertar
```php
$sql = "INSERT INTO ejemplo(nombre) VALUES('Pablo')";
mysqli_query($conexion,$sql);
```

Actualizar
```php
$sql = "UPDATE ejemplo SET nombre='Otro' WHERE id=1";
mysqli_query($conexion,$sql);
```

Borrar
```php
$sql = "DELETE FROM ejemplo WHERE id=1";
mysqli_query($conexion,$sql);
```

SELECT
```php
$result = mysqli_query($conexion,"SELECT * FROM ejemplo");
while($fila = mysqli_fetch_assoc($result)){
    echo $fila["id"]." ".$fila["nombre"];
}
```

## 7. PLANTILLAS RÁPIDAS PARA EXAMEN
Proteger página:
```php
session_start();
if(!isset($_SESSION['usuario'])) exit("Acceso no permitido");
```

Redirección:
```php
header("Location: pagina.php");
exit;
```

Cookie recordar usuario:
```php
if(isset($_POST['recordar'])){
    setcookie("usuarioRecordado",$_POST['usuario'],time()+7*24*3600);
}
```

Procesar formulario seguro:
```php
if($_SERVER["REQUEST_METHOD"]=="POST"){ ... }
```

Cerrar sesión completo:
```php
session_start();
$_SESSION=[];
session_destroy();
setcookie(session_name(),'',time()-3600);
```

## 8. CHECKLIST FINAL DEL EXAMEN

- ¿Usé `session_start()` arriba del todo?
- ¿Usé `setcookie()` ANTES del HTML?
- ¿Usé `isset($_SESSION['x'])` para proteger zonas privadas?
- ¿Hice redirect con `header()` seguido de `exit`?
- ¿En mysqli puse host, user, password y BD correctamente?
- ¿Testeé el CRUD?

## 9. MINI-PROBLEMAS TÍPICOS (con solución rápida)
"Warning: headers already sent"

→ Usaste `echo` antes de `header()` o `setcookie()`.

Cookie no aparece

→ Solo existe en la SIGUIENTE petición.

No entra a `privado.php`

→ Falta `session_start()`.

FIN DEL README
