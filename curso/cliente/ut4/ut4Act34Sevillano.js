//Actividad 34

//Usar operaciones agregadas para analizar las piezas eliminadas.


/*Crea un array con piezas capturadas, cada una con su tipo y valor.
Calcula:
Total de piezas capturadas.
Valor total acumulado.
Piezas más valiosas (filtradas).
Muestra un resumen en consola con reduce() y filter().
Ejemplo base(tienes que ampliarlo a 10 capturas):

const capturas = [
  { tipo: "Peón", valor: 1 },
  { tipo: "Alfil", valor: 3 },
  { tipo: "Dama", valor: 9 },
  { tipo: "Torre", valor: 5 }
];

*/

//array de piezas capturadas, con su tipo y valor
const capturas = [
    { tipo: "Peón", valor: 1 },
    { tipo: "Alfil", valor: 3 },
    { tipo: "Dama", valor: 9 },
    { tipo: "Torre", valor: 5 },
    { tipo: "Caballo", valor: 3 },
    { tipo: "Rey", valor: 0 },
    { tipo: "Peón", valor: 1 },
    { tipo: "Alfil", valor: 3 },
    { tipo: "Dama", valor: 9 },
    { tipo: "Torre", valor: 5 }
];


//Calcular total de piezas capturadas
const totalPiezasCapturadas = capturas.length;

//Calcular valor total acumulado
const valorTotalAcumulado = capturas.reduce((total, pieza) => total + pieza.valor, 0);

//Filtrar piezas más valiosas
const piezasMasValiosas = capturas.filter(pieza => pieza.valor > 5);

//Mostrar resumen en consola
console.log("Resumen de capturas:");
console.log(`Total de piezas capturadas: ${totalPiezasCapturadas}`);
console.log(`Valor total acumulado: ${valorTotalAcumulado}`);
console.log("Piezas más valiosas:");
piezasMasValiosas.forEach(pieza => {
    console.log(`- ${pieza.tipo}: ${pieza.valor}`);
});