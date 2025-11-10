// Contadores de piezas 
const peon = 4;     
const caballo = 1;  
const alfil = 1;    
const torre = 1;    
const dama = 1;     

// Cálculo directo sin funciones (todo básico)
const total = peon * 1 + caballo * 3 + alfil * 3 + torre * 5 + dama * 9;
const totalRedondeado = Math.round(total * 10) / 10;

// Mostrar resultado con un decimal
console.log('Puntuación total:', totalRedondeado.toFixed(1));
