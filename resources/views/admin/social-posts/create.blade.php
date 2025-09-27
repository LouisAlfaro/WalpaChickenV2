@extends('layouts.admin')

@section('title', 'Crear Post Social - Admin Panel')
@section('page-title', 'Crear Nuevo Post Social')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Crear Post para Comunidad Social</h2>
    <a href="{{ route('admin.social-posts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Volver a la Lista
    </a>
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

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Información del Post</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.social-posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Título y Orden -->
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="title" class="form-label">Título (opcional)</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
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
                           value="{{ old('order', 0) }}" 
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
                          placeholder="Descripción opcional del post">{{ old('description') }}</textarea>
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
                               {{ old('media_type', 'image') == 'image' ? 'checked' : '' }}>
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
                               {{ old('media_type') == 'video' ? 'checked' : '' }}>
                        <label class="form-check-label" for="media_video">
                            <i class="fas fa-video me-2"></i>Video (URL)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Imagen -->
            <div id="image_section" class="mb-4">
                <label for="image" class="form-label">Imagen <span class="text-danger">*</span></label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*">
                <div class="form-text">
                    Formatos: JPG, PNG, GIF. Tamaño máximo: 5MB. 
                    Resolución recomendada: 400x400px para mejor visualización.
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <!-- Preview de imagen -->
                <div id="imagePreview" class="mt-3" style="display: none;">
                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                </div>
            </div>

            <!-- Video URL -->
            <div id="video_section" class="mb-4" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <label for="video_file" class="form-label">Subir Video <span class="text-danger">*</span></label>
                        <input type="file" 
                            class="form-control @error('video_file') is-invalid @enderror" 
                            id="video_file" 
                            name="video_file" 
                            accept="video/*">
                        <div class="form-text">MP4, WebM, MOV. Máximo: 50MB</div>
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
                            value="{{ old('video_url') }}" 
                            placeholder="https://www.youtube.com/watch?v=...">
                        <div class="form-text">YouTube, TikTok, Instagram, etc.</div>
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Preview de video -->
                <div id="videoPreview" class="mt-3" style="display: none;">
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
                           value="{{ old('overlay_text') }}" 
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
                        <option value="bottom" {{ old('overlay_position', 'bottom') == 'bottom' ? 'selected' : '' }}>Abajo</option>
                        <option value="center" {{ old('overlay_position') == 'center' ? 'selected' : '' }}>Centro</option>
                        <option value="top" {{ old('overlay_position') == 'top' ? 'selected' : '' }}>Arriba</option>
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
                                    {{ old('social_platform', 'facebook') == $key ? 'selected' : '' }}>
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
                           value="{{ old('social_url') }}" 
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
                           value="{{ old('button_text', 'Seguir') }}" 
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
                               value="{{ old('button_color', '#1877F2') }}">
                        <input type="text" 
                               class="form-control" 
                               id="button_color_text" 
                               value="{{ old('button_color', '#1877F2') }}" 
                               readonly>
                    </div>
                    <div class="form-text">Se ajustará automáticamente según la red social</div>
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
                    <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Guardar Post
                </button>
                <a href="{{ route('admin.social-posts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Cancelar
                </a>
            </div>
        </form>
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
    const videoUrlInput = document.getElementById('video_url');
    const videoFileInput = document.getElementById('video_file');

    function toggleMediaSections() {
        const selectedType = document.querySelector('input[name="media_type"]:checked').value;
        
        if (selectedType === 'image') {
            imageSection.style.display = 'block';
            videoSection.style.display = 'none';
            imageInput.required = true;
            videoUrlInput.required = false;
            videoFileInput.required = false;
        } else {
            imageSection.style.display = 'none';
            videoSection.style.display = 'block';
            imageInput.required = false;
            // No hacer required los videos porque puede ser archivo O URL
        }
    }

    mediaRadios.forEach(radio => {
        radio.addEventListener('change', toggleMediaSections);
    });

    // Preview de imagen
    const imagePreview = document.getElementById('imagePreview');
    const preview = document.getElementById('preview');

    if (imageInput) {
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
    }

    // Preview de video
    const videoPreview = document.getElementById('videoPreview');
    const videoPreviewElement = document.getElementById('videoPreviewElement');

    if (videoFileInput && videoPreviewElement) {
        videoFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                videoPreviewElement.src = url;
                videoPreview.style.display = 'block';
            } else {
                videoPreview.style.display = 'none';
            }
        });
    }

    // Limpiar previews al cambiar tipo de media
    mediaRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (imagePreview) imagePreview.style.display = 'none';
            if (videoPreview) videoPreview.style.display = 'none';
            if (videoPreviewElement && videoPreviewElement.src) {
                URL.revokeObjectURL(videoPreviewElement.src);
            }
        });
    });

    // Cambio de plataforma social - actualizar color
    const platformSelect = document.getElementById('social_platform');
    const colorInput = document.getElementById('button_color');
    const colorText = document.getElementById('button_color_text');

    if (platformSelect && colorInput && colorText) {
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
    }

    // Inicializar
    toggleMediaSections();
});
</script>
@endsection