@extends('layouts.admin')

@section('title', 'Nueva Sección de Empresa')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-plus text-walpa me-2"></i>Nueva Sección de Empresa
        </h1>
        <a href="{{ route('admin.company-sections.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-edit me-2"></i>Información de la Sección
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.company-sections.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <!-- Tipo -->
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">
                                    <i class="fas fa-tag text-walpa me-1"></i>Tipo de Sección <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('type') is-invalid @enderror" 
                                        id="type" 
                                        name="type" 
                                        required>
                                    <option value="">Seleccionar tipo...</option>
                                    @foreach($types as $key => $type)
                                        <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Orden -->
                            <div class="col-md-6 mb-3">
                                <label for="order" class="form-label">
                                    <i class="fas fa-sort-numeric-up text-walpa me-1"></i>Orden
                                </label>
                                <input type="number" 
                                       class="form-control @error('order') is-invalid @enderror" 
                                       id="order" 
                                       name="order" 
                                       value="{{ old('order', 0) }}" 
                                       min="0"
                                       placeholder="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Orden de visualización (menor número aparece primero)</div>
                            </div>
                        </div>

                        <!-- Título -->
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading text-walpa me-1"></i>Título <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="Ej: Nuestra Misión"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contenido -->
                        <div class="mb-3">
                            <label for="content" class="form-label">
                                <i class="fas fa-align-left text-walpa me-1"></i>Contenido <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" 
                                      name="content" 
                                      rows="4"
                                      placeholder="Descripción detallada de la sección..."
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                <i class="fas fa-image text-walpa me-1"></i>Imagen (Opcional)
                            </label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 2MB</div>
                            
                            <!-- Preview -->
                            <div id="image-preview" class="mt-3" style="display: none;">
                                <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <!-- Lista de Items -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-list text-walpa me-1"></i>Lista de Items (Opcional)
                            </label>
                            <div class="form-text mb-2">Útil para valores, objetivos, características, etc.</div>
                            
                            <div id="list-items-container">
                                @if(old('list_items'))
                                    @foreach(old('list_items') as $index => $item)
                                        <div class="input-group mb-2 list-item">
                                            <span class="input-group-text">{{ $index + 1 }}</span>
                                            <input type="text" 
                                                   class="form-control" 
                                                   name="list_items[]" 
                                                   value="{{ $item }}"
                                                   placeholder="Item de la lista">
                                            <button type="button" class="btn btn-danger remove-item">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 list-item">
                                        <span class="input-group-text">1</span>
                                        <input type="text" 
                                               class="form-control" 
                                               name="list_items[]" 
                                               placeholder="Item de la lista">
                                        <button type="button" class="btn btn-danger remove-item">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            
                            <button type="button" id="add-item" class="btn btn-sm btn-outline-walpa">
                                <i class="fas fa-plus me-1"></i>Agregar Item
                            </button>
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="fas fa-toggle-on text-walpa me-1"></i>Sección activa
                                </label>
                            </div>
                            <div class="form-text">Solo las secciones activas se mostrarán en el sitio web</div>
                        </div>

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.company-sections.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-walpa">
                                        <i class="fas fa-save me-2"></i>Crear Sección
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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-info-circle me-2"></i>Tipos de Secciones
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($types as $key => $type)
                        <div class="mb-2">
                            <span class="badge bg-info me-2">{{ $type }}</span>
                            <small class="text-muted">
                                @switch($key)
                                    @case('mission')
                                        Propósito y razón de ser de la empresa
                                        @break
                                    @case('vision')
                                        Aspiraciones y metas a futuro
                                        @break
                                    @case('values')
                                        Principios y valores corporativos
                                        @break
                                    @case('history')
                                        Historia y trayectoria de la empresa
                                        @break
                                    @case('team')
                                        Información sobre el equipo
                                        @break
                                    @case('objectives')
                                        Objetivos y metas empresariales
                                        @break
                                @endswitch
                            </small>
                        </div>
                    @endforeach
                </div>
            </div>

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
                            <li>Usa contenido claro y conciso</li>
                            <li>Agrega imágenes de alta calidad</li>
                            <li>Los items de lista son ideales para valores</li>
                            <li>El orden determina la secuencia en el sitio</li>
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

.btn-outline-walpa {
    border-color: #D4AF37;
    color: #D4AF37;
}

.btn-outline-walpa:hover {
    background-color: #D4AF37;
    border-color: #D4AF37;
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

.input-group-text {
    background-color: #f8f9fa;
    font-weight: bold;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemCounter = {{ old('list_items') ? count(old('list_items')) : 1 }};

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

    // Gestión de lista de items
    const container = document.getElementById('list-items-container');
    const addButton = document.getElementById('add-item');

    function updateItemNumbers() {
        const items = container.querySelectorAll('.list-item');
        items.forEach((item, index) => {
            item.querySelector('.input-group-text').textContent = index + 1;
        });
        itemCounter = items.length;
    }

    function removeItem(button) {
        button.closest('.list-item').remove();
        updateItemNumbers();
    }

    // Agregar nuevo item
    addButton.addEventListener('click', function() {
        itemCounter++;
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 list-item';
        newItem.innerHTML = `
            <span class="input-group-text">${itemCounter}</span>
            <input type="text" class="form-control" name="list_items[]" placeholder="Item de la lista">
            <button type="button" class="btn btn-danger remove-item">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newItem);
        
        // Agregar event listener al botón de eliminar
        newItem.querySelector('.remove-item').addEventListener('click', function() {
            removeItem(this);
        });
    });

    // Event listeners para botones de eliminar existentes
    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item') || e.target.closest('.remove-item')) {
            const button = e.target.closest('.remove-item');
            removeItem(button);
        }
    });
});
</script>
@endpush
@endsection