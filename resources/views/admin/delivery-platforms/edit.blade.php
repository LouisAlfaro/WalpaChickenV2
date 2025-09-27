@extends('layouts.admin')

@section('title', 'Editar Plataforma de Delivery')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Editar Plataforma: {{ $deliveryPlatform->name }}
                    </h4>
                    <a href="{{ route('admin.delivery-platforms.index') }}" class="btn btn-dark btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Volver
                    </a>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.delivery-platforms.update', $deliveryPlatform) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
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
                                       value="{{ old('name', $deliveryPlatform->name) }}"
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
                                       value="{{ old('order', $deliveryPlatform->order) }}"
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
                                <div class="input-group">
                                    <input type="url" 
                                           class="form-control @error('link') is-invalid @enderror" 
                                           id="link" 
                                           name="link" 
                                           value="{{ old('link', $deliveryPlatform->link) }}"
                                           placeholder="https://www.rappi.com/stores/..."
                                           required>
                                    <a href="{{ $deliveryPlatform->link }}" target="_blank" class="btn btn-outline-secondary">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                                <small class="form-text text-muted">URL completa donde los usuarios harán el pedido</small>
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Imagen Actual -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-image me-1 text-muted"></i>
                                    Imagen Actual
                                </label>
                                <div class="text-center">
                                    @if($deliveryPlatform->image_url)
                                        <img src="{{ $deliveryPlatform->image_url }}" 
                                             alt="{{ $deliveryPlatform->name }}"
                                             class="border rounded shadow-sm"
                                             style="max-width: 120px; max-height: 120px;">
                                    @else
                                        <div class="border rounded d-flex align-items-center justify-content-center" 
                                             style="width: 120px; height: 120px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Nueva Imagen -->
                            <div class="col-md-8 mb-3">
                                <label for="image" class="form-label fw-bold">
                                    <i class="fas fa-upload me-1 text-warning"></i>
                                    Cambiar Logo
                                </label>
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/jpeg,image/png,image/jpg,image/gif">
                                <small class="form-text text-muted">
                                    Dejar vacío para mantener la imagen actual. Formatos: JPG, PNG, GIF. Tamaño máximo: 2MB
                                </small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado Activo -->
                            <div class="col-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="is_active" 
                                           name="is_active" 
                                           value="1"
                                           {{ old('is_active', $deliveryPlatform->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_active">
                                        <i class="fas fa-toggle-on me-1 {{ $deliveryPlatform->is_active ? 'text-success' : 'text-muted' }}"></i>
                                        Plataforma Activa
                                        @if($deliveryPlatform->is_active)
                                            <span class="badge bg-success ms-2">ACTIVA</span>
                                        @else
                                            <span class="badge bg-secondary ms-2">INACTIVA</span>
                                        @endif
                                    </label>
                                </div>
                                <small class="form-text text-muted">Solo las plataformas activas se muestran en el frontend</small>
                            </div>

                            <!-- Preview de nueva imagen -->
                            <div class="col-12 mb-3">
                                <div id="imagePreview" class="text-center" style="display: none;">
                                    <p class="fw-bold text-muted mb-2">Vista previa de la nueva imagen:</p>
                                    <img id="preview" class="border rounded shadow-sm" style="max-width: 150px; max-height: 150px;">
                                </div>
                            </div>
                        </div>

                        <!-- Información adicional -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Información:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Creado: {{ $deliveryPlatform->created_at->format('d/m/Y H:i') }}</li>
                                        <li>Última modificación: {{ $deliveryPlatform->updated_at->format('d/m/Y H:i') }}</li>
                                    </ul>
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
                                    <button type="submit" class="btn btn-warning text-dark">
                                        <i class="fas fa-save me-1"></i>
                                        Actualizar Plataforma
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
// Preview de nueva imagen
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

// Actualizar estado del toggle visual
document.getElementById('is_active').addEventListener('change', function() {
    const icon = this.parentElement.querySelector('i');
    const badge = this.parentElement.querySelector('.badge');
    
    if (this.checked) {
        icon.className = 'fas fa-toggle-on me-1 text-success';
        badge.className = 'badge bg-success ms-2';
        badge.textContent = 'ACTIVA';
    } else {
        icon.className = 'fas fa-toggle-on me-1 text-muted';
        badge.className = 'badge bg-secondary ms-2';
        badge.textContent = 'INACTIVA';
    }
});
</script>
@endsection