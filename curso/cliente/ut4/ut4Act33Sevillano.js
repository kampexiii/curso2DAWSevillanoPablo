/*
Objetivo:
Combinar todo lo aprendido para crear un mini torneo.
A partir de las clases Pieza, Partida y Jugador
Requisitos:
Crea varios jugadores y guardalos en un array.
Usa la clase Partida para simular enfrentamientos aleatorios.
Almacena los resultados (ganador, elo, total partidas).
Muestra un ranking final en consola.
*/

// Clase Pieza
class Pieza {
    constructor(tipo, color) {
        this.tipo = tipo;
        this.color = color;
    }
}

// Clase Jugador
class Jugador {
    constructor(nombre, elo) {
        this.nombre = nombre;
        this.elo = elo;
        this.partidasJugadas = 0;
        this.partidasGanadas = 0;
    }
}

// Clase Partida
class Partida {
    constructor(jugador1, jugador2) {
        this.jugador1 = jugador1;
        this.jugador2 = jugador2;
        this.ganador = null;
    }

    simular() {
        // Simular resultado aleatorio
        let resultado = Math.random();
        
        if (resultado < 0.5) {
            this.ganador = this.jugador1;
            this.jugador1.partidasGanadas++;
            this.jugador1.elo += 10;
            this.jugador2.elo -= 5;
        } else {
            this.ganador = this.jugador2;
            this.jugador2.partidasGanadas++;
            this.jugador2.elo += 10;
            this.jugador1.elo -= 5;
        }
        
        this.jugador1.partidasJugadas++;
        this.jugador2.partidasJugadas++;
        
        console.log(this.jugador1.nombre + " vs " + this.jugador2.nombre + " - Ganador: " + this.ganador.nombre);
    }
}

// Crear jugadores
let jugadores = [
    new Jugador("Ana", 1200),
    new Jugador("Luis", 1250),
    new Jugador("Marta", 1180),
    new Jugador("Carlos", 1220)
];

console.log("Jugadores iniciales:");
for (let i = 0; i < jugadores.length; i++) {
    console.log(jugadores[i].nombre + " - ELO: " + jugadores[i].elo);
}

console.log("\nSimulando partidas:");

// Simular enfrentamientos aleatorios
let partidas = [];
for (let i = 0; i < jugadores.length; i++) {
    for (let j = i + 1; j < jugadores.length; j++) {
        let partida = new Partida(jugadores[i], jugadores[j]);
        partida.simular();
        partidas.push(partida);
    }
}

// Ordenar jugadores por ELO
jugadores.sort((a, b) => b.elo - a.elo);

// Mostrar ranking final
console.log("\nRanking Final:");
for (let i = 0; i < jugadores.length; i++) {
    console.log((i + 1) + ". " + jugadores[i].nombre + " - ELO: " + jugadores[i].elo + " - Partidas: " + jugadores[i].partidasJugadas + " - Victorias: " + jugadores[i].partidasGanadas);
}

// Usar filter para jugadores con mas de 1 victoria
let ganadores = jugadores.filter(j => j.partidasGanadas > 1);
console.log("\nJugadores con mas de 1 victoria:");
ganadores.forEach(j => console.log(j.nombre + ": " + j.partidasGanadas + " victorias"));

// Usar map para crear array de nombres
let nombres = jugadores.map(j => j.nombre);
console.log("\nNombres de jugadores: " + nombres.join(", "));

// Usar reduce para calcular ELO total
let eloTotal = jugadores.reduce((total, j) => total + j.elo, 0);
console.log("ELO total: " + eloTotal);


