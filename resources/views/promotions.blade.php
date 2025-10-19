@extends('layouts.app')

@section('content')
<div class="promotions-page">
    <!-- Header -->
    <div class="promotions-header text-center py-5">
        <h1 class="display-4 text-white">Promociones</h1>
        <p class="lead text-white">Descubre nuestras ofertas especiales y promociones exclusivas</p>
    </div>

    <div class="container py-5">
        @if($promotions->count() > 0)
            <!-- Grid de Promociones -->
            <div class="row g-4">
                @foreach($promotions as $promotion)
                    <div class="col-lg-4 col-md-6 mb-4">
                        @if($promotion->link)
                            <a href="{{ $promotion->link }}" target="_blank" class="text-decoration-none">
                        @endif
                        
                        <div class="promotion-item">
                            <!-- Imagen -->
                            <div class="promotion-image-container">
                                @if($promotion->image)
                                    <img src="{{ asset('storage/promotions/' . $promotion->image) }}" 
                                         class="promotion-image" 
                                         alt="{{ $promotion->title }}">
                                @else
                                    <div class="placeholder-image d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif

                                <!-- Overlay con hover effect -->
                                <div class="promotion-overlay">
                                    <div class="overlay-content">
                                        @if($promotion->link)
                                            <i class="fas fa-external-link-alt fa-2x text-white"></i>
                                            <p class="text-white mt-2 mb-0">Ver más</p>
                                        @else
                                            <i class="fas fa-eye fa-2x text-white"></i>
                                            <p class="text-white mt-2 mb-0">Ver detalles</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Contenido de la tarjeta -->
                            <div class="promotion-content">
                                <h5 class="promotion-title">{{ $promotion->title }}</h5>
                                
                                @if($promotion->description)
                                    <p class="promotion-description">
                                        {{ $promotion->description }}
                                    </p>
                                @endif

                                <!-- Fechas de vigencia -->
                                @if($promotion->start_date || $promotion->end_date)
                                    <div class="promotion-dates">
                                        <small>
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            @if($promotion->start_date && $promotion->end_date)
                                                Válido del {{ $promotion->start_date->format('d/m/Y') }} al {{ $promotion->end_date->format('d/m/Y') }}
                                            @elseif($promotion->start_date)
                                                Válido desde {{ $promotion->start_date->format('d/m/Y') }}
                                            @elseif($promotion->end_date)
                                                Válido hasta {{ $promotion->end_date->format('d/m/Y') }}
                                            @endif
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($promotion->link)
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Llamada a la acción -->
            <div class="text-center mt-5">
                <div class="cta-section py-4">
                    <h3 class="text-walpa mb-3">¿Te interesan nuestras promociones?</h3>
                    <p class="text-muted mb-4">Visita cualquiera de nuestros locales y disfruta de estas increíbles ofertas</p>
                    <a href="{{ route('locations') }}" class="btn btn-walpa btn-lg">
                        <i class="fas fa-map-marker-alt me-2"></i>Ver Nuestros Locales
                    </a>
                </div>
            </div>
        @else
            <!-- Estado vacío -->
            <div class="empty-state text-center py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <i class="fas fa-percentage fa-4x text-muted mb-4"></i>
                            <h3 class="text-muted mb-3">No hay promociones disponibles</h3>
                            <p class="text-muted mb-4">
                                Por el momento no tenemos promociones activas, pero pronto tendremos ofertas increíbles para ti.
                            </p>
                            <a href="{{ route('menu') }}" class="btn btn-walpa me-3">
                                <i class="fas fa-utensils me-2"></i>Ver Nuestra Carta
                            </a>
                            <a href="{{ route('locations') }}" class="btn btn-outline-walpa">
                                <i class="fas fa-map-marker-alt me-2"></i>Nuestros Locales
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- CSS personalizado -->
<style>
.promotions-page {
    background: #fec601;
    min-height: 100vh;
    position: relative;
}

.promotions-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(255,255,255,0.12) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255,255,255,0.08) 0%, transparent 50%);
    pointer-events: none;
}

.promotions-header {
    background: #210303;
    color: #fec601;
    margin-bottom: 0;
    position: relative;
    padding: 4rem 0;
}

.promotions-header h1 {
    color: #fec601;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.promotions-header p {
    color: rgba(254,198,1,0.9);
}

.promotions-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 0;
    background: transparent;
}

.text-walpa {
    color: #210303 !important;
}

.btn-walpa {
    background: #210303;
    border: none;
    color: #fec601;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(33,3,3,0.4);
}

.btn-walpa:hover {
    background: #2c1810;
    color: #fec601;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(33,3,3,0.5);
}

.btn-outline-walpa {
    border: 3px solid #210303;
    color: #210303;
    background: transparent;
    font-weight: 700;
    transition: all 0.3s ease;
}

.btn-outline-walpa:hover {
    background-color: #210303;
    border-color: #210303;
    color: #fec601;
    transform: translateY(-2px);
}

.promotion-item {
    border-radius: 0 !important;
    overflow: visible;
    transition: all 0.3s ease;
    cursor: pointer;
    background: transparent;
    border: none;
    box-shadow: none;
}

.promotion-item:hover {
    transform: translateY(-5px);
}

.promotion-image-container {
    position: relative;
    height: 450px;
    overflow: hidden;
    border: 3px solid #210303;
    background: #fff;
}

.promotion-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.promotion-item:hover .promotion-image {
    transform: scale(1.05);
}

.promotion-content {
    padding: 1.5rem;
    background: white;
    border: 3px solid #210303;
    border-top: none;
}

.promotion-title {
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
    font-weight: 900;
    color: #210303;
}

.promotion-description {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #210303;
    margin-bottom: 1rem;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #dee2e6;
}

.promotion-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(33,3,3,0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.promotion-item:hover .promotion-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.overlay-content i,
.overlay-content p {
    color: #fec601;
}

.promotion-item:hover .overlay-content {
    transform: translateY(0);
}

.promotion-dates {
    border: none;
    background: #fec601;
    color: #210303;
    margin: 0 -1.5rem -1.5rem -1.5rem;
    padding: 1rem 1.5rem;
    font-weight: 700;
    font-size: 0.95rem;
    border-top: 3px solid #210303;
}

.cta-section {
    background: #210303;
    border-radius: 0 !important;
    border: 3px solid #fec601;
    padding: 3rem;
}

.cta-section h3 {
    color: #fec601 !important;
}

.cta-section p {
    color: rgba(254,198,1,0.9);
}

.empty-state {
    min-height: 60vh;
    display: flex;
    align-items: center;
}

@media (max-width: 768px) {
    .promotions-header h1 {
        font-size: 2.5rem;
    }
    
    .promotion-image-container {
        height: 250px;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .promotions-header h1 {
        font-size: 2rem;
    }
    
    .promotion-image-container {
        height: 200px;
    }
    
    .cta-section {
        margin: 0 1rem;
    }
}
</style>

<!-- JavaScript para efectos adicionales -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animación de entrada para las tarjetas
    const promotionCards = document.querySelectorAll('.promotion-card');
    
    // Configurar observer para animaciones al hacer scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1
    });

    // Aplicar animación inicial y observar
    promotionCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Efecto de click para las tarjetas con enlaces
    promotionCards.forEach(card => {
        const link = card.querySelector('a');
        if (link) {
            card.addEventListener('click', function(e) {
                if (e.target.tagName !== 'A') {
                    link.click();
                }
            });
        }
    });
});
</script>
@endsection