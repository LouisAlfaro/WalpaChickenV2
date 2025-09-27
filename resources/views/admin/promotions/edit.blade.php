@extends('layouts.admin')

@section('title', 'Editar Promoción')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit text-walpa me-2"></i>Editar Promoción
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.promotions.show', $promotion) }}" class="btn btn-info">
                <i class="fas fa-eye me-2"></i>Ver
            </a>
            <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-edit me-2"></i>Editar: {{ $promotion->title }}
                    </h6>
                    <span class="badge {{ $promotion->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $promotion->is_active ? 'Activa' : 'Inactiva' }}
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Título -->
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading text-walpa me-1"></i>Título <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $promotion->title) }}" 
                                       placeholder="Ej: Promoción de Temporada"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Orden -->
                            <div class="col-md-4 mb-3">
                                <label for="order" class="form-label">
                                    <i class="fas fa-sort-numeric-up text-walpa me-1"></i>Orden
                                </label>
                                <input type="number" 
                                       class="form-control @error('order') is-invalid @enderror" 
                                       id="order" 
                                       name="order" 
                                       value="{{ old('order', $promotion->order) }}" 
                                       min="0"
                                       placeholder="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Orden de visualización (menor número aparece primero)</div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left text-walpa me-1"></i>Descripción
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3"
                                      placeholder="Descripción detallada de la promoción...">{{ old('description', $promotion->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Imagen Actual y Nueva -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                <i class="fas fa-image text-walpa me-1"></i>Imagen
                            </label>
                            
                            <!-- Imagen actual -->
                            @if($promotion->image)
                                <div class="mb-3">
                                    <label class="form-label text-muted">Imagen actual:</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/promotions/' . $promotion->image) }}" 
                                             alt="{{ $promotion->title }}" 
                                             class="img-thumbnail"
                                             style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                        <div>
                                            <p class="mb-1"><strong>{{ $promotion->image }}</strong></p>
                                            <small class="text-muted">Subir una nueva imagen reemplazará la actual</small>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Input nueva imagen -->
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 2MB
                                @if(!$promotion->image) <span class="text-danger">(Requerido)</span> @endif
                            </div>
                            
                            <!-- Preview nueva imagen -->
                            <div id="image-preview" class="mt-3" style="display: none;">
                                <label class="form-label text-muted">Vista previa de la nueva imagen:</label>
                                <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <!-- Enlace -->
                        <div class="mb-3">
                            <label for="link" class="form-label">
                                <i class="fas fa-link text-walpa me-1"></i>Enlace (Opcional)
                            </label>
                            <input type="url" 
                                   class="form-control @error('link') is-invalid @enderror" 
                                   id="link" 
                                   name="link" 
                                   value="{{ old('link', $promotion->link) }}" 
                                   placeholder="https://ejemplo.com/promocion">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">URL donde redirigir al hacer clic en la promoción</div>
                        </div>

                        <!-- Fechas de Vigencia -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">
                                    <i class="fas fa-calendar-plus text-walpa me-1"></i>Fecha de Inicio
                                </label>
                                <input type="date" 
                                       class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" 
                                       name="start_date" 
                                       value="{{ old('start_date', $promotion->start_date?->format('Y-m-d')) }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Dejar vacío si no tiene fecha de inicio específica</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">
                                    <i class="fas fa-calendar-minus text-walpa me-1"></i>Fecha de Fin
                                </label>
                                <input type="date" 
                                       class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" 
                                       name="end_date" 
                                       value="{{ old('end_date', $promotion->end_date?->format('Y-m-d')) }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Dejar vacío si no tiene fecha de expiración</div>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', $promotion->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="fas fa-toggle-on text-walpa me-1"></i>Promoción activa
                                </label>
                            </div>
                            <div class="form-text">Solo las promociones activas se mostrarán en el sitio web</div>
                        </div>

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-walpa">
                                        <i class="fas fa-save me-2"></i>Actualizar Promoción
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar con información -->
        <div class="col-lg-4">
            <!-- Información de la promoción -->
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
                                <h5 class="text-walpa">{{ $promotion->order }}</h5>
                                <small class="text-muted">Orden</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="{{ $promotion->is_current ? 'text-success' : 'text-warning' }}">
                                {{ $promotion->is_current ? 'Vigente' : 'No vigente' }}
                            </h5>
                            <small class="text-muted">Estado</small>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-12">
                            <small class="text-muted d-block">Creado:</small>
                            <p>{{ $promotion->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-12">
                            <small class="text-muted d-block">Última actualización:</small>
                            <p>{{ $promotion->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Consejos -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-lightbulb me-2"></i>Consejos
                    </h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-lightbulb me-2"></i>Recomendaciones:</h6>
                        <ul class="mb-0 ps-3">
                            <li>Usa imágenes de alta calidad (mínimo 800x600px)</li>
                            <li>El título debe ser atractivo y descriptivo</li>
                            <li>Configura fechas de vigencia para promociones temporales</li>
                            <li>El orden determina la posición en el sitio web</li>
                        </ul>
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

.img-thumbnail {
    border: 2px solid #D4AF37;
}

.border-end {
    border-right: 1px solid #dee2e6 !important;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview de imagen
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Validación de fechas
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    startDate.addEventListener('change', function() {
        if (this.value) {
            endDate.min = this.value;
        }
    });

    endDate.addEventListener('change', function() {
        if (startDate.value && this.value < startDate.value) {
            alert('La fecha de fin no puede ser anterior a la fecha de inicio');
            this.value = '';
        }
    });
});
</script>
@endpush
@endsection