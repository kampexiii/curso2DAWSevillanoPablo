/**
 * Scripts para mi sistema de gestión de alumnos
 * Lo separé aquí para no liar el código PHP con JavaScript
 * Aquí tengo las funciones para el modo oscuro, ejecutar operaciones y los prompts
 */

/**
 * Función para cambiar entre modo claro y oscuro
 * La guardo en localStorage para que se acuerde cuando vuelva
 */
function toggleMode() {
    document.body.classList.toggle('dark-mode');
    // Guardo la preferencia - así no se me olvida
    localStorage.setItem('modoOscuro', document.body.classList.contains('dark-mode'));
}

/**
 * Función para cambiar conexión - la uso desde los botones del header
 * @param {string} estado - 'on' o 'off'
 */
function cambiarConexion(estado) {
    console.log('Cambiando conexión a:', estado); // Para debuggear si hace falta
    window.location.href = '?conexion=' + estado; // Cambio la URL
}

/**
 * Cuando carga la página, veo si tenía modo oscuro guardado
 * Si lo tenía, lo activo automáticamente
 */
window.onload = function() {
    if (localStorage.getItem('modoOscuro') === 'true') {
        document.body.classList.add('dark-mode');
    }
};

/**
 * Función para ejecutar operaciones PHP - la uso para los botones CRUD
 * @param {string} archivo - El archivo PHP que quiero ejecutar (crear_alumno.php, etc.)
 * @param {string} metodo - GET o POST, normalmente GET para estas operaciones simples
 * @param {object} datos - Los datos que envío si es POST
 */
function ejecutarOperacion(archivo, metodo = 'GET', datos = null) {
    // Uso un iframe oculto para ejecutar las operaciones sin recargar la página
    const frame = document.getElementById('operacionFrame');
    if (metodo === 'POST' && datos) {
        // Si es POST, creo un formulario oculto con los datos
        const form = document.createElement('form');
        form.action = archivo;
        form.method = 'POST';
        form.target = 'operacionFrame'; // El resultado va al iframe

        // Añado los campos del formulario con los datos
        for (const key in datos) {
            if (datos.hasOwnProperty(key)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = datos[key];
                form.appendChild(input);
            }
        }

        // Lo añado al body, lo envío y lo borro
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    } else {
        // Para GET es más simple, solo cambio el src del iframe
        frame.src = archivo;
    }

    // Después de ejecutar, recargo la página para ver los cambios
    // Espero 500ms para que la operación se complete
    setTimeout(function() {
        location.reload();
    }, 500);
}

/**
 * Prompt para borrar alumno - pide el ID y ejecuta
 * Validación básica para que no me metan cualquier cosa
 */
function borrarAlumnoPrompt() {
    const id = prompt('Introduce el ID del alumno a borrar:');
    if (id && id.trim() !== '') {
        // Valido que sea un número positivo
        if (isNaN(id) || id <= 0) {
            alert('Por favor, introduce un ID válido (número positivo).');
            return;
        }
        // Ejecuto la operación con el ID
        ejecutarOperacion('borrar_alumno.php', 'POST', { id: id.trim() });
    }
}

/**
 * Prompt para editar alumno - pide todos los datos
 * Es un poco largo pero así controlo todo desde aquí
 */
function editarAlumnoPrompt() {
    const id = prompt('ID del alumno a editar:');
    if (!id || id.trim() === '') return;

    // Valido el ID primero
    if (isNaN(id) || id <= 0) {
        alert('Por favor, introduce un ID válido.');
        return;
    }

    // Pido todos los datos uno por uno
    const nombre = prompt('Nuevo nombre:');
    const apellidos = prompt('Nuevos apellidos:');
    const email = prompt('Nuevo email:');
    const edad = prompt('Nueva edad:');
    const nota = prompt('Nueva nota:');
    const activo = prompt('Activo (1=Sí, 0=No):');

    // Valido que tenga lo básico
    if (!nombre || !apellidos || !email) {
        alert('Nombre, apellidos y email son obligatorios.');
        return;
    }

    // Ejecuto con todos los datos
    ejecutarOperacion('editar_alumno.php', 'POST', {
        id: id.trim(),
        nombre: nombre.trim(),
        apellidos: apellidos.trim(),
        email: email.trim(),
        edad: edad.trim(),
        nota: nota.trim(),
        activo: activo.trim()
    });
}

/**
 * Prompt para crear alumno nuevo
 * Similar al editar pero sin ID
 */
function crearAlumnoPrompt() {
    const nombre = prompt('Nombre:');
    const apellidos = prompt('Apellidos:');
    const email = prompt('Email:');
    const edad = prompt('Edad:');
    const nota = prompt('Nota:');
    const activo = prompt('Activo (1=Sí, 0=No):', '1'); // Por defecto activo

    // Valido lo obligatorio
    if (!nombre || !apellidos || !email) {
        alert('Nombre, apellidos y email son obligatorios.');
        return;
    }

    // Ejecuto la creación
    ejecutarOperacion('crear_alumno.php', 'POST', {
        nombre: nombre.trim(),
        apellidos: apellidos.trim(),
        email: email.trim(),
        edad: edad.trim(),
        nota: nota.trim(),
        activo: activo.trim()
    });
}