@extends('layouts.app')

@section('title', $product['name'] . ' | Café Aurora')
@section('meta_description', $product['description'])

@section('content')
    {{-- Contenido visual de la ficha de producto --}}
    <div class="container" style="margin-top: 3rem;">
        <section class="product-hero">
            <div class="product-hero-inner">
                <div class="product-hero-image">
                    {{-- Imagen del producto --}}
                    <img src="{{ asset($product['image_url']) }}" alt="{{ $product['alt'] ?? $product['name'] }}">
                </div>
                <div class="product-hero-info">
                    {{-- Información del producto --}}
                    <h1>{{ $product['name'] }}</h1>
                    <p class="product-hero-category">{{ $product['category'] }}</p>
                    {{-- En la exposición: esta descripción me sirve para hablar de contenido claro para SGE y Zero-Click --}}
                    <p class="product-hero-description">{{ $product['description'] }}</p>
                    <p class="product-hero-price">{{ number_format($product['price'], 2, ',', '.') }}€</p>

                    <div style="margin-top: 2rem;">
                        <a href="{{ route('products.index') }}" class="btn-secondary">← Volver a la carta</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('jsonld')
    {{-- En la exposición: uso este JSON-LD de Product para hablar de rich snippets de precio, nombre e imagen en los resultados de búsqueda --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product['name'],
            'description' => $product['description'],
            'image' => asset($product['image_url']),
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'EUR',
                'price' => $product['price'],
                'availability' => 'https://schema.org/InStock',
            ],
            'brand' => [
                '@type' => 'Brand',
                'name' => 'Café Aurora',
            ],
        ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) !!}
    </script>
@endpush
