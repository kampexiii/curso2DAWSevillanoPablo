function valorPieza(pieza) {
  switch (pieza) { 
    // Completar los casos para cada pieza
    case "♕": // Dama
        return 9;
    case "♖": // Torre
        return 5;
    case "♗": // Alfil
        return 3;
    case "♘": // Caballo
        return 3;
    case "♙": // Peón
        return 1;
    default:
        return 0; // si no se reconoce la pieza
  }
}

// Ejemplo de uso
console.log(valorPieza("♕")); // debería devolver 9
console.log(valorPieza("♖")); // 5
console.log(valorPieza("♗")); // 3
console.log(valorPieza("♘")); // 3
console.log(valorPieza("♙")); // 1
console.log(valorPieza("♔")); // 0 → el rey no tiene valor