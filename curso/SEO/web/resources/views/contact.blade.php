@extends('layouts.app')

@section('title', 'Contacto | Café Aurora')

@section('content')
    <div class="container" style="max-width: 800px;">
        <h1 style="text-align: center; color: var(--color-primary); margin-bottom: 2rem;">Contacta con Nosotros</h1>

        <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <form action="#" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Nombre</label>
                    <input type="text" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Email</label>
                    <input type="email" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Mensaje</label>
                    <textarea rows="5" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;"></textarea>
                </div>
                <button type="submit" class="btn" style="width: 100%; border: none; cursor: pointer;">Enviar Mensaje</button>
            </form>
        </div>
    </div>
@endsection
