<?php
// index.php - ESTRUCTURA PRINCIPAL Y LLAMADA A MÓDULOS

// Definición de la URL base para assets (ajustada a tu estructura)
function asset_url($path) {
    return 'assets/img/' . $path;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Viaje de Regreso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Manrope:wght@300;400;600;700&family=Marcellus&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="resources/css/estilo.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="body-base">

    <?php require_once __DIR__ . '/resources/views/header.php'; ?>
    
    <?php require_once __DIR__ . '/resources/views/contenido.php'; ?> 
    
    <?php require_once __DIR__ . '/resources/views/pie.php'; ?>

</body>
</html>