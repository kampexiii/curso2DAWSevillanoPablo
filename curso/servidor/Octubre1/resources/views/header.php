<?php
// Archivo: Octubre1/resources/views/header.php
// En este archivo se monta la cabecera de la web: incluye el perfil, el menú
// y además un botón para alternar entre idiomas (ES/EN).
?>
<header>
  <div class="header-bar">
    <?php 
    // Aquí inserto el bloque de perfil (imagen de usuario + título "Mi cuenta/My account")
    // Al usar __DIR__ me aseguro de que la ruta a perfil.php siempre es correcta.
    require_once __DIR__ . '/perfil.php'; 
    ?>

    <!-- Este formulario sirve como "toggle" de idioma -->
    <form class="lang-toggle" method="get" action="">
      <?php
      // El input hidden guarda el idioma al que quiero cambiar:
      // si estoy en español => pongo "en"; si estoy en inglés => pongo "es".
      ?>
      <input type="hidden" name="lang" value="<?php echo (($_GET['lang'] ?? 'es') === 'es') ? 'en' : 'es'; ?>">

      <?php
      // El texto del botón muestra el idioma al que voy a saltar:
      // si estoy en español, pone "EN"; si estoy en inglés, pone "ES".
      ?>
      <button type="submit">
        <?php echo (($_GET['lang'] ?? 'es') === 'es') ? 'EN' : 'ES'; ?>
      </button>

      <?php
      // Este bucle mantiene el resto de parámetros GET de la URL
      // para que al cambiar de idioma no se pierdan.
      foreach ($_GET as $k => $v) {
        if ($k !== 'lang') {
          echo '<input type="hidden" name="'.htmlspecialchars($k).'" value="'.htmlspecialchars($v).'">';
        }
      }
      ?>
    </form>
  </div>

  <nav id="menu">
    <?php 
    // Aquí cargo la lista del menú (que se genera en base al array $MENU del idioma).
    require_once __DIR__ . '/menu.php'; 
    ?>
  </nav>
</header>
