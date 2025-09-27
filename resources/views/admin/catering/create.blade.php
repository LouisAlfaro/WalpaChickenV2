@extends('layouts.admin')

@section('title', 'Crear Paquete de Catering')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-plus text-walpa me-2"></i>Crear Paquete de Catering
        </h1>
        <a href="{{ route('admin.catering.packages') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Información del Paquete</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.catering.packages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="name" class="form-label">Nombre del Paquete</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="Ej: 10 a 20 personas" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="order" class="form-label">Orden</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                       id="order" name="order" value="{{ old('order', 0) }}" min="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="min_people" class="form-label">Mínimo Personas</label>
                                <input type="number" class="form-control @error('min_people') is-invalid @enderror" 
                                       id="min_people" name="min_people" value="{{ old('min_people') }}" 
                                       min="1" required>
                                @error('min_people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="max_people" class="form-label">Máximo Personas</label>
                                <input type="number" class="form-control @error('max_people') is-invalid @enderror" 
                                       id="max_people" name="max_people" value="{{ old('max_people') }}" 
                                       min="1" required>
                                @error('max_people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="price_per_person" class="form-label">Precio por Persona (S/)</label>
                                <input type="number" step="0.01" class="form-control @error('price_per_person') is-invalid @enderror" 
                                       id="price_per_person" name="price_per_person" value="{{ old('price_per_person') }}" 
                                       min="0">
                                @error('price_per_person')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen del Paquete</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Características del Paquete</label>
                            <div id="features-container">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="features[]" placeholder="Característica del paquete">
                                    <button type="button" class="btn btn-danger remove-feature">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" id="add-feature" class="btn btn-sm btn-outline-walpa">
                                <i class="fas fa-plus me-1"></i>Agregar Característica
                            </button>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Paquete activo</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.catering.packages') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-walpa">
                                <i class="fas fa-save me-2"></i>Crear Paquete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Información</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i>Sobre los paquetes:</h6>
                        <ul class="mb-0 ps-3">
                            <li>Define rangos claros de personas</li>
                            <li>El precio por persona es opcional</li>
                            <li>Las características ayudan a destacar el paquete</li>
                            <li>El orden determina la posición en el sitio</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('features-container');
    const addButton = document.getElementById('add-feature');

    addButton.addEventListener('click', function() {
        const newFeature = document.createElement('div');
        newFeature.className = 'input-group mb-2';
        newFeature.innerHTML = `
            <input type="text" class="form-control" name="features[]" placeholder="Característica del paquete">
            <button type="button" class="btn btn-danger remove-feature">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newFeature);
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-feature')) {
            e.target.closest('.input-group').remove();
        }
    });
});
</script>
@endpush
@endsection