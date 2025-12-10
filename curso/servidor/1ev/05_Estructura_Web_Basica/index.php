<?php
// Archivo: Octubre1/index.php
// Este es el archivo principal del proyecto, el que se ejecuta al entrar en la web.
// Aquí decidimos qué idioma se va a cargar y vamos llamando al resto de vistas.


// 1. Detecto el idioma desde la URL con $_GET['lang'].
//    Si no hay valor, por defecto uso "es" (español).
$lang = $_GET['lang'] ?? 'es';

// 2. Según el idioma, incluyo el fichero de constantes/arrays de traducción.
//    Uso __DIR__ para no depender de la carpeta actual, así la ruta siempre es correcta.
switch ($lang) {
    case 'en':
        require_once __DIR__ . '/resources/lang/english.php';
        break;
    case 'es':
    default:
        require_once __DIR__ . '/resources/lang/spain.php';
        break;
}
?>
<!DOCTYPE html>
<!-- 3. En el <html> marco el atributo lang dinámicamente, útil para accesibilidad y SEO -->
<html lang="<?php echo $lang === 'en' ? 'en' : 'es'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla modular PHP</title>

    <!-- 4. Vinculo las hojas de estilo que afectan a toda la web -->
    <link rel="stylesheet" href="resources/css/estilo.css">
    <link rel="stylesheet" href="resources/css/menu.css">
</head>
<body>

    <!-- 5. Cabecera: aquí está el perfil y el menú -->
    <?php require_once __DIR__ . '/resources/views/header.php'; ?>

    <!-- 6. Zona principal de contenido -->
    <main id="content">
        <?php require_once __DIR__ . '/resources/views/contenido.php'; ?>
    </main>

    <!-- 7. Pie de página -->
    <?php require_once __DIR__ . '/resources/views/pie.php'; ?>

</body>
</html>
