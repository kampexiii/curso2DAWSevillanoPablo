//ut2Act10Sevillano.js

const tablero = ["♘", "♗", "♕", "♖", "♔"];

// Auxiliares en arrow para no repetir texto
const lineales = () => ["horizontal sin límite", "vertical sin límite"];
const diagonales = () => ["diagonal sin límite"];

// Función principal: siempre devuelvo un array de strings
function movimientosPosibles(pieza) {
  switch (pieza) {
    case "♔":
      return ["1 casilla en cualquier dirección"];

    case "♕":
      return [...lineales(), ...diagonales()];

    case "♖":
      return [...lineales()];

    case "♗":
      return [...diagonales()];

    case "♘":
      return [
        "cualquier movimiento en 'L' (2+1) que en la posición final esté libre y no ocupada por una pieza del mismo color"
      ];

    case "♙":
      return [
        "1 hacia adelante",
        "2 desde inicio si libre",
        "captura al paso, 1 en diagonal, si ambos peones están en paralelo y el rival solo hizo el avance de dos casillas inicial con ese peón"
      ];

    default:
      return ["Movimiento desconocido"];
  }
}

// FASE 2
//Crea una función mostrarMovimientos(piezas) que reciba un array de piezas y muestre por consola todos sus movimientos posibles usando la función anterior.
//Asegúrate de usar un bucle y practicar la modularización.


function mostrarMovimientos(piezas) {
  piezas.forEach(function (pieza) {
    console.log("Pieza " + pieza + ":");
    let movimientos = movimientosPosibles(pieza);
    movimientos.forEach(function (mov) {
      console.log(" - " + mov);
    });
  });
}


// Ejemplo:
mostrarMovimientos(tablero);
