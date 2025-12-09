<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Termina la sesión actual

header('Location: login.php?msg=Has cerrado la sesión de manera exitosa.'); // Redirige al login con mensaje
exit;
