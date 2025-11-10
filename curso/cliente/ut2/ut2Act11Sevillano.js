//Crear un archivo con el nombre: ut2Act11Apellido.js

  // FASE1
    // Requisitos:
      //Crea una función iniciarPartida() que:
      //Declare una variable turnoActual (empieza en 1).
      //Declare una constante turnosMaximos (por ejemplo, 10).
      //Use un bucle while para simular los turnos.
      //En cada turno:
      //Determina de quién es el turno:
      //Si el número de turno es impar → Blancas
      //Si es par → Negras
      //Usa una función auxiliar esTurnoDeBlancas(turno) que devuelva un booleano.
      //Muestra un mensaje como: 
      //Turno 1 → Mueven las ♙ blancas
      //Turno 2 → Mueven las ♟ negras
      //Si el turno llega al último (turnosMaximos), muestra un mensaje final:
      //Se alcanzó el número máximo de turnos. Partida finalizada.




// --- Auxiliar de turno: mantengo arrow por brevedad; impar = blancas, par = negras.
const esTurnoDeBlancas = (n) => n % 2 === 1;


function iniciarPartida() {
  let turnoActual = 1;              // arranco en 1 para que el primer turno sea de blancas
  const turnosMaximos = 10;         // límite simple para la demo
  let movimientosValidos = 0;       // FASE 2: contador simulado de movimientos válidos

  while (turnoActual <= turnosMaximos) {
    const blancas = esTurnoDeBlancas(turnoActual);
    const pieza = blancas ? "♙ blancas" : "♟ negras";
    console.log("Turno " + turnoActual + " → Mueven las " + pieza);

    // --- FASE 2: cada 3 turnos recuerdo revisar el reloj.
    if (turnoActual % 3 === 0) console.log("Recordatorio: revisa el reloj de juego.");

    // --- FASE 2: sumo 1 movimiento válido solo si el turno es par (negras) usando ternario.
    movimientosValidos += (turnoActual % 2 === 0 ? 1 : 0);

    if (turnoActual === turnosMaximos) {
      console.log("Se alcanzó el número máximo de turnos. Partida finalizada.");
      console.log("Movimientos válidos (simulados): " + movimientosValidos); 
    }

    turnoActual++;
  }
}

// --- Consultar un turno concreto usando la auxiliar de esTurnoDeBlancas()
function mostrarTurno(n) {
  console.log(esTurnoDeBlancas(n) ? "Turno de blancas" : "Turno de negras");
}

  // FASE 2
      //Cada 3 turnos, muestra un mensaje extra:
      //Recordatorio: revisa el reloj de juego.
      //Añade un contador de movimientos válidos (simulado).
      //Usa un operador ternario para sumar 1 solo si turnoActual es par (por ejemplo, “las negras hacen un movimiento válido”).
      //Si más adelante hay estados reales de partida, enlazar el “movimiento válido” a validaciones reales del tablero.
