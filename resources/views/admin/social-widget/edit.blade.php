{{-- resources/views/admin/social-widget/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Widget de Redes Sociales')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">Widget de Redes Sociales</h2>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.social-widget.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Estado</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               id="is_active" name="is_active" value="1"
                                               {{ old('is_active', $widget->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Mostrar widget en el sitio web
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Posición</label>
                                    <select class="form-select" id="position" name="position" required>
                                        <option value="left" {{ old('position', $widget->position) == 'left' ? 'selected' : '' }}>
                                            Izquierda
                                        </option>
                                        <option value="right" {{ old('position', $widget->position) == 'right' ? 'selected' : '' }}>
                                            Derecha
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="background_color" class="form-label">Color de fondo</label>
                            <input type="color" class="form-control form-control-color" 
                                   id="background_color" name="background_color" 
                                   value="{{ old('background_color', $widget->background_color) }}">
                        </div>

                        <h5 class="mb-3">Enlaces de Redes Sociales</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">
                                        <i class="fab fa-facebook me-2"></i>Facebook
                                    </label>
                                    <input type="url" class="form-control" id="facebook" 
                                           name="social_links[facebook]" 
                                           value="{{ old('social_links.facebook', $widget->social_links['facebook'] ?? '') }}"
                                           placeholder="https://facebook.com/tu-pagina">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">
                                        <i class="fab fa-instagram me-2"></i>Instagram
                                    </label>
                                    <input type="url" class="form-control" id="instagram" 
                                           name="social_links[instagram]" 
                                           value="{{ old('social_links.instagram', $widget->social_links['instagram'] ?? '') }}"
                                           placeholder="https://instagram.com/tu-cuenta">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tiktok" class="form-label">
                                        <i class="fab fa-tiktok me-2"></i>TikTok
                                    </label>
                                    <input type="url" class="form-control" id="tiktok" 
                                           name="social_links[tiktok]" 
                                           value="{{ old('social_links.tiktok', $widget->social_links['tiktok'] ?? '') }}"
                                           placeholder="https://tiktok.com/@tu-cuenta">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="linkedin" class="form-label">
                                        <i class="fab fa-linkedin me-2"></i>LinkedIn
                                    </label>
                                    <input type="url" class="form-control" id="linkedin" 
                                           name="social_links[linkedin]" 
                                           value="{{ old('social_links.linkedin', $widget->social_links['linkedin'] ?? '') }}"
                                           placeholder="https://linkedin.com/company/tu-empresa">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="twitter" class="form-label">
                                        <i class="fab fa-twitter me-2"></i>Twitter/X
                                    </label>
                                    <input type="url" class="form-control" id="twitter" 
                                           name="social_links[twitter]" 
                                           value="{{ old('social_links.twitter', $widget->social_links['twitter'] ?? '') }}"
                                           placeholder="https://twitter.com/tu-cuenta">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6>Vista Previa</h6>
                </div>
                <div class="card-body">
                    <div class="position-relative" style="height: 200px; background: #f8f9fa;">
                        <div id="preview-widget" class="social-widget-floating" 
                             style="position: absolute; top: 50%; transform: translateY(-50%); {{ $widget->position == 'left' ? 'left: 20px;' : 'right: 20px;' }}">
                            <div class="social-icons-vertical" style="background: {{ $widget->background_color }};">
                                @if(!empty($widget->social_links['facebook']))
                                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                                @endif
                                @if(!empty($widget->social_links['instagram']))
                                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if(!empty($widget->social_links['tiktok']))
                                    <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                                @endif
                                @if(!empty($widget->social_links['linkedin']))
                                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                                @endif
                                @if(!empty($widget->social_links['twitter']))
                                    <a href="#" class="social-icon"><i class="fab fa-times"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection