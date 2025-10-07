// ----- Parámetros base -----
const CELL = 72;
const FILES = ['a','b','c','d','e','f','g','h'];
const RANKS = [8,7,6,5,4,3,2,1];

const boardEl  = document.getElementById('board');
const layerEl  = document.getElementById('pieces-layer');

// ----- Construir 64 casillas (sin lógica) -----
function buildBoard(){
  boardEl.innerHTML = '';
  for(let r=0; r<8; r++){
    for(let f=0; f<8; f++){
      const cell = document.createElement('div');
      cell.className = 'square';
      cell.dataset.square = `${FILES[f]}${RANKS[r]}`;
      boardEl.appendChild(cell);
    }
  }
}

// ----- Mapa de rutas de imágenes (ajusta si tus nombres cambian) -----
const PIECE_SRC = {
  W: {
    p: 'assets/image/piezas/blancas/peonBlanco.png',
    r: 'assets/image/piezas/blancas/torreBlanco.png',
    n: 'assets/image/piezas/blancas/caballoBlanco.png',
    b: 'assets/image/piezas/blancas/alfilBlanco.png',
    q: 'assets/image/piezas/blancas/reinaBlanca.png',
    k: 'assets/image/piezas/blancas/reyBlanco.png',
  },
  B: {
    p: 'assets/image/piezas/negras/peonNegro.png',
    r: 'assets/image/piezas/negras/torreNegra.png',
    n: 'assets/image/piezas/negras/caballoNegro.png',
    b: 'assets/image/piezas/negras/alfilNegro.png',
    // intento 1: reinaNegra.png; fallback a reinNegra.png si falla
    q: ['assets/image/piezas/negras/reinaNegra.png','assets/image/piezas/negras/reinNegra.png'],
    k: 'assets/image/piezas/negras/reyNegro.png',
  }
};

// ----- Posición inicial (independiente del lado abajo) -----
const START = [
  ['a8','r','B'],['b8','n','B'],['c8','b','B'],['d8','q','B'],['e8','k','B'],['f8','b','B'],['g8','n','B'],['h8','r','B'],
  ['a7','p','B'],['b7','p','B'],['c7','p','B'],['d7','p','B'],['e7','p','B'],['f7','p','B'],['g7','p','B'],['h7','p','B'],
  ['a2','p','W'],['b2','p','W'],['c2','p','W'],['d2','p','W'],['e2','p','W'],['f2','p','W'],['g2','p','W'],['h2','p','W'],
  ['a1','r','W'],['b1','n','W'],['c1','b','W'],['d1','q','W'],['e1','k','W'],['f1','b','W'],['g1','n','W'],['h1','r','W'],
];

// Utilidad: square -> pixel
function squareToXY(square){
  const f = FILES.indexOf(square[0]);
  const r = RANKS.indexOf(Number(square[1]));
  return { x: f * CELL, y: r * CELL };
}

// Crea <img> y lo coloca en la capa superior
function placePiece(square, color, type){
  const img = document.createElement('img');
  img.className = 'piece';
  img.alt = `${color==='W'?'blanca':'negra'} ${type}`;
  const src = PIECE_SRC[color][type];

  if (Array.isArray(src)) {
    img.src = src[0];
    img.onerror = () => { img.onerror = null; img.src = src[1]; };
  } else {
    img.src = src;
  }

  const {x,y} = squareToXY(square);
  img.style.setProperty('--x', `${x}px`);
  img.style.setProperty('--y', `${y}px`);
  layerEl.appendChild(img);
}

// Pinta todas las piezas suponiendo que 'W' o 'B' están abajo
function renderInitialPosition(sideBottom = 'W'){
  layerEl.innerHTML = '';
  if (sideBottom === 'W') {
    START.forEach(([sq, t, c]) => placePiece(sq, c, t));
  } else {
    // invertir tablero para negras abajo (volteo simple de coordenadas)
    START.forEach(([sq, t, c]) => {
      const f = 7 - FILES.indexOf(sq[0]);
      const r = 7 - RANKS.indexOf(Number(sq[1]));
      const flipped = `${FILES[f]}${RANKS[r]}`;
      placePiece(flipped, c, t);
    });
  }
}

// API mínima para tus botones del index
window.startGame = function(sideBottom){
  buildBoard();
  renderInitialPosition(sideBottom);
  console.log(`Partida iniciada con ${sideBottom==='W'?'blancas':'negras'} abajo`);
};

// Render inicial del tablero (sin piezas aún)
buildBoard();
