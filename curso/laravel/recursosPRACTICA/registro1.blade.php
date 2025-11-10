@extends('layout1')

@section('registro')
    <span>Nuevo Usuario</span>
@endsection

@section('contenido')
    <h1>Registro de Nuevo Usuario</h1>
    <p class="lead">
        Solo se permite el registro de personas mayores de edad.
        Por favor, completa los siguientes datos:
    </p>

    <form action="" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div>
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required min="0">
        </div>

        <div class="btn-row">
            <button type="submit" class="btn-primary">Registrarse</button>
            <a href="{{ route('inicio') }}" class="btn-ghost">Volver al inicio</a>
        </div>
    </form>
@endsection