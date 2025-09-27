@extends('layouts.admin')

@section('title', 'Editar Popup Promocional')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">Editar Popup: {{ $promotionalPopup->title }}</h2>
                <a href="{{ route('admin.promotional-popups.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.promotional-popups.update', $promotionalPopup) }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Título *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" 
                                           value="{{ old('title', $promotionalPopup->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="display_frequency" class="form-label">Frecuencia (horas) *</label>
                                    <select class="form-control @error('display_frequency') is-invalid @enderror" 
                                            id="display_frequency" name="display_frequency">
                                        <option value="1" {{ old('display_frequency', $promotionalPopup->display_frequency) == 1 ? 'selected' : '' }}>1 hora</option>
                                        <option value="6" {{ old('display_frequency', $promotionalPopup->display_frequency) == 6 ? 'selected' : '' }}>6 horas</option>
                                        <option value="12" {{ old('display_frequency', $promotionalPopup->display_frequency) == 12 ? 'selected' : '' }}>12 horas</option>
                                        <option value="24" {{ old('display_frequency', $promotionalPopup->display_frequency) == 24 ? 'selected' : '' }}>24 horas</option>
                                        <option value="48" {{ old('display_frequency', $promotionalPopup->display_frequency) == 48 ? 'selected' : '' }}>48 horas</option>
                                        <option value="168" {{ old('display_frequency', $promotionalPopup->display_frequency) == 168 ? 'selected' : '' }}>1 semana</option>
                                    </select>
                                    @error('display_frequency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen del Popup</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if($promotionalPopup->image_url)
                                <div class="mt-2">
                                    <p class="small text-muted mb-2">Imagen actual:</p>
                                    <img src="{{ $promotionalPopup->image_url }}" 
                                         alt="{{ $promotionalPopup->title }}" 
                                         class="img-thumbnail" style="max-width: 300px;">
                                </div>
                            @endif
                            
                            <small class="form-text text-muted">Dejar vacío para mantener la imagen actual. Máximo 2MB.</small>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Enlace (opcional)</label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror" 
                                   id="link" name="link" 
                                   value="{{ old('link', $promotionalPopup->link) }}" 
                                   placeholder="https://ejemplo.com">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Fecha de inicio</label>
                                    <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" 
                                           id="start_date" name="start_date" 
                                           value="{{ old('start_date', $promotionalPopup->start_date?->format('Y-m-d\TH:i')) }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Fecha de fin</label>
                                    <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" 
                                           id="end_date" name="end_date" 
                                           value="{{ old('end_date', $promotionalPopup->end_date?->format('Y-m-d\TH:i')) }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $promotionalPopup->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Activar popup (desactivará otros popups activos)
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.promotional-popups.index') }}" class="btn btn-secondary me-md-2">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Actualizar Popup
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection