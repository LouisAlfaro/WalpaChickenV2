<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WalpaChicken - Restaurante')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* COLORES EXACTOS DE WALPA */
:root {
    --color-fondo-primario: #210303;
    --color-fondo-secundario: #d03336;
    --color-fondo-terciario: #fec601;
    --color-fondo-cuaternario: #ffffff;
    --color-fondo-quinario: #e9e9e9;
    --color-fondo-senario: #b18322;
    --color-fondo-septenario: #778089;
    --color-texto-primario: #210303;
    --color-texto-secundario: #d03336;
    --color-texto-terciario: #fec601;
    --color-texto-cuaternario: #ffffff;
    --color-texto-quinario: #e9e9e9;
    --color-texto-senario: #b18322;
    --color-texto-septenario: #778089;
    --color-borde-primario: #210303;
    --color-borde-secundario: #d03336;
    --color-borde-terciario: #fec601;
    --color-borde-cuaternario: #ffffff;
    --color-borde-quinario: #e9e9e9;
    --color-borde-senario: #b18322;
    --color-borde-septenario: #778089;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: var(--color-texto-primario);
    margin: 0;
    padding: 0;
}

/* ESPACIADO GLOBAL REDUCIDO PARA TODAS LAS PÁGINAS */
.container,
.container-fluid {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.py-5 {
    padding-top: 1.5rem !important;
    padding-bottom: 1.5rem !important;
}

.py-4 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.mb-5 {
    margin-bottom: 1.5rem !important;
}

.mb-4 {
    margin-bottom: 1rem !important;
}

.my-5 {
    margin-top: 1.5rem !important;
    margin-bottom: 1.5rem !important;
}

/* Headers de todas las páginas */
.menu-header,
.catering-hero,
.company-hero,
.opportunities-hero,
.locations-hero,
.promotions-header {
    padding: 1.5rem 0 !important;
    margin-bottom: 1rem !important;
}

/* Secciones generales */
section,
.section {
    
    margin: 0 !important;
}

.container-fluid {
    padding: 0;
}

/* ELIMINAR TODOS LOS ESPACIOS ENTRE SECCIONES */
#heroCarousel,
.hero-slider,
.carousel,
.carousel-inner,
.carousel-item,
.social-community-section,
.section-title {
    margin: 0 !important;
    padding: 0;
}

.navbar-walpa {
    background-color: var(--color-fondo-primario) !important;
    padding: 1rem 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.navbar-brand {
    color: var(--color-texto-terciario) !important;
    font-weight: bold;
    font-size: 2.2rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.nav-link {
    color: var(--color-texto-cuaternario) !important;
    font-weight: 600;
    margin: 0 1rem;
    letter-spacing: 0.5px;
    transition: color 0.3s ease;
}

.nav-link:hover {
    color: var(--color-texto-terciario) !important;
}

.btn-walpa {
    background: #210303 !important;
    color: #fff !important;
    border: none;
    font-weight: bold;
    padding: 0.7rem 1.8rem;
    border-radius: 25px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(33, 3, 3, 0.3);
    opacity: 1 !important;
}

.btn-walpa:hover {
    background: #210303 !important;
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(33, 3, 3, 0.4);
    opacity: 1 !important;
}

.btn-walpa.active {
    background: #210303 !important;
    color: #fff !important;
    opacity: 1 !important;
}

.btn-walpa:focus,
.btn-walpa:active {
    background: #210303 !important;
    color: #fff !important;
    opacity: 1 !important;
}

.btn-outline-walpa {
    background: transparent;
    color: #210303;
    border: 2px solid #210303;
    font-weight: bold;
    padding: 0.7rem 1.8rem;
    border-radius: 25px;
    transition: all 0.3s ease;
    opacity: 1 !important;
}

.btn-outline-walpa:hover {
    background: #210303 !important;
    color: #fff !important;
    border-color: #210303;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(33, 3, 3, 0.4);
    opacity: 1 !important;
}

.btn-outline-walpa.active {
    background: #210303 !important;
    color: #fff !important;
    border-color: #210303;
    opacity: 1 !important;
}

.btn-outline-walpa:focus,
.btn-outline-walpa:active {
    background: #210303 !important;
    color: #fff !important;
    border-color: #210303;
    opacity: 1 !important;
}

/* SLIDER PROPORCIONAL EN ALTURA */
.hero-slider {
    height: 70vh; /* Cambiar de 100vh a 70vh para mejor proporción */
    position: relative;
    overflow: hidden;
    margin: 0 !important;
    background-color: #210303; /* Color de fondo durante transiciones */
}

.hero-slider .carousel-item {
    height: 70vh;
    transition: transform 0.6s ease-in-out;
    background-color: #210303; /* Prevenir flash blanco */
}

.slider-item {
    height: 70vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    background-color: #210303; /* Prevenir flash blanco */
}

/* Prevenir flash blanco en el carrusel */
.carousel-inner {
    background-color: #210303 !important;
}

.carousel-item {
    background-color: #210303 !important;
}

/* Transición suave sin flash blanco */
.carousel-item.active,
.carousel-item-next,
.carousel-item-prev {
    display: block;
}

.carousel-item-next:not(.carousel-item-start),
.carousel-item-prev:not(.carousel-item-end),
.active.carousel-item-start,
.active.carousel-item-end {
    transform: translateX(0);
}

@supports (transform-style: preserve-3d) {
    .carousel-item-next,
    .carousel-item-prev {
        transform-style: preserve-3d;
        backface-visibility: hidden;
    }
}

.slider-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.2); /* Menos opacidad */
    display: flex;
    align-items: center;
    justify-content: center;
}

.slider-content {
    text-align: center;
    color: white;
    max-width: 600px;
    padding: 2rem;
}

.slider-content h2 {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.slider-content p {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
    line-height: 1.6;
}

/* SECCIÓN DE COMUNIDAD SIN ESPACIOS */
.social-community-section {
    background: #fec601;
    margin: 0 !important;
    position: relative;
    padding: 0;
}

.section-title {
    background: linear-gradient(135deg, var(--color-fondo-terciario), var(--color-fondo-senario));
    color: var(--color-texto-primario);
    text-align: center;
    padding: 1rem;
    margin: 0 !important; /* Sin márgenes */
    font-size: 2.8rem;
    font-weight: bold;
    position: relative;
    overflow: hidden;
}

.section-title::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.section-title:hover::before {
    left: 100%;
}

.promotion-card,
.favorites-section,
.container {
    margin-bottom: 0 !important;
    margin-top: 0 !important;
    padding: 2rem;
}

.promotion-card {
    background: var(--color-fondo-cuaternario);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    margin: 1rem;
    border: 2px solid transparent;
}

.promotion-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    border-color: var(--color-borde-terciario);
}

.promotion-image {
    height: 280px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.promotion-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.1));
}

