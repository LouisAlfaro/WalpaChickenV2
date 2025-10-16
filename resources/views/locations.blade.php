@extends('layouts.app')

@section('title', 'Nuestros Locales - Walpa')

@section('content')
<div class="locations-page">
    <div class="container">
        <!-- Título de la página -->
        <div class="page-header">
            <h1 class="page-title">Nuestros Locales</h1>
        </div>

        <!-- Grid de locales -->
        <div class="locations-grid">
            @foreach($locations as $location)
                <div class="location-card">
                    <!-- Imagen del local -->
                    <div class="location-image">
                        <img src="{{ $location->image_url }}" 
                             alt="{{ $location->name }}" 
                             loading="lazy">
                        
                        <!-- Overlay con efectos -->
                        <div class="image-overlay"></div>
                    </div>

                    <!-- Información del local -->
                    <div class="location-content">
                        <!-- Badge y título -->
                        <div class="location-header">
                            <span class="location-badge">Nuestra sede</span>
                            <h2 class="location-name">{{ $location->name ?: 'WALPA' }}</h2>
                        </div>

                        <!-- Dirección -->
                        <div class="location-details">
                            <div class="detail-item">
                                <span class="detail-label">Dirección:</span>
                                <p class="detail-text">{{ $location->address ?: 'Dirección no disponible' }}</p>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="location-actions">
                            @if($location->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $location->phone) }}" 
                                target="_blank" 
                                class="action-btn phone-btn">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>{{ $location->phone }}</span>
                                </a>
                            @endif

                            @if($location->maps_url)
                                <a href="{{ $location->maps_url }}" 
                                   target="_blank" 
                                   class="action-btn maps-btn">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Google Maps</span>
                                </a>
                            @endif

                            @if($location->menu_pdf_url)
                                <a href="{{ $location->menu_pdf_url }}" 
                                   target="_blank" 
                                   class="action-btn menu-btn">
                                    <i class="fas fa-utensils"></i>
                                    <span>Ver Carta</span>
                                </a>
                            @endif

                            <a href="#" class="action-btn promotions-btn">
                                <i class="fas fa-percent"></i>
                                <span>Ver Promociones</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($locations->count() === 0)
            <div class="no-locations">
                <div class="no-locations-icon">
                    <i class="fas fa-store"></i>
                </div>
                <h3>Próximamente nuevos locales</h3>
                <p>Estamos expandiendo nuestras ubicaciones para estar más cerca de ti.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* Página de locales - Diseño moderno */
.locations-page {
    background: linear-gradient(135deg, #fec601 0%, #f8d000 50%, #e6c200 100%);
    min-height: 100vh;
    padding: 40px 0 80px;
    position: relative;
}

.locations-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.12) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255,255,255,0.08) 0%, transparent 50%);
    pointer-events: none;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
}

/* Header de la página */
.page-header {
    margin-bottom: 50px;
    text-align: left;
}

.page-title {
    font-size: 2.8rem;
    font-weight: 900;
    color: #210303;
    margin: 0;
    position: relative;
    display: inline-block;
    padding-left: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.page-title::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 5px;
    background: linear-gradient(135deg, #210303, #2c1810);
    border-radius: 3px;
}

/* Grid de locales */
.locations-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
}

/* Tarjeta de local - MEJORADA */
.location-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 
        0 10px 40px rgba(0,0,0,0.08),
        0 2px 8px rgba(0,0,0,0.04);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: grid;
    grid-template-columns: 450px 1fr;
    position: relative;
    min-height: 380px;
}

.location-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 
        0 20px 60px rgba(0,0,0,0.12),
        0 8px 16px rgba(0,0,0,0.08);
    border-color: #210303;
}

/* Imagen del local - MEJORADA PARA MOSTRAR COMPLETA */
.location-image {
    position: relative;
    overflow: hidden;
    background: white;
    min-height: 380px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-right: 3px solid #fec601;
}

.location-image img {
    width: 95%;
    height: 95%;
    object-fit: contain;
    object-position: center;
    transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.location-card:hover .location-image img {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        135deg,
        rgba(254,198,1,0.1) 0%,
        transparent 40%,
        transparent 60%,
        rgba(33,3,3,0.1) 100%
    );
    opacity: 0;
    transition: opacity 0.4s ease;
}

