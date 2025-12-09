<?php
// resources/views/contenido.php - Todas las secciones del cuerpo de la web
?>

<section class="hero-bg-static text-center hero-section">
    <div class="twinkles" aria-hidden="true"></div>
    <div class="container py-5 py-md-5">
        <div class="d-flex justify-content-center">
            <div class="logo-wrapper" role="img" aria-label="Logotipo de Viaje de Regreso">
                <div class="logo-blur-bg"></div>
                <img src="<?= asset_url('viajedeRegresoLogoSinFondo.webp') ?>" alt="Viaje de Regreso" class="logo-img" />
            </div>
        </div>
        
        <h1 class="hero-title mt-3">Viaje de Regreso</h1>
        <p class="hero-subtitle mt-2">Un espacio sereno para volver a ti: calma, conciencia y conexión.</p>
        
        <div class="d-flex align-items-center justify-content-center gap-3 mt-4 flex-wrap">
            <a href="#planes" class="btn-primary-shine">Empieza gratis</a>
            <a href="#" class="btn-secondary-custom">Iniciar sesión</a>
        </div>
        
        <p class="hero-accent-text mt-3">respira • siente • regresa</p>
        <div class="hero-divider mt-4 mx-auto"></div>
        <a href="#libro" class="scroll-link mt-3">↓ Desplázate</a>
    </div>
</section>

<section id="libro" class="section-libro position-relative overflow-hidden">
    <div class="bg-grid"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-start g-4">
            
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-2">
                    <svg aria-hidden="true" class="icon-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M3 21s5-1 9-5 5-9 5-9l-3 1-3-3s-5 1-9 5-4 9-4 9l5 2z"></path></svg> 
                    <h2 class="title-earth">El Libro del Viaje</h2>
                </div>
                <p class="text-body mt-3">Una guía clara y amable para comprender el camino interior. Reúne conceptos esenciales, propuestas sencillas y relatos breves que iluminan la práctica cotidiana. No pretende “enseñarte” quién eres, sino recordártelo.</p>
                <p class="text-body mt-3">Es un punto de partida para quien busca calma sin dogmas: lenguaje directo, pausa y una invitación a cuidarte con atención.</p>
                <div class="mt-4">
                    <span class="btn-secondary-custom select-none cursor-default"> Leer un avance (próximamente) </span>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card-base shine position-relative overflow-hidden">
                    <div class="card-img-wrapper">
                        <img src="<?= asset_url('portadalibroProvisional.webp') ?>" alt="Portada provisional del libro Viaje de Regreso" class="w-100 h-auto" />
                    </div> 
                    <span class="card-tag">Portada provisional</span>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section id="energia" class="section-energia bg-white/65 position-relative overflow-hidden">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center gap-2">
                    <svg aria-hidden="true" class="icon-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"> <circle cx="12" cy="12" r="8"></circle><path d="M12 4v16M4 12h16M6.5 6.5l11 11M17.5 6.5l-11 11"></path> </svg> 
                    <h2 class="title-earth">Energía y equilibrio</h2>
                </div>
                <p class="text-body mt-3 max-w-lg">Comprender tu energía es comprender tu ritmo. Aquí encontrarás un mapa sencillo para reconocer tu estado (enraizar, abrir, expresar, ver con calma…) y recursos para volver a tu centro cuando lo necesites.</p>
                
                <div class="row g-4 mt-4">
                    <div class="col-sm-6 col-lg-4"> <div class="card-base card-energy p-4"><h3>Enraizar</h3><p class="text-card-small">Estabilidad y presencia para sostenerte.</p></div></div>
                    <div class="col-sm-6 col-lg-4"> <div class="card-base card-energy p-4"><h3>Abrir el corazón</h3><p class="text-card-small">Escucha y compasión sin perder tus límites.</p></div></div>
                    <div class="col-sm-6 col-lg-4"> <div class="card-base card-energy p-4"><h3>Expresar</h3><p class="text-card-small">Claridad amable: decir lo que sientes.</p></div></div>
                    <div class="col-sm-6 col-lg-4"> <div class="card-base card-energy p-4"><h3>Ver con calma</h3><p class="text-card-small">Intuición y perspectiva sin prisa.</p></div></div>
                    <div class="col-sm-6 col-lg-4"> <div class="card-base card-energy p-4"><h3>Fluir</h3><p class="text-card-small">Creatividad y movimiento sin exigencia.</p></div></div>
                    <div class="col-sm-6 col-lg-4"> <div class="card-base card-energy p-4"><h3>Conectar</h3><p class="text-card-small">Sentido de unidad y pertenencia.</p></div></div>
                </div>
                
                <div class="mt-4">
                    <span class="btn-primary-shine select-none cursor-default"> Quiero equilibrar mi energía </span>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="practica" class="section-practica position-relative overflow-hidden">
    <div class="container py-5">
        <div class="d-flex align-items-center gap-2">
             <svg aria-hidden="true" class="icon-primary-lg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"> <path d="M2 12c3 0 3-6 6-6s3 12 6 12 3-6 6-6"></path> </svg> 
            <h2 class="title-earth">Práctica meditativa</h2>
        </div>
        <p class="text-body mt-3 max-w-lg">La práctica aquí se aprende viviendo: breves indicaciones, espacios de silencio y propuestas amables para llevar la calma a lo cotidiano. No necesitas experiencia previa; sólo disponibilidad para escucharte.</p>
        <p class="text-body mt-3 max-w-lg">Empieza suave, sin exigencia. Cuando el cuerpo y la mente encuentran un ritmo, lo demás se ordena.</p>
        <div class="mt-4">
            <span class="btn-secondary-custom"> Explorar cómo empezar </span>
        </div>
    </div>
