// Función para validar la posición en un tablero de ajedrez

function validarPosicion(x, y) {
  // Compruebo que sean números finitos (descarto NaN e Infinity)
  if (!Number.isFinite(x) || !Number.isFinite(y)) {
    console.error("Error: coordenadas inválidas (NaN o Infinity).");
    return false;
  }

  // Obviamente que sean enteros
  if (!Number.isInteger(x) || !Number.isInteger(y)) {
    console.error("Error: las coordenadas deben ser enteros de 1 a 8.");
    return false;
  }

  // Rango permitido 1–8
  if (x < 1 || x > 8 || y < 1 || y > 8) {
    console.error("Error: coordenadas fuera de rango (deben estar entre 1 y 8).");
    return false;
  }

  console.log("Posición válida.");
  return true;
}

// Ejemplos directos (puedes dejarlos o quitarlos al entregar):
 validarPosicion(3, 7);       // -> Posición válida.
 validarPosicion(9, 1);       // -> fuera de rango
 validarPosicion(NaN, 2);     // -> NaN/Infinity
 validarPosicion(4, Infinity);// -> NaN/Infinity