.location-card:hover .image-overlay {
    opacity: 1;
}

/* Contenido del local */
.location-content {
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: white;
    position: relative;
}

.location-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 60px;
    background: linear-gradient(135deg, #210303, #2c1810);
    border-radius: 0 2px 2px 0;
}

/* Header del local */
.location-header {
    margin-bottom: 25px;
    padding-left: 20px;
}

.location-badge {
    display: inline-block;
    background: linear-gradient(135deg, #fec601, #f8d000);
    color: #210303;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
    box-shadow: 0 4px 15px rgba(254,198,1,0.4);
}

.location-name {
    font-size: 2.2rem;
    font-weight: 900;
    color: #210303;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
    line-height: 1.1;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.05);
}

/* Detalles del local */
.location-details {
    margin-bottom: 30px;
    padding-left: 20px;
}

.detail-item {
    margin-bottom: 15px;
}

.detail-label {
    display: block;
    font-size: 1rem;
    font-weight: 700;
    color: #210303;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-text {
    font-size: 1.1rem;
    color: #5a5a5a;
    line-height: 1.5;
    margin: 0;
    font-weight: 400;
}

/* Botones de acción */
.location-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 12px;
    padding-left: 20px;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 14px 18px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-align: center;
    gap: 8px;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.action-btn:hover::before {
    left: 100%;
}

.action-btn i {
    font-size: 1rem;
}

.phone-btn {
    background: linear-gradient(135deg, #25d366, #20c55b);
    color: white;
    box-shadow: 0 4px 15px rgba(37,211,102,0.3);
}

.phone-btn:hover {
    background: linear-gradient(135deg, #20c55b, #1ea351);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37,211,102,0.4);
    color: white;
}

.maps-btn {
    background: linear-gradient(135deg, #fec601, #f4d03f);
    color: #2c1810;
    box-shadow: 0 4px 15px rgba(254,198,1,0.3);
}

.maps-btn:hover {
    background: linear-gradient(135deg, #f4d03f, #f1c40f);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254,198,1,0.4);
    color: #2c1810;
}

.menu-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    box-shadow: 0 4px 15px rgba(231,76,60,0.3);
}

.menu-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(231,76,60,0.4);
    color: white;
}

.promotions-btn {
    background: linear-gradient(135deg, #d03336, #b71c1c);
    color: white;
    box-shadow: 0 4px 15px rgba(208,51,54,0.3);
}

.promotions-btn:hover {
    background: linear-gradient(135deg, #b71c1c, #9a0007);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(208,51,54,0.4);
    color: white;
}

/* Estado vacío */
.no-locations {
    text-align: center;
    padding: 80px 20px;
    max-width: 500px;
    margin: 0 auto;
}

.no-locations-icon {
    font-size: 4rem;
    color: #bdc3c7;
    margin-bottom: 25px;
}

.no-locations h3 {
    font-size: 1.8rem;
    color: #2c1810;
    margin-bottom: 15px;
    font-weight: 700;
}

.no-locations p {
    color: #7f8c8d;
    font-size: 1.1rem;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .location-card {
        grid-template-columns: 400px 1fr;
        min-height: 350px;
    }
    
    .location-image {
        min-height: 350px;
    }
}

@media (max-width: 768px) {
    .locations-page {
        padding: 30px 0 60px;
    }
    
    .page-title {
        font-size: 2.2rem;
    }
    
    .location-card {
        grid-template-columns: 1fr;
        margin: 0 10px;
        min-height: auto;
    }
    
    .location-image {
        height: 280px;
        min-height: 280px;
    }
    
    .location-content {
        padding: 30px;
    }
    
    .location-name {
        font-size: 1.8rem;
    }
    
    .location-actions {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 0 15px;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .location-content {
        padding: 25px;
    }
    
    .location-name {
        font-size: 1.6rem;
    }
    
    .location-actions {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .action-btn {
        padding: 12px 16px;
        font-size: 0.85rem;
    }
}

/* Animaciones adicionales */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.location-card {
    animation: slideInUp 0.6s ease-out;
}

.location-card:nth-child(2) {
    animation-delay: 0.1s;
}

.location-card:nth-child(3) {
    animation-delay: 0.2s;
}

.location-card:nth-child(4) {
    animation-delay: 0.3s;
}
</style>
@endsection