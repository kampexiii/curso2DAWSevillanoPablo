<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| RUTAS WEB (Tienda de Café)
|--------------------------------------------------------------------------
*/

// 1. PORTADA
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. TIENDA (Catálogo y Detalle)
Route::get('/tienda', [ProductController::class, 'index'])->name('products.index');
Route::get('/producto/{slug}', [ProductController::class, 'show'])->name('products.show');

// 3. CONTACTO
Route::get('/contacto', [ContactController::class, 'index'])->name('contact');

// 4. SITEMAP XML
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
