@extends('layouts.admin')

@section('title', 'Crear Plataforma de Delivery')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Crear Nueva Plataforma
                    </h4>
                    <a href="{{ route('admin.delivery-platforms.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Volver
                    </a>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.delivery-platforms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <!-- Nombre -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-1 text-primary"></i>
                                    Nombre de la Plataforma *
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       placeholder="ej. Rappi, PedidosYa, Didi Food..."
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Orden -->
                            <div class="col-md-6 mb-3">
                                <label for="order" class="form-label fw-bold">
                                    <i class="fas fa-sort-numeric-down me-1 text-success"></i>
                                    Orden de Visualización
                                </label>
                                <input type="number" 
                                       class="form-control @error('order') is-invalid @enderror" 
                                       id="order" 
                                       name="order" 
                                       value="{{ old('order', 0) }}"
                                       min="0"
                                       placeholder="0, 1, 2...">
                                <small class="form-text text-muted">Menor número aparece primero</small>
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Link -->
                            <div class="col-12 mb-3">
                                <label for="link" class="form-label fw-bold">
                                    <i class="fas fa-link me-1 text-info"></i>
                                    Enlace de la Plataforma *
                                </label>
                                <input type="url" 
                                       class="form-control @error('link') is-invalid @enderror" 
                                       id="link" 
                                       name="link" 
                                       value="{{ old('link') }}"
                                       placeholder="https://www.rappi.com/stores/..."
                                       required>
                                <small class="form-text text-muted">URL completa donde los usuarios harán el pedido</small>
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Imagen -->
                            <div class="col-md-8 mb-3">
                                <label for="image" class="form-label fw-bold">
                                    <i class="fas fa-image me-1 text-warning"></i>
                                    Logo de la Plataforma *
                                </label>
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/jpeg,image/png,image/jpg,image/gif"
                                       required>
                                <small class="form-text text-muted">
                                    Formatos: JPG, PNG, GIF. Tamaño máximo: 2MB. Recomendado: 300x300px
                                </small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado Activo -->
                            <div class="col-md-4 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="is_active" 
                                           name="is_active" 
                                           value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_active">
                                        <i class="fas fa-toggle-on me-1 text-success"></i>
                                        Plataforma Activa
                                    </label>
                                </div>
                            </div>

                            <!-- Preview de imagen -->
                            <div class="col-12 mb-3">
                                <div id="imagePreview" class="text-center" style="display: none;">
                                    <p class="fw-bold text-muted mb-2">Vista previa:</p>
                                    <img id="preview" class="border rounded shadow-sm" style="max-width: 150px; max-height: 150px;">
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.delivery-platforms.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>
                                        Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i>
                                        Crear Plataforma
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Preview de imagen
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
});
</script>
@endsection