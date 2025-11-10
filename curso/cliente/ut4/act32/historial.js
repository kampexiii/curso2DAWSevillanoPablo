// historial.js
const historial = (() => {
    const jugadas = [];
    return {
        registrarJugada: (jugada) => {
            jugadas.push(jugada);
        },
        mostrarHistorial: () => {
            jugadas.forEach((jugada, index) => {
                console.log(`${index + 1}. ${jugada}`);
            });
        }
    };
})();
export const registrarJugada = historial.registrarJugada;
export const mostrarHistorial = historial.mostrarHistorial;
