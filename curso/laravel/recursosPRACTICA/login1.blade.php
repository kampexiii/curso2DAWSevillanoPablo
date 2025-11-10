@extends('layout1')

@section('registro')
    <span>Bienvenida</span>
@endsection

@section('contenido')
    <h1>Autenticación de Usuario</h1>
    <p class="lead">
        Introduce tus credenciales para acceder a la aplicación.
    </p>

    <form action="" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre de usuario:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="btn-row">
            <button type="submit" class="btn-primary">Entrar</button>
            <a href="{{ route('inicio') }}" class="btn-ghost">Volver al inicio</a>
        </div>
    </form>
@endsection
