<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Base de datos de productos (Cafetería y Pastelería Local)
    private $products = [
        [
            'slug' => 'desayuno-clasico',
            'name' => 'Desayuno Clásico',
            'price' => 3.50,
            'description' => 'Café con leche grande y tostada de pan de pueblo con tomate rallado y aceite de oliva virgen extra.',
            'image_url' => 'images/cafe-aurora/producto-desayuno-clasico.jpg',
            'alt' => 'Desayuno clásico con café con leche y tostada de tomate',
            'category' => 'Desayunos'
        ],
        [
            'slug' => 'chocolate-con-churros',
            'name' => 'Chocolate con Churros',
            'price' => 4.20,
            'description' => 'Taza de chocolate caliente espeso con 4 churros artesanos recién hechos en nuestro obrador.',
            'image_url' => 'images/cafe-aurora/producto-chocolate-churros.jpg',
            'alt' => 'Taza de chocolate caliente con churros artesanos',
            'category' => 'Tradición'
        ],
        [
            'slug' => 'racion-porras',
            'name' => 'Ración de Porras',
            'price' => 1.80,
            'description' => '2 unidades de nuestras famosas porras madrileñas. Crujientes por fuera, tiernas por dentro.',
            'image_url' => 'images/cafe-aurora/producto-porras-artesanas.jpg',
            'alt' => 'Ración de porras madrileñas recién hechas',
            'category' => 'Tradición'
        ],
        [
            'slug' => 'croissant-mantequilla',
            'name' => 'Croissant de Mantequilla',
            'price' => 1.90,
            'description' => 'Hojaldre 100% mantequilla, horneado cada mañana. El acompañante perfecto para tu café.',
            'image_url' => 'images/cafe-aurora/producto-croissant.jpg',
            'alt' => 'Croissant de mantequilla dorado y crujiente',
            'category' => 'Bollería'
        ],
        [
            'slug' => 'napolitana-chocolate',
            'name' => 'Napolitana de Chocolate',
            'price' => 2.10,
            'description' => 'Rellena de abundante crema de cacao y avellanas. Un capricho dulce irresistible.',
            'image_url' => 'images/cafe-aurora/producto-napolitana-chocolate.jpg',
            'alt' => 'Napolitana de chocolate rellena de crema de cacao',
            'category' => 'Bollería'
        ],
        [
            'slug' => 'cafe-especialidad-bolsa',
            'name' => 'Café de la Casa (250g)',
            'price' => 8.50,
            'description' => 'Llévate nuestro blend exclusivo a casa. Notas a chocolate y nueces. Molido al momento.',
            'image_url' => 'images/cafe-aurora/producto-cafe-grano-250g.jpg',
            'alt' => 'Paquete de café en grano Café Aurora 250g',
            'category' => 'Tienda'
        ]
    ];

    public function index()
    {
        return view('products.index', ['products' => $this->products]);
    }

    public function show($slug)
    {
        $product = collect($this->products)->firstWhere('slug', $slug);

        if (!$product) {
            abort(404);
        }

        return view('products.show', ['product' => $product]);
    }
}
