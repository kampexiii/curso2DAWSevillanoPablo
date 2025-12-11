// ============================================================
// Actividad 39 – Pruebas de aplicaciones (UT6 Cliente)
// Autor: Pablo Sevillano Aparicio
// Descripción: Validación del formulario de torneo de ajedrez
//              y exportación de las funciones para poder
//              probarlas con Jest.
// ============================================================

// ===============================
// 1. Expresiones regulares
// ===============================

// Con este patrón valido nombres con letras, acentos y espacios, mínimo 3 caracteres.
const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,}$/;

// Con este patrón valido emails básicos: texto@texto.dominio
const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// ===============================
// 2. Funciones de validación puras (NO usan DOM)
// ===============================

// Con esta función valido los dos nombres: formato correcto y que no sean iguales.
function validarNombres(blancas, negras) {
    if (!regexNombre.test(blancas.trim())) return false;
    if (!regexNombre.test(negras.trim())) return false;
    if (blancas.trim() === negras.trim()) return false;
    return true;
}

// Aquí compruebo que el color seleccionado solo puede ser "blancas" o "negras".
function validarColor(color) {
    return color === "blancas" || color === "negras";
}

// Esta función valida que se haya elegido algún resultado en el select.
function validarResultado(resultado) {
    return resultado !== "";
}

// Con esta función valido el email usando la expresión regular definida arriba.
function validarEmail(email) {
    return regexEmail.test(email.trim());
}

// Aquí valido que la fecha no esté vacía y que no sea futura.
function validarFecha(fecha) {
    if (!fecha) return false;
    const hoy = new Date().setHours(0, 0, 0, 0);
    const fechaValor = new Date(fecha).setHours(0, 0, 0, 0);
    return fechaValor <= hoy;
}

// Con esta función controlo que el comentario no pase de 200 caracteres.
function validarComentario(comentario) {
    return comentario.length <= 200;
}

// Valida todos los campos de golpe a partir de un objeto de datos.
function validarFormulario(data) {
    return (
        validarNombres(data.jBlancas, data.jNegras) &&
        validarColor(data.color) &&
        validarResultado(data.resultado) &&
        validarEmail(data.email) &&
        validarFecha(data.fecha) &&
        validarComentario(data.comentario)
    );
}

// ===============================
// 3. CÓDIGO DEL DOM (solo si existe document)
// ===============================

// Aquí engancho toda la lógica al DOM solo cuando estoy en un navegador.
if (typeof document !== "undefined") {
    document.addEventListener("DOMContentLoaded", () => {

        const form = document.getElementById("formTorneo");

        // Campos del formulario
        const jugadorBlancas = document.getElementById("jugadorBlancas");
        const jugadorNegras = document.getElementById("jugadorNegras");
        const colorRadios = document.getElementsByName("color");
        const resultado = document.getElementById("resultado");
        const email = document.getElementById("email");
        const fecha = document.getElementById("fecha");
        const comentario = document.getElementById("comentario");

        // Elementos para mensajes de error (por si quiero usarlos más adelante)
        const errBlancas = document.getElementById("errBlancas");
        const errNegras = document.getElementById("errNegras");
        const errColor = document.getElementById("errColor");
        const errResultado = document.getElementById("errResultado");
        const errEmail = document.getElementById("errEmail");
        const errFecha = document.getElementById("errFecha");
        const errComentario = document.getElementById("errComentario");
        const mensajeFinal = document.getElementById("mensajeFinal");

        // Con esta función obtengo el color seleccionado en los radios.
        function getColor() {
            for (let r of colorRadios) if (r.checked) return r.value;
            return "";
        }

        // Esta función se encarga de guardar la partida en localStorage.
        function guardarPartida() {
            const partidas = JSON.parse(localStorage.getItem("partidas")) || [];
            partidas.push({
                jugadorBlancas: jugadorBlancas.value.trim(),
                jugadorNegras: jugadorNegras.value.trim(),
                color: getColor(),
                resultado: resultado.value,
                email: email.value.trim(),
                fecha: fecha.value,
                comentario: comentario.value.trim()
            });
            localStorage.setItem("partidas", JSON.stringify(partidas));
        }

        // Aquí gestiono el envío del formulario.
        form.addEventListener("submit", (e) => {
            e.preventDefault(); // No dejo que el navegador envíe el formulario directamente.

            const data = {
                jBlancas: jugadorBlancas.value,
                jNegras: jugadorNegras.value,
                color: getColor(),
                resultado: resultado.value,
                email: email.value,
                fecha: fecha.value,
                comentario: comentario.value
            };

            if (validarFormulario(data)) {
                guardarPartida();
                form.reset();
                mensajeFinal.textContent = "Partida registrada correctamente ✅";
            } else {
                mensajeFinal.textContent = "Hay errores en el formulario ❌";
            }
        });
    });
}

// ===============================
// 4. Exportación para pruebas (Jest)
// ===============================

// Aquí exporto las funciones para poder probarlas con Jest en Node.
if (typeof module !== "undefined") {
    module.exports = {
        regexNombre,
        regexEmail,
        validarNombres,
        validarColor,
        validarResultado,
        validarEmail,
        validarFecha,
        validarComentario,
        validarFormulario
    };
}
