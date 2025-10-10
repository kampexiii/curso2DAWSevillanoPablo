// Resources/js/main.js
(function () {
  const root = document.documentElement;
  const storageKey = 'theme'; // 'dark' | 'light' | null
  const toggleId = 'theme-toggle';

  function applyTheme(theme) {
    if (theme === 'dark') {
      root.classList.add('dark');
      root.classList.remove('light-prefer');
      setTogglePressed(true);
    } else if (theme === 'light') {
      root.classList.remove('dark');
      root.classList.add('light-prefer'); // evita override por prefers-color-scheme
      setTogglePressed(false);
    } else {
      // system
      root.classList.remove('dark');
      root.classList.remove('light-prefer');
      const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
      if (prefersDark) root.classList.add('dark');
      setTogglePressed(prefersDark);
    }
  }

  function setTogglePressed(isDark) {
    const btn = document.getElementById(toggleId);
    if (!btn) return;
    btn.setAttribute('aria-pressed', String(isDark));
    btn.title = isDark ? 'Modo oscuro activado — cambiar a claro' : 'Modo claro activado — cambiar a oscuro';
    btn.innerHTML = isDark ? '🌙 Oscuro' : '☀️ Claro';
  }

  function toggleTheme() {
    const current = localStorage.getItem(storageKey);
    if (current === 'dark') {
      localStorage.setItem(storageKey, 'light');
      applyTheme('light');
    } else if (current === 'light') {
      localStorage.removeItem(storageKey); // volver a sistema
      applyTheme(null);
    } else {
      localStorage.setItem(storageKey, 'dark');
      applyTheme('dark');
    }
  }

  // Inicialización
  (function init() {
    const saved = localStorage.getItem(storageKey);
    if (saved === 'dark' || saved === 'light') {
      applyTheme(saved);
    } else {
      applyTheme(null);
    }

    // Asociar evento al botón (si existe)
    document.addEventListener('DOMContentLoaded', function () {
      const btn = document.getElementById(toggleId);
      if (btn) {
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          toggleTheme();
        });
      }
    });

    // Si el usuario cambia la preferencia del sistema, actualizar si no hay preferencia guardada
    if (window.matchMedia) {
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        const saved = localStorage.getItem(storageKey);
        if (!saved) {
          applyTheme(null); // reaplica según sistema
        }
      });
    }
  })();
})();
