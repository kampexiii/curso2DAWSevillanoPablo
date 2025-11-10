/*
Crea un programa que:

Guarde en un array varias jugadas (algunas repetidas).
Muestre cuántas veces aparece cada jugada.

*/

jugadas = ["e4", "e5", "Cf3", "e4", "Cc6", "Cf3", "d4", "e5", "e4"];
let conteoJugadas = {};
for (let i = 0; i < jugadas.length; i++) {
  let jugada = jugadas[i];
  conteoJugadas[jugada] = (conteoJugadas[jugada] || 0) + 1;
}

for (let jugada in conteoJugadas) {
  console.log("La jugada " + jugada + " aparece " + conteoJugadas[jugada] + " veces.");
}
