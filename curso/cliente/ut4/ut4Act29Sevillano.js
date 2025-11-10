/*
Pida cuántos jugadores hay.
Solicite sus nombres y puntuaciones (usando dos arrays).
Ordene los jugadores por puntuación de mayor a menor.
Muestre en consola la clasificación completa:
Ejemplo de salida:


1. Ana - 8 puntos
2. Luis - 6 puntos
3. Marta - 4 puntos

*/

let numJugadores = parseInt(prompt("¿Cuántos jugadores hay?"));
let nombres = [];
let puntuaciones = [];

for (let i = 0; i < numJugadores; i++) {
  nombres.push(prompt("Introduce el nombre del jugador " + (i + 1) + ":"));
  puntuaciones.push(parseInt(prompt("Introduce la puntuación de " + nombres[i] + ":")));
}

// Ordenar jugadores por puntuación de mayor a menor
let clasificacion = [];
for (let i = 0; i < numJugadores; i++) {
  clasificacion.push({ nombre: nombres[i], puntuacion: puntuaciones[i] });
}
clasificacion.sort((a, b) => b.puntuacion - a.puntuacion);

// Mostrar clasificación
console.log("Clasificación:");
for (let i = 0; i < clasificacion.length; i++) {
  console.log((i + 1) + ". " + clasificacion[i].nombre + " - " + clasificacion[i].puntuacion + " puntos");
}