<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ajedrez — Proyecto Pablo</title>
  <link rel="stylesheet" href="assets/css/tablero.css">
  <link rel="stylesheet" href="assets/css/piezas.css">
</head>
<body>
  <main class="wrap">
    <section class="board-wrap">
      <div id="board" class="board" aria-label="Tablero de ajedrez"></div>
      <div id="pieces-layer" class="pieces-layer"></div>
    </section>

    <!-- Selector simple para empezar con blancas o negras abajo -->
    <aside class="panel">
      <h2>Empezar partida</h2>
      <button class="btn" onclick="startGame('W')">Blancas abajo</button>
      <button class="btn" onclick="startGame('B')">Negras abajo</button>
    </aside>
  </main>

  <!-- Tu lógica real irá luego aquí -->
  <script src="assets/js/movimientos.js"></script>
  <!-- Si tienes un registro de jugadores, lo enlazas aquí -->
  <!-- <script src="assets/js/registroJugadores.js"></script> -->
</body>
</html>
