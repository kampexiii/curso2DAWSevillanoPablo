// 1. Pedimos nombres
let nombreBlancas = prompt("Introduce el nombre del jugador con blancas:");
let nombreNegras = prompt("Introduce el nombre del jugador con negras:");

if (!nombreBlancas || !nombreNegras) {
    alert("ERROR: Ningún campo puede estar vacío.");
    throw new Error("Datos inválidos");
}

// 2. Simulamos jugadas
let jugadas = 10;
let contBlancas = 0;
let contNegras = 0;
let contTotal = 0;

while (jugadas > 0) {
    let num = Math.round(Math.random() * 6 + 1);
    if (num % 2 === 0) contNegras++;
    else contBlancas++;

    contTotal++;
    jugadas--;
}

// 3. Calculamos resultado
let resultado = "Tablas";
if (contBlancas > contNegras) resultado = "Ganan blancas";
else if (contNegras > contBlancas) resultado = "Ganan negras";

// 4. Guardamos en localStorage
localStorage.setItem("Blancas", nombreBlancas);
localStorage.setItem("Negras", nombreNegras);
localStorage.setItem("Resultado", resultado);

// 5. Contador total de partidas
let totalPartidas = localStorage.getItem("totalPartidas");
if (!totalPartidas) totalPartidas = 0;
totalPartidas++;
localStorage.setItem("totalPartidas", totalPartidas);

// 6. Asignamos evento al botón cuando el DOM esté cargado
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("iniciar").addEventListener("click", () => {
        abrirVentana(resultado, contTotal, contBlancas, contNegras);
    });
});

// 7. Función para abrir la ventana
function abrirVentana(resultado, contTotal, contBlancas, contNegras) {
    let ventana = window.open("", "", "width=500,height=500");

    let colorTexto = "gray"; // Tablas
    if (resultado.toLowerCase() === "ganan blancas") colorTexto = "blue";
    if (resultado.toLowerCase() === "ganan negras") colorTexto = "black";

    ventana.document.write(`
        <h1 style="font-family: monospace">Torneo de ajedrez</h1>
        <p style="color:${colorTexto}; font-family: monospace">Ganador: ${resultado}</p>
        <p style="font-family: monospace">Total de capturas: ${contTotal}</p>
        <p style="font-family: monospace">Contador Blancas: ${contBlancas}</p>
        <p style="font-family: monospace">Contador Negras: ${contNegras}</p>
        <p style="font-family: monospace">Total partidas: ${totalPartidas}</p>
    `);

    ventana.document.title = 'Torneo ajedrez';
    ventana.document.body.style.backgroundColor = 'gray';
}