.promotion-content {
    padding: 2rem;
}

.promotion-content h5 {
    color: var(--color-texto-primario);
    font-weight: bold;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

/* Sección de Favoritos - Versión Mejorada */
.favorites-section {
    background: linear-gradient(135deg, #fec601 0%, #f8d000 50%, #e6c200 100%);
    padding: 0px 0 15px 0;
    position: relative;
    overflow: hidden;
}

/* Elementos decorativos de fondo */
.favorites-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255,255,255,0.08) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(255,255,255,0.05) 0%, transparent 50%);
    animation: rotate 30s linear infinite;
}

.favorites-section::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(45deg, transparent 48%, rgba(255,255,255,0.03) 49%, rgba(255,255,255,0.03) 51%, transparent 52%),
        linear-gradient(-45deg, transparent 48%, rgba(255,255,255,0.03) 49%, rgba(255,255,255,0.03) 51%, transparent 52%);
    background-size: 20px 20px;
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.section-title-favorites {
    text-align: center;
    margin-bottom: 8px;
    margin-top: -30px;
    position: relative;
    z-index: 10;
}

.section-title-favorites {
    font-size: 3.5rem;
    font-weight: 900;
    color: #2c1810;
    text-shadow: 
        2px 2px 0px rgba(255,255,255,0.3),
        4px 4px 8px rgba(0,0,0,0.1);
    letter-spacing: -1px;
    margin-bottom: 0;
    padding-top: 0;
}

.section-subtitle {
    font-size: 1.3rem;
    font-weight: 400;
    color: #2c1810;
    opacity: 0.85;
    margin-top: 5px;
    margin-bottom: 8px;
    font-style: italic;
}

.favorites-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    max-width: 1900px;
    margin: 0 auto;
    position: relative;
    z-index: 5;
}

/* Imagen principal con efectos mejorados - CUADRADA Y SIN RECORTAR */
.favorite-main {
    position: relative;
    border-radius: 0px;
    overflow: hidden;
    box-shadow: 
        0 25px 50px rgba(0,0,0,0.18),
        0 15px 30px rgba(0,0,0,0.12),
        inset 0 1px 0 rgba(255,255,255,0.2);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    background: #fec601;
    border: 4px solid rgba(255,255,255,0.8);
    aspect-ratio: 1 / 1;
}

.favorite-main:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 
        0 35px 70px rgba(0,0,0,0.22),
        0 20px 40px rgba(0,0,0,0.18),
        inset 0 1px 0 rgba(255,255,255,0.3);
}

.favorite-image-main {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    position: relative;
    border-radius: 0px;
}

/* Imágenes laterales en grid 2x2 - MÁS CUADRADAS Y GRANDES */
.favorite-sidebar {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 15px;
    height: 100%;
}

.favorite-small {
    position: relative;
    border-radius: 0px;
    overflow: hidden;
    box-shadow: 
        0 18px 35px rgba(0,0,0,0.15),
        0 10px 20px rgba(0,0,0,0.1),
        inset 0 1px 0 rgba(255,255,255,0.2);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    aspect-ratio: 1 / 1;
    background: #fec601;
    border: 3px solid rgba(255,255,255,0.7);
}

.favorite-small:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 
        0 25px 50px rgba(0,0,0,0.2),
        0 15px 30px rgba(0,0,0,0.15),
        inset 0 1px 0 rgba(255,255,255,0.3);
}

.favorite-image-small {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    position: relative;
    border-radius: 0px;
}

/* Overlay mejorado con gradiente más suave */
.favorite-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.9) 0%,
        rgba(0,0,0,0.7) 30%,
        rgba(0,0,0,0.4) 60%,
        transparent 100%
    );
    color: white;
    padding: 25px;
    transform: translateY(100%);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    backdrop-filter: blur(2px);
}

.favorite-main:hover .favorite-overlay,
.favorite-small:hover .favorite-overlay {
    transform: translateY(0);
}

.favorite-overlay h3 {
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.favorite-overlay h4 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 8px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
}

