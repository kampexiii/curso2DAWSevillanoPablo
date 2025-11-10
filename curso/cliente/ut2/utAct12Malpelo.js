// Función auxiliar que devuelve true si el turno es de las blancas
function esTurnoDeBlancas(turno) {
    return turno % 2 !== 0; // impar → blancas, par → negras
}

// Función principal que simula la partida
function iniciarPartida() {
    let turnoActual = 1; // contador de turno
    const turnosMaximos = 10; // número máximo de turnos permitidos
    let movimientosValidos = 0; // contador de movimientos válidos (simulado)

    while (turnoActual <= turnosMaximos) {
        // Verificamos de quién es el turno
        if (esTurnoDeBlancas(turnoActual)) {
            console.log(`Turno ${turnoActual} → Mueven las ♙ blancas`);
        } else {
            console.log(`Turno ${turnoActual} → Mueven las ♟ negras`);
        }

        // Recordatorio en ciertos turnos
        if (turnoActual == 3 || turnoActual == 6 || turnoActual == 9) {
            console.log("⏱️ Revisa el reloj de juego");
        }

        // Operador ternario: solo las negras (turno par) hacen un movimiento válido
        movimientosValidos += (turnoActual % 2 === 0) ? 1 : 0;

        // Incrementamos el turno para evitar bucle infinito
        turnoActual++;
    }

    // Mensaje final
    console.log("🏁 Se alcanzó el número máximo de turnos. Partida finalizada.");
    console.log(`✅ Movimientos válidos realizados por las negras: ${movimientosValidos}`);
}

// Llamada a la función
iniciarPartida();