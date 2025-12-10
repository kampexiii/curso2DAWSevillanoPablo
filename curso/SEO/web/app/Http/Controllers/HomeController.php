<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Podríamos pasar productos destacados aquí
        return view('home');
    }
}
