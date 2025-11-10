// Contador de tiempo de turno — base para reloj de ajedrez

let inicioTurno = 0; // almacena el momento de inicio
// Inicia el turno, guardando el tiempo actual
function iniciarTurno() {
  inicioTurno = Date.now();
  console.log("⏳ Turno iniciado...");
}

// Finaliza el turno y muestra el tiempo transcurrido
function finalizarTurno() {
  if (!inicioTurno) {
    console.log("Error: el turno no ha sido iniciado.");
    return;
  }
  const fin = Date.now();
  const segundos = Math.floor((fin - inicioTurno) / 1000);
// Mensaje según tiempo
  if (segundos > 60) {
    console.log(`⏱ ${segundos}s — Tiempo excedido ⚠️`);
  } else {
    console.log(`✅ Turno finalizado en ${segundos}s`);
  }

  inicioTurno = 0; // reseteo para el siguiente turno
}

//Ejemplo de uso:
iniciarTurno();

// simulo que pasan 5 segundos
setTimeout(finalizarTurno, 5000); // prueba también con 65000 para ver “Tiempo excedido”
