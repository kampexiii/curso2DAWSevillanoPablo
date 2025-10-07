// --- Configuración inicial ---
  let turno = "blancas" ; // turno puede ser "blancas" o "negras"
  let enJaque = false ;// enJaque ¿El rey está en jaque?
  let sinMovimientos = false ;// sinMovimientos ¿El rey no tiene movimientos legales?

/**
 * Comprueba el estado del rey, y lo muestra por consola
 */
function comprobarEstadoRey(enJaque, sinMovimientos) {

if(enJaque){
    if(sinMovimientos){
        console.log("Jaque Mate");
    }else{
        console.log("Jaque al Rey");
    }
}else{
    if(sinMovimientos){
        console.log("Rey ahogado, tablas");
    }else{
        console.log("Todo normal, sigan");
    }
}











}

/**
 * Muestra de quién es el turno
 */
function mostrarTurno(turno) {
    console.log("el turno es del jugador de " + turno);





}

// --- Ejecución ---
comprobarEstadoRey(enJaque, sinMovimientos);
mostrarTurno(turno);