.favorite-overlay p {
    font-size: 0.95rem;
    opacity: 0.95;
    line-height: 1.5;
    margin: 0;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

/* Botón de promociones mejorado */
.btn-promociones {
    background: linear-gradient(135deg, #d03336 0%, #e63946 50%, #ff1744 100%);
    color: white;
    padding: 18px 45px;
    font-size: 1.4rem;
    font-weight: 700;
    border: none;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-decoration: none;
    display: inline-block;
    box-shadow: 
        0 8px 20px rgba(208,51,54,0.3),
        0 4px 10px rgba(208,51,54,0.2),
        inset 0 1px 0 rgba(255,255,255,0.2);
    position: relative;
    overflow: hidden;
}

.btn-promociones::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-promociones:hover::before {
    left: 100%;
}

.btn-promociones:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 
        0 15px 35px rgba(208,51,54,0.4),
        0 8px 20px rgba(208,51,54,0.3),
        inset 0 1px 0 rgba(255,255,255,0.3);
    color: white;
    text-decoration: none;
}

.btn-promociones:active {
    transform: translateY(-2px) scale(1.02);
}

/* Responsive mejorado para 5 favoritos */
@media (max-width: 992px) {
    .favorites-section {
        padding: 60px 0;
    }
    
    .section-title-favorites {
        font-size: 3rem;
    }

    .favorites-grid {
        grid-template-columns: 1.2fr 1fr;
        gap: 25px;
    }

    .favorite-image-main {
        height: 500px;
    }

    .favorite-small {
        aspect-ratio: 1 / 1;
        height: auto;
    }
}

@media (max-width: 768px) {
    .section-title-favorites {
        font-size: 2.5rem;
    }

    .favorites-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 0 15px;
    }

    .favorite-image-main {
        height: 380px;
    }

    .favorite-small {
        aspect-ratio: 1 / 1;
        height: auto;
    }

    .favorite-sidebar {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto auto;
        gap: 15px;
    }
    
    .btn-promociones {
        font-size: 1.2rem;
        padding: 15px 35px;
    }
}

@media (max-width: 576px) {
    .favorites-section {
        padding: 50px 0;
    }
    
    .section-title-favorites {
        font-size: 2.2rem;
    }

    .favorite-image-main {
        height: 320px;
    }

    .favorite-small {
        aspect-ratio: 1 / 1;
        height: auto;
    }
    
    .favorite-sidebar {
        grid-template-columns: 1fr;
        grid-template-rows: repeat(4, auto);
    }
    
    .btn-promociones {
        font-size: 1.1rem;
        padding: 14px 30px;
    }
}

.favorite-item h5 {
    color: var(--color-texto-primario);
    font-weight: bold;
    font-size: 1.4rem;
    margin-bottom: 0.5rem;
}

/* ======================
   FOOTER WALPA
====================== */
.footer-walpa {
    background: #1a0b0a; /* Marrón oscuro */
    color: #ffffff;
    font-family: 'Inter', sans-serif;
    padding: 60px 0 30px;
}

.footer-walpa h5 {
    color: #D4AF37; /* Dorado */
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Links */
.footer-walpa a {
    color: #ffffff;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 8px;
    position: relative;
    transition: color 0.3s ease;
}

.footer-walpa a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 0;
    height: 2px;
    background: #D4AF37;
    transition: width 0.3s ease;
}

.footer-walpa a:hover {
    color: #D4AF37;
}

.footer-walpa a:hover::after {
    width: 100%;
}

/* Textos */
.footer-walpa p {
    margin-bottom: 6px;
    font-size: 0.95rem;
}

/* Divider */
.footer-walpa hr {
    border-color: rgba(255,255,255,0.1);
}

/* Social icons */
.footer-walpa .social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    margin-right: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.footer-walpa .social-icons a:hover {
    background: #D4AF37;
    color: #1a0b0a;
    transform: translateY(-3px);
}

/* Copy */
.footer-walpa .text-center p {
    font-size: 0.85rem;
    margin: 0;
    color: rgba(255,255,255,0.7);
}

/* Responsive */
@media (max-width: 768px) {
    .footer-walpa {
        text-align: center;
    }
    .footer-walpa .social-icons {
        margin-top: 15px;
    }
}



.social-icons a {
    color: var(--color-texto-terciario);
    font-size: 1.8rem;
    margin: 0 0.8rem;
    transition: all 0.3s ease;
    display: inline-block;
}

.social-icons a:hover {
    color: var(--color-texto-cuaternario);
    transform: translateY(-3px);
}

.btn-secondary-walpa {
    background-color: var(--color-fondo-secundario);
    color: var(--color-texto-cuaternario);
    border: none;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    transition: all 0.3s ease;
    font-size: 0.8rem;
    text-decoration: none;
    white-space: nowrap;
}

.btn-secondary-walpa:hover {
    background-color: #b02a2d;
    color: var(--color-texto-cuaternario);
    text-decoration: none;
}

.navbar-walpa .dropdown-toggle::after {
    margin-left: 0.5rem;
}

.alert-success {
    background-color: #FFF8E1;
    border-color: var(--color-borde-terciario);
    color: var(--color-texto-primario);
}

.alert-danger {
    background-color: #FFEBEE;
    border-color: var(--color-borde-secundario);
    color: var(--color-texto-secundario);
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 2rem;
    height: 2rem;
}

.carousel-indicators {
    bottom: 2rem;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin: 0 5px;
}

.navbar-toggler {
    border-color: var(--color-borde-terciario);
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28254, 198, 1, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* SOCIAL POSTS - 3 COLUMNAS SIEMPRE VISIBLES */
.social-community-section .container {
    max-width: 1400px;
    padding: 0 2rem;
}

.social-community-section .row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    padding: 0.5rem 0;
    margin: 0;
}

.social-community-section .col-md-4 {
    padding: 0;
    margin: 0;
    width: 100%;
    max-width: 100%;
}

.social-post-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    display: flex;
    flex-direction: column;
    height: 550px;
    margin: 0;
    width: 100%;
}

.social-post-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

.walpa-logo {
    position: absolute;
    top: 15px;
    left: 15px;
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    z-index: 10;
}

.logo-inner {
    width: 40px;
    height: 40px;
    background: #fec601;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #210303;
    font-weight: bold;
    font-size: 1.2rem;
}

.logo-text {
    position: absolute;
    bottom: -18px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 7px;
    color: #666;
    text-align: center;
    line-height: 1;
}

.social-post-media {
    flex: 1; /* ✅ ocupa todo el espacio disponible */
    position: relative;
    overflow: hidden;
}


.social-image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}

.social-post-media iframe,
.social-post-media video {
    width: 100%;
    height: auto;
    object-fit: contain; /* 🔹 muestra todo el contenido sin recortar */
    border: none;
}

.video-placeholder {
    background: linear-gradient(135deg, #333, #555);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
}

.overlay-text {
    position: absolute;
    left: 0;
    right: 0;
    color: white;
    font-weight: bold;
    font-size: 2rem;
    text-shadow: 3px 3px 6px rgba(0,0,0,0.8);
    padding: 1.5rem;
    text-align: center;
    text-transform: uppercase;
}

.overlay-top { top: 25px; }
.overlay-center { top: 50%; transform: translateY(-50%); }
.overlay-bottom { bottom: 25px; }

.social-post-footer {
    padding: 0.8rem 1rem;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    height: auto; /* ✅ se adapta */
    min-height: 60px; /* opcional si quieres un mínimo */
}

.social-button {
    border: none;
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: bold;
    color: white;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-size: 15px;
}

.social-button:hover {
    transform: translateY(-2px);
    color: white;
    opacity: 0.9;
}

/* Responsive */
@media (max-width: 991px) {
    /* Navbar colapsado en móvil */
    .navbar-collapse {
        background-color: var(--color-fondo-primario);
        padding: 1rem;
        margin-top: 1rem;
        border-radius: 10px;
    }
    
    .navbar-nav {
        margin-bottom: 1rem;
    }
    
    .nav-link {
        padding: 0.5rem 0;
        margin: 0;
    }
    
    /* Botones en el navbar móvil */
    .navbar-collapse .d-flex {
        flex-direction: column;
        align-items: stretch !important;
        gap: 0.5rem;
    }
    
    .navbar-collapse .d-flex > span {
        text-align: center;
        margin: 0 0 0.5rem 0 !important;
        font-size: 0.9rem;
    }
    
    .btn-secondary-walpa {
        width: 100%;
        text-align: center;
        margin: 0.25rem 0 !important;
        padding: 0.6rem 1rem;
        white-space: normal;
    }
    
    .dropdown {
        width: 100%;
    }
    
    .dropdown .nav-link {
        width: 100%;
        text-align: left;
    }
    
    .delivery-dropdown {
        width: 100%;
        text-align: left;
        padding: 0.5rem 1rem !important;
    }
}

@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.8rem;
    }
    
    .slider-content h2 {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2rem;
        padding: 2rem;
    }
    
    .favorite-image {
        width: 180px;
        height: 180px;
    }
    
    .hero-slider,
    .hero-slider .carousel-item,
    .slider-item {
        height: 50vh; /* Menos altura en móviles */
    }
    
    /* Social Posts - 3 columnas más pequeñas en tablets */
    .social-community-section .container {
        padding: 0 1rem;
    }
    
    .social-community-section .row {
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    .social-post-card {
        height: 420px;
    }
    
    .walpa-logo {
        width: 45px;
        height: 45px;
        top: 10px;
        left: 10px;
    }
    
    .logo-inner {
        width: 32px;
        height: 32px;
        font-size: 0.9rem;
    }
    
    .social-button {
        padding: 10px 20px;
        font-size: 14px;
    }
}

.locations-section {
    background: #210303;
    padding: 20px 60px;
    position: relative;
    overflow: visible;
}

.locations-section::before {
    content: none;
}

.locations-title {
    text-align: center;
    margin-bottom: 15px;
    position: relative;
    z-index: 10;
    font-size: 3rem;
    font-weight: 900;
    color: #fec601;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    letter-spacing: -1px;
}

.locations-subtitle {
    font-size: 1.2rem;
    font-weight: 400;
    color: rgba(255,255,255,0.8);
    margin-top: 5px;
    font-style: italic;
}

/* CONTENEDOR - MÁS GRANDE PARA IMAGEN */
.locations-carousel-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0;
    overflow: visible;
    position: relative;
}

/* CAROUSEL - SIN ESTILOS DE BOOTSTRAP */
#locationsCarousel {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #210303;
    border-radius: 0 !important;
}
#locationsCarousel .carousel-inner {
    display: flex;
    overflow: hidden;
    background: #210303;
    border-radius: 0 !important;
}
#locationsCarousel .carousel-item {
    flex: 0 0 100%;
    max-width: 100%;
    margin: 0;
    padding: 0;
    display: none;
    background: #210303;
    border-radius: 0 !important;
    transition: transform 0.6s ease-in-out;
}
#locationsCarousel .carousel-item.active {
    display: block;
}

/* TARJETA DE UBICACIÓN - LAYOUT HORIZONTAL (2 COLUMNAS IGUALES) */
.location-card {
    background: transparent;
    border: none;
    box-shadow: none;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    align-items: stretch;
    padding: 0;
    margin: 0 0 60px 0;
    width: 100%;
    border-radius: 0 !important;
    min-height: 800px;
}

/* IMAGEN - COLUMNA IZQUIERDA COMPLETA */
.location-image {
    width: 100%;
    height: 100%;
    min-height: 800px;
    border-radius: 0 !important;
    overflow: hidden;
    margin: 0;
    padding: 0;
    background: #000;
}
.location-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0 !important;
    display: block;
}

/* INFO - COLUMNA DERECHA */
.location-info {
    padding: 40px;
    background: #fff;
    margin: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    border-radius: 0 !important;
}
.location-name {
    font-size: 2.5rem;
    font-weight: 900;
    color: #210303;
    text-transform: uppercase;
    margin-bottom: 15px;
    letter-spacing: 1px;
    text-align: left;
}
.location-address {
    font-size: 1.3rem;
    color: #666;
    margin-bottom: 20px;
    text-align: left;
}

/* BOTONES - ALINEADOS A LA IZQUIERDA */
.location-actions {
    display: flex;
    justify-content: flex-start;
    gap: 15px;
    flex-wrap: wrap;
}
.location-btn {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: #fff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}
.whatsapp-btn {
    background: linear-gradient(135deg, #25d366, #128c7e);
}
.maps-btn {
    background: linear-gradient(135deg, #4285f4, #34a853);
}
.location-btn:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 12px 35px rgba(0,0,0,0.4);
}

/* CONTROLES - FUERA DE LA IMAGEN */
.locations-control-prev,
.locations-control-next {
    position: absolute;
    top: 40%;
    transform: translateY(-50%);
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fec601, #e6b800);
    border: none;
    color: #2c1810;
    font-size: 1.4rem;
    font-weight: bold;
    box-shadow: 0 8px 25px rgba(254,198,1,0.4);
    transition: all 0.3s ease;
    z-index: 100;
}
.locations-control-prev:hover,
.locations-control-next:hover {
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 12px 35px rgba(254,198,1,0.5);
}
.locations-control-prev { left: -80px; }
.locations-control-next { right: -80px; }

/* INDICADORES */
.locations-indicators {
    position: absolute;
    bottom: -45px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    list-style: none;
}
.locations-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    border: 2px solid #fec601;
}
.locations-indicators button.active {
    background: #fec601;
    transform: scale(1.3);
}

/* CTA */
.locations-cta {
    text-align: center;
    margin-top: 30px;
}
.btn-all-locations {
    background: linear-gradient(135deg, #fec601, #e6b800);
    color: #2c1810;
    padding: 15px 35px;
    font-size: 1.3rem;
    font-weight: 700;
    border-radius: 50px;
    text-transform: uppercase;
    box-shadow: 0 8px 25px rgba(254,198,1,0.3);
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .location-card {
        grid-template-columns: 1fr;
        min-height: auto;
        gap: 0;
    }
    
    .location-image {
        height: 450px;
        border-radius: 20px 20px 0 0;
    }
    
    .location-info {
        border-radius: 0 0 20px 20px;
    }
    
    .location-name {
        font-size: 2.2rem;
    }
    
    .location-address {
        font-size: 1.2rem;
    }
    
    .locations-control-prev { left: -60px; }
    .locations-control-next { right: -60px; }
}
@media (max-width: 768px) {
    .location-image {
        height: 350px;
    }
    
    .location-info {
        padding: 30px;
    }
    
    .location-name {
        font-size: 2rem;
    }
    
    .location-address {
        font-size: 1.1rem;
    }
    
    .locations-control-prev { left: -50px; }
    .locations-control-next { right: -50px; }
}
@media (max-width: 576px) {
    .locations-carousel-container {
        padding: 0 20px;
    }
    
    .location-image {
        height: 280px;
    }
    
    .location-info {
        padding: 20px;
    }
    
    .location-name {
        font-size: 1.6rem;
        margin-bottom: 15px;
    }
    
    .location-address {
        font-size: 1rem;
        margin-bottom: 20px;
    }
    
    .location-btn {
        width: 55px;
        height: 55px;
        font-size: 1.5rem;
    }
    
    .locations-control-prev,
    .locations-control-next {
        display: none;
    }
    
    .btn-all-locations {
        padding: 15px 35px;
        font-size: 1.1rem;
    }
}

/* ============================================
   ESTILOS ESPECÍFICOS PARA HOME - CARRUSEL VERTICAL MEJORADO
   ============================================ */
.home-location-card {
    background: #210303;
    border: 5px solid #210303;
    box-shadow: 0 25px 70px rgba(33,3,3,0.5), 0 10px 40px rgba(0,0,0,0.5);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px;
    margin: 0 auto;
    max-width: 650px;
    border-radius: 30px;
    overflow: hidden;
    position: relative;
}

.home-location-image {
    width: 100%;
    height: 520px;
    position: relative;
    overflow: hidden;
    border-radius: 22px 22px 0 0;
    z-index: 1;
}

.home-location-image::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(to top, #210303, transparent);
    z-index: 1;
}

.home-location-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.home-location-card:hover .home-location-image img {
    transform: scale(1.05);
}

.home-location-info {
    padding: 30px 25px;
    background: #210303;
    text-align: center;
    width: 100%;
    position: relative;
    z-index: 1;
}

.home-location-name {
    font-size: 2.8rem;
    font-weight: 900;
    background: linear-gradient(135deg, #fec601 0%, #ffdd44 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-transform: uppercase;
    margin-bottom: 15px;
    letter-spacing: 2px;
    text-shadow: 0 4px 10px rgba(254,198,1,0.3);
    position: relative;
    display: inline-block;
}

.home-location-name::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: #fec601;
    border-radius: 2px;
}

.home-location-address {
    font-size: 1.5rem;
    color: #fff;
    margin-bottom: 20px;
    margin-top: 10px;
    font-weight: 400;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.home-location-actions {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.home-location-btn {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #210303;
    background: linear-gradient(135deg, #fec601 0%, #ffdd44 100%);
    box-shadow: 0 10px 30px rgba(254,198,1,0.4), 
                inset 0 -2px 10px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 3px solid #210303;
    position: relative;
    overflow: hidden;
}

.home-location-btn::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
    transform: scale(0);
    transition: transform 0.5s ease;
}

.home-location-btn:hover::before {
    transform: scale(1);
}

.home-location-btn:hover {
    transform: translateY(-5px) scale(1.15) rotate(5deg);
    box-shadow: 0 15px 40px rgba(254,198,1,0.6),
                0 0 30px rgba(254,198,1,0.4),
                inset 0 -2px 10px rgba(0,0,0,0.1);
}

/* CONTROLES DEL CARRUSEL HOME - MEJORADOS */
.home-locations-control-prev,
.home-locations-control-next {
    position: absolute;
    top: 40%;
    transform: translateY(-50%);
    width: 65px;
    height: 65px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fec601 0%, #ffdd44 100%);
    border: 4px solid #210303;
    color: #210303;
    font-size: 1.6rem;
    font-weight: bold;
    box-shadow: 0 10px 30px rgba(254,198,1,0.5),
                0 0 20px rgba(254,198,1,0.3),
                inset 0 -2px 10px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 1;
    backdrop-filter: blur(10px);
}

.home-locations-control-prev:hover,
.home-locations-control-next:hover {
    transform: translateY(-50%) scale(1.2);
    box-shadow: 0 15px 40px rgba(254,198,1,0.7),
                0 0 40px rgba(254,198,1,0.5),
                inset 0 -2px 10px rgba(0,0,0,0.1);
    background: linear-gradient(135deg, #ffdd44 0%, #fec601 100%);
}

.home-locations-control-prev:active,
.home-locations-control-next:active {
    transform: translateY(-50%) scale(1.05);
}

.home-locations-control-prev { 
    left: 20px;
}

.home-locations-control-next { 
    right: 20px;
}

.home-locations-control-prev i,
.home-locations-control-next i {
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

/* INDICADORES HOME - OCULTOS */
.home-locations-indicators {
    display: none !important;
}

/* RESPONSIVE PARA CARRUSEL DE LOCALES HOME */
@media (max-width: 992px) {
    .locations-section {
        padding: 60px 40px;
    }
    
    .locations-title {
        font-size: 2.5rem;
        margin-bottom: 40px;
    }
    
    .locations-subtitle {
        font-size: 1.1rem;
    }
    
    .home-location-card {
        max-width: 580px;
        border-radius: 25px;
        border-width: 4px;
    }
    
    .home-location-image {
        height: 450px;
    }
    
    .home-location-info {
        padding: 45px 35px;
    }
    
    .home-location-name {
        font-size: 2.3rem;
    }
    
    .home-location-address {
        font-size: 1.35rem;
    }
    
    .home-location-btn {
        width: 62px;
        height: 62px;
        font-size: 1.75rem;
    }
    
    .home-locations-control-prev,
    .home-locations-control-next {
        width: 58px;
        height: 58px;
        font-size: 1.45rem;
    }
}

@media (max-width: 768px) {
    .locations-section {
        padding: 50px 30px;
    }
    
    .locations-title {
        font-size: 2.2rem;
        margin-bottom: 35px;
    }
    
    .locations-subtitle {
        font-size: 1rem;
    }
    
    .home-location-card {
        max-width: 520px;
        border-radius: 22px;
        border-width: 4px;
        padding: 6px;
    }
    
    .home-location-image {
        height: 380px;
        border-radius: 18px 18px 0 0;
    }
    
    .home-location-info {
        padding: 38px 28px;
    }
    
    .home-location-name {
        font-size: 2rem;
        letter-spacing: 1.5px;
    }
    
    .home-location-address {
        font-size: 1.25rem;
        margin-bottom: 28px;
    }
    
    .home-location-actions {
        gap: 28px;
    }
    
    .home-location-btn {
        width: 58px;
        height: 58px;
        font-size: 1.65rem;
        border-width: 2.5px;
    }
    
    .home-locations-control-prev,
    .home-locations-control-next {
        width: 52px;
        height: 52px;
        font-size: 1.35rem;
        border-width: 3px;
    }
    
    .home-locations-control-prev {
        left: 15px;
    }
    
    .home-locations-control-next {
        right: 15px;
    }
    
    .btn-all-locations {
        padding: 16px 40px;
        font-size: 1.2rem;
    }
}

@media (max-width: 576px) {
    .locations-section {
        padding: 40px 20px;
    }
    
    .locations-title {
        font-size: 1.8rem;
        margin-bottom: 30px;
        letter-spacing: 0;
    }
    
    .locations-subtitle {
        font-size: 0.95rem;
    }
    
    .locations-carousel-container {
        padding: 0 10px;
    }
    
    .home-location-card {
        max-width: 100%;
        border-radius: 18px;
        border-width: 3px;
        padding: 5px;
    }
    
    .home-location-image {
        height: 280px;
        border-radius: 15px 15px 0 0;
    }
    
    .home-location-info {
        padding: 30px 20px;
    }
    
    .home-location-name {
        font-size: 1.6rem;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }
    
    .home-location-address {
        font-size: 1.05rem;
        margin-bottom: 22px;
    }
    
    .home-location-actions {
        gap: 22px;
    }
    
    .home-location-btn {
        width: 52px;
        height: 52px;
        font-size: 1.45rem;
        border-width: 2px;
    }
    
    .home-locations-control-prev,
    .home-locations-control-next {
        width: 46px;
        height: 46px;
        font-size: 1.15rem;
        border-width: 3px;
    }
    
    .home-locations-control-prev {
        left: 8px;
    }
    
    .home-locations-control-next {
        right: 8px;
    }
    
    .btn-all-locations {
        padding: 14px 32px;
        font-size: 1.05rem;
        width: 90%;
        max-width: 320px;
    }
}

@media (max-width: 400px) {
    .locations-title {
        font-size: 1.5rem;
    }
    
    .locations-subtitle {
        font-size: 0.85rem;
    }
    
    .home-location-card {
        border-radius: 15px;
        border-width: 2px;
        padding: 4px;
    }
    
    .home-location-image {
        height: 240px;
        border-radius: 12px 12px 0 0;
    }
    
    .home-location-info {
        padding: 25px 18px;
    }
    
    .home-location-name {
        font-size: 1.4rem;
    }
    
    .home-location-address {
        font-size: 0.95rem;
        margin-bottom: 20px;
    }
    
    .home-location-actions {
        gap: 18px;
    }
    
    .home-location-btn {
        width: 48px;
        height: 48px;
        font-size: 1.3rem;
    }
    
    .home-locations-control-prev,
    .home-locations-control-next {
        width: 42px;
        height: 42px;
        font-size: 1.05rem;
    }
    
    .btn-all-locations {
        padding: 12px 28px;
        font-size: 0.95rem;
        width: 95%;
    }
}

.social-widget-floating {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1000;
    transition: all 0.3s ease;
}

.social-widget-left {
    left: 20px;
}

.social-widget-right {
    right: 20px;
}

.social-icons-vertical {
    display: flex;
    flex-direction: column;
    border-radius: 30px;
    padding: 15px 0;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 65px;
    height: 65px;
    margin: 10px 0;
    background: #210303;
    color: white;
    text-decoration: none;
    border-radius: 50%;
    transition: all 0.3s ease;
    font-size: 26px;
    border: none;
}

.social-icon:hover {
    background: #3a0808;
    color: white;
    transform: scale(1.15);
    text-decoration: none;
}

/* Responsive Widget */
@media (max-width: 768px) {
    .social-widget-floating {
        bottom: 20px;
        top: auto;
        left: 50%;
        right: auto;
        transform: translateX(-50%);
    }

    .social-icons-vertical {
        flex-direction: row;
        border-radius: 30px;
        padding: 0 15px;
    }

    .social-icon {
        margin: 0 8px;
        width: 50px;
        height: 50px;
        font-size: 20px;
    }

    /* Dropdown Pedir Online */
.delivery-dropdown {
    background: linear-gradient(135deg, #4CAF50, #45a049) !important;
    color: white !important;
    border-radius: 20px !important;
    padding: 0.5rem 1.2rem !important;
    margin: 0 0.5rem !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
}

.delivery-dropdown:hover {
    background: linear-gradient(135deg, #45a049, #4CAF50) !important;
    color: white !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3) !important;
}

.delivery-dropdown-menu {
    background: white !important;
    border: none !important;
    border-radius: 12px !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    padding: 8px 0 !important;
    margin-top: 8px !important;
    min-width: 220px !important;
}

.delivery-platform-link {
    display: flex !important;
    align-items: center !important;
    padding: 12px 18px !important;
    color: #333 !important;
    text-decoration: none !important;
    transition: all 0.3s ease !important;
    font-weight: 600 !important;
    border-bottom: 1px solid #f0f0f0 !important;
}

.delivery-platform-link:last-child {
    border-bottom: none !important;
}

.delivery-platform-link:hover {
    background: #f8f9fa !important;
    color: #4CAF50 !important;
    text-decoration: none !important;
    transform: translateX(5px) !important;
}

.delivery-platform-img {
    width: 20px !important;
    height: 20px !important;
    max-width: 20px !important;
    max-height: 20px !important;
    min-width: 20px !important;
    min-height: 20px !important;
    object-fit: cover !important;
    border-radius: 3px !important;
    margin-right: 8px !important;
    border: 1px solid #ddd !important;
    display: inline-block !important;
    vertical-align: middle !important;
    flex-shrink: 0 !important;
}



/* Responsive para móviles */
@media (max-width: 991px) {
    .delivery-dropdown {
        background: transparent !important;
        color: var(--color-texto-cuaternario) !important;
        border-radius: 0 !important;
        padding: 0.5rem 0 !important;
        margin: 0 !important;
        width: 100%;
        text-align: left;
    }
    
    .delivery-dropdown:hover {
        background: rgba(76, 175, 80, 0.1) !important;
        transform: none !important;
        box-shadow: none !important;
    }
    
    .delivery-dropdown-menu {
        position: static !important;
        float: none !important;
        width: 100% !important;
        margin-top: 0 !important;
        background: rgba(255,255,255,0.95) !important;
        border-radius: 8px !important;
    }
    
    .delivery-platform-link {
        padding: 10px 15px !important;
    }
    
    /* Social Posts en tablets - mantener 3 columnas */
    .social-community-section .container {
        padding: 0 1rem;
    }
    
    .social-community-section .row {
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        padding: 1.5rem 0;
    }
    
    .social-post-card {
        height: 400px;
    }
    
    .walpa-logo {
        width: 45px;
        height: 45px;
        top: 10px;
        left: 10px;
    }
    
    .logo-inner {
        width: 30px;
        height: 30px;
        font-size: 0.85rem;
    }
    
    .social-button {
        padding: 8px 15px;
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    /* Social Posts en móviles - 1 columna centrada */
    .social-community-section .container {
        padding: 0 1rem;
    }
    
    .social-community-section .row {
        grid-template-columns: 1fr;
        gap: 1rem;
        padding: 1rem 0;
    }
    
    .social-post-card {
        height: 500px;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .walpa-logo {
        width: 50px;
        height: 50px;
    }
    
    .logo-inner {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
}


}
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-walpa">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo1.png') }}" alt="Walpa" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('locations') }}">NUESTRA CARTA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('locations') }}">PROMOCIONES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('catering') }}">CORPORATIVOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('locations') }}">LOCALES</a>
                    </li>
                    @php $deliveryPlatforms = \App\Models\DeliveryPlatform::active()->get(); @endphp
                    @if($deliveryPlatforms->count() > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle delivery-dropdown" href="#" id="pedirOnlineDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-motorcycle me-1"></i>ONLINE APLICACIONES
                        </a>
                        <ul class="dropdown-menu delivery-dropdown-menu">
                            @foreach($deliveryPlatforms as $platform)
                            <li>
                                <a class="dropdown-item delivery-platform-link" href="{{ $platform->link }}" target="_blank">
                                    <img src="{{ $platform->image_url }}" alt="{{ $platform->name }}" class="delivery-platform-img" style="width: 20px !important; height: 20px !important; max-width: 20px !important; max-height: 20px !important; object-fit: cover !important;">
                                    {{ $platform->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                </ul>
                
                <div class="d-flex align-items-center">
                    <span class="text-white me-3" style="font-size: 0.85rem; font-weight: 500; white-space: nowrap;">ELIGE TU EXPERIENCIA:</span>
                    <a href="{{ url('/catering') }}" class="btn btn-secondary-walpa me-2">RESERVA ONLINE</a>
                    <a href="{{ route('opportunities.index') }}" class="btn btn-secondary-walpa me-3">OPORTUNIDADES</a>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="ubicacionDropdown" role="button" data-bs-toggle="dropdown" style="font-weight: 500; white-space: nowrap;">
                            MI UBICACIÓN
                        </a>
                        <ul class="dropdown-menu">
                            @forelse($locations as $location)
                                <li>
                                    <a class="dropdown-item" href="{{ $location->maps_url ?? '#' }}">
                                        {{ $location->name }}
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item text-muted">No hay locales registrados</span></li>
                            @endforelse
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer-walpa">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('images/logo1.png') }}" alt="Walpa" height="60">
            </div>
            <div class="col-md-2">
                <h5>EMPRESA</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/empresa') }}">Nuestra empresa</a></li>
                    <li><a href="{{ url('/locales') }}">Sedes</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>ATENCIÓN AL CLIENTE</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/catering') }}">Reservar</a></li>
                    <li><a href="{{ url('/catering') }}">Nuestros clientes</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>OPORTUNIDAD</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/oportunidades#comercial') }}">Hagamos negocios</a></li>
                    <li><a href="{{ url('/oportunidades#proveedores') }}">Sé proveedor</a></li>
                    <li><a href="{{ url('/oportunidades#comercial') }}">Trabaja con nosotros</a></li>
                </ul>
            </div>
            @php $contact = \App\Models\ContactInfo::first(); @endphp
            <div class="col-md-3">
                <h5>CONTACTO</h5>
                <p>Atención: {{ $contact->schedule }}</p>
                <p>{{ $contact->address }} - {{ $contact->phone }}</p>
                <p>{{ $contact->email }}</p>
                <div class="social-icons">
                    @if($contact->facebook)<a href="{{ $contact->facebook }}"><i class="fab fa-facebook"></i></a>@endif
                    @if($contact->instagram)<a href="{{ $contact->instagram }}"><i class="fab fa-instagram"></i></a>@endif
                    @if($contact->tiktok)<a href="{{ $contact->tiktok }}"><i class="fab fa-tiktok"></i></a>@endif
                    @if($contact->linkedin)<a href="{{ $contact->linkedin }}"><i class="fab fa-linkedin"></i></a>@endif
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p>&copy; {{ date('Y') }} TODOS LOS DERECHOS RESERVADOS</p>
        </div>
    </div>
</footer>
    @php $socialWidget = \App\Models\SocialWidget::getActive(); @endphp
    @if($socialWidget)
        <div class="social-widget-floating social-widget-{{ $socialWidget->position }}">
            <div class="social-icons-vertical">
                
                @if(!empty($socialWidget->social_links['facebook']))
                    <a href="{{ $socialWidget->social_links['facebook'] }}" target="_blank" class="social-icon" title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                @endif
                @if(!empty($socialWidget->social_links['instagram']))
                    <a href="{{ $socialWidget->social_links['instagram'] }}" target="_blank" class="social-icon" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                @endif
                @if(!empty($socialWidget->social_links['tiktok']))
                    <a href="{{ $socialWidget->social_links['tiktok'] }}" target="_blank" class="social-icon" title="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                @endif
                @if(!empty($socialWidget->social_links['linkedin']))
                    <a href="{{ $socialWidget->social_links['linkedin'] }}" target="_blank" class="social-icon" title="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                @endif
                @if(!empty($socialWidget->social_links['twitter']))
                    <a href="{{ $socialWidget->social_links['twitter'] }}" target="_blank" class="social-icon" title="Twitter/X">
                        <i class="fab fa-times"></i>
                    </a>
                @endif
            </div>
        </div>
    @endif

    @include('components.promotional-popup')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>