//Actividad 35

/*
Crea un array con varios jugadores (nombre, ELO, victorias, derrotas).
Calcula el ELO medio y la tasa de victorias.
Muestra el top 3 ordenado por rendimiento.
Guarda el ranking final en localStorage.
Abre una nueva ventana que muestre el ranking con formato HTML dinámico.
*/

// Clase Jugador
class Jugador {
    constructor(nombre, elo, victorias, derrotas, numeroPartidas) {
        this.nombre = nombre;
        this.elo = elo;
        this.victorias = victorias;
        this.derrotas = derrotas;
        this.numeroPartidas = numeroPartidas;
    }

    getTasaVictorias() {
        return this.numeroPartidas > 0 ? (this.victorias / this.numeroPartidas) : 0;
    }
}

// Array de jugadores
const jugadores = [
    new Jugador("Ana", 1500, 30, 10, 40),
    new Jugador("Pablo", 1600, 25, 15, 40),
    new Jugador("Marcos", 1550, 20, 10, 30),
    new Jugador("Asier", 1650, 35, 5, 40),
    new Jugador("Sandra", 1550, 15, 25, 40)
];

// Calcular ELO medio
const eloMedio = jugadores.reduce((total, jugador) => total + jugador.elo, 0) / jugadores.length;


// Mostrar top 3 por rendimiento
const ranking = jugadores.map((jugador, index) => ({
    nombre: jugador.nombre,
    rendimiento: jugador.elo + jugador.getTasaVictorias()
})).sort((a, b) => b.rendimiento - a.rendimiento).slice(0, 3);

// Guardar ranking en localStorage
localStorage.setItem("ranking", JSON.stringify(ranking));


// Función para mostrar el ranking en la página principal
function mostrarRankingEnPagina() {
    const ranking = JSON.parse(localStorage.getItem("ranking")) || [];
    const ul = document.getElementById("ranking-list");
    if (!ul) return;
    ul.innerHTML = "";
    ranking.forEach((jugador, i) => {
        ul.innerHTML += `<li>${i+1}. ${jugador.nombre}: ${jugador.rendimiento.toFixed(2)}</li>`;
    });
}

// Función para abrir el ranking en una ventana nueva
function verRanking() {
    const ranking = JSON.parse(localStorage.getItem("ranking")) || [];
    const win = window.open("", "Ranking", "width=600,height=400");
    win.document.write("<h1>Ranking de Jugadores</h1>");
    win.document.write("<ul>");
    ranking.forEach((jugador, i) => {
        win.document.write(`<li>${i+1}. ${jugador.nombre}: ${jugador.rendimiento.toFixed(2)}</li>`);
    });
    win.document.write("</ul>");
}

// Ejecutar al cargar
window.addEventListener('DOMContentLoaded', mostrarRankingEnPagina);
