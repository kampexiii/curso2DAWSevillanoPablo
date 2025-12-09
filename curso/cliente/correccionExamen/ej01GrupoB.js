//ej01GrupoB.js
//4 de Noviembre de 2025
//Simula el tiempo que tarda cada jugador en realizar sus jugadas durante una partida, calculando estadisticas con numero aleatorios

let numeroIncorrecto = true;
let sim = 0;
let numJug = 0;
let tBlancas = 0;
let tiNegras = 0;
let jBlancas = 0;
let jNegras = 0;
let  jb;
let jn;
let nj;
let mediaNegras = 0;
let mediaBlancas = 0;


//pedimos los nombres de los dos jugadores
jb = prompt("nombre del jugador de blancas:");
jn= prompt("nombre del jugador de negras:");
//pedimos el numero de jugadas
nj = prompt("numero de jugadas:");

//transformamos el valor a numero entero
nj = parseInt(nj);
//console.log(nj);

//validamos que el numero de jugadas sea un numero positivo
while (isNaN(nj) || nj <= 0) {
    nj = prompt("Por favor, ingrese un numero de jugadas valido (numero positivo):");
}

//validamos que el numero de jugadas sea  un entero mayor que 0
if(nj <=0){
    while(numeroIncorrecto){
        nj = prompt("Introduce un numero de jugadas correcto (entero mayor que 0):");
        if(nj>=0){
            numeroIncorrecto = false;
            break
        }
    }
}


//funcion simular jugadas
function simularJugadas(nj) {
    for(let i = 0; i < nj; i++){
        //Cada jugada genera un tiempo aleatorio entre 10 y 30 segundos
        sim = Math.floor((Math.random() * 20)+ 10);

        if(i%2==0){
            console.log(`Jugada ${i+1} del jugador de blancas ${jb}: ${sim} segundos`);
            tiNegras += sim;
            jNegras++;
        }else{
            console.log(`Jugada ${i+1} del jugador de negras ${jn}: ${sim} segundos`);
            tBlancas += sim;
            jBlancas++;
        }
    }
}

//llamamos a la funcion
simularJugadas(nj);

//calcular la media
mediaNegras = tiNegras / jNegras;
mediaBlancas = tBlancas / jBlancas;

if(tiNegras > tBlancas){
    console.log("El jugador de Blancas fue mas rapido")
}else if(tiNegras < tBlancas){
    console.log("El jugador de Negras fue mas rapido")
}else{
    console.log("Ambos jugadores tuvieron el mismo tiempo")
}

//mostramos el tiempo medio de ambos jugadores
console.log(`El tiempo medio del jugador de blancas ${jb} es: ${mediaBlancas} segundos`);
console.log(`El tiempo medio del jugador de negras ${jn} es: ${mediaNegras} segundos`);

if (mediaBlancas === mediaNegras) {
    console.log("Empate Tecnico.");
}


//MOSTRAR RESUMEN
console.log("-----RESUMEN DE LA PARTIDA-----");
console.log(`Jugador de Blancas: ${jb}`);
console.log(`Numero de jugadas realizadas por blancas: ${jBlancas}`);
console.log(`Tiempo total empleado por blancas: ${tBlancas} segundos`);
console.log(`Tiempo medio por jugada de blancas: ${mediaBlancas} segundos`);
console.log(`Jugador de Negras: ${jn}`);
console.log(`Numero de jugadas realizadas por negras: ${jNegras}`);
console.log(`Tiempo total empleado por negras: ${tiNegras} segundos`);
console.log(`Tiempo medio por jugada de negras: ${mediaNegras} segundos`);

