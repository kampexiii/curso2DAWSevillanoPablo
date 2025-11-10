<?php

use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistroController::class, 'inicio'])->name('inicio');
Route::get('/registro', [RegistroController::class, 'registro'])->name('registro');
Route::get('/login', [RegistroController::class, 'login'])->name('login');
