@extends('layouts.admin')

@section('title', 'Nuevo Beneficio')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-plus text-walpa me-2"></i>Nuevo Beneficio
        </h1>
        <a href="{{ route('admin.opportunities.benefits') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-edit me-2"></i>Información del Beneficio
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.opportunities.benefits.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading text-walpa me-1"></i>Título <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title') }}" 
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
                                       id="order" name="order" value="{{ old('order', 0) }}" 
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
                                      placeholder="Descripción detallada del beneficio...">{{ old('description') }}</textarea>
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
                                    <i id="icon-preview" class="fas fa-star"></i>
                                </span>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                       id="icon" name="icon" value="{{ old('icon') }}" 
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
                                       name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
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
                                <i class="fas fa-save me-2"></i>Crear Beneficio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-info-circle me-2"></i>Consejos
                    </h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-lightbulb me-2"></i>Recomendaciones:</h6>
                        <ul class="mb-0 ps-3">
                            <li>Usa títulos claros y atractivos</li>
                            <li>Explica claramente cada beneficio</li>
                            <li>Los iconos ayudan a identificar rápidamente</li>
                            <li>El orden determina la posición en el sitio</li>
                        </ul>
                    </div>
                    
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Importante:</h6>
                        <p class="mb-0">Los beneficios se mostrarán en la sección "Trabajo" del sitio web.</p>
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
    
    // Inicializar con valor actual
    updateIconPreview(iconInput.value);
});
</script>
@endpush
@endsection