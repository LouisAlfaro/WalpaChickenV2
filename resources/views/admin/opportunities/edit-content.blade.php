@extends('layouts.admin')

@section('title', 'Editar Contenido - ' . $types[$type])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit text-walpa me-2"></i>Editar Contenido - {{ $types[$type] }}
        </h1>
        <a href="{{ route('admin.opportunities.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-{{ $type === 'comercial' ? 'handshake' : ($type === 'proveedores' ? 'truck' : 'users') }} me-2"></i>
                        Contenido para {{ $types[$type] }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.opportunities.content.update', $type) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading text-walpa me-1"></i>Título
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" 
                                   value="{{ old('title', $content->title ?? '') }}" 
                                   placeholder="Ej: Formulario {{ $types[$type] }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left text-walpa me-1"></i>Descripción
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4"
                                      placeholder="Descripción del contenido...">{{ old('description', $content->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">
                                <i class="fas fa-image text-walpa me-1"></i>Imagen
                            </label>
                            
                            @if($content && $content->image)
                                <div class="mb-3">
                                    <label class="form-label text-muted">Imagen actual:</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $content->image_url }}" 
                                             alt="{{ $content->title }}" 
                                             class="img-thumbnail"
                                             style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                        <div>
                                            <p class="mb-1"><strong>{{ $content->image }}</strong></p>
                                            <small class="text-muted">Subir una nueva imagen reemplazará la actual</small>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 2MB
                                @if(!$content || !$content->image) 
                                    <span class="text-info">(Recomendado para una mejor presentación)</span> 
                                @endif
                            </div>
                            
                            <!-- Preview nueva imagen -->
                            <div id="image-preview" class="mt-3" style="display: none;">
                                <label class="form-label text-muted">Vista previa:</label>
                                <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.opportunities.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-walpa">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Información del tipo -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-info-circle me-2"></i>Información
                    </h6>
                </div>
                <div class="card-body">
                    @if($content)
                        <div class="row text-center mb-3">
                            <div class="col-6">
                                <div class="border-end">
                                    <h5 class="{{ $content->is_active ? 'text-success' : 'text-danger' }}">
                                        {{ $content->is_active ? 'Activo' : 'Inactivo' }}
                                    </h5>
                                    <small class="text-muted">Estado</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="text-info">{{ $type }}</h5>
                                <small class="text-muted">Tipo</small>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <small class="text-muted d-block">Creado:</small>
                                <p>{{ $content->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-12">
                                <small class="text-muted d-block">Última actualización:</small>
                                <p>{{ $content->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Nuevo Contenido</h6>
                            <p class="mb-0">Estás creando contenido nuevo para la sección {{ $types[$type] }}.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Consejos por tipo -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-lightbulb me-2"></i>Consejos para {{ $types[$type] }}
                    </h6>
                </div>
                <div class="card-body">
                    @if($type === 'comercial')
                        <div class="alert alert-info">
                            <h6><i class="fas fa-handshake me-2"></i>Comercial:</h6>
                            <ul class="mb-0 ps-3">
                                <li>Enfócate en los beneficios de ser socio comercial</li>
                                <li>Incluye información sobre términos comerciales</li>
                                <li>Usa imágenes que muestren productos o locales</li>
                                <li>Destaca la experiencia de la marca</li>
                            </ul>
                        </div>
                    @elseif($type === 'proveedores')
                        <div class="alert alert-success">
                            <h6><i class="fas fa-truck me-2"></i>Proveedores:</h6>
                            <ul class="mb-0 ps-3">
                                <li>Explica los requisitos para ser proveedor</li>
                                <li>Menciona los estándares de calidad</li>
                                <li>Incluye información sobre procesos de evaluación</li>
                                <li>Usa imágenes de productos o procesos</li>
                            </ul>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-users me-2"></i>Trabajo:</h6>
                            <ul class="mb-0 ps-3">
                                <li>Destaca la cultura empresarial</li>
                                <li>Menciona oportunidades de crecimiento</li>
                                <li>Incluye beneficios laborales</li>
                                <li>Usa imágenes del equipo o ambiente laboral</li>
                            </ul>
                        </div>
                    @endif
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
});
</script>
@endpush
@endsection