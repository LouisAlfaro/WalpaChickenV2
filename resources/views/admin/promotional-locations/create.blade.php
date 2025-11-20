@extends('layouts.admin')

@section('title', 'Crear Promoción')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Agregar Nueva Promoción</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.promotional-locations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.promotional-locations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Nombre -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nombre de la Promoción</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Ej: Promoción San Martín">
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
                                       value="{{ old('order', 0) }}" 
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
                                      placeholder="Av. Santa Rosa de Lima 695, San Juan de Lurigancho 15438">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Teléfono -->
                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="(01) 748-2626">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Horario -->
                            <div class="col-md-4 mb-3">
                                <label for="schedule" class="form-label">Horario</label>
                                <input type="text" 
                                       class="form-control @error('schedule') is-invalid @enderror" 
                                       id="schedule" 
                                       name="schedule" 
                                       value="{{ old('schedule') }}" 
                                       placeholder="Lun - Dom: 11:00 AM - 10:00 PM">
                                @error('schedule')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- WhatsApp URL -->
                            <div class="col-md-4 mb-3">
                                <label for="whatsapp_url" class="form-label">URL de WhatsApp</label>
                                <input type="url" 
                                       class="form-control @error('whatsapp_url') is-invalid @enderror" 
                                       id="whatsapp_url" 
                                       name="whatsapp_url" 
                                       value="{{ old('whatsapp_url') }}" 
                                       placeholder="https://wa.me/51987654321">
                                @error('whatsapp_url')
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
                                      placeholder="Descripción de la promoción">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- PDF Promoción -->
                        <div class="mb-3">
                            <label for="promotion_pdf" class="form-label">PDF de Promoción</label>
                            <input type="file" 
                                class="form-control @error('promotion_pdf') is-invalid @enderror" 
                                id="promotion_pdf" 
                                name="promotion_pdf" 
                                accept="application/pdf">
                            <div class="form-text">Archivo PDF con detalles de la promoción. Tamaño máximo: 10MB</div>
                            @error('promotion_pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen de la Promoción</label>
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

                        <!-- Vista previa de imagen -->
                        <div class="mb-3" id="imagePreview" style="display: none;">
                            <label class="form-label">Vista previa:</label>
                            <div>
                                <img id="preview" src="" alt="Vista previa" class="img-thumbnail" style="max-width: 300px;">
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
                                       {{ old('active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Activo
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Promoción
                        </button>
                        <a href="{{ route('admin.promotional-locations.index') }}" class="btn btn-secondary">
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
