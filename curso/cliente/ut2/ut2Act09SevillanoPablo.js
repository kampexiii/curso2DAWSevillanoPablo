/***Crear un archivo con el nombre: ut2Act09Apellido.js
Entrega el archivo en la plataforma antes de que acabe el tiempo de la tarea.
FASE 1:
Crea una función llamada calcularValorPiezas(tablero) que reciba un array de piezas (por ejemplo ["♕", "♖", "♙", "♘"]) 
y devuelva el valor total del conjunto de piezas según la siguiente tabla:

Pieza
Valor
 
La función debe:
 	
Usar un for...of para recorrer el array.
Acumular los puntos totales.
Retornar el resultado final.
Usar un valor por defecto ([]) para el parámetro, 
por si no se pasa ningún tablero.


♕ Dama	9	
♖ Torre	5	
♗ Alfil	3	 	
♘ Caballo	3	 	
♙ Peón	1	 	
♔ Rey	500	 	

***/



const VALORES = {
    "♕": 9,  // dama
    "♖": 5,  // torre
    "♗": 3,  // alfil		
    "♘": 3,  // caballo
    "♙": 1,  // peón
    "♔": 500 // rey
};

function calcularValorPiezas(tablero = []) {
    let sumaValorPiezas = 0;
    for (const pieza of tablero) {
        sumaValorPiezas += VALORES[pieza] || 0;
    }
    return sumaValorPiezas;
}


const piezas = ["♕", "♖", "♙", "♘"];
console.log(calcularValorPiezas(piezas));  // Salida: 9 + 5 + 1 + 3 = 18



/*** FASE 2:
Crea otra función llamada compararJugadores(jugadorA, jugadorB) que reciba dos arrays (uno por jugador) y compare quién tiene más puntos usando la función anterior.
Devuelve el siguiente mensaje: "El Jugador A tiene ventaja con X puntos frente a Y." ***/


const jugadorA = ["♕", "♖", "♗", "♘", "♘", "♙", "♙", "♙", "♙", "♙"];
const jugadorB = ["♖", "♖", "♗", "♗", "♘", "♘", "♙", "♙", "♙", "♙", "♙", "♙", "♙"];

function compararJugadores(jugadorA = [], jugadorB = []) {
    const sumaPiezasJugadorA = calcularValorPiezas(jugadorA);
    const sumaPiezasJugadorB = calcularValorPiezas(jugadorB);

    if (sumaPiezasJugadorA > sumaPiezasJugadorB) {
        return console.log("El Jugador A tiene ventaja de " + sumaPiezasJugadorA + " puntos frente a " + sumaPiezasJugadorB + " del Jugador B.")
    } if (sumaPiezasJugadorB > sumaPiezasJugadorA) {
        return console.log("El Jugador B tiene ventaja de " + sumaPiezasJugadorB + " puntos frente a " + sumaPiezasJugadorA + " del Jugador A.")
    } else {
        return console.log("Tienen el mismo numero de puntos")
    }

}


