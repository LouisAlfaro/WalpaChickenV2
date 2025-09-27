@extends('layouts.admin')

@section('title', 'Ver Post Social - Admin Panel')
@section('page-title', 'Detalles del Post Social')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $socialPost->title ?: 'Post #' . $socialPost->id }}</h2>
    <div class="btn-group">
        <a href="{{ route('admin.social-posts.edit', $socialPost) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Editar
        </a>
        <a href="{{ route('admin.social-posts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Media Principal -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-{{ $socialPost->media_type === 'video' ? 'video' : 'image' }} me-2"></i>
            {{ ucfirst($socialPost->media_type) }} del Post
        </h5>
    </div>
    <div class="card-body text-center">
        <div class="position-relative d-inline-block">
            @if($socialPost->media_type === 'image' && $socialPost->image)
                <img src="{{ asset('storage/' . $socialPost->image) }}" 
                     alt="{{ $socialPost->title }}" 
                     class="img-fluid rounded shadow"
                     style="max-width: 100%; max-height: 400px; object-fit: contain;">
            @elseif($socialPost->media_type === 'video' && $socialPost->video_url)
                <div class="bg-dark text-white p-5 rounded">
                    <i class="fas fa-video fa-3x mb-3"></i>
                    <h5>Video URL</h5>
                    <p class="mb-3">{{ $socialPost->video_url }}</p>
                    <a href="{{ $socialPost->video_url }}" target="_blank" class="btn btn-light">
                        <i class="fas fa-external-link-alt me-2"></i>Ver Video
                    </a>
                </div>
            @endif
            
            <!-- Badge de estado superpuesto -->
            <span class="position-absolute top-0 start-0 m-2 badge {{ $socialPost->active ? 'bg-success' : 'bg-danger' }} fs-6">
                {{ $socialPost->active ? 'ACTIVO' : 'INACTIVO' }}
            </span>
            
            <!-- Texto superpuesto si existe -->
            @if($socialPost->overlay_text)
                <div class="position-absolute w-100 text-white text-center fw-bold fs-4 
                     @if($socialPost->overlay_position === 'top') top-0 mt-3
                     @elseif($socialPost->overlay_position === 'center') top-50 translate-middle-y
                     @else bottom-0 mb-3 @endif"
                     style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                    {{ $socialPost->overlay_text }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Información del Post -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información General</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-5">Título:</dt>
                            <dd class="col-sm-7">{{ $socialPost->title ?: 'Sin título' }}</dd>
                            
                            <dt class="col-sm-5">Tipo de Media:</dt>
                            <dd class="col-sm-7">
                                <span class="badge {{ $socialPost->media_type === 'video' ? 'bg-info' : 'bg-primary' }}">
                                    {{ ucfirst($socialPost->media_type) }}
                                </span>
                            </dd>
                            
                            <dt class="col-sm-5">Estado:</dt>
                            <dd class="col-sm-7">
                                <span class="badge {{ $socialPost->active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $socialPost->active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </dd>
                            
                            <dt class="col-sm-5">Orden:</dt>
                            <dd class="col-sm-7">{{ $socialPost->order }}</dd>
                        </dl>
                    </div>
                    
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-5">Creado:</dt>
                            <dd class="col-sm-7">
                                {{ $socialPost->created_at->format('d/m/Y') }}
                                <div class="small text-muted">{{ $socialPost->created_at->format('H:i') }}</div>
                            </dd>
                            
                            <dt class="col-sm-5">Actualizado:</dt>
                            <dd class="col-sm-7">
                                {{ $socialPost->updated_at->format('d/m/Y') }}
                                <div class="small text-muted">{{ $socialPost->updated_at->format('H:i') }}</div>
                            </dd>
                            
                            <dt class="col-sm-5">ID:</dt>
                            <dd class="col-sm-7"><code>#{{ $socialPost->id }}</code></dd>
                            
                            @if($socialPost->media_type === 'image' && $socialPost->image)
                            <dt class="col-sm-5">Archivo:</dt>
                            <dd class="col-sm-7">
                                <code>{{ basename($socialPost->image) }}</code>
                                @if(file_exists(storage_path('app/public/' . $socialPost->image)))
                                    <div class="small text-muted">
                                        {{ number_format(filesize(storage_path('app/public/' . $socialPost->image)) / 1024, 2) }} KB
                                    </div>
                                @endif
                            </dd>
                            @endif
                        </dl>
                    </div>
                </div>
                
                @if($socialPost->description)
                    <hr>
                    <h6>Descripción:</h6>
                    <p class="text-muted">{{ $socialPost->description }}</p>
                @endif
                
                @if($socialPost->overlay_text)
                    <hr>
                    <h6>Texto Superpuesto:</h6>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-dark fs-6">{{ $socialPost->overlay_text }}</span>
                        <small class="text-muted">(Posición: {{ ucfirst($socialPost->overlay_position) }})</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Red Social -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-share-alt me-2"></i>Red Social</h6>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="{{ $socialPost->platform_icon }} fa-3x" 
                       style="color: {{ $socialPost->platform_color }};"></i>
                </div>
                <h6>{{ $socialPost->social_platform_info['name'] ?? ucfirst($socialPost->social_platform) }}</h6>
                
                @if($socialPost->social_url)
                    <p class="small text-muted mb-3">{{ $socialPost->social_url }}</p>
                @endif
                
                <!-- Botón simulado -->
                <button class="btn btn-sm fw-bold text-white border-0" 
                        style="background-color: {{ $socialPost->button_color }};">
                    <i class="{{ $socialPost->platform_icon }} me-2"></i>{{ $socialPost->button_text }}
                </button>
                
                @if($socialPost->social_url)
                    <div class="mt-3">
                        <a href="{{ $socialPost->social_url }}" 
                           target="_blank" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-external-link-alt me-2"></i>Ir al Perfil
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Acciones -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-cog me-2"></i>Acciones</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.social-posts.edit', $socialPost) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Editar Post
                    </a>
                    <a href="{{ route('admin.social-posts.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Crear Nuevo
                    </a>
                    <hr>
                    <form action="{{ route('admin.social-posts.destroy', $socialPost) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este post? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Eliminar Post
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Estadísticas</h6>
            </div>
            <div class="card-body">
                @php
                    $totalPosts = \App\Models\SocialPost::count();
                    $activePosts = \App\Models\SocialPost::where('active', true)->count();
                    $platformPosts = \App\Models\SocialPost::where('social_platform', $socialPost->social_platform)->count();
                @endphp
                
                <div class="text-center mb-3">
                    <div class="h5 text-primary mb-1">{{ $totalPosts }}</div>
                    <div class="text-muted small">Total de Posts</div>
                </div>
                
                <div class="text-center mb-3">
                    <div class="h5 text-success mb-1">{{ $activePosts }}</div>
                    <div class="text-muted small">Posts Activos</div>
                </div>
                
                <div class="text-center">
                    <div class="h5 text-info mb-1">{{ $platformPosts }}</div>
                    <div class="text-muted small">Posts de {{ ucfirst($socialPost->social_platform) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview del post en contexto -->
<div class="card mt-4">
    <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-eye me-2"></i>Previsualización en el Frontend</h6>
    </div>
    <div class="card-body">
        <p class="text-muted mb-3">Así se verá este post en la sección "Comunidad Social Walpa":</p>
        
        <!-- Simulación de la tarjeta del frontend -->
        <div class="border rounded p-3 bg-light" style="max-width: 400px; margin: 0 auto;">
            <div class="card h-100">
                <!-- Logo Walpa simulado -->
                <div class="position-absolute top-0 start-0 m-2 bg-white rounded-circle p-2" 
                     style="width: 50px; height: 50px; z-index: 10;">
                    <div class="w-100 h-100 bg-warning rounded-circle d-flex align-items-center justify-content-center">
                        <strong style="font-size: 12px;">W</strong>
                    </div>
                </div>
                
                <!-- Media -->
                @if($socialPost->media_type === 'image' && $socialPost->image)
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $socialPost->image) }}" 
                             alt="{{ $socialPost->title }}" 
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                        
                        @if($socialPost->overlay_text)
                            <div class="position-absolute w-100 text-white text-center fw-bold 
                                 @if($socialPost->overlay_position === 'top') top-0 mt-2
                                 @elseif($socialPost->overlay_position === 'center') top-50 translate-middle-y
                                 @else bottom-0 mb-2 @endif"
                                 style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8); font-size: 18px;">
                                {{ $socialPost->overlay_text }}
                            </div>
                        @endif
                    </div>
                @elseif($socialPost->media_type === 'video')
                    <div class="bg-dark text-white d-flex align-items-center justify-content-center"
                         style="height: 200px;">
                        <div class="text-center">
                            <i class="fas fa-play fa-2x mb-2"></i>
                            <div>Video</div>
                        </div>
                    </div>
                @endif
                
                <!-- Botón social -->
                <div class="card-body text-center">
                    <button class="btn fw-bold text-white border-0" 
                            style="background-color: {{ $socialPost->button_color }};">
                        <i class="{{ $socialPost->platform_icon }} me-2"></i>{{ $socialPost->button_text }}
                    </button>
                </div>
            </div>
        </div>
        
        <div class="mt-3 text-center">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-success">
                <i class="fas fa-external-link-alt me-2"></i>Ver en el sitio web
            </a>
        </div>
    </div>
