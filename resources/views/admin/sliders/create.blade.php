@extends('layouts.admin')

@section('title', 'Crear Slider - Admin Panel')
@section('page-title', 'Crear Nuevo Slider')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Crear Nuevo Slider</h2>
    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
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
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Información del Slider</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
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
                          placeholder="Descripción opcional del slider">{{ old('description') }}</textarea>
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
                       value="{{ old('link') }}" 
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
                        <option value="main" {{ old('section') == 'main' ? 'selected' : '' }}>
                            Principal (Carousel superior)
                        </option>
                        <option value="promotions" {{ old('section') == 'promotions' ? 'selected' : '' }}>
                            Promociones (Comunidad Social)
                        </option>
                        <option value="favorites" {{ old('section') == 'favorites' ? 'selected' : '' }}>
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
                        <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Imagen -->
            <div class="mb-4">
                <label for="image" class="form-label">Imagen <span class="text-danger">*</span></label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*" 
                       required>
                <div class="form-text">
                    Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB. 
                    Resolución recomendada: 1200x600px para slider principal.
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <!-- Preview de imagen -->
                <div id="imagePreview" class="mt-3" style="display: none;">
                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Guardar Slider
                </button>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Información de ayuda -->
<div class="card mt-4">
    <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información sobre las Secciones</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h6 class="text-primary"><i class="fas fa-star me-1"></i>Principal</h6>
                <p class="small mb-0">Se muestra como carousel en la parte superior de la página principal.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-warning"><i class="fas fa-percentage me-1"></i>Promociones</h6>
                <p class="small mb-0">Aparece en la sección "Comunidad Social Walpa" con diseño de tarjetas.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-danger"><i class="fas fa-heart me-1"></i>Favoritos</h6>
                <p class="small mb-0">Se muestra en la sección "Mis favoritos" con diseño especial.</p>
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