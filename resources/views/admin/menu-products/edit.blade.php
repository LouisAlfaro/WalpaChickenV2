@extends('layouts.admin')

@section('title', 'Editar Producto')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar Producto</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.menu-products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.menu-products.update', $menuProduct) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Nombre -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nombre del Producto</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $menuProduct->name) }}" 
                                       placeholder="Ej: El Práctico">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Precio -->
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Precio (S/)</label>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price', $menuProduct->price) }}" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="1.00">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Local -->
                            <div class="col-md-6 mb-3">
                                <label for="location_id" class="form-label">Local</label>
                                <select class="form-control @error('location_id') is-invalid @enderror" 
                                        id="location_id" 
                                        name="location_id">
                                    <option value="">Seleccionar local...</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" 
                                                {{ old('location_id', $menuProduct->location_id) == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
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
                                       value="{{ old('order', $menuProduct->order ?? 0) }}" 
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
                                      placeholder="Ej: Jugo de Papaya">{{ old('description', $menuProduct->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Imagen actual -->
                        @if($menuProduct->image)
                            <div class="mb-3">
                                <label class="form-label">Imagen actual:</label>
                                <div>
                                    <img src="{{ $menuProduct->image_url }}" 
                                         alt="{{ $menuProduct->name }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;">
                                </div>
                            </div>
                        @endif

                        <!-- Nueva imagen -->
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ $menuProduct->image ? 'Cambiar imagen' : 'Imagen del Producto' }}</label>
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
                                       {{ old('active', $menuProduct->active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Activo
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Producto
                        </button>
                        <a href="{{ route('admin.menu-products.index') }}" class="btn btn-secondary">
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