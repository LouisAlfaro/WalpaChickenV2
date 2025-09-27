@extends('layouts.admin')

@section('title', 'Editar Información de Catering')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit text-walpa me-2"></i>Editar Información de Catering
        </h1>
        <a href="{{ route('admin.catering.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Información Principal</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.catering.update-info') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Título Principal</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" 
                                   value="{{ old('title', $cateringInfo->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $cateringInfo->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="main_image" class="form-label">Imagen Principal</label>
                            @if($cateringInfo && $cateringInfo->main_image)
                                <div class="mb-2">
                                    <img src="{{ $cateringInfo->main_image_url }}" class="img-thumbnail" style="max-width: 200px;">
                                    <p class="small text-muted">Imagen actual</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" 
                                   id="main_image" name="main_image" accept="image/*">
                            @error('main_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="images" class="form-label">Imágenes Adicionales</label>
                            <input type="file" class="form-control @error('images.*') is-invalid @enderror" 
                                   id="images" name="images[]" accept="image/*" multiple>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Puedes seleccionar múltiples imágenes</div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.catering.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-walpa">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Consejos</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-lightbulb me-2"></i>Recomendaciones:</h6>
                        <ul class="mb-0 ps-3">
                            <li>Usa imágenes de alta calidad</li>
                            <li>La descripción debe ser atractiva</li>
                            <li>Incluye información sobre el servicio</li>
                            <li>Las imágenes adicionales se mostrarán en galería</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection