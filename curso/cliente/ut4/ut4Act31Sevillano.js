/*

Registra las jugadas en un array.
Usa filter() para obtener solo las capturas (jugadas con “x”).
Usa map() para numerarlas: ["1. e4", "2. e5", "3. Cf3", ...].
Usa reduce() para contar cuántas jugadas totales hubo.
Muestra el resumen en consola:
Jugadas totales: 12
Capturas: 3
Media por jugador: 6

*/

const jugadas = [
  "e4", "e5", "Cf3", "Cc6", "Ab5", "a6",
  "AxC", "Af6", "Cxe5", "Ae7", "Cxc6", "dxc6"
];

const capturas = jugadas.filter(jugada => jugada.includes("x"));
const jugadasNumeradas = jugadas.map((jugada, index) => `${index + 1}. ${jugada}`);
const totalJugadas = jugadas.reduce((total, jugada) => total + 1, 0);
const totalCapturas = capturas.length;
const mediaPorJugador = totalJugadas / 2;

console.log("Jugadas totales: " + totalJugadas);
console.log("Capturas: " + totalCapturas);
console.log("Media por jugador: " + mediaPorJugador);

console.log("Jugadas numeradas:", jugadasNumeradas);