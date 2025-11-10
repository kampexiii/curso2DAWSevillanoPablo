
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unidad: Layout y Registro</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="page">
        <header>
            <div class="container header-flex">
                <div class="brand">MiAplicación - Unidad: Layout y Registro</div>
                <nav>
                    @yield('registro')
                </nav>
            </div>
        </header>

        <main>
            <div class="container">
                <div class="card">
                    @yield('contenido')
                </div>
            </div>
        </main>

        <footer>
            Unidad didáctica: diseño de layout con CSS — Cabecera / Cuerpo / Footer
        </footer>
    </div>
</body>
</html>
