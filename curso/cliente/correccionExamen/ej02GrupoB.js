function iniciar() {
    let numJugadas;
    let bucleJugadas = true;

    while (bucleJugadas){
        numJugadas = parseInt(prompt("Por favor, introduzca el número de jugadas que tendrá la partida"), 10);
        if (numJugadas > 0 && !isNaN(numJugadas)){
            bucleJugadas =  false;
        }
        else{
            console.log("El número de jugadas no puede ser 0 o menor que 0");
        }
    }

    let numCapturas = 0;
    for (let i = 0; i < numJugadas; i++) {
        let numAleatorio = Math.floor(Math.random() * (6 - 1 + 1) + 1);
        if (numAleatorio % 3 === 0){
            numCapturas++;
            console.log("Pieza capturada con éxito");
        }
        else{
            console.log("No se ha capturado la pieza");
        }
    }

    let porcentajeCapturas = (100 * numCapturas) / numJugadas;

    let tipoPartida;
    if (porcentajeCapturas > 20){
        tipoPartida = "partida agresiva";
        console.log(`Ha sido una: ${tipoPartida}`);
    }
    else{
        tipoPartida = "partida tranquila";
    }

    // Abrimos una nueva ventana como chrome lo bloquea la abro con un botón
    let ventana = window.open("", "", "width=400,height=300");
    abrirVentana(ventana, numJugadas, numCapturas, porcentajeCapturas, tipoPartida);
}

function abrirVentana(ventana, numJugadas, numCapturas, porcentajeCapturas, tipoPartida){
    const color = porcentajeCapturas > 20 ? "red" : "green";

    ventana.document.write(`
        <h1>Torneo de ajedrez</h1>
        <p>Total de jugadas: ${numJugadas}</p>
        <p>Total de capturas: ${numCapturas}</p>
        <p style="color:${color};">Porcentaje de capturas: ${porcentajeCapturas.toFixed(2)}%</p>
        <p>Porcentaje de capturas: ${tipoPartida}</p>
    `);

    ventana.document.title = 'Torneo ajedrez';
}

const boton = document.getElementById('btnEjecutar');
if (boton) {
    boton.addEventListener('click', iniciar);
}
