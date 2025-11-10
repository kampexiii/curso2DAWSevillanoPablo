let movimientosTotales = 0;
let movimientosBlancas = 0; 
let movimientosNegras = 0;
turno=1;

while (movimientosTotales <= 5){

  if(turno %2 == 1){
  movimientosBlancas ++;
  console.log("las blancas han realizado su movimiento");
  movimientosTotales += movimientosBlancas;
  } else{
    movimientosNegras++;
    console.log("las negras han realizado su movimiento");
    movimientosTotales += movimientosNegras;
  }
  
  turno++;
}
console.log("se han realizado " + movimientosTotales + " movimientos en total, las blancas hicieron " + movimientosBlancas + " y las negras hicieron " + movimientosNegras)
console.log("turnos: " + turno)