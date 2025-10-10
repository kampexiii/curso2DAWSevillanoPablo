<?php
// Detectar el nivel de la página para ajustar rutas (mantén esta lógica si aún no está definida en el archivo)
$nivel = '';
if (basename(dirname($_SERVER['SCRIPT_FILENAME'])) === 'Pages') {
    $nivel = '../';
}
?>

<section class="animals">
    <h2>Perros en adopción 🐾</h2>
    <p>Estos peludos están esperando un hogar lleno de cariño. Si alguno te roba el corazón, ¡contáctanos para iniciar el proceso de adopción!</p>

    <div class="animal-list">
        <!-- Perro 1 -->
        <article class="animal-card">
            <img src="<?= $nivel ?>Resources/assets/img/perros/perro1.jpg"
                 alt="Luna"
                 onerror="this.src='<?= $nivel ?>Resources/assets/img/logo.png'">
            <h4>Luna</h4>
            <p>Raza: Mestiza<br>Edad: 2 años<br>Dulce, juguetona y le encanta la compañía humana.</p>
            <div class="call-to-action">❤️ Disponible para adopción</div>
        </article>

        <!-- Perro 2 -->
        <article class="animal-card">
            <img src="<?= $nivel ?>Resources/assets/img/perros/perro2.jpg"
                 alt="Rocky"
                 onerror="this.src='<?= $nivel ?>Resources/assets/img/logo.png'">
            <h4>Rocky</h4>
            <p>Raza: Pastor Alemán<br>Edad: 4 años<br>Leal y protector, ideal para familias activas.</p>
            <div class="call-to-action">❤️ Disponible para adopción</div>
        </article>

        <!-- Perro 3 -->
        <article class="animal-card">
            <img src="<?= $nivel ?>Resources/assets/img/perros/perro3.jpg"
                 alt="Milo"
                 onerror="this.src='<?= $nivel ?>Resources/assets/img/logo.png'">
            <h4>Milo</h4>
            <p>Raza: Labrador Retriever<br>Edad: 3 años<br>Juguetón, sociable y muy inteligente.</p>
            <div class="call-to-action">❤️ Disponible para adopción</div>
        </article>

        <!-- Perro 4 -->
        <article class="animal-card">
            <img src="<?= $nivel ?>Resources/assets/img/perros/perro4.jpg"
                 alt="Nina"
                 onerror="this.src='<?= $nivel ?>Resources/assets/img/logo.png'">
            <h4>Nina</h4>
            <p>Raza: Border Collie<br>Edad: 1 año<br>Muy activa, perfecta para familias deportistas.</p>
            <div class="call-to-action">❤️ Disponible para adopción</div>
        </article>

        <!-- Perro 5 -->
        <article class="animal-card">
            <img src="<?= $nivel ?>Resources/assets/img/perros/perro5.jpg"
                 alt="Toby"
                 onerror="this.src='<?= $nivel ?>Resources/assets/img/logo.png'">
            <h4>Toby</h4>
            <p>Raza: Beagle<br>Edad: 5 años<br>Tranquilo, sociable y muy cariñoso.</p>
            <div class="call-to-action">❤️ Disponible para adopción</div>
        </article>

        <!-- Perro 6 -->
        <article class="animal-card">
            <img src="<?= $nivel ?>Resources/assets/img/perros/perro6.jpg"
                 alt="Max"
                 onerror="this.src='<?= $nivel ?>Resources/assets/img/logo.png'">
            <h4>Max</h4>
            <p>Raza: Mestizo<br>Edad: 3 años<br>Leal, activo y muy sociable.</p>
            <div class="call-to-action">❤️ Disponible para adopción</div>
        </article>
    </div>
</section>