</section>

<section id="blog" class="section-blog position-relative overflow-hidden bg-white/65">
    <div class="container py-5">
        <div class="d-flex align-items-center gap-2">
            <svg aria-hidden="true" class="icon-primary-lg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"> <path d="M3 5h7a4 4 0 0 1 4 4v10H7a4 4 0 0 0-4 4V5z"></path> <path d="M21 5h-7a4 4 0 0 0-4 4v10h7a4 4 0 0 1 4 4V5z"></path> </svg> 
            <h2 class="title-earth">Lecturas que acompañan</h2>
        </div>
        <p class="text-body mt-3">Artículos breves, diarios de práctica y reflexiones para sostener tu proceso. Un lugar al que volver cuando necesites recordar, tomar aire o ver con perspectiva.</p>
        
        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <article class="card-base card-blog p-4">
                    <h3 class="title-card-small">Entrada 1 (placeholder)</h3>
                    <p class="text-card-small">Resumen breve del artículo. Texto de ejemplo hasta publicar contenido real.</p>
                    <div class="text-primary mt-3">Leer más</div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="card-base card-blog p-4">
                    <h3 class="title-card-small">Entrada 2 (placeholder)</h3>
                    <p class="text-card-small">Resumen breve del artículo. Texto de ejemplo hasta publicar contenido real.</p>
                    <div class="text-primary mt-3">Leer más</div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="card-base card-blog p-4">
                    <h3 class="title-card-small">Entrada 3 (placeholder)</h3>
                    <p class="text-card-small">Resumen breve del artículo. Texto de ejemplo hasta publicar contenido real.</p>
                    <div class="text-primary mt-3">Leer más</div>
                </article>
            </div>
        </div>
        
        <div class="mt-4">
            <span class="btn-primary-shine select-none cursor-default"> Explorar el blog </span>
        </div>
    </div>
</section>

