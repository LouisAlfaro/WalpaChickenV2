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
                        <div class="promotion-card h-100">
                            @if($promotion->link)
                                <a href="{{ $promotion->link }}" target="_blank" class="text-decoration-none">
                            @endif
                            
                            <div class="card h-100 shadow-sm border-0 promotion-item">
                                <!-- Imagen -->
                                <div class="promotion-image-container">
                                    @if($promotion->image)
                                        <img src="{{ asset('storage/promotions/' . $promotion->image) }}" 
                                             class="card-img-top promotion-image" 
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
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-walpa fw-bold">{{ $promotion->title }}</h5>
                                    
                                    @if($promotion->description)
                                        <p class="card-text text-muted flex-grow-1">
                                            {{ $promotion->description }}
                                        </p>
                                    @endif

                                    <!-- Fechas de vigencia -->
                                    @if($promotion->start_date || $promotion->end_date)
                                        <div class="promotion-dates mt-auto pt-3">
                                            <small class="text-muted">
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
    background-color: #f8f9fa;
    min-height: 100vh;
}

.promotions-header {
    background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);
    color: white;
    margin-bottom: 0;
    position: relative;
}

.promotions-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50px;
    background: linear-gradient(45deg, transparent 50%, #f8f9fa 50%);
}

.text-walpa {
    color: #D4AF37 !important;
}

.btn-walpa {
    background-color: #D4AF37;
    border-color: #D4AF37;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-walpa:hover {
    background-color: #B8860B;
    border-color: #B8860B;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}

.btn-outline-walpa {
    border-color: #D4AF37;
    color: #D4AF37;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-walpa:hover {
    background-color: #D4AF37;
    border-color: #D4AF37;
    color: white;
    transform: translateY(-2px);
}

.promotion-card {
    transition: transform 0.3s ease;
}

.promotion-card:hover {
    transform: translateY(-5px);
}

.promotion-item {
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    cursor: pointer;
}

.promotion-item:hover {
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.promotion-image-container {
    position: relative;
    height: 300px;
    overflow: hidden;
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
    background: rgba(212, 175, 55, 0.85);
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

.promotion-item:hover .overlay-content {
    transform: translateY(0);
}

.promotion-dates {
    border-top: 1px solid #eee;
    background-color: #f8f9fa;
    margin: 0 -1.25rem -1.25rem;
    padding: 0.75rem 1.25rem;
}

.cta-section {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(184, 134, 11, 0.1) 100%);
    border-radius: 15px;
    border: 2px solid rgba(212, 175, 55, 0.2);
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