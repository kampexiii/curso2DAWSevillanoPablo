// ut2Act03Sevillano.js

//Queremos programar un pequeño sistema que:

// Compruebe si un rey está en jaque.
// Si está en jaque, verifique con un nested if si además es jaque mate.
// Si no está en jaque, indique que la partida sigue normal.
// Finalmente, usar un operador ternario para mostrar de forma breve qué jugador tiene el turno.

// escenario 1 (todo normal)
let turno = 'blancas';
let enJaque = false;
let sinMovimientos = false;

function verificarEstado() {
    if (enJaque) {
        if (sinMovimientos) {
            console.log('Jaque mate');
            // está en jaque y no tiene movimientos. Verificación de jaque mate y mostrar ganador.
            console.log(turno === 'blancas' ? 'Ganaron las negras' : 'Ganaron las blancas'); 
            // opcional, uso del ternario para indicar quien es el ganador
        } else {
            console.log('Jaque al rey'); 
            // está en jaque pero aún tiene movimientos. Verificación de jaque normal.
        }
    } else {
        if (sinMovimientos) {
            console.log('Tablas por ahogado'); 
            // no está en jaque, pero no tiene movimientos. Verificación de ahogado.
        } else {
            console.log('Todo normal, tranquilo'); 
            // no está en jaque, ni tampoco está sin movimientos. Por lo tanto, todo sigue normal.
        }
    }
}

function mostrarTurno() {
    console.log(turno === 'blancas' ? 'Turno de blancas' : 'Turno de negras'); 
    // uso del operador ternario para mostrar de forma breve qué jugador tiene el turno
}

console.log('Escenario 1');
verificarEstado();
mostrarTurno();

// escenario 2 (solo jaque)
turno = 'negras';
enJaque = true;
sinMovimientos = false;

console.log('Escenario 2');
verificarEstado();
mostrarTurno();
// opcional, escenario 2 (solo jaque)

// escenario 3 (jaque mate)
turno = 'blancas';
enJaque = true;
sinMovimientos = true;

console.log('Escenario 3');
verificarEstado();
mostrarTurno();
// opcional, escenario 3 (jaque mate)
// opcional, uso del ternario para indicar quien es el ganador

// escenario 4 (ahogado)
turno = 'negras';
enJaque = false;
sinMovimientos = true;

console.log('Escenario 4');
verificarEstado();
mostrarTurno();
// opcional, escenario 4 (ahogado)


// Retos opcionales (implican investigación)
// Cambiar valores de turno, enJaque y sinMovimientos para probar distintos escenarios.
// Añadir un tercer nivel de comprobación: si es jaque mate, mostrar también qué jugador ganó.
// Usar ternario dentro de un console.log() para imprimir directamente el ganador (ejemplo: "Ganaron las blancas" o "Ganaron las negras").