</div>

<!-- Navegación entre posts -->
@php
    $prevPost = \App\Models\SocialPost::where('id', '<', $socialPost->id)->orderBy('id', 'desc')->first();
    $nextPost = \App\Models\SocialPost::where('id', '>', $socialPost->id)->orderBy('id', 'asc')->first();
@endphp

@if($prevPost || $nextPost)
    <div class="card mt-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4">
                    @if($prevPost)
                        <a href="{{ route('admin.social-posts.show', $prevPost) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-chevron-left me-2"></i>Anterior: 
                            {{ $prevPost->title ? Str::limit($prevPost->title, 15) : 'Post #' . $prevPost->id }}
                        </a>
                    @endif
                </div>
                
                <div class="col-md-4 text-center">
                    <span class="text-muted">
                        <i class="fas fa-share-alt me-2"></i>Post {{ $socialPost->id }} de {{ \App\Models\SocialPost::count() }}
                    </span>
                </div>
                
                <div class="col-md-4 text-end">
                    @if($nextPost)
                        <a href="{{ route('admin.social-posts.show', $nextPost) }}" class="btn btn-outline-secondary">
                            Siguiente: 
                            {{ $nextPost->title ? Str::limit($nextPost->title, 15) : 'Post #' . $nextPost->id }}
                            <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('scripts')
<script>
// Auto-cerrar alertas después de 5 segundos
setTimeout(function() {
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);
</script>
@endsection