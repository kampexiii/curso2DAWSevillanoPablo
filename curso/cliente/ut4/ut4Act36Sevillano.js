//ut4Act36Sevillano.js


// Tablero 8x8 con piezas en posiciones iniciales
let tablero = [
    ['♜', '♞', '♝', '♛', '♚', '♝', '♞', '♜'],
    ['♟', '♟', '♟', '♟', '♟', '♟', '♟', '♟'],
    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
    ['♙', '♙', '♙', '♙', '♙', '♙', '♙', '♙'],
    ['♖', '♘', '♗', '♕', '♔', '♗', '♘', '♖']
];

let historialMovimientos = [];
let totalMovimientos = 0;

// Mostrar el tablero
function mostrarTablero() {
    console.log("\n");
    for (let fila = 7; fila >= 0; fila--) {
        let linea = (fila + 1) + " ";
        for (let col = 0; col < 8; col++) {
            let pieza = tablero[fila][col];
            let esBlanca = (fila + col) % 2 === 0;
            if (pieza === ' ') {
                linea += esBlanca ? '. ' : '  ';
            } else {
                linea += pieza + ' ';
            }
        }
        console.log(linea);
    }
    console.log("  a b c d e f g h\n");
}

// --- CONVERSIÓN DE NOTACIÓN (e2, e4) A COORDENADAS ---
function notacionAIndice(coord) {
    // coord: string tipo 'e2'
    if (typeof coord !== 'string' || coord.length !== 2) return null;
    const col = coord[0].toLowerCase().charCodeAt(0) - 97; // 'a' = 0
    const fila = parseInt(coord[1], 10) - 1; // '1' = 0
    if (col < 0 || col > 7 || fila < 0 || fila > 7) return null;
    return [fila, col];
}

// --- MODIFICAR moverPieza PARA USAR NOTACIÓN ---
function moverPieza(origen, destino) {
    const o = notacionAIndice(origen);
    const d = notacionAIndice(destino);
    if (!o || !d) {
        console.log('Coordenadas inválidas. Usa formato letra+número, ej: e2 e4');
        return;
    }
    let ocupada = tablero[d[0]][d[1]] !== ' ';
    tablero[d[0]][d[1]] = tablero[o[0]][o[1]];
    tablero[o[0]][o[1]] = ' ';
    totalMovimientos++;
    let mov = `${origen} -> ${destino}`;
    if (ocupada) mov += ' [CAPTURA]';
    historialMovimientos.push(mov);
    console.log('Movimiento realizado: ' + mov);
}

// Mostrar información
function mostrarInfo() {
    console.log("\nTotal movimientos: " + totalMovimientos);
    console.log("Historial:");
    for (let i = 0; i < historialMovimientos.length; i++) {
        console.log((i + 1) + ". " + historialMovimientos[i]);
    }
}



// --- MENÚ INTERACTIVO  ---
if (require.main === module) {
    const readline = require('readline');
    const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout
    });

    function mostrarMenu() {
        console.log('\n=== MENÚ AJEDREZ ===');
        console.log('1. Mostrar tablero');
        console.log('2. Mover pieza');
        console.log('3. Ver historial');
        console.log('4. Salir');
    }

    function pedirOpcion() {
        mostrarMenu();
        rl.question('Elige opción (1-4): ', (op) => {
            if (op === '1') {
                mostrarTablero();
                pedirOpcion();
            } else if (op === '2') {
                console.log("Ejemplo de movimiento: e2 e4 (mueve de columna e fila 2 a columna e fila 4)");
                rl.question('Introduce movimiento (ej: e2 e4): ', (input) => {
                    const partes = input.trim().split(' ');
                    if (partes.length === 2) {
                        moverPieza(partes[0], partes[1]);
                    } else {
                        console.log('Formato incorrecto. Debe ser: letra+número espacio letra+número, ej: e2 e4');
                    }
                    pedirOpcion();
                });
            } else if (op === '3') {
                mostrarInfo();
                pedirOpcion();
            } else if (op === '4') {
                console.log('¡Hasta luego!');
                rl.close();
            } else {
                console.log('Opción no válida.');
                pedirOpcion();
            }
        });
    }

    pedirOpcion();
}

