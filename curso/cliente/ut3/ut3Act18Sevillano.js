//Valida que la pieza esté entre las permitidas: rey, reina, torre, alfil, caballo, peón.

// Array de piezas 
const piezas = ["rey", "reina", "torre", "alfil", "caballo", "peón", "torre", "alfil"];

//Pide al usuario el nombre de una pieza y la casilla destino.


function moverPieza(pieza, casilla) {
  // Convertir a minúsculas para comparación
  const piezaLower = pieza.toLowerCase();
  const casillaUpper = casilla.toUpperCase();
  // Validar pieza
  if (!piezas.includes(piezaLower)) {
    console.error("Error: pieza no válida. Debe ser una de las siguientes: rey, reina, torre, alfil, caballo, peón.");
    return;
  }
  // Validar casilla (formato letra+número)
  const letra = casillaUpper.charAt(0);
  const numero = casillaUpper.charAt(1);
  const letrasValidas = ["A", "B", "C", "D", "E", "F", "G", "H"];
  if (!letrasValidas.includes(letra) || isNaN(numero) || numero < 1 || numero > 8) {
    console.error("Error: casilla no válida. Debe estar entre A1 y H8.");
    return;
  }
  // Mensaje de movimiento
  let mensaje = `El ${piezaLower.toUpperCase()} se ha movido a ${casillaUpper}.`;
  if (casillaUpper.includes("C")) {
    mensaje += " Movimiento al flanco de dama.";
  }
  console.log(mensaje);
}

// Ejemplos de uso
moverPieza("Reina", "D5");
moverPieza("Caballo", "C3");
moverPieza("Alfil", "H9"); // Casilla no válida
moverPieza("Torre", "B2");
moverPieza("Peón", "C4");
moverPieza("Rey", "E1");
moverPieza("Dragón", "D4"); // Pieza no válida