<section id="conexiones" class="section-conexiones hero-bg-static position-relative overflow-hidden">
    <div class="twinkles" aria-hidden="true"></div>
    <div class="container py-5 position-relative">
        <div class="d-flex align-items-center gap-2">
            <svg aria-hidden="true" class="icon-heart-animated" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"> <path d="M12 21s-7.5-4.6-9.5-8.3C1 9.6 3 6.5 6 6.5c2 0 3.1 1.2 3.9 2.3.8-1.1 1.9-2.3 3.9-2.3 3 0 5 3.1 3.5 6.2C19.5 16.4 12 21 12 21z"/> </svg> 
            <h2 class="title-gtext">Conexiones con propósito</h2>
        </div>
        <p class="text-body-lg mt-3 max-w-lg">Encuentros para <strong>personas como tú</strong>: sensibles, curiosas, con ganas de crecer. Afinidad primero; después, la charla. Aquí conectas desde la calma, la escucha y el deseo de compartir camino.</p>
        
        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <article class="card-base card-conexiones p-4">
                    <h3 class="title-card-small">Afinidad real</h3>
                    <p class="text-card-small">Perfiles con intención: lo que te calma, lo que te inspira, cómo cuidas de ti. Menos swipe, más verdad.</p>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                         <span class="tag-primary">Amistad consciente</span>
                         <span class="tag-rose">Acompañamiento</span>
                         <span class="tag-coral">Relación con sentido</span>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="card-base card-conexiones p-4">
                    <h3 class="title-card-small">Charla que abre</h3>
                    <p class="text-card-small">Si ambos sentís afinidad, hay **match** y se abre un chat con preguntas suaves...</p>
                    <ul class="list-unstyled mt-3 text-card-xs">
                         <li>• “¿Qué te trajo a este viaje?”</li>
                         <li>• “Un acto de amor propio hoy…”</li>
                    </ul>
                </article>
            </div>
            <div class="col-md-4">
                <article class="card-base card-conexiones p-4">
                    <h3 class="title-card-small">Ritmo amable</h3>
                    <p class="text-card-small">Sin prisa. Enfócate en *pocas conexiones valiosas*, pausa cuando lo necesites y vuelve cuando el corazón te lo pida.</p>
                    <p class="text-card-xs mt-3">Aquí cuidamos el tono: presencia, límites claros y cariño por el proceso.</p>
                </article>
            </div>
        </div>
        
        <div class="d-flex flex-wrap gap-3 mt-4">
            <span class="btn-primary-shine select-none cursor-default"> Conocer a personas afines </span>
            <span class="btn-secondary-custom select-none cursor-default"> Cómo funciona </span>
        </div>
        <p class="text-body-sm mt-3">No buscamos matches infinitos; buscamos <strong>encuentros con sentido</strong>.</p>
    </div>
</section>

<section id="planes" class="section-planes position-relative overflow-hidden bg-white/65">
    <div class="container py-5">
        <div class="d-flex align-items-center gap-2">
            <svg aria-hidden="true" class="icon-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.6L22 9.3l-5 4.6 1.5 6.8L12 17.8 5.5 20.7 7 13.9 2 9.3l7.1-.7L12 2z"/></svg>
            <h2 class="title-earth">Da el primer paso</h2>
        </div>
        <p class="text-body mt-3">Empieza sin compromiso. Si sientes que este espacio te sostiene, podrás ampliar tu acceso cuando quieras.</p>
        
        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="card-base card-plan p-4">
                    <h3 class="title-card-small">Inicio</h3>
                    <p class="text-card-small mb-3">Registro gratuito con <strong>2 tokens</strong> de bienvenida.</p>
                    <a href="#planes" class="btn-secondary-custom"> Empezar gratis </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-base card-plan p-4">
                    <h3 class="title-card-small">Packs de tokens</h3>
                    <p class="text-card-small mb-3">Desbloquea meditaciones, capítulos y contenidos exclusivos.</p>
                    <span class="btn-secondary-custom select-none cursor-default"> Ver opciones </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-base card-plan p-4 ring-1 ring-[#027373]/30">
                    <h3 class="title-card-small">Premium</h3>
                    <p class="text-card-small mb-3">Acceso ilimitado a todo + módulo Conexiones.</p>
                    <span class="btn-primary-shine select-none cursor-default"> Hacerse Premium </span>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cta-final" class="section-cta-final hero-bg-static text-center position-relative overflow-hidden">
    <div class="twinkles" aria-hidden="true"></div>
    <div class="container py-5 position-relative">
        <h2 class="title-earth title-cta-final">El Viaje comienza contigo</h2>
        <p class="text-body-lg mt-2">Respira. Un paso cada día basta.</p>
        <a href="#planes" class="btn-primary-shine mt-4"> Empieza ahora </a>
    </div>
</section>