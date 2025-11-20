@extends('layouts.app')

@section('title', 'Nuestros Deliveries - Walpa')

@section('content')
<div class="locations-page">
    <div class="container">
        <!-- Título de la página -->
        <div class="page-header">
            <h1 class="page-title">Nuestros Deliveries</h1>
        </div>

        <!-- Grid de deliveries -->
        <div class="locations-grid">
            @foreach($deliveryLocations as $location)
                <div class="location-card">
                    <!-- Imagen del delivery -->
                    <div class="location-image">
                        <img src="{{ $location->image_url }}" 
                             alt="{{ $location->name }}" 
                             loading="lazy">
                        
                        <!-- Overlay con efectos -->
                        <div class="image-overlay"></div>
                    </div>

                    <!-- Información del delivery -->
                    <div class="location-content">
                        <!-- Badge y título -->
                        <div class="location-header">
                            <span class="location-badge">Delivery</span>
                            <h2 class="location-name">{{ $location->name ?: 'WALPA' }}</h2>
                        </div>

                        <!-- Detalles -->
                        <div class="location-details">
                            @if($location->address)
                            <div class="detail-item">
                                <span class="detail-label">Dirección:</span>
                                <p class="detail-text">{{ $location->address }}</p>
                            </div>
                            @endif

                            @if($location->schedule)
                            <div class="detail-item">
                                <span class="detail-label">Horario:</span>
                                <p class="detail-text">{{ $location->schedule }}</p>
                            </div>
                            @endif

                            @if($location->description)
                            <div class="detail-item">
                                <span class="detail-label">Descripción:</span>
                                <p class="detail-text">{{ $location->description }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Botón de WhatsApp -->
                        @if($location->phone || $location->whatsapp_url)
                        <div class="location-actions">
                            @if($location->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $location->phone) }}" 
                                target="_blank" 
                                class="action-btn phone-btn">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>{{ $location->phone }}</span>
                                </a>
                            @elseif($location->whatsapp_url)
                                <a href="{{ $location->whatsapp_url }}" 
                                   target="_blank" 
                                   class="action-btn phone-btn">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>WhatsApp</span>
                                </a>
                            @endif
                        </div>
                        @endif

                        <!-- Plataformas de Delivery -->
                        @if($location->pedidosya_url || $location->didifood_url || $location->rappi_url)
                            <div class="delivery-platforms">
                                <h6 class="delivery-title">
                                    <i class="fas fa-motorcycle"></i> Pídelo en:
                                </h6>
                                <div class="platforms-grid">
                                    @if($location->pedidosya_url)
                                        <a href="{{ $location->pedidosya_url }}" 
                                           target="_blank" 
                                           class="platform-btn pedidosya-btn"
                                           title="Pedir en PedidosYa">
                                            <div class="platform-icon pedidosya-icon">
                                                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="50" cy="50" r="45" fill="#FA0050"/>
                                                    <path d="M30 35 L50 35 L70 35 L65 55 L50 55 L45 65 L35 65 Z" fill="white"/>
                                                    <circle cx="55" cy="70" r="8" fill="white"/>
                                                </svg>
                                            </div>
                                            <span>PedidosYa</span>
                                        </a>
                                    @endif

                                    @if($location->didifood_url)
                                        <a href="{{ $location->didifood_url }}" 
                                           target="_blank" 
                                           class="platform-btn didifood-btn"
                                           title="Pedir en Didi Food">
                                            <div class="platform-icon didifood-icon">
                                                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="50" cy="50" r="45" fill="#FF7F00"/>
                                                    <path d="M35 40 Q35 30 45 30 L55 30 Q65 30 65 40 L65 60 Q65 70 55 70 L45 70 Q35 70 35 60 Z" fill="white"/>
                                                    <circle cx="42" cy="45" r="4" fill="#FF7F00"/>
                                                    <circle cx="58" cy="45" r="4" fill="#FF7F00"/>
                                                </svg>
                                            </div>
                                            <span>Didi Food</span>
                                        </a>
                                    @endif

                                    @if($location->rappi_url)
                                        <a href="{{ $location->rappi_url }}" 
                                           target="_blank" 
                                           class="platform-btn rappi-btn"
                                           title="Pedir en Rappi">
                                            <div class="platform-icon rappi-icon">
                                                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="50" cy="50" r="45" fill="#FF441F"/>
                                                    <path d="M35 45 L45 35 L55 45 L65 35 L65 55 L55 65 L45 55 L35 65 Z" fill="white"/>
                                                </svg>
                                            </div>
                                            <span>Rappi</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($deliveryLocations->count() === 0)
            <div class="no-locations">
                <div class="no-locations-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3>Próximamente nuevos deliveries</h3>
                <p>Estamos expandiendo nuestras zonas de cobertura.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* Página de deliveries - Diseño moderno */
