<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Muestra el formulario de contacto.
     */
    public function index()
    {
        return view('contact');
    }

    // Aquí podría añadir un método 'store' para procesar el envío del formulario
    // y mandar un email real, pero para la demo de SEO visual no es necesario.
}
