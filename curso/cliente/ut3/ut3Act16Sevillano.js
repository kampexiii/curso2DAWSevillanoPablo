// Función para colocar una pieza aleatoria en un tablero

// Único punto donde uso Math (enteros 1–8)
function enteroAleatorio1a8() {
  return Math.floor(Math.random() * 8) + 1;
}

// Función pura: calcula posición aleatoria
function colocarPiezaAleatoria(pieza) {
  const fila = enteroAleatorio1a8();    // fila 1–8
  const columna = enteroAleatorio1a8(); // columna 1–8
  return { pieza, fila, columna };      // devuelvo datos
}

// Ejemplo
const resultado = colocarPiezaAleatoria("torre");
console.log(`Pieza: ${resultado.pieza} | fila: ${resultado.fila}, columna: ${resultado.columna}`);

// Guardar como: ut3Ac16Apellido.js
