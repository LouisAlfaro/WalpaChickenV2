@extends('layouts.admin')

@section('title', 'Editar Ubicación')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar Ubicación</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.locations.update', $location) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Nombre -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nombre del Local</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $location->name) }}" 
                                       placeholder="Ej: WALPA CHICKEN SAN MARTÍN">
                                @error('name')
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
                                       value="{{ old('order', $location->order ?? 0) }}" 
                                       min="0" 
                                       placeholder="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="2" 
                                      placeholder="Av. Santa Rosa de Lima 695, San Juan de Lurigancho 15438">{{ old('address', $location->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Teléfono -->
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $location->phone) }}" 
                                       placeholder="(01) 748-2626">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- WhatsApp URL -->
                            <div class="col-md-6 mb-3">
                                <label for="whatsapp_url" class="form-label">URL de WhatsApp</label>
                                <input type="url" 
                                       class="form-control @error('whatsapp_url') is-invalid @enderror" 
                                       id="whatsapp_url" 
                                       name="whatsapp_url" 
                                       value="{{ old('whatsapp_url', $location->whatsapp_url) }}" 
                                       placeholder="https://wa.me/51987654321">
                                @error('whatsapp_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Google Maps URL -->
                        <div class="mb-3">
                            <label for="maps_url" class="form-label">URL de Google Maps</label>
                            <input type="url" 
                                   class="form-control @error('maps_url') is-invalid @enderror" 
                                   id="maps_url" 
                                   name="maps_url" 
                                   value="{{ old('maps_url', $location->maps_url) }}" 
                                   placeholder="https://maps.google.com/...">
                            @error('maps_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Descripción adicional del local">{{ old('description', $location->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Imagen actual -->
                        @if($location->image)
                            <div class="mb-3">
                                <label class="form-label">Imagen actual:</label>
                                <div>
                                    <img src="{{ $location->image_url }}" 
                                         alt="{{ $location->name }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 300px;">
                                </div>
                            </div>
                        @endif

                        <!-- Nueva imagen -->
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ $location->image ? 'Cambiar imagen' : 'Imagen del Local' }}</label>
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
                                <img id="preview" src="" alt="Vista previa" class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        @if($location->menu_pdf)
                            <div class="mb-3">
                                <label class="form-label">Carta PDF actual:</label>
                                <div class="d-flex align-items-center gap-3">
                                    <a href="{{ $location->menu_pdf_url }}" 
                                    target="_blank" 
                                    class="btn btn-outline-danger">
                                        <i class="fas fa-file-pdf"></i> Ver PDF Actual
                                    </a>
                                    <span class="text-muted">{{ $location->menu_pdf }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Nuevo PDF -->
                        <div class="mb-3">
                            <label for="menu_pdf" class="form-label">{{ $location->menu_pdf ? 'Cambiar Carta PDF' : 'Carta PDF' }}</label>
                            <input type="file" 
                                class="form-control @error('menu_pdf') is-invalid @enderror" 
                                id="menu_pdf" 
                                name="menu_pdf" 
                                accept="application/pdf">
                            <div class="form-text">Archivo PDF de la carta del local. Tamaño máximo: 10MB</div>
                            @error('menu_pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($location->promotions_pdf)
                            <div class="mb-3">
                                <label class="form-label">Promociones PDF actual:</label>
                                <div class="d-flex align-items-center gap-3">
                                    <a href="{{ $location->promotions_pdf_url }}" 
                                    target="_blank" 
                                    class="btn btn-outline-danger">
                                        <i class="fas fa-file-pdf"></i> Ver PDF Actual
                                    </a>
                                    <span class="text-muted">{{ $location->promotions_pdf }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Nuevo PDF de Promociones -->
                        <div class="mb-3">
                            <label for="promotions_pdf" class="form-label">{{ $location->promotions_pdf ? 'Cambiar Promociones PDF' : 'Promociones PDF' }}</label>
                            <input type="file" 
                                class="form-control @error('promotions_pdf') is-invalid @enderror" 
                                id="promotions_pdf" 
                                name="promotions_pdf" 
                                accept="application/pdf">
                            <div class="form-text">Archivo PDF de promociones del local. Tamaño máximo: 10MB</div>
                            @error('promotions_pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="active" 
                                       name="active" 
                                       value="1" 
                                       {{ old('active', $location->active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Activo
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Ubicación
                        </button>
                        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">
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