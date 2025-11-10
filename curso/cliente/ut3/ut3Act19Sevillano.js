/* FASE 1 + FASE 2 (mínimos cambios sobre tu lógica) */

// Array de piezas
const piezas = ["rey", "reina", "torre", "alfil", "caballo", "peón"];
const letrasValidas = ["A", "B", "C", "D", "E", "F", "G", "H"];
const numerosValidos = [1, 2, 3, 4, 5, 6, 7, 8]; // (no lo uso, pero lo mantengo)

// Mapeo símbolo <-> nombre (para admitir ♙♘♗ sin cambiar tu lógica)
const SIMBOLO_A_PIEZA = { "♙": "peón", "♘": "caballo", "♗": "alfil" };
const PIEZA_A_SIMBOLO = { "peón": "♙", "caballo": "♘", "alfil": "♗" };

/* FASE 2: auxiliar — a=1, b=2, ..., h=8 */
function coordenadaAValor(letra) {
  const L = String(letra || "").toUpperCase();
  const idx = letrasValidas.indexOf(L);
  return idx === -1 ? null : idx + 1;
}

// Normalizo pieza sin tocar tu flujo general
function normalizarPieza(p) {
  if (!p) return "";
  let s = String(p).trim();
  // Si viene símbolo, lo traduzco
  if (SIMBOLO_A_PIEZA[s]) return SIMBOLO_A_PIEZA[s];
  s = s.toLowerCase();
  if (s === "peon") s = "peón"; // admito "peon" sin tilde
  return s;
}

function esMovimientoValido(pieza, origen, destino) {

  // Convertir a minúsculas para comparación (mantengo tu idea)
  let piezaLower = normalizarPieza(pieza);
  const origenUpper = origen.toUpperCase();
  const destinoUpper = destino.toUpperCase();

  // Validar pieza (tu misma comprobación, pero ya normalizada)
  if (!piezas.includes(piezaLower)) {
    console.error("Error: pieza no válida. Debe ser una de las siguientes: rey, reina, torre, alfil, caballo, peón.");
    return false;
  }

  // Validar origen y destino (formato letra+número)
  const origenLetra = origenUpper.charAt(0);
  const origenNumero = parseInt(origenUpper.charAt(1));
  const destinoLetra = destinoUpper.charAt(0);
  const destinoNumero = parseInt(destinoUpper.charAt(1));

  // Validar formato de casillas
  if (!letrasValidas.includes(origenLetra) || isNaN(origenNumero) || origenNumero < 1 || origenNumero > 8 ||
      !letrasValidas.includes(destinoLetra) || isNaN(destinoNumero) || destinoNumero < 1 || destinoNumero > 8) {
    console.error("Error: casilla no válida. Debe estar entre A1 y H8.");
    return false;
  }

  // Convertir letras a valores numéricos (uso la auxiliar pedida)
  const origenCol = coordenadaAValor(origenLetra);
  const destinoCol = coordenadaAValor(destinoLetra);
  const origenRow = origenNumero;
  const destinoRow = destinoNumero;

  const colDiff = Math.abs(destinoCol - origenCol);
  const rowDiff = Math.abs(destinoRow - origenRow);

  let valido = false; // inicialmente falso, cambiará según la pieza

  // Lógica de movimiento simplificada (sin colisiones)
  switch (piezaLower) {
    case "peón":
      valido = (colDiff === 0 && rowDiff === 1);  // 1 casilla vertical (sin color)
      break;
    case "caballo":
      valido = (colDiff === 2 && rowDiff === 1) || (colDiff === 1 && rowDiff === 2); // L
      break;
    case "alfil":
      valido = (colDiff === rowDiff && colDiff !== 0); // diagonal
      break;
    default:
      console.error("Error: lógica de movimiento no implementada para esta pieza."); // salvaguarda
      return false;
  }
  return valido;
}

// Imprime el resultado del movimiento
function imprimirMovimiento(pieza, origen, destino, esValido) {
  const nombre = normalizarPieza(pieza);
  const simbolo = PIEZA_A_SIMBOLO[nombre] || pieza; // si ya era símbolo, lo muestro tal cual
  const etiqueta = esValido ? "Movimiento válido" : "Movimiento inválido";
  console.log(`${etiqueta}: ${simbolo} de ${origen.toLowerCase()} a ${destino.toLowerCase()}`);
}

/* FASE 2: array de jugadas y validación en bucle */
const jugadas = [
  { pieza: "Caballo", origen: "b1", destino: "c3" },
  { pieza: "Alfil",   origen: "c1", destino: "c4" },
  { pieza: "Peón",    origen: "e2", destino: "e3" },
  { pieza: "Peon",    origen: "d5", destino: "d6" }, // sin tilde, lo normalizo a "peón"
  { pieza: "♙",       origen: "a2", destino: "a3" }, // símbolo
  { pieza: "Peón",    origen: "e2", destino: "e4" }, // inválido (doble)
  { pieza: "Dragón",  origen: "d4", destino: "d5" }, // pieza no válida (dispara tu error)
];

// Procesar todas las jugadas
for (const j of jugadas) {
  const ok = esMovimientoValido(j.pieza, j.origen, j.destino);
  const nombre = normalizarPieza(j.pieza);
  const casillasOK =
    letrasValidas.includes(j.origen[0].toUpperCase()) &&
    letrasValidas.includes(j.destino[0].toUpperCase()) &&
    !isNaN(parseInt(j.origen[1])) &&
    !isNaN(parseInt(j.destino[1]));

  if (["peón","caballo","alfil"].includes(nombre) && casillasOK) {
    imprimirMovimiento(j.pieza, j.origen, j.destino, ok);
  }
}

/* Ejemplos sueltos (como en tu enunciado) */
esMovimientoValido("Caballo", "b1", "c3");
esMovimientoValido("Alfil", "c1", "c4");
esMovimientoValido("Peón", "e2", "e3");
esMovimientoValido("Peón", "e2", "e4"); // inválido
esMovimientoValido("Dragón", "d4", "d5"); // pieza no válida (error esperado)
