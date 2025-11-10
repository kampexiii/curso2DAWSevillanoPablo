

const historial = []; // aquí guardo las jugadas como strings

// Función para registrar una jugada
function registrarJugada(pieza, casilla) {
  // Formato de pieza y casilla
  const piezaFmt = String(pieza).trim().toUpperCase();     // "reina" -> "REINA"
  const casillaFmt = String(casilla).trim().toUpperCase(); // "d4"   -> "D4"

  // Número de línea = posición en el historial + 1
  const num = historial.length + 1;

  // Formato pedido: "1. REINA A D4"
  const linea = `${num}. ${piezaFmt} A ${casillaFmt}`;

  // Guardo en el array de strings
  historial.push(linea);
}

// (Opcional) Mostrar historial por consola usando join("\n")
function mostrarHistorial() {
  console.log(historial.join("\n"));
}

/* ----------------- DEMO RÁPIDA ----------------- */
// Ejemplo tal cual el enunciado
registrarJugada("reina", "d4");
registrarJugada("caballo", "f3");
registrarJugada("alfil", "c5");

// Muestra:
// 1. REINA A D4
// 2. CABALLO A F3
// 3. ALFIL A C5
mostrarHistorial();
