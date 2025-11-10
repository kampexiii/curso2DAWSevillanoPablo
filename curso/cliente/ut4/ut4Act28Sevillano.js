/*Crea un script que:

Pida al usuario cuántas jugadas desea registrar.
Use un bucle for para solicitar cada jugada (por ejemplo: "e4", "e5", "Cf3"...).
Las almacene en un array.
Muestre al final en consola:
Todas las jugadas registradas.
El número total de jugadas (length).
La primera y última jugada.
Después de registrar las jugadas, pregunta si el jugador quiere deshacer la última.
Si responde “sí”, usa .pop() y muestra el nuevo listado actualizado.
Ejemplo de salida:

Jugadas registradas: e4, e5, Cf3, Cc6
Total: 4
Primera: e4
Última: Cc6 */



let numJugadas = parseInt(prompt("¿Cuántas jugadas deseas registrar?"));
let jugadas = [];
for (let i = 0; i < numJugadas; i++) {
  let jugada = prompt("Introduce la jugada " + (i + 1) + ":");
  jugadas.push(jugada);
}
console.log("Jugadas registradas: " + jugadas.join(", "));
console.log("Total: " + jugadas.length);
console.log("Primera: " + jugadas[0]);
console.log("Última: " + jugadas[jugadas.length - 1]);