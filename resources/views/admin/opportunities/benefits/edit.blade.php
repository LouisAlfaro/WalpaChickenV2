@extends('layouts.admin')

@section('title', 'Editar Beneficio')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit text-walpa me-2"></i>Editar Beneficio
        </h1>
        <a href="{{ route('admin.opportunities.benefits') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-edit me-2"></i>Editar: {{ $benefit->title }}
                    </h6>
                    <span class="badge {{ $benefit->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $benefit->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.opportunities.benefits.update', $benefit) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading text-walpa me-1"></i>Título <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $benefit->title) }}" 
                                       placeholder="Ej: Gratificación y CTS" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="order" class="form-label">
                                    <i class="fas fa-sort-numeric-up text-walpa me-1"></i>Orden
                                </label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                       id="order" name="order" value="{{ old('order', $benefit->order) }}" 
                                       min="0" placeholder="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Orden de visualización (menor número aparece primero)</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left text-walpa me-1"></i>Descripción <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required
                                      placeholder="Descripción detallada del beneficio...">{{ old('description', $benefit->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">
                                <i class="fas fa-icons text-walpa me-1"></i>Icono (Opcional)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i id="icon-preview" class="{{ $benefit->icon ?: 'fas fa-star' }}"></i>
                                </span>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                       id="icon" name="icon" value="{{ old('icon', $benefit->icon) }}" 
                                       placeholder="fas fa-star">
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Usa clases de FontAwesome. Ej: fas fa-star, fas fa-heart, fas fa-trophy
                            </div>

                            <!-- Iconos comunes -->
                            <div class="mt-2">
                                <small class="text-muted">Iconos comunes:</small>
                                <div class="icon-selector mt-1">
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1 mb-1" onclick="selectIcon('fas fa-star')">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1 mb-1" onclick="selectIcon('fas fa-heart')">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1 mb-1" onclick="selectIcon('fas fa-trophy')">
                                        <i class="fas fa-trophy"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1 mb-1" onclick="selectIcon('fas fa-gift')">
                                        <i class="fas fa-gift"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1 mb-1" onclick="selectIcon('fas fa-shield-alt')">
                                        <i class="fas fa-shield-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1 mb-1" onclick="selectIcon('fas fa-users')">
                                        <i class="fas fa-users"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1 mb-1" onclick="selectIcon('fas fa-money-bill-wave')">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1 mb-1" onclick="selectIcon('fas fa-graduation-cap')">
                                        <i class="fas fa-graduation-cap"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" 
                                       name="is_active" value="1" {{ old('is_active', $benefit->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="fas fa-toggle-on text-walpa me-1"></i>Beneficio activo
                                </label>
                            </div>
                            <div class="form-text">Solo los beneficios activos se mostrarán en el sitio web</div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.opportunities.benefits') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-walpa">
                                <i class="fas fa-save me-2"></i>Actualizar Beneficio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Información del beneficio -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-info-circle me-2"></i>Información
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h5 class="text-walpa">{{ $benefit->order }}</h5>
                                <small class="text-muted">Orden</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="{{ $benefit->is_active ? 'text-success' : 'text-danger' }}">
                                {{ $benefit->is_active ? 'Activo' : 'Inactivo' }}
                            </h5>
                            <small class="text-muted">Estado</small>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-12">
                            <small class="text-muted d-block">Creado:</small>
                            <p>{{ $benefit->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-12">
                            <small class="text-muted d-block">Última actualización:</small>
                            <p>{{ $benefit->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vista previa -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-desktop me-2"></i>Vista Previa
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Así se verá en el sitio web:</p>
                    <div class="border rounded p-3 bg-light">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="{{ $benefit->icon ?: 'fas fa-star' }} fa-2x text-walpa"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">{{ $benefit->title }}</h6>
                                <p class="small text-muted mb-0">{{ Str::limit($benefit->description, 80) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.btn-walpa {
    background-color: #D4AF37;
    border-color: #D4AF37;
    color: white;
}

.btn-walpa:hover {
    background-color: #B8860B;
    border-color: #B8860B;
    color: white;
}

.text-walpa {
    color: #D4AF37 !important;
}

.form-check-input:checked {
    background-color: #D4AF37;
    border-color: #D4AF37;
}

.border-end {
    border-right: 1px solid #dee2e6 !important;
}

.icon-selector .btn {
    transition: all 0.2s ease;
}

.icon-selector .btn:hover {
    background-color: #D4AF37;
    border-color: #D4AF37;
    color: white;
}
</style>
@endpush

@push('scripts')
<script>
function selectIcon(iconClass) {
    document.getElementById('icon').value = iconClass;
    updateIconPreview(iconClass);
}

function updateIconPreview(iconClass) {
    const preview = document.getElementById('icon-preview');
    preview.className = iconClass || 'fas fa-star';
}

document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('icon');
    
    iconInput.addEventListener('input', function() {
        updateIconPreview(this.value);
    });
});
</script>
@endpush
@endsection