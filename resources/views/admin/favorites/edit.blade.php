@extends('layouts.admin')

@section('title', 'Editar Favorito')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar Favorito</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.favorites.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.favorites.update', $favorite) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Título -->
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $favorite->title) }}" 
                                       placeholder="Título del favorito">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Orden -->
                            <div class="col-md-6 mb-3">
                                <label for="order" class="form-label">Orden</label>
                                <input type="number" 
                                       class="form-control @error('order') is-invalid @enderror" 
                                       id="order" 
                                       name="order" 
                                       value="{{ old('order', $favorite->order ?? 0) }}" 
                                       min="0" 
                                       placeholder="0">
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
                                      placeholder="Descripción del favorito">{{ old('description', $favorite->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Imagen actual -->
                        @if($favorite->image)
                            <div class="mb-3">
                                <label class="form-label">Imagen actual:</label>
                                <div>
                                    <img src="{{ $favorite->image_url }}" 
                                         alt="{{ $favorite->title }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;">
                                </div>
                            </div>
                        @endif

                        <!-- Nueva imagen -->
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ $favorite->image ? 'Cambiar imagen' : 'Imagen' }}</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vista previa de nueva imagen -->
                        <div class="mb-3" id="imagePreview" style="display: none;">
                            <label class="form-label">Vista previa:</label>
                            <div>
                                <img id="preview" src="" alt="Vista previa" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="active" 
                                       name="active" 
                                       value="1" 
                                       {{ old('active', $favorite->active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Activo
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Favorito
                        </button>
                        <a href="{{ route('admin.favorites.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
