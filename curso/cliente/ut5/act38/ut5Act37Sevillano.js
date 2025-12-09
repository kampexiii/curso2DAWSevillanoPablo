//ut5Act37Sevillano.js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formJugador');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Limpiar errores previos
        document.getElementById('errorNombre').textContent = '';
        document.getElementById('errorCorreo').textContent = '';
        document.getElementById('errorElo').textContent = '';
        document.getElementById('mensajeExito').textContent = '';

        // Obtener valores
        const nombre = document.getElementById('nombre').value.trim();
        const correo = document.getElementById('correo').value.trim();
        const elo = document.getElementById('elo').value;

        let valid = true;

        // Validar nombre
        const namePattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ ]{2,30}$/;
        if (!namePattern.test(nombre)) {
            document.getElementById('errorNombre').textContent = 'Nombre inválido. Solo letras y espacios, 2-30 caracteres.';
            valid = false;
        }

        // Validar email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(correo)) {
            document.getElementById('errorCorreo').textContent = 'Email inválido.';
            valid = false;
        }

        // Validar ELO
        const eloNum = parseInt(elo);
        if (isNaN(eloNum) || eloNum < 800 || eloNum > 3000) {
            document.getElementById('errorElo').textContent = 'ELO debe ser un número entre 800 y 3000.';
            valid = false;
        }

        if (valid) {
            document.getElementById('mensajeExito').textContent = 'Jugador registrado exitosamente.';
            // Opcionalmente resetear el formulario
            form.reset();
        }
    });
});