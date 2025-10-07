  const colorRey = 'blancas'; // iniciamos el rey

function puedeMoverRey(enJaque, piezaDestino, colorDestino, puedeEnrocar) {
  // Completar la condición lógica que combine los parámetros
  // y devuelva un booleano `true` o `false`.
    if (enJaque) {
    return false;
  } else {
    // si la casilla está libre, puede mover
    if (!piezaDestino) {
      return true;
    } else {
      // hay una pieza en destino
      if (colorDestino === colorRey) {
        // pieza propia -> sólo se permite si es torre propia y además está permitido enrocar
        if (puedeEnrocar && (piezaDestino === '♖' || piezaDestino === '♜')) {
          return true;
        } else {
          return false; // bloqueada por pieza propia
        }
      } else {
        // pieza enemiga (o color distinto) -> puede capturar
        if (colorDestino && colorDestino !== colorRey) {
          return true;
        } else {
          // no sabemos el color destino -> por seguridad lo denegamos
          return false;
        }
      }
    }
  }
}

// Ejemplos de pruebas:
console.log(puedeMoverRey(false, null, null, false));  
// true: rey no en jaque y destino libre

console.log(puedeMoverRey(true, "♖", "blancas", false));  
// false: rey está en jaque → no puede moverse

console.log(puedeMoverRey(false, "♖", "blancas", true));  
// true: aunque destino ocupado por torre propia, puede enrocar

console.log(puedeMoverRey(false, "♙", "negras", false));  
// true: destino ocupado por pieza enemiga, puede capturar
