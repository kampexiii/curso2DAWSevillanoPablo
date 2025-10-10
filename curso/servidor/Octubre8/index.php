<?php
// index.php — Todo en un solo archivo con ajustes visuales
function asset_url($path) {
    return 'assets/img/' . ltrim($path, '/');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Viaje de Regreso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tipografías -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Manrope:wght@300;400;600;700&family=Marcellus&display=swap" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="resources/css/estilo.css">
    <link rel="stylesheet" href="resources/css/formulario.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="description" content="Viaje de Regreso — espacio sereno para volver a ti. Contacto y consultas.">
</head>
<body class="body-base">

    <!-- HEADER -->
    <header class="py-2 bg-white shadow-sm sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.php" class="logo">
                <img src="<?php echo asset_url('viajedeRegresoLogoSinFondo.webp'); ?>" alt="Logo Viaje de Regreso" style="max-height:50px;">
            </a>
            <nav>
                <ul class="d-flex gap-3 list-unstyled mb-0">
                    <li><a href="#formulario" class="text-decoration-none text-body">Inicio</a></li>
                    <li><a href="#formulario" class="text-decoration-none text-body">Conecta</a></li>
                    <li><a href="#formulario" class="text-decoration-none text-body">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- MAIN / HERO + FORMULARIO -->
    <main>
        <!-- HERO PRINCIPAL -->
        <section class="hero-inicial d-flex align-items-center justify-content-center text-center py-5">
            <div class="container">
                <h1 class="hero-titulo">Respira • Siente • Regresa</h1>
                <p class="hero-subtitulo">Un espacio sereno para volver a ti</p>
                <a href="#formulario" class="btn-primary-shine mt-4">Empezar mi viaje</a>
            </div>
        </section>

        <!-- FORMULARIO DE CONTACTO -->
        <section id="formulario" class="seccion-formulario py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="formulario-wrapper p-4 p-md-5 shadow-sm rounded">
                            <h2 class="seccion-titulo text-center mb-4">Conecta con nosotros</h2>
                            <p class="text-center subtitulo-formulario mb-5">
                                Déjanos tus datos y comienza este viaje consciente. Te responderemos en breve.
                            </p>

                            <!-- FORMULARIO HTML -->
                            <form action="#" method="POST" class="contact-form">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre completo</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pais" class="form-label">País</label>
                                    <input type="text" id="pais" name="pais" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mensaje" class="form-label">Mensaje</label>
                                    <textarea id="mensaje" name="mensaje" rows="4" class="form-control" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn-primary-shine">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer-base py-4 mt-5">
        <div class="container text-center">
            <img src="<?php echo asset_url('viajedeRegresoLogoSinFondo.webp'); ?>" alt="Logo" class="footer-logo mb-3" style="max-height:50px;">
            <p class="footer-text mb-1">© 2025 Viaje de Regreso. Todos los derechos reservados.</p>
            <p class="footer-notice">Diseñado con ❤️ y consciencia.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="resources/js/main.js" defer></script>
</body>
</html>
