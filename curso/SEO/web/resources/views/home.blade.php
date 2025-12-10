@extends('layouts.app')

@section('title', 'Café Aurora | Tu Pastelería en Collado Villalba')
@section('meta_description', 'Churros artesanos, el mejor café y pastelería casera en el corazón de la Sierra de Madrid. Ven a desayunar con nosotros.')

@section('content')
    {{-- En la exposición: aquí explico qué es el SEO hoy y por qué el mensaje es natural, sin repetir keywords --}}
    {{-- Hero Section Moderno --}}
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-text">
                <p class="hero-badge">Cafetería de barrio en Collado Villalba</p>
                <h1>Café Aurora</h1>
                <p class="hero-subtitle">
                    El sabor de siempre con churros, porras y bollería recién horneada cada mañana.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('products.index') }}" class="btn-primary">Ver nuestra carta</a>
                    <a href="{{ route('contact') }}" class="btn-secondary">Cómo llegar</a>
                </div>
            </div>
            <div class="hero-image">
                {{-- Imagen realista de placeholder --}}
                <img src="{{ asset('images/cafe-aurora/hero-cafe-aurora.jpg') }}" alt="Ambiente acogedor de Café Aurora en Collado Villalba" loading="lazy">
            </div>
        </div>
    </section>

    {{-- Info Section --}}
    <div class="container" style="margin-top: 4rem; text-align: center;">
        {{-- En la exposición: aquí conecto con E-E-A-T y explico que muestro experiencia real del negocio --}}
            Llevamos más de 20 años despertando a Villalba con el olor a café recién hecho y pan tostado.
            Somos un negocio familiar donde la calidad y el trato cercano son lo primero.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <div style="padding: 2rem; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🥐</div>
                <h3>Obrador Propio</h3>
                <p>Nuestros croissants y napolitanas se hornean aquí mismo, sin congelados.</p>
            </div>
            <div style="padding: 2rem; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">☕</div>
                <h3>Café 100% Arábica</h3>
                <p>Seleccionamos el mejor grano y lo molemos al instante para tu taza.</p>
            </div>
            <div style="padding: 2rem; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🏔️</div>
                <h3>En la Sierra</h3>
                <p>El mejor ambiente para relajarte en el centro de Collado Villalba.</p>
            </div>
        </div>
    </div>
@endsection

@push('jsonld')
@php
$schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'Bakery',
    'name'     => 'Café Aurora',
    'image'    => 'https://placehold.co/1200x630?text=Cafe+Aurora+Villalba',
    'address'  => [
        '@type'            => 'PostalAddress',
        'streetAddress'    => 'Calle Real 24',
        'addressLocality'  => 'Collado Villalba',
        'addressRegion'    => 'Madrid',
        'postalCode'       => '28400',
        'addressCountry'   => 'ES',
    ],
    'priceRange' => '$',
    'servesCuisine' => 'Spanish',
    'openingHours' => 'Mo-Su 07:00-21:00'
];
@endphp
{{-- En la exposición: aquí muestro el JSON-LD de LocalBusiness/Bakery para explicar qué son los datos estructurados y cómo ayudan a Google a entender que somos un negocio físico en Villalba --}}
<script type="application/ld+json">
@json($schema)
</script>
@endpush
