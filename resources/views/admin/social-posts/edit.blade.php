@extends('layouts.admin')

@section('title', 'Editar Post Social - Admin Panel')
@section('page-title', 'Editar Post Social')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Post: {{ $socialPost->title ?: 'Post #' . $socialPost->id }}</h2>
    <div class="btn-group">
        <a href="{{ route('admin.social-posts.show', $socialPost) }}" class="btn btn-info">
            <i class="fas fa-eye me-2"></i>Ver
        </a>
        <a href="{{ route('admin.social-posts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h6><i class="fas fa-exclamation-triangle me-2"></i>Por favor corrige los siguientes errores:</h6>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Post Social</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.social-posts.update', $socialPost) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Título y Orden -->
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="title" class="form-label">Título (opcional)</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $socialPost->title) }}" 
                           placeholder="Título del post social">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="order" class="form-label">Orden</label>
                    <input type="number" 
                           class="form-control @error('order') is-invalid @enderror" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', $socialPost->order) }}" 
                           min="0">
                    <div class="form-text">Orden de aparición (0 = primero)</div>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" 
                          name="description" 
                          rows="3" 
                          placeholder="Descripción opcional del post">{{ old('description', $socialPost->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tipo de Media -->
            <div class="mb-4">
                <label class="form-label">Tipo de Contenido <span class="text-danger">*</span></label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="radio" 
                               name="media_type" 
                               id="media_image" 
                               value="image" 
                               {{ old('media_type', $socialPost->media_type) == 'image' ? 'checked' : '' }}>
                        <label class="form-check-label" for="media_image">
                            <i class="fas fa-image me-2"></i>Imagen
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="radio" 
                               name="media_type" 
                               id="media_video" 
                               value="video" 
                               {{ old('media_type', $socialPost->media_type) == 'video' ? 'checked' : '' }}>
                        <label class="form-check-label" for="media_video">
                            <i class="fas fa-video me-2"></i>Video (URL)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Imagen Actual -->
            @if($socialPost->media_type === 'image' && $socialPost->image)
            <div class="mb-3">
                <label class="form-label">Imagen Actual</label>
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('storage/' . $socialPost->image) }}" 
                         alt="{{ $socialPost->title }}" 
                         class="img-thumbnail"
                         style="width: 150px; height: 150px; object-fit: cover;">
                    <div>
                        <p class="mb-1"><strong>Archivo:</strong> {{ basename($socialPost->image) }}</p>
                        <p class="mb-0 text-muted">Subida el {{ $socialPost->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Nueva Imagen -->
            <div id="image_section" class="mb-4">
                <label for="image" class="form-label">
                    @if($socialPost->media_type === 'image' && $socialPost->image)
                        Cambiar Imagen (opcional)
                    @else
                        Imagen <span class="text-danger">*</span>
                    @endif
                </label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*">
                <div class="form-text">
                    @if($socialPost->media_type === 'image' && $socialPost->image)
                        Solo selecciona una imagen si quieres cambiar la actual.
                    @endif
                    Formatos: JPG, PNG, GIF. Máximo: 5MB.
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <!-- Preview de nueva imagen -->
                <div id="imagePreview" class="mt-3" style="display: none;">
                    <p class="mb-2"><strong>Vista previa de la nueva imagen:</strong></p>
                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                </div>
            </div>

            <!-- Video Actual -->
            @if($socialPost->media_type === 'video')
                <div class="mb-3">
                    <label class="form-label">Video Actual</label>
                    <div class="d-flex align-items-center gap-3">
                        @if($socialPost->video_file)
                            <video controls style="width: 200px; height: 150px;">
                                <source src="{{ asset('storage/' . $socialPost->video_file) }}" type="video/mp4">
                            </video>
                            <div>
                                <p class="mb-1"><strong>Archivo:</strong> {{ basename($socialPost->video_file) }}</p>
                                <p class="mb-0 text-muted">Subido el {{ $socialPost->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        @elseif($socialPost->video_url)
                            <div class="bg-dark text-white p-3 rounded">
                                <i class="fas fa-video fa-2x mb-2"></i>
                                <p class="mb-0">URL: {{ $socialPost->video_url }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Nuevo Video -->
            <div id="video_section" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="video_file" class="form-label">
                            @if($socialPost->media_type === 'video' && $socialPost->video_file)
                                Cambiar Video (opcional)
                            @else
                                Subir Video <span class="text-danger">*</span>
                            @endif
                        </label>
                        <input type="file" 
                            class="form-control @error('video_file') is-invalid @enderror" 
                            id="video_file" 
                            name="video_file" 
                            accept="video/*">
                        <div class="form-text">
                            @if($socialPost->media_type === 'video' && $socialPost->video_file)
                                Solo selecciona un video si quieres cambiar el actual.
                            @endif
                            MP4, WebM, MOV. Máximo: 50MB
                        </div>
                        @error('video_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="video_url" class="form-label">O URL del Video</label>
                        <input type="url" 
                            class="form-control @error('video_url') is-invalid @enderror" 
                            id="video_url" 
                            name="video_url" 
                            value="{{ old('video_url', $socialPost->video_url) }}" 
                            placeholder="https://www.youtube.com/watch?v=...">
                        <div class="form-text">YouTube, TikTok, Instagram, etc.</div>
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Preview de nuevo video -->
                <div id="videoPreview" class="mt-3" style="display: none;">
                    <p class="mb-2"><strong>Vista previa del nuevo video:</strong></p>
                    <video id="videoPreviewElement" controls style="max-width: 300px; max-height: 200px;">
                        Tu navegador no soporta videos HTML5.
                    </video>
                </div>
            </div>

            <!-- Texto Superpuesto -->
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="overlay_text" class="form-label">Texto Superpuesto</label>
                    <input type="text" 
                           class="form-control @error('overlay_text') is-invalid @enderror" 
                           id="overlay_text" 
                           name="overlay_text" 
                           value="{{ old('overlay_text', $socialPost->overlay_text) }}" 
                           placeholder="Ej: LURIGANCHO?, LA BRASA SE CELEBRA">
                    <div class="form-text">Texto que aparece sobre la imagen/video</div>
                    @error('overlay_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="overlay_position" class="form-label">Posición del Texto</label>
                    <select class="form-select @error('overlay_position') is-invalid @enderror" 
                            id="overlay_position" 
                            name="overlay_position">
                        <option value="bottom" {{ old('overlay_position', $socialPost->overlay_position) == 'bottom' ? 'selected' : '' }}>Abajo</option>
                        <option value="center" {{ old('overlay_position', $socialPost->overlay_position) == 'center' ? 'selected' : '' }}>Centro</option>
                        <option value="top" {{ old('overlay_position', $socialPost->overlay_position) == 'top' ? 'selected' : '' }}>Arriba</option>
                    </select>
                    @error('overlay_position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Red Social -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="social_platform" class="form-label">Red Social <span class="text-danger">*</span></label>
                    <select class="form-select @error('social_platform') is-invalid @enderror" 
                            id="social_platform" 
                            name="social_platform" 
                            required>
                        @foreach($platforms as $key => $platform)
                            <option value="{{ $key }}" 
                                    data-color="{{ $platform['color'] }}"
                                    {{ old('social_platform', $socialPost->social_platform) == $key ? 'selected' : '' }}>
                                {{ $platform['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('social_platform')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="social_url" class="form-label">URL de la Red Social</label>
                    <input type="url" 
                           class="form-control @error('social_url') is-invalid @enderror" 
                           id="social_url" 
                           name="social_url" 
                           value="{{ old('social_url', $socialPost->social_url) }}" 
                           placeholder="https://facebook.com/walpa">
                    <div class="form-text">URL a la que dirigirá el botón</div>
                    @error('social_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Botón -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="button_text" class="form-label">Texto del Botón <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('button_text') is-invalid @enderror" 
                           id="button_text" 
                           name="button_text" 
                           value="{{ old('button_text', $socialPost->button_text) }}" 
                           placeholder="Seguir"
                           required>
                    @error('button_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="button_color" class="form-label">Color del Botón</label>
                    <div class="input-group">
                        <input type="color" 
                               class="form-control form-control-color @error('button_color') is-invalid @enderror" 
                               id="button_color" 
                               name="button_color" 
                               value="{{ old('button_color', $socialPost->button_color) }}">
                        <input type="text" 
                               class="form-control" 
                               id="button_color_text" 
                               value="{{ old('button_color', $socialPost->button_color) }}" 
                               readonly>
                    </div>
                    @error('button_color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label for="active" class="form-label">Estado</label>
                <select class="form-select @error('active') is-invalid @enderror" 
                        id="active" 
                        name="active">
                    <option value="1" {{ old('active', $socialPost->active) == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('active', $socialPost->active) == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Actualizar Post
                </button>
                <a href="{{ route('admin.social-posts.show', $socialPost) }}" class="btn btn-info">
                    <i class="fas fa-eye me-2"></i>Ver Post
                </a>
                <a href="{{ route('admin.social-posts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Información adicional -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información del Post</h6>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $socialPost->id }}</p>
                <p><strong>Tipo:</strong> {{ ucfirst($socialPost->media_type) }}</p>
                <p><strong>Creado:</strong> {{ $socialPost->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Actualizado:</strong> {{ $socialPost->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-cog me-2"></i>Acciones Adicionales</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.social-posts.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Crear Otro Post
                    </a>
                    <form action="{{ route('admin.social-posts.destroy', $socialPost) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este post? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Eliminar Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar cambio de tipo de media
    const mediaRadios = document.querySelectorAll('input[name="media_type"]');
    const imageSection = document.getElementById('image_section');
    const videoSection = document.getElementById('video_section');
    const imageInput = document.getElementById('image');
    const videoInput = document.getElementById('video_url');

    function toggleMediaSections() {
        const selectedType = document.querySelector('input[name="media_type"]:checked').value;
        
        if (selectedType === 'image') {
            imageSection.style.display = 'block';
            videoSection.style.display = 'none';
            videoInput.required = false;
        } else {
            imageSection.style.display = 'none';
            videoSection.style.display = 'block';
            imageInput.required = false;
            videoInput.required = true;
        }
    }

    mediaRadios.forEach(radio => {
        radio.addEventListener('change', toggleMediaSections);
    });

    // Preview de imagen
    const imagePreview = document.getElementById('imagePreview');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Cambio de plataforma social - actualizar color
    const platformSelect = document.getElementById('social_platform');
    const colorInput = document.getElementById('button_color');
    const colorText = document.getElementById('button_color_text');

    platformSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const color = selectedOption.getAttribute('data-color');
        if (color) {
            colorInput.value = color;
            colorText.value = color;
        }
    });

    // Sincronizar color picker con texto
    colorInput.addEventListener('change', function() {
        colorText.value = this.value;
    });

    // Inicializar
    toggleMediaSections();
});
</script>
@endsection