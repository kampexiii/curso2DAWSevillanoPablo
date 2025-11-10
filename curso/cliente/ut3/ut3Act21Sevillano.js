// Cálculo de minutos entre dos fechas y resumen de partida
const MS_POR_MIN = 60000;
// Minutos completos entre dos fechas
function minutosEntre(inicio, fin) {
  const t0 = new Date(inicio).getTime();
  const t1 = new Date(fin).getTime();
  if (isNaN(t0) || isNaN(t1)) throw new Error("Fechas inválidas"); // validación básica
  if (t1 < t0) throw new Error("Fin anterior a inicio");
  return Math.floor((t1 - t0) / MS_POR_MIN); // minutos completos
}
// Formateo de fechas y duraciones
function f2(n) { return String(n).padStart(2, "0"); }
function fechaCorta(f) {
  const d = new Date(f);
  return `${f2(d.getDate())}/${f2(d.getMonth()+1)}/${d.getFullYear()} ${f2(d.getHours())}:${f2(d.getMinutes())}`;
}
// Duración en formato "X h Y min"
function duracionTexto(min) {
  const h = Math.floor(min / 60), m = min % 60;
  return `${h} h ${m} min`;
}
// Resumen de partida
function resumenPartida(inicio, fin) {
  const mins = minutosEntre(inicio, fin);
  return `Partida del ${fechaCorta(inicio)} al ${fechaCorta(fin)} → ${mins} minutos (${duracionTexto(mins)})`;
}

//Ejemplo de uso:
const inicio = "2025-10-22T09:00:00";
const fin    = "2025-10-22T10:37:45";

console.log("Minutos:", minutosEntre(inicio, fin));
console.log(resumenPartida(inicio, fin));
