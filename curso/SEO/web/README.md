# ☕ Café Aurora - Proyecto SEO con Laravel 12

Este es un proyecto educativo para demostrar técnicas de SEO técnico utilizando Laravel 12.

## 🚀 Cómo iniciar el proyecto

1.  Abre una terminal en esta carpeta (`curso/seo/web`).
2.  Ejecuta el servidor de desarrollo de Laravel:
    ```bash
    php artisan serve
    ```
3.  Abre tu navegador en la dirección que te muestra (normalmente `http://127.0.0.1:8000`).

## 📂 Estructura del Proyecto

-   **Rutas (`routes/web.php`)**: Definición de URLs amigables.
-   **Controladores (`app/Http/Controllers/`)**: Lógica de negocio (Productos, Contacto, Sitemap).
-   **Vistas (`resources/views/`)**: Plantillas Blade con HTML semántico y metadatos SEO.
-   **Estilos (`public/css/app.css`)**: CSS personalizado (sin dependencias de Node.js).

## ✨ Características SEO Implementadas

1.  **URLs Amigables**: `/producto/cafe-etiopia` en lugar de IDs numéricos.
2.  **Meta Etiquetas Dinámicas**: Títulos y descripciones únicos por página.
3.  **Datos Estructurados (JSON-LD)**: Schema.org para `CoffeeShop` y `Product`.
4.  **Sitemap XML**: Generado dinámicamente en `/sitemap.xml`.
5.  **HTML Semántico**: Uso correcto de `<header>`, `<main>`, `<article>`, `<h1>`, etc.
