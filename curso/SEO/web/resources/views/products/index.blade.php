@extends('layouts.app')

@section('title', 'Nuestra Carta | Café Aurora')
@section('meta_description', 'Descubre nuestros desayunos, meriendas y café de especialidad en Collado Villalba. Churros, porras y bollería artesana.')

@section('content')
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 3rem; color: var(--color-primary);">Nuestra Carta y Productos</h1>

        {{-- En la exposición: aquí explico intención transaccional, porque el usuario viene a comparar productos y precios --}}
        {{-- En la exposición: cuando cambio a vista móvil en DevTools, uso esta sección para hablar de Mobile-First y Core Web Vitals --}}
        <div class="product-grid">
            @foreach($products as $product)
                <article class="product-card">
                    {{-- Imagen del producto en el listado --}}
                    <img src="{{ asset($product['image_url']) }}" alt="{{ $product['alt'] ?? $product['name'] }}" class="product-card-image" loading="lazy">
                    <div class="product-card-body">
                        <p class="product-category">{{ strtoupper($product['category']) }}</p>
                        <h3 class="product-name">{{ $product['name'] }}</h3>
                        <p class="product-price">{{ number_format($product['price'], 2, ',', '.') }}€</p>
                        <a href="{{ route('products.show', $product['slug']) }}" class="btn-link">Ver</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
