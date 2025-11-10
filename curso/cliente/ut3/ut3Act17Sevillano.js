// Array de piezas 
const piezas = ["rey", "reina", "torre", "alfil", "caballo", "peón", "torre", "alfil"];

// Único punto donde uso Math (enteros 1–8)
function enteroAleatorio1a8() {
  return Math.floor(Math.random() * 8) + 1;
}

// Genera una disposición aleatoria (una por fila)
function generarDisposicion(pzas) {
  const resultado = [];

 
  pzas.forEach((pieza, i) => {
    const fila = i + 1;              // filas 1..8
    const columna = enteroAleatorio1a8(); // columna 1..8
    resultado.push({ pieza, fila, columna }); // datos estructurados
  });

  return resultado;
}

// Muestra por consola el resultado
const disposicion = generarDisposicion(piezas);
console.table(disposicion);

