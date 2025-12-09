<?php
// resources/views/pie.php - Footer
?>

<footer class="footer-base border-t border-[#027373]/20 bg-white/80">
    <div class="container py-5">
        <div class="row g-4">
            
            <div class="col-md-3">
                <div class="d-flex align-items-center gap-2">
                    <img src="<?= asset_url('viajedeRegresoLogoSinFondo.webp') ?>" alt="Viaje de Regreso" class="footer-logo" > 
                    <span class="title-card-small">Viaje de Regreso</span>
                </div>
                <p class="footer-text mt-3">Un espacio digital de calma, práctica y sentido. Tecnología al servicio de tu interior.</p>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <span class="tag-primary-small">SSL activo</span> 
                    <span class="tag-primary-small">Pagos seguros</span> 
                    <span class="tag-primary-small">RGPD</span> 
                    <span class="tag-primary-small">Sin anuncios</span> 
                </div>
            </div>
            
            <div class="col-md-3">
                <h4 class="title-earth-small">Explorar</h4>
                <ul class="list-unstyled mt-3 footer-links">
                    <li><span class="cursor-default">Sobre el proyecto</span></li>
                    <li><a class="text-primary hover-underline" href="#libro">Libro del Viaje</a></li>
                    <li><a class="text-primary hover-underline" href="#blog">Lecturas / Blog</a></li>
                    <li><span class="cursor-default">Conexiones (Premium)</span></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h4 class="title-earth-small">Legal</h4>
                <ul class="list-unstyled mt-3 footer-links">
                    <li><a class="text-primary hover-underline" href="#">Política de privacidad</a></li>
                    <li><a class="text-primary hover-underline" href="#">Política de cookies</a></li>
                    <li><a class="text-primary hover-underline" href="#">Términos y condiciones</a></li>
                    <li><a class="text-primary hover-underline" href="#">Accesibilidad</a></li>
                </ul>
                <p class="footer-notice mt-3"><strong>Aviso:</strong> el contenido no sustituye consejo médico, psicológico o legal profesional.</p>
            </div>
            
            <div class="col-md-3">
                <h4 class="title-earth-small">Contacto</h4>
                <p class="footer-text mt-3"> Correo: <a class="text-primary hover-underline" href="mailto:hola@viajederegreso.es">hola@viajederegreso.es</a><br> Ubicación: España (atención online) </p>
                
                <form class="mt-3">
                    <label class="d-block footer-text mb-1">Suscríbete a novedades</label>
                    <div class="d-flex gap-2">
                        <input type="email" disabled class="form-control form-control-sm footer-input" placeholder="Tu email (próximamente)" />
                        <button type="button" disabled class="btn-primary-small"> Enviar </button>
                    </div>
                </form>
                
                <div class="d-flex gap-3 mt-3 text-primary">
                    <span class="cursor-default text-primary">Instagram</span> 
                    <span class="cursor-default text-primary">YouTube</span> 
                    <span class="cursor-default text-primary">LinkedIn</span> 
                </div>
            </div>
            
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container py-3 d-flex justify-content-between text-xs">
            <div>© 2025 Viaje de Regreso. Todos los derechos reservados.</div>
            <div>Idioma: <span>ES</span></div>
        </div>
    </div>
</footer>