@extends('layouts.app')

@section('title', 'Nuestras Promociones - Walpa')

@section('content')
<div class="locations-page">
    <div class="container">
        <!-- Título de la página -->
        <div class="page-header">
            <h1 class="page-title">Nuestras Promociones</h1>
        </div>

        <!-- Grid de promociones -->
        <div class="locations-grid">
            @foreach($promotionalLocations as $location)
                <div class="location-card">
                    <!-- Imagen de la promoción -->
                    <div class="location-image">
                        <img src="{{ $location->image_url }}" 
                             alt="{{ $location->name }}" 
                             loading="lazy">
                        
                        <!-- Overlay con efectos -->
                        <div class="image-overlay"></div>
                    </div>

                    <!-- Información de la promoción -->
                    <div class="location-content">
                        <!-- Badge y título -->
                        <div class="location-header">
                            <span class="location-badge">Promoción</span>
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

                            @if($location->promotion_pdf_url)
                                <a href="{{ $location->promotion_pdf_url }}" 
                                   target="_blank" 
                                   class="action-btn promotions-btn">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>Ver Promoción</span>
                                </a>
                            @endif

                            @if($location->whatsapp_url)
                                <a href="{{ $location->whatsapp_url }}" 
                                   target="_blank" 
                                   class="action-btn phone-btn">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>WhatsApp</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($promotionalLocations->count() === 0)
            <div class="no-locations">
                <div class="no-locations-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <h3>Próximamente nuevas promociones</h3>
                <p>Estamos preparando increíbles ofertas para ti.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* Página de promociones - Diseño moderno */
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

/* Tarjeta de promoción */
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

.promotions-btn {
    background: linear-gradient(135deg, #d03336, #ff4444);
    color: white;
}

.promotions-btn:hover {
    background: linear-gradient(135deg, #a02628, #d03336);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(208, 51, 54, 0.4);
    color: white;
}

/* Sin promociones */
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
}
</style>
@endsection
