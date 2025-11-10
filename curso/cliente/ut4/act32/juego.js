// juego.js
import { moverPieza } from './movimientos.js';
import { registrarJugada, mostrarHistorial } from './historial.js';

const jugar = (origen, destino) => {
    const movimiento = moverPieza(origen, destino);
    registrarJugada(movimiento);
    console.log(movimiento);
};

jugar("e2", "e4");
jugar("e7", "e5");
jugar("g1", "f3");

mostrarHistorial();
export { registrarJugada, mostrarHistorial };