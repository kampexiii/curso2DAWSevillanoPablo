// Valores de las piezas (en puntos)
const VALORES = {
 // dama
 // torre
 // caballo
 // peón
};

// Puntos y jugadas




/**
 * Captura de pieza
 * @param {string} pieza - símbolo de la pieza (♕, ♖, ♘, ♙)
 * @param {string} color - "blancas" o "negras" (quién captura)
 */
function capturar(pieza, color) {
  // Aumentamos jugada








  console.log(`${color} capturan ${pieza}`);
  mostrarEstado();
}

/**
 * Muestra el estado de la partida
 */
function mostrarEstado() {
  // Mostrar puntos actuales
  console.log(`Blancas: ${puntosBlancas} | Negras: ${puntosNegras}`);

  // Mostrar quién va ganando
  
  
  
  
  
  

  // Comprobar si alguien llega exactamente a 10 puntos
  
  
  
  
  
  

  // Turno según jugadas (par = blancas, impar = negras)
  
  
  
}

// Ejemplo de partida
capturar("♖", "blancas"); // +5
capturar("♘", "negras");  // +3
capturar("♙", "blancas"); // +1
capturar("♕", "negras");  // +9
