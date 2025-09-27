@extends('layouts.admin')

@section('title', 'Comunidad Social - Admin Panel')
@section('page-title', 'Comunidad Social Walpa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Posts de Comunidad Social</h2>
    <a href="{{ route('admin.social-posts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Nuevo Post
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($socialPosts->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="80">Media</th>
                            <th>Contenido</th>
                            <th>Texto Superpuesto</th>
                            <th>Red Social</th>
                            <th>Orden</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th width="150">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($socialPosts as $post)
                        <tr>
                            <td>
                                @if($post->media_type === 'image' && $post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="img-thumbnail"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @elseif($post->media_type === 'video')
                                    <div class="bg-dark text-white d-flex align-items-center justify-content-center"
                                         style="width: 60px; height: 60px; border-radius: 4px;">
                                        <i class="fas fa-play"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($post->title)
                                    <strong>{{ $post->title }}</strong><br>
                                @endif
                                @if($post->description)
                                    <small class="text-muted">{{ Str::limit($post->description, 50) }}</small>
                                @endif
                                @if($post->media_type === 'video')
                                    <br><small class="text-info">
                                        <i class="fas fa-video me-1"></i>Video
                                    </small>
                                @endif
                            </td>
                            <td>
                                @if($post->overlay_text)
                                    <span class="badge bg-dark">{{ $post->overlay_text }}</span>
                                    <br><small class="text-muted">{{ ucfirst($post->overlay_position) }}</small>
                                @else
                                    <span class="text-muted">Sin texto</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="{{ $post->platform_icon }} me-2" 
                                       style="color: {{ $post->platform_color }};"></i>
                                    <div>
                                        <div>{{ $post->social_platform_info['name'] ?? ucfirst($post->social_platform) }}</div>
                                        <small class="text-muted">{{ $post->button_text }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $post->order }}</td>
                            <td>
                                <span class="badge {{ $post->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $post->active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>{{ $post->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.social-posts.show', $post) }}" 
                                       class="btn btn-outline-info" 
                                       title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.social-posts.edit', $post) }}" 
                                       class="btn btn-outline-warning" 
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.social-posts.destroy', $post) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger" 
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-share-alt fa-4x text-muted mb-3"></i>
            <h4>No hay posts sociales creados</h4>
            <p class="text-muted mb-4">Comienza creando tu primer post para la comunidad social de Walpa.</p>
            <a href="{{ route('admin.social-posts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Crear Primer Post
            </a>
        </div>
    </div>
@endif

<!-- Información sobre redes sociales -->
<div class="card mt-4">
    <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Acerca de la Comunidad Social</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h6><i class="fas fa-image text-primary me-2"></i>Contenido Visual</h6>
                <p class="small text-muted">Sube imágenes llamativas o videos para atraer la atención de tu audiencia.</p>
            </div>
            <div class="col-md-4">
                <h6><i class="fas fa-font text-warning me-2"></i>Texto Superpuesto</h6>
                <p class="small text-muted">Agrega texto sobre las imágenes como "LURIGANCHO?" o "LA BRASA SE CELEBRA".</p>
            </div>
            <div class="col-md-4">
                <h6><i class="fas fa-share text-success me-2"></i>Botones Sociales</h6>
                <p class="small text-muted">Cada post puede tener un botón que dirija a tu red social favorita.</p>
            </div>
        </div>
    </div>
</div>
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