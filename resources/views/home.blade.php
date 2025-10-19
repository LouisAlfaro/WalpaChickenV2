@extends('layouts.app')

@section('title', 'WalpaChicken - Restaurante Auténtico')

@section('content')
@if($mainSliders->count() > 0)
<div id="heroCarousel" class="carousel slide hero-slider" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($mainSliders as $index => $slider)
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" 
                class="{{ $index === 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    
    <div class="carousel-inner">
        @foreach($mainSliders as $index => $slider)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <div class="slider-item" style="background-image: url('{{ asset('storage/' . $slider->image) }}');">
                <div class="slider-overlay">
                    <div class="slider-content">
                        <h2>{{ $slider->title }}</h2>
                        @if($slider->description)
                        <p>{{ $slider->description }}</p>
                        @endif
                        @if($slider->link)
                        <a href="{{ $slider->link }}" class="btn btn-walpa btn-lg">Ver más</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@endif

<!-- Comunidad Social Walpa (Posts Sociales) -->
@if(isset($socialPosts) && $socialPosts->count() > 0)
<div class="social-community-section">
    <div class="section-title">
        COMUNIDAD SOCIAL WALPA
    </div>

    <div class="container">
        <div class="row">
            @foreach($socialPosts as $post)
            <div class="col-md-4 mb-4">
                <div class="social-post-card">
                    <!-- Logo Walpa -->
                    <div class="walpa-logo">
                        <div class="logo-inner">W</div>
                        <div class="logo-text">
                            <small>El auténtico</small><br>
                            <small>Es auténtico</small>
                        </div>
                    </div>
                    
                    <!-- Media Content -->
                    <div class="social-post-media">
                        @if($post->media_type === 'image' && $post->image)
                            <div class="social-image" style="background-image: url('{{ asset('storage/' . $post->image) }}');"></div>
                        @elseif($post->media_type === 'video')
                            @if($post->video_file)
                                <!-- Video archivo subido -->
                                <video width="100%" height="320" autoplay muted loop playsinline>
                                    <source src="{{ asset('storage/' . $post->video_file) }}" type="video/mp4">
                                    Tu navegador no soporta videos HTML5.
                                </video>
                            @elseif($post->video_url)
                                <!-- Video desde URL -->
                                @php
                                    $videoId = null;
                                    $embedUrl = null;
                                    $platform = 'unknown';
                                    
                                    // YouTube
                                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $post->video_url, $matches)) {
                                        $videoId = $matches[1];
                                        $embedUrl = "https://www.youtube.com/embed/{$videoId}?autoplay=1&mute=1&loop=1&playlist={$videoId}";
                                        $platform = 'youtube';
                                    }
                                    // TikTok
                                    elseif (preg_match('/tiktok\.com\/.*\/video\/(\d+)/', $post->video_url, $matches)) {
                                        $videoId = $matches[1];
                                        $embedUrl = "https://www.tiktok.com/embed/v2/{$videoId}";
                                        $platform = 'tiktok';
                                    }
                                    // Instagram (Reels)
                                    elseif (preg_match('/instagram\.com\/(?:p|reel)\/([A-Za-z0-9_-]+)/', $post->video_url, $matches)) {
                                        $videoId = $matches[1];
                                        $embedUrl = "https://www.instagram.com/p/{$videoId}/embed/";
                                        $platform = 'instagram';
                                    }
                                    // Vimeo
                                    elseif (preg_match('/vimeo\.com\/(\d+)/', $post->video_url, $matches)) {
                                        $videoId = $matches[1];
                                        $embedUrl = "https://player.vimeo.com/video/{$videoId}?autoplay=1&muted=1&loop=1";
                                        $platform = 'vimeo';
                                    }
                                @endphp
                                
                                @if($embedUrl)
                                    @if($platform === 'tiktok')
                                        <!-- TikTok requiere un wrapper especial -->
                                        <div class="tiktok-wrapper" style="position: relative; width: 100%; height: 500px; max-width: 320px; margin: 0 auto;">
                                            <iframe src="{{ $embedUrl }}" 
                                                    width="100%" 
                                                    height="100%" 
                                                    frameborder="0" 
                                                    allow="encrypted-media"
                                                    style="border-radius: 12px;">
                                            </iframe>
                                        </div>
                                    @else
                                        <!-- YouTube, Instagram, Vimeo -->
                                        <iframe width="100%" height="320" 
                                                src="{{ $embedUrl }}" 
                                                frameborder="0" 
                                                allow="autoplay; encrypted-media" 
                                                allowfullscreen
                                                style="border-radius: 12px;">
                                        </iframe>
                                    @endif
                                @else
                                    <!-- Fallback: enlace directo al video -->
                                    <div class="video-link-card" onclick="window.open('{{ $post->video_url }}', '_blank')" style="cursor: pointer;">
                                        <div class="video-placeholder">
                                            <i class="fas fa-external-link-alt"></i>
                                            <p>Ver Video</p>
                                            <small>{{ parse_url($post->video_url, PHP_URL_HOST) }}</small>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="video-placeholder">
                                    <i class="fas fa-video"></i>
                                    <p>Video no disponible</p>
                                </div>
                            @endif
                        @else
                            <div class="video-placeholder">
                                <i class="fas fa-image"></i>
                                <p>Contenido multimedia</p>
                            </div>
                        @endif
                        
                        <!-- Overlay Text -->
                        @if($post->overlay_text)
                            <div class="overlay-text overlay-{{ $post->overlay_position }}">
                                {{ $post->overlay_text }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Social Button -->
                    <div class="social-post-footer">
                        @if($post->social_url)
                            <a href="{{ $post->social_url }}" 
                               target="_blank" 
                               class="social-button"
                               style="background-color: {{ $post->button_color }};">
                                <i class="{{ $post->platform_icon }}"></i>
                                {{ $post->button_text }}
                            </a>
                        @else
                            <button class="social-button"
                                    style="background-color: {{ $post->button_color }};">
                                <i class="{{ $post->platform_icon }}"></i>
                                {{ $post->button_text }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if($favorites->count() > 0)
<div class="favorites-section">
    <div class="container">
        <div class="section-title-favorites">
            Mis favoritos
            <div class="section-subtitle">Descubre nuestros mejores platillos</div>
        </div>
        
        <div class="favorites-grid">
            <!-- Imagen principal (primera favorita) -->
            <div class="favorite-main">
                <div class="favorite-image-main" style="background-image: url('{{ $favorites->first()->image_url }}');">
                    <div class="favorite-overlay">
                        <h3>{{ $favorites->first()->title ?: 'Platillo Especial' }}</h3>
                        <p>{{ $favorites->first()->description ?: 'Nuestro platillo más popular, preparado con ingredientes frescos.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Imágenes laterales (ahora 4 en lugar de 2) -->
            <div class="favorite-sidebar">
                @foreach($favorites->skip(1)->take(4) as $favorite)
                    <div class="favorite-small">
                        <div class="favorite-image-small" style="background-image: url('{{ $favorite->image_url }}');">
                            <div class="favorite-overlay">
                                <h4>{{ $favorite->title ?: 'Delicioso' }}</h4>
                                <p>{{ Str::limit($favorite->description ?: 'Sabor único e irresistible.', 50) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                @if($favorites->count() < 5)
                    @for($i = $favorites->count(); $i < 5; $i++)
                        <div class="favorite-small">
                            <div class="favorite-image-small" style="background-image: url('{{ asset('images/default-favorite.jpg') }}');">
                                <div class="favorite-overlay">
                                    <h4>Próximamente</h4>
                                    <p>Nuevos sabores en camino...</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
@endif

<!-- Sección de Promociones -->
@if($promotionSliders->count() > 0)
<div class="section-title">
    COMUNIDAD SOCIAL WALPA
</div>

<div class="container">
    <div class="row">
        @foreach($promotionSliders as $promotion)
        <div class="col-md-4 mb-4">
            <div class="promotion-card">
                <div class="promotion-image" style="background-image: url('{{ asset('storage/' . $promotion->image) }}');"></div>
                <div class="promotion-content">
                    <h5>{{ $promotion->title }}</h5>
                    @if($promotion->description)
                    <p>{{ $promotion->description }}</p>
                    @endif
                    @if($promotion->link)
                    <a href="{{ $promotion->link }}" class="btn btn-walpa">Seguir</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif


<!-- Sección Encuentra tu Walpa -->
@if($locations->count() > 0)
<div class="locations-section">
    <div class="container">
        <div class="locations-title">
            Encuentra tu Walpa más cercano
            <div class="locations-subtitle">Conoce todas nuestras sedes</div>
        </div>

        <!-- Carrousel de Ubicaciones CORREGIDO -->
        <div class="locations-carousel-container">
            <div id="locationsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000" data-bs-wrap="true" data-bs-pause="hover">
                
                <!-- Items del Carrousel -->
                <div class="carousel-inner">
                    @foreach($locations as $index => $location)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="home-location-card">
                                <!-- Imagen del Local -->
                                <div class="home-location-image">
                                    <img src="{{ $location->image_url }}" 
                                         alt="{{ $location->name }}" 
                                         loading="lazy">
                                </div>

                                <!-- Información del Local -->
                                <div class="home-location-info">
                                    <h3 class="home-location-name">{{ $location->name ?: 'WALPA CHICKEN' }}</h3>
                                    <p class="home-location-address">{{ $location->address ?: 'Dirección no disponible' }}</p>
                                    
                                    <!-- Botones de Acción -->
                                    <div class="home-location-actions">
                                        @if($location->whatsapp_url)
                                            <a href="{{ $location->whatsapp_url }}" 
                                               target="_blank" 
                                               class="home-location-btn whatsapp-btn">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif

                                        @if($location->maps_url)
                                            <a href="{{ $location->maps_url }}" 
                                               target="_blank" 
                                               class="home-location-btn maps-btn">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Controles de Navegación -->
                <button class="carousel-control-prev home-locations-control-prev" 
                        type="button" 
                        data-bs-target="#locationsCarousel" 
                        data-bs-slide="prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-control-next home-locations-control-next" 
                        type="button" 
                        data-bs-target="#locationsCarousel" 
                        data-bs-slide="next">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Indicadores -->
                <div class="carousel-indicators home-locations-indicators">
                    @foreach($locations as $index => $location)
                        <button type="button" 
                                data-bs-target="#locationsCarousel" 
                                data-bs-slide-to="{{ $index }}" 
                                class="{{ $index === 0 ? 'active' : '' }}">
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Botón Ver Todas las Sedes -->
        <div class="locations-cta" style="z-index: 999; position: relative;">
            <a href="/locales" class="btn-all-locations" style="pointer-events: auto; display: inline-block;">
                Conoce el resto de nuestras sedes
            </a>
        </div>
    </div>
</div>
@else
    <!-- Vista cuando no hay ubicaciones -->
    <div class="locations-section">
        <div class="container">
            <div class="locations-title">
                Encuentra tu Walpa más cercano
                <div class="locations-subtitle">Conoce todas nuestras sedes</div>
            </div>

            <div class="locations-carousel-container">
                <div class="location-card">
                    <div class="location-image">
                        <img src="{{ asset('images/default-location.jpg') }}" 
                             alt="Próximamente">
                    </div>
                    <div class="location-info">
                        <h3 class="location-name">PRÓXIMAMENTE</h3>
                        <p class="location-address">Nuevas ubicaciones en camino</p>
                        <div class="location-actions">
                            <span class="location-btn disabled">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <span class="location-btn disabled">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="locations-cta">
                <a href="{{ route('locations') }}" class="btn-all-locations" onclick="alert('Próximamente: Página de todas las sedes')">
                    Conoce el resto de nuestras sedes
                </a>
            </div>
        </div>
    </div>
@endif
@endsection

@section('styles')
<style>
/* Estilos para videos de redes sociales */
.tiktok-wrapper {
    background: linear-gradient(45deg, #ff0050, #00f2ea);
    padding: 3px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(255, 0, 80, 0.3);
}

.tiktok-wrapper iframe {
    background: white;
}

.video-link-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    color: white;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.video-link-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.video-link-card .video-placeholder {
    background: transparent;
    color: white;
}

.video-link-card .video-placeholder i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #FFD700;
}

.video-link-card .video-placeholder p {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.video-link-card .video-placeholder small {
    opacity: 0.8;
    font-size: 0.9rem;
}

/* Mejorar iframes de video */
iframe[src*="youtube"],
iframe[src*="vimeo"],
iframe[src*="instagram"] {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

iframe[src*="youtube"]:hover,
iframe[src*="vimeo"]:hover,
iframe[src*="instagram"]:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    transform: translateY(-2px);
}

/* Responsive para TikTok */
@media (max-width: 768px) {
    .tiktok-wrapper {
        height: 400px;
        max-width: 280px;
    }
}
</style>
@endsection

@section('scripts')
<script>
// Auto-play del carousel con transición mejorada
document.addEventListener('DOMContentLoaded', function() {
    var heroCarousel = document.querySelector('#heroCarousel');
    if (heroCarousel) {
        var carousel = new bootstrap.Carousel(heroCarousel, {
            interval: 5000,
            wrap: true,
            pause: false,
            touch: true
        });

        // Prevenir flash blanco durante transiciones
        heroCarousel.addEventListener('slide.bs.carousel', function (e) {
            var items = heroCarousel.querySelectorAll('.carousel-item');
            items.forEach(function(item) {
                item.style.backgroundColor = '#210303';
            });
        });
    }

    var locationsCarousel = document.querySelector('#locationsCarousel');
    if (locationsCarousel) {
        // Inicializar el carrusel con configuración específica
        var carousel = new bootstrap.Carousel(locationsCarousel, {
            interval: 4000,
            wrap: true,
            pause: 'hover',
            touch: true,
            ride: 'carousel'
        });

        // Prevenir flash blanco en el carrusel de locales
        locationsCarousel.addEventListener('slide.bs.carousel', function (e) {
            var items = locationsCarousel.querySelectorAll('.carousel-item');
            items.forEach(function(item) {
                item.style.backgroundColor = '#210303';
            });
        });
        
        // Asegurar que el carrusel comience automáticamente
        carousel.cycle();
    }
});
</script>
@endsection