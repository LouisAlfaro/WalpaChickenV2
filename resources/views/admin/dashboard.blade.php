@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')

@section('content')
@php
// Verificar que los modelos existen antes de usarlos
$slidersCount = class_exists('\App\Models\Slider') ? \App\Models\Slider::count() : 0;
$slidersActive = class_exists('\App\Models\Slider') ? \App\Models\Slider::where('active', true)->count() : 0;
$slidersMain = class_exists('\App\Models\Slider') ? \App\Models\Slider::where('section', 'main')->count() : 0;

$favoritesCount = class_exists('\App\Models\Favorite') ? \App\Models\Favorite::count() : 0;
$favoritesActive = class_exists('\App\Models\Favorite') ? \App\Models\Favorite::where('active', true)->count() : 0;

$socialPostsCount = class_exists('\App\Models\SocialPost') ? \App\Models\SocialPost::count() : 0;
$socialPostsActive = class_exists('\App\Models\SocialPost') ? \App\Models\SocialPost::where('active', true)->count() : 0;

$contentActive = $slidersActive + $favoritesActive + $socialPostsActive;

$recentSliders = class_exists('\App\Models\Slider') ? \App\Models\Slider::latest()->take(3)->get() : collect();
$recentFavorites = class_exists('\App\Models\Favorite') ? \App\Models\Favorite::latest()->take(3)->get() : collect();
$recentSocialPosts = class_exists('\App\Models\SocialPost') ? \App\Models\SocialPost::latest()->take(3)->get() : collect();
@endphp

<!-- Estadísticas -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">{{ $slidersCount }}</div>
                    <div class="stats-label">Total Sliders</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-images" style="color: var(--color-fondo-terciario);"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">{{ $favoritesCount }}</div>
                    <div class="stats-label">Mis Favoritos</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-heart" style="color: #dc3545;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">{{ $socialPostsCount }}</div>
                    <div class="stats-label">Posts Sociales</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-share-alt" style="color: #e91e63;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">{{ $contentActive }}</div>
                    <div class="stats-label">Contenido Activo</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-check-circle" style="color: #28a745;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">{{ $slidersMain }}</div>
                    <div class="stats-label">Slider Principal</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-star" style="color: var(--color-fondo-secundario);"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Acciones Rápidas -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-bolt me-2"></i>
                Acciones Rápidas
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-primary mb-2"><i class="fas fa-images me-1"></i> Sliders</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Nuevo Slider
                            </a>
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>Ver Sliders
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6 class="text-danger mb-2"><i class="fas fa-heart me-1"></i> Favoritos</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.favorites.create') }}" class="btn btn-danger">
                                <i class="fas fa-plus me-2"></i>Nuevo Favorito
                            </a>
                            <a href="{{ route('admin.favorites.index') }}" class="btn btn-outline-danger">
                                <i class="fas fa-list me-2"></i>Ver Favoritos
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-success mb-2"><i class="fas fa-share-alt me-1"></i> Comunidad Social</h6>
                        <div class="d-grid gap-2">
                            @if(Route::has('admin.social-posts.create'))
                                <a href="{{ route('admin.social-posts.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Nuevo Post Social
                                </a>
                                <a href="{{ route('admin.social-posts.index') }}" class="btn btn-outline-success">
                                    <i class="fas fa-list me-2"></i>Ver Posts Sociales
                                </a>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    <i class="fas fa-plus me-2"></i>Nuevo Post Social
                                </button>
                                <small class="text-muted">Rutas no configuradas</small>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <a href="{{ route('home') }}" class="btn btn-warning btn-lg" target="_blank">
                        <i class="fas fa-eye me-2"></i>Ver Sitio Web
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle me-2"></i>
                Información del Sistema
            </div>
            <div class="card-body">
                <p><strong>Usuario:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Última sesión:</strong> {{ now()->format('d/m/Y H:i') }}</p>
                <p><strong>Versión:</strong> 1.0.0</p>
            </div>
        </div>
    </div>
</div>

