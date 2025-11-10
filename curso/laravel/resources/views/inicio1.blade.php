@extends('layout')

@section('registro')
    <a href="{{ route('registro') }}">Usuario nuevo</a>
    <a href="{{ route('login') }}">Autentificarse</a>
@endsection

@section('contenido')

        <h1>Bienvenido a la Aplicación de Registro</h1>
        <p class="lead">
            Esta aplicación forma parte de una unidad didáctica donde aprenderás a diseñar un layout completo
            en Laravel utilizando el patrón MVC. Aquí podrás registrarte como nuevo usuario o autenticarte
            si ya tienes una cuenta. Todo el diseño se gestiona mediante CSS externo y las vistas se
            integran dinámicamente con el sistema de plantillas de Laravel.
        </p>

@endsection
