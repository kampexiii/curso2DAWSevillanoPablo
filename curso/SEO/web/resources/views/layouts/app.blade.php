<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- En la exposición: aquí enseño cómo controlo los títulos, descripciones y canonical de forma manual en Laravel, igual que explico en el bloque de CMS --}}
    {{-- SEO Dinámico --}}
    <title>@yield('title', 'Café Aurora | Café de Especialidad')</title>
    <meta name="description" content="@yield('meta_description', 'El mejor café de especialidad tostado artesanalmente.')">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Estilos --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- JSON-LD --}}
    @stack('jsonld')
</head>
<body>

    <header>
        <nav>
            <a href="{{ route('home') }}" class="logo">☕ Café Aurora</a>
            <ul>
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('products.index') }}">Tienda</a></li>
                <li><a href="{{ route('contact') }}">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container" style="text-align: center;">
            <div style="margin-bottom: 1.5rem;">
                <h4 style="margin-bottom: 0.5rem; color: var(--color-primary);">📍 Café Aurora</h4>
                <p>Calle Real, 24 - 28400 Collado Villalba, Madrid</p>
                <p>🕒 Abierto todos los días: 07:00 - 21:00</p>
            </div>
            <hr style="border: 0; border-top: 1px solid #ddd; margin: 1rem auto; max-width: 200px;">
            <p>&copy; {{ date('Y') }} Café Aurora. Tu pastelería artesana.</p>
        </div>
    </footer>

</body>
</html>
