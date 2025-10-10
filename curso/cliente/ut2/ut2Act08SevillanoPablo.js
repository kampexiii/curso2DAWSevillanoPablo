// 1. Contar alfiles en el tablero con un for
const tablero = ["♖", "♘", "♗", "♕", "♗", "♘", "♖", "♔"];
/***INTRODUCE CÓDIGO AQUÍ***/
console.log(" ");
console.log("------------------------------------------------------------------ ");
console.log("Ejercicio 1");
let contadorAlfiles = 0;
for (i = 0; i < tablero.length; i++) {
    if (tablero[i] === "♗") {
        contadorAlfiles++;
        console.log("Hemos encontrado un alfil, seguimos buscando")
    }
}





console.log(`Número de alfiles: ${contadorAlfiles}`);
console.log(" ");


// 2. Simular avance de un peón con while
/***INTRODUCE CÓDIGO AQUÍ***/ // el peón empieza en segunda fila
console.log(" ");
console.log("------------------------------------------------------------------ ");
console.log("Ejercicio 2");

//suponemos que el peon esta en la columna A:
let filaPeonA = 2
console.log("El peon comienza en la posicion " + "A" + filaPeonA)
while (filaPeonA < 8) {
    if (filaPeonA == 2) {
        filaPeonA += 2;
        console.log("El peon avanzo a la posicion " + "A" + filaPeonA)
    } else {
        filaPeonA++;
        console.log("El peon avanzo a la posicion " + "A" + filaPeonA)
    }

};



console.log("¡El peón ha llegado a la octava fila y puede coronar!");
console.log(" ");


// 3. Comprobar si el rey está en jaque con do...while
let reyJaque = false;
const COLORES = ["blancas", "negras"];
let turno = 0;

console.log(" ");
console.log("------------------------------------------------------------------ ");
console.log("Ejercicio 3");

do {
    turno++;

    if (turno % 2 == 0) {
        console.log("Turno Negras");
    } else {
        console.log("Turno Blancas");
    }

    // Simulación: el rey está en jaque a partir del turno 5
    if (turno >= 5) {
        reyJaque = true;
    }

} while (!reyJaque);










console.log("El rey está en jaque");
console.log(" ");

// 4. Usar continue para saltar el enroque(investigar sin IA) 
const movimientos = ["e4", "d4", "O-O", "c5"];

console.log(" ");
console.log("------------------------------------------------------------------ ");
console.log("Ejercicio 4");
for (const movimiento of movimientos) {
    if (movimiento === "O-O") {
        continue;
    }
    console.log("movimiento: " + movimiento);

}




console.log(" ");

// 5. Usar break para detenerse al encontrar la dama(investigar sin IA)
const piezas = ["♙", "♘", "♗", "♕", "♖"];
console.log(" ");
console.log("------------------------------------------------------------------ ");
console.log("Ejercicio 5");
for (const pieza of piezas) {
    if (pieza === "♕") {
        console.log("Dama encontrada");
        break;
    }
    console.log("Dama no encontrada, pieza actual es: " + pieza + " , seguimos avanzando")

}

console.log("------------------------------------------------------------------ ");
console.log(" ");




