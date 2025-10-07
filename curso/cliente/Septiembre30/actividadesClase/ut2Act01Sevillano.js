// Empieza con los puntos de blancas y negras en 0.
let puntosBlancas = 0;
let puntosNegras = 0;


// Arrays Piezas
const piezasBlancas = ["♙", "♘", "♗", "♖", "♕"];
const piezasNegras  = ["♟", "♞", "♝", "♜", "♛"];

// Array Valores
const valoresPiezas = {
    "♙": 1, "♘": 3, "♗": 3, "♖": 5, "♕": 9,
    "♟": 1, "♞": 3, "♝": 3, "♜": 5, "♛": 9
};



// Usa asignación y aritmética para sumar los puntos cuando se captura una pieza.
function piezaCapturada(pieza) {
    const valor = valoresPiezas[pieza] || 0;

    // Si es pieza negra → suma puntos a blancas
    if (piezasNegras.includes(pieza)) {
        puntosBlancas += valor;
    }
    // Si es pieza blanca → suma puntos a negras
    else if (piezasBlancas.includes(pieza)) {
        puntosNegras += valor;
    }
}



//Usa comparación para decidir quién va ganando.

function mostrarQuienVaGanando(puntosBlancas, puntosNegras){
    return puntosBlancas >= puntosNegras
        ? `Van ganando blancas con ${puntosBlancas}`
        : `Van ganando negras con ${puntosNegras}`;
}



//Muestra el resultado por consola.

function mostrarMarcador() {
    console.log(`Puntos Blancas: ${puntosBlancas} | Puntos Negras: ${puntosNegras}`);
}


//Añadir un contador de jugadas con += 1 y usar % para saber de quién es el turno.

let turno = 0; // contador de turnos

function sumaTurno(){
    turno++;
    return turno;
}

function turnoActual(movimiento){
    return movimiento % 2 === 0 ? "blancas" : "negras";
}


//Implementar una función capturar(pieza, color) que sume automáticamente los puntos según el valor de la pieza capturada.

function capturar(pieza, color) {
    const valor = valoresPiezas[pieza] || 0;

    if (color === "negras" && piezasNegras.includes(pieza)) {
        // Si capturan una pieza negra → suman blancas
        puntosBlancas += valor;
    }
    else if (color === "blancas" && piezasBlancas.includes(pieza)) {
        // Si capturan una pieza blanca → suman negras
        puntosNegras += valor;
    }
}


//Usar === para comprobar si alguien ha llegado a 10 puntos exactos y mostrar un mensaje especial.

function felicitacion10Puntos(puntosBlancas, puntosNegras) {
    if (puntosBlancas === 10) {
        return "🎉 FELICIDADES: Blancas han llegado a 10 puntos exactos 🎉";
    }
    else if (puntosNegras === 10) {
        return "🎉 FELICIDADES: Negras han llegado a 10 puntos exactos 🎉";
    }
    else {
        return ""; // Ninguno alcanzo los 10 puntos
    }
}



// Reset
puntosBlancas = 0; puntosNegras = 0;

// ===== PRUEBAS (ordenadas igual que las funciones) =====

// 1) piezaCapturada
piezaCapturada("♟"); // Blancas +1
piezaCapturada("♘"); // Negras +3
piezaCapturada("♛"); // Blancas +9
mostrarMarcador();   // Espero: Blancas 10 | Negras 3

// 2) mostrarQuienVaGanando
console.log(mostrarQuienVaGanando(puntosBlancas, puntosNegras)); // "Van ganando blancas con 10"

// 3) mostrarMarcador
mostrarMarcador();

// 4) sumaTurno y turnoActual
turno = 0;
console.log(sumaTurno(), turnoActual(1)); // 1, "negras"
console.log(sumaTurno(), turnoActual(2)); // 2, "blancas"

// 5) capturar
puntosBlancas = 0; puntosNegras = 0;
capturar("♟", "negras");   // Blancas +1
capturar("♘", "blancas");  // Negras +3
capturar("♛", "negras");   // Blancas +9
mostrarMarcador();         // Espero: Blancas 10 | Negras 3

// 6) felicitacion10Puntos
console.log(felicitacion10Puntos(puntosBlancas, puntosNegras));  // Felicitación para Blancas

// 7) pieza inválida
const pb = puntosBlancas, pn = puntosNegras;
piezaCapturada("X");
console.log(pb === puntosBlancas && pn === puntosNegras); // true



// Subir archivo ut2Act01Apellido.js
