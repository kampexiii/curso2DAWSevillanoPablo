/**
 * @file Simulador de turnos de ajedrez (Actividad 11 → Documentada en Act. 12)
 * @author Alejandro Malpelo (autor) — Pablo Sevillano (revisor)
 * @description Control básico de turnos con recordatorios y conteo de movimientos válidos.
 *              Ejemplo docente para practicar comentarios adecuados y JSDoc.
 */

/**
 * Determina si el turno actual corresponde a las piezas blancas.
 * @param {number} turno - Contador de turno (1..N). Impares → blancas, pares → negras.
 * @returns {boolean} true si mueven las blancas; false si mueven las negras.
 * @example
 * // turno 1 → true (blancas)
 * esTurnoDeBlancas(1);
 * // turno 2 → false (negras)
 * esTurnoDeBlancas(2);
 */
function esTurnoDeBlancas(turno) {
    // Comentario de Sevillano (revisor): uso de módulo para distinguir impar/par es claro y suficiente.
    // Comentario de Malpelo (autor): correcto; mantenemos %2 para no añadir dependencia ni sobrecomplicar.
    return turno % 2 !== 0; // impar → blancas, par → negras
}

/**
 * Inicia la simulación de una partida con un número máximo de turnos.
 * - Imprime en consola de quién es el turno.
 * - Muestra un recordatorio en turnos 3, 6 y 9.
 * - Cuenta movimientos válidos simulados de las negras (turnos pares).
 *
 * @returns {void}
 * @throws {TypeError} Si la configuración inicial no es válida (no aplica en este ejemplo).
 * @example
 * // Simplemente llama a la función para ejecutar la simulación
 * iniciarPartida();
 */
function iniciarPartida() {
    // Comentario de Sevillano (revisor): inicializo estado mínimo y fijo máximos aquí para tenerlo todo a la vista.
    // Comentario de Malpelo (autor): variables claras; los máximos se podrían parametrizar en el futuro.
    let turnoActual = 1;           // contador de turno
    const turnosMaximos = 10;      // tope de turnos
    let movimientosValidos = 0;    // solo contamos los de negras (simulación)

    while (turnoActual <= turnosMaximos) {
        // Comentario de Sevillano (revisor): priorizo legibilidad en el mensaje, incluye iconos Unicode para claridad.
        // Comentario de Malpelo (autor): de acuerdo, facilita la corrección visual.
        if (esTurnoDeBlancas(turnoActual)) {
            console.log(`Turno ${turnoActual} → Mueven las ♙ blancas`);
        } else {
            console.log(`Turno ${turnoActual} → Mueven las ♟ negras`);
        }

        // Comentario de Sevillano (revisor): recordatorio periódico en 3,6,9. Si se parametriza, usaría un array o %3.
        // Comentario de Malpelo (autor): buena idea; lo dejo literal por ser un ejemplo simple.
        if (turnoActual === 3 || turnoActual === 6 || turnoActual === 9) {
            console.log("⏱️ Revisa el reloj de juego");
        }

        // Comentario de Sevillano (revisor): ternario correcto; dejamos explícito que solo negras suman movimiento válido.
        // Comentario de Malpelo (autor): exacto; en un futuro se podría validar jugada real.
        movimientosValidos += (turnoActual % 2 === 0) ? 1 : 0;

        // Comentario de Sevillano (revisor): incremento al final del ciclo para evitar bucles infinitos.
        // Comentario de Malpelo (autor): imprescindible en cualquier contador de turnos.
        turnoActual++;
    }

    // Comentario de Sevillano (revisor): cierre con resumen claro para evaluación.
    // Comentario de Malpelo (autor): mantiene el enfoque docente.
    console.log("🏁 Se alcanzó el número máximo de turnos. Partida finalizada.");
    console.log(`✅ Movimientos válidos realizados por las negras: ${movimientosValidos}`);
}

// Llamada de ejemplo (puede comentarse en producción de pruebas)
iniciarPartida();
