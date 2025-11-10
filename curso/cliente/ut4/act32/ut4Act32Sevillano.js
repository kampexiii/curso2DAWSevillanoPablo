/*
Objetivo:
Construir la base de un motor que permita realizar jugadas y registrarlas.
Requisitos:
Crea un modulo movimientos.js con una funcion moverPieza(origen, destino).
Crea otro modulo historial.js que exporte una funcion registrarJugada(jugada).
En juego.js, importa ambos y combina su uso:
Llama a moverPieza() y registra la jugada.
Muestra el historial final en consola.
Añade una funcion en historial.js:
mostrarHistorial(): muestra todas las jugadas con su numero (1. e4, 2. e5, etc.).
Utiliza funciones flecha y un closure para mantener el historial privado.
*/

// Modulo movimientos.js
const moverPieza = (origen, destino) => {
    return "Movimiento de " + origen + " a " + destino;
};

// Modulo historial.js
const historial = (() => {
    const jugadas = [];
    return {
        registrarJugada: (jugada) => {
            jugadas.push(jugada);
        },
        mostrarHistorial: () => {
            console.log("\nHistorial de jugadas:");
            jugadas.forEach((jugada, index) => {
                console.log((index + 1) + ". " + jugada);
            });
        }
    };
})();

// Modulo juego.js
const jugar = (origen, destino) => {
    const movimiento = moverPieza(origen, destino);
    historial.registrarJugada(movimiento);
    console.log(movimiento);
};

// Ejecutar partida
console.log("Iniciando partida:");
jugar("e2", "e4");
jugar("e7", "e5");
jugar("g1", "f3");
jugar("b8", "c6");
jugar("f1", "c4");

historial.mostrarHistorial();
