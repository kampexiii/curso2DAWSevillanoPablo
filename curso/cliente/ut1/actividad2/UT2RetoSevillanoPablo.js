// Valores de las piezas (en puntos)
const VALORES = {
    "♕": 9, // dama
    "♖": 5, // torre
    "♘": 3, // caballo
    "♙": 1  // peón
};

// Puntos y jugadas
let puntosBlancas = 0;
let puntosNegras  = 0;
let jugadas       = 0;

/**
 * Captura de pieza
 * @param {string} pieza - símbolo de la pieza (♕, ♖, ♘, ♙)
 * @param {string} color - "blancas" o "negras" (quién captura)
 */
function capturar(pieza, color) {
    // Aumentamos jugada
    jugadas++;

    // funcion de sumar puntos al color correcto
    if (color === "blancas") {
        puntosBlancas += VALORES[pieza];
    } else if (color === "negras") {
        puntosNegras += VALORES[pieza];
    }

    console.log(`${color} capturan ${pieza}`);
    mostrarEstado();
}

/**
 * Muestra el estado de la partida
 */
function mostrarEstado() {
    // Mostrar puntos actuales
    console.log(`Blancas: ${puntosBlancas} | Negras: ${puntosNegras}`);

    // Mostrar quién va ganando
    console.log(
        puntosNegras === puntosBlancas
            ? "Empate"
            : (puntosNegras > puntosBlancas
                ? "Va ganando el jugador de Negras"
                : "Va ganando el jugador de Blancas")
    );

    // Comprobar si alguien llega exactamente a 10 puntos
    if (puntosBlancas === 10) {
        console.log("Felicidades Blancas, has obtenido 10 puntos exactamente");
    } else if (puntosNegras === 10) {
        console.log("Felicidades Negras, has obtenido 10 puntos exactamente");
    }

    // Turno según jugadas (par = blancas, impar = negras)
    const turno = (jugadas % 2 === 0) ? "blancas" : "negras";
    console.log("Turno:", turno);
}

// Ejemplo de partida
capturar("♖", "blancas"); // +5
capturar("♘", "negras");  // +3
capturar("♙", "blancas"); // +1
capturar("♕", "negras");  // +9
