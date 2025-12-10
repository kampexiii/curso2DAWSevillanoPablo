<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        // En la exposición: enseño este sitemap.xml en el navegador para explicar que aquí listamos las URLs principales y ayudamos a Google a rastrear toda la web
        // Necesitamos los productos para generar las URLs dinámicas en el sitemap
        $products = [
            ['slug' => 'cafe-etiopia-yirgacheffe'],
            ['slug' => 'cafe-colombia-huila'],
            ['slug' => 'cafe-sumatra-mandheling'],
            ['slug' => 'pack-degustacion'],
        ];

        return response()->view('sitemap', ['products' => $products])
            ->header('Content-Type', 'text/xml');
    }
}
