@extends('layouts.admin')

@section('title', 'Editar Slider - Admin Panel')
@section('page-title', 'Editar Slider')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Slider: {{ $slider->title }}</h2>
    <div class="btn-group">
        <a href="{{ route('admin.sliders.show', $slider) }}" class="btn btn-info">
            <i class="fas fa-eye me-2"></i>Ver
        </a>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
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
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Información del Slider</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Título -->
                <div class="col-md-8 mb-3">
                    <label for="title" class="form-label">Título (opcional)</label>
                    <input type="text" 
                        class="form-control @error('title') is-invalid @enderror" 
                        id="title" 
                        name="title" 
                        value="{{ old('title') }}" 
                        placeholder="Título opcional del slider">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Orden -->
                <div class="col-md-4 mb-3">
                    <label for="order" class="form-label">Orden</label>
                    <input type="number" 
                           class="form-control @error('order') is-invalid @enderror" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', $slider->order) }}" 
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
                          placeholder="Descripción opcional del slider">{{ old('description', $slider->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Enlace -->
            <div class="mb-3">
                <label for="link" class="form-label">Enlace (URL)</label>
                <input type="url" 
                       class="form-control @error('link') is-invalid @enderror" 
                       id="link" 
                       name="link" 
                       value="{{ old('link', $slider->link) }}" 
                       placeholder="https://ejemplo.com (opcional)">
                <div class="form-text">URL a la que dirigirá cuando se haga clic en el slider</div>
                @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <!-- Sección -->
                <div class="col-md-6 mb-3">
                    <label for="section" class="form-label">Sección <span class="text-danger">*</span></label>
                    <select class="form-select @error('section') is-invalid @enderror" 
                            id="section" 
                            name="section" 
                            required>
                        <option value="">Selecciona una sección</option>
                        <option value="main" {{ old('section', $slider->section) == 'main' ? 'selected' : '' }}>
                            Principal (Carousel superior)
                        </option>
                        <option value="promotions" {{ old('section', $slider->section) == 'promotions' ? 'selected' : '' }}>
                            Promociones (Comunidad Social)
                        </option>
                        <option value="favorites" {{ old('section', $slider->section) == 'favorites' ? 'selected' : '' }}>
                            Favoritos (Mis favoritos)
                        </option>
                    </select>
                    @error('section')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="col-md-6 mb-3">
                    <label for="active" class="form-label">Estado</label>
                    <select class="form-select @error('active') is-invalid @enderror" 
                            id="active" 
                            name="active">
                        <option value="1" {{ old('active', $slider->active) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('active', $slider->active) == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Imagen Actual -->
            <div class="mb-3">
                <label class="form-label">Imagen Actual</label>
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('storage/' . $slider->image) }}" 
                         alt="{{ $slider->title }}" 
                         class="img-thumbnail"
                         style="width: 200px; height: 120px; object-fit: cover;">
                    <div>
                        <p class="mb-1"><strong>Archivo:</strong> {{ basename($slider->image) }}</p>
                        <p class="mb-0 text-muted">Subida el {{ $slider->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Nueva Imagen -->
            <div class="mb-4">
                <label for="image" class="form-label">Cambiar Imagen (opcional)</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*">
                <div class="form-text">
                    Solo selecciona una imagen si quieres cambiar la actual. 
                    Formatos: JPG, PNG, GIF. Máximo: 2MB.
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <!-- Preview de nueva imagen -->
                <div id="imagePreview" class="mt-3" style="display: none;">
                    <p class="mb-2"><strong>Vista previa de la nueva imagen:</strong></p>
                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Actualizar Slider
                </button>
                <a href="{{ route('admin.sliders.show', $slider) }}" class="btn btn-info">
                    <i class="fas fa-eye me-2"></i>Ver Slider
                </a>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
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
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información del Slider</h6>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $slider->id }}</p>
                <p><strong>Creado:</strong> {{ $slider->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Actualizado:</strong> {{ $slider->updated_at->format('d/m/Y H:i') }}</p>
                <p><strong>Tamaño de imagen:</strong> 
                    @if(file_exists(storage_path('app/public/' . $slider->image)))
                        {{ number_format(filesize(storage_path('app/public/' . $slider->image)) / 1024, 2) }} KB
                    @else
                        <span class="text-danger">Archivo no encontrado</span>
                    @endif
                </p>
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
                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Crear Otro Slider
                    </a>
                    <form action="{{ route('admin.sliders.destroy', $slider) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este slider? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Eliminar Slider
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
    const imageInput = document.getElementById('image');
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
});
</script>
@endsection