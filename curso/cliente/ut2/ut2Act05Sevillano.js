// Queremos crear un programa que muestre cómo se mueve una pieza de ajedrez según el símbolo que elija el jugador:
// ♕ → Dama
// ♖ → Torre
// ♔ o ♚ → Rey (blanco o negro)




// Pasos a realizar:
    // Usar un switch para mostrar un mensaje con el movimiento de la pieza.
    // Agrupar casos (♔ y ♚) para que tengan el mismo comportamiento.
    // Usar default para manejar un símbolo que no corresponda a ninguna pieza.


// --- Configuración inicial ---
let pieza = '♞'; // cambia aquí para probar otras piezas

// --- Función principal ---
function mostrarMovimiento(pieza) {
    let tipoPieza = '';

    switch (pieza) {
        // opcional, Piezas mayores
        case '♕': // Dama blanca
        case '♛': // opcional: dama negra agrupada aquí
            console.log('La Dama se mueve en todas direcciones y todas las casillas que quiera.');
            tipoPieza = 'mayor';
            break;

        case '♖': // Torre blanca
        case '♜': // opcional: torre negra agrupada aquí
            console.log('La Torre va en línea recta, vertical u horizontal.');
            tipoPieza = 'mayor';
            break;

        case '♔': // Rey blanco
        case '♚': // Rey negro agrupado aquí
            console.log('El Rey se mueve una casilla en cualquier dirección.');
            tipoPieza = 'mayor';
            break;

        // opcional, Piezas menores
        case '♗': // Alfil blanco
        case '♝': // Alfil negro agrupado
            console.log('El Alfil se mueve solo en diagonal.');
            tipoPieza = 'menor';
            break;

        case '♘': // Caballo blanco
        case '♞': // Caballo negro agrupado
            console.log('El Caballo se mueve en L y puede saltar piezas.');
            tipoPieza = 'menor';
            break;

        case '♙': // Peón blanco
        case '♟': // Peón negro agrupado
            console.log('El Peón avanza una casilla (dos al principio) y captura en diagonal.');
            tipoPieza = 'menor';
            break;

        default:
            console.log('Símbolo no reconocido. Elige una pieza válida.');
            return;
    }

    // opcional, mensaje para indicar si es mayor o menor
    if (tipoPieza === 'mayor') {
        console.log('➡ Esta pieza es de las GRANDES.');
    } else if (tipoPieza === 'menor') {
        console.log('➡ Esta pieza es de las PEQUEÑAS.');
    }
}

// --- Ejecución ---
mostrarMovimiento(pieza);




// Retos opcionales (implican investigación)
    // Añadir más piezas (♗, ♘, ♙) con su explicación de movimientos.
    // Agrupar rey blanco (♔) y rey negro (♚) en un mismo case. Lo mismo con el resto de piezas negras.
    // Añadir un mensaje que indique:
        // Si la pieza es mayor (dama, torre, rey).
        // O si es menor (alfil, caballo, peón).