.locations-page {
    background: linear-gradient(135deg, #fec601 0%, #f8d000 50%, #e6c200 100%);
    min-height: 100vh;
    padding: 5px 0 5px;
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
    padding: 0 10px;
    position: relative;
    z-index: 2;
}

/* Header de la página */
.page-header {
    margin-bottom: 5px;
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
    top: 50%;
    transform: translateY(-50%);
    width: 6px;
    height: 80%;
    background: #d03336;
    border-radius: 3px;
}

/* Grid de tarjetas */
.locations-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0px;
}

/* Tarjeta de delivery */
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
    margin: 5px;
}

.location-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 
        0 20px 60px rgba(0,0,0,0.12),
        0 8px 16px rgba(0,0,0,0.08);
}

/* Imagen */
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
    background: linear-gradient(to bottom, transparent 0%, rgba(33, 3, 3, 0.4) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.location-card:hover .image-overlay {
    opacity: 1;
}

/* Contenido */
.location-content {
    padding: 25px;
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

.location-header {
    margin-bottom: 25px;
    padding-left: 20px;
}

.location-badge {
    display: inline-block;
    background: linear-gradient(135deg, #d03336, #ff4444);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
    box-shadow: 0 4px 15px rgba(208, 51, 54, 0.4);
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

/* Detalles */
.location-details {
    margin-bottom: 15px;
    padding-left: 20px;
}

.detail-item {
    margin-bottom: 12px;
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
    margin-bottom: 15px;
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

.phone-btn {
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
}

.phone-btn:hover {
    background: linear-gradient(135deg, #128C7E, #075E54);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
    color: white;
}

/* Plataformas de delivery */
.delivery-platforms {
    margin-top: 20px;
    padding-top: 20px;
    padding-left: 20px;
    border-top: 2px dashed #e0e0e0;
}

.delivery-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #210303;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.delivery-title i {
    color: #d03336;
}

.platforms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
    gap: 10px;
}

.platform-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 12px;
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
    color: #333;
    font-weight: 600;
    font-size: 0.85rem;
}

.platform-btn:hover {
    transform: translateY(-3px);
    border-color: transparent;
    color: white;
}

.platform-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.platform-icon svg {
    width: 100%;
    height: 100%;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
}

.pedidosya-btn:hover {
    background: linear-gradient(135deg, #FA0050, #d00045);
    box-shadow: 0 8px 20px rgba(250, 0, 80, 0.3);
}

.didifood-btn:hover {
    background: linear-gradient(135deg, #FF7F00, #e67200);
    box-shadow: 0 8px 20px rgba(255, 127, 0, 0.3);
}

.rappi-btn:hover {
    background: linear-gradient(135deg, #FF441F, #e6391a);
    box-shadow: 0 8px 20px rgba(255, 68, 31, 0.3);
}

/* Sin deliveries */
.no-locations {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(33, 3, 3, 0.1);
}

.no-locations-icon {
    font-size: 5rem;
    color: #d03336;
    margin-bottom: 20px;
}

.no-locations h3 {
    font-size: 2rem;
    font-weight: 800;
    color: #210303;
    margin-bottom: 10px;
}

.no-locations p {
    font-size: 1.1rem;
    color: #666;
}

/* Responsive */
@media (max-width: 992px) {
    .location-card {
        grid-template-columns: 1fr;
        min-height: auto;
    }
    
    .location-image {
        min-height: 300px;
        border-right: none;
        border-bottom: 3px solid #fec601;
    }
    
    .location-actions {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .location-name {
        font-size: 1.8rem;
    }
    
    .platforms-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>
@endsection
