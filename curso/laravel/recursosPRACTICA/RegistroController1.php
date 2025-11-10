<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroController
{
    /**
     * Muestra la página de inicio cuando se accede por primera vez (GET /)
     */
    public function inicio()
    {
               
            return view('inicio' );
           
        }

        

     public function registro()
    {
        return view('registro');
    }

    public function login()
    {
        return view('login');
    }
}