<!-- Contenido Reciente -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-images me-2"></i>
                Últimos Sliders Creados
            </div>
            <div class="card-body">
                @if($recentSliders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Título</th>
                                    <th>Sección</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSliders as $slider)
                                <tr>
                                    <td>
                                        @if($slider->image)
                                            <img src="{{ asset('storage/' . $slider->image) }}" 
                                                 alt="{{ $slider->title }}" 
                                                 style="width: 40px; height: 30px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div class="bg-secondary" style="width: 40px; height: 30px; border-radius: 4px;"></div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $slider->title ?: 'Sin título' }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm 
                                            @if($slider->section === 'main') bg-primary
                                            @elseif($slider->section === 'promotions') bg-warning text-dark
                                            @else bg-info
                                            @endif">
                                            {{ ucfirst($slider->section) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm {{ $slider->active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $slider->active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.sliders.edit', $slider) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-2">
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-outline-primary">
                            Ver todos los sliders
                        </a>
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-images fa-2x text-muted mb-2"></i>
                        <p class="text-muted">No hay sliders creados</p>
                        <a href="{{ route('admin.sliders.create') }}" class="btn btn-sm btn-primary">
                            Crear Primer Slider
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-heart me-2"></i>
                Últimos Favoritos
            </div>
            <div class="card-body">
                @if($recentFavorites->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                @foreach($recentFavorites as $favorite)
                                <tr>
                                    <td style="width: 50px;">
                                        @if($favorite->image)
                                            <img src="{{ $favorite->image_url }}" 
                                                 alt="{{ $favorite->title }}" 
                                                 style="width: 40px; height: 30px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div class="bg-secondary" style="width: 40px; height: 30px; border-radius: 4px;"></div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ Str::limit($favorite->title ?: 'Sin título', 15) }}</strong>
                                        <br><span class="badge badge-sm {{ $favorite->active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $favorite->active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.favorites.edit', $favorite) }}" 
                                           class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-2">
                        <a href="{{ route('admin.favorites.index') }}" class="btn btn-sm btn-outline-danger">
                            Ver todos
                        </a>
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-heart fa-2x text-muted mb-2"></i>
                        <p class="text-muted small">No hay favoritos</p>
                        <a href="{{ route('admin.favorites.create') }}" class="btn btn-sm btn-danger">
                            Crear Primero
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-share-alt me-2"></i>
                Últimos Posts Sociales
            </div>
            <div class="card-body">
                @if($recentSocialPosts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Media</th>
                                    <th>Título</th>
                                    <th>Red Social</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSocialPosts as $post)
                                <tr>
                                    <td>
                                        @if($post->media_type === 'image' && $post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" 
                                                 alt="{{ $post->title }}" 
                                                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div class="bg-dark text-white d-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px; border-radius: 4px; font-size: 12px;">
                                                <i class="fas fa-video"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $post->title ?: 'Post #' . $post->id }}</strong>
                                        @if($post->overlay_text)
                                            <br><small class="text-muted">{{ Str::limit($post->overlay_text, 30) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="{{ $post->platform_icon ?? 'fas fa-link' }}" 
                                           style="color: {{ $post->platform_color ?? '#666' }};"></i>
                                        {{ ucfirst($post->social_platform) }}
                                    </td>
                                    <td>
                                        <span class="badge badge-sm {{ $post->active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $post->active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(Route::has('admin.social-posts.edit'))
                                            <a href="{{ route('admin.social-posts.edit', $post) }}" 
                                               class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-2">
                        @if(Route::has('admin.social-posts.index'))
                            <a href="{{ route('admin.social-posts.index') }}" class="btn btn-sm btn-outline-success">
                                Ver todos los posts
                            </a>
                        @endif
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-share-alt fa-2x text-muted mb-2"></i>
                        <p class="text-muted">No hay posts sociales</p>
                        @if(Route::has('admin.social-posts.create'))
                            <a href="{{ route('admin.social-posts.create') }}" class="btn btn-sm btn-success">
                                Crear Primer Post
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Guía de Contenido -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-question-circle me-2"></i>
                Guía de Contenido
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h6><i class="fas fa-star text-warning me-2"></i>Slider Principal</h6>
                        <p class="small text-muted">Carousel en la parte superior de la página principal.</p>
                    </div>
                    <div class="col-md-3">
                        <h6><i class="fas fa-percentage text-info me-2"></i>Slider Promociones</h6>
                        <p class="small text-muted">Aparece en sección específica de promociones.</p>
                    </div>
                    <div class="col-md-3">
                        <h6><i class="fas fa-heart text-danger me-2"></i>Slider Favoritos</h6>
                        <p class="small text-muted">Se muestra en "Mis favoritos" con diseño especial.</p>
                    </div>
                    <div class="col-md-3">
                        <h6><i class="fas fa-share-alt text-success me-2"></i>Comunidad Social</h6>
                        <p class="small text-muted">Tarjetas con videos/imágenes y botones de redes sociales.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Actualizar estadísticas cada 30 segundos
setInterval(function() {
    location.reload();
}, 30000);
</script>
@endsection