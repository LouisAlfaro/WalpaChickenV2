@extends('layouts.admin')

@section('title', 'Ver Promoción')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-eye text-walpa me-2"></i>Ver Promoción
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Editar
            </a>
            <form action="{{ route('admin.promotions.toggle', $promotion) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn {{ $promotion->is_active ? 'btn-secondary' : 'btn-success' }}">
                    <i class="fas fa-{{ $promotion->is_active ? 'pause' : 'play' }} me-2"></i>
                    {{ $promotion->is_active ? 'Desactivar' : 'Activar' }}
                </button>
            </form>
            <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Información Principal -->
        <div class="col-lg-8">
            <!-- Imagen de la promoción -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-image me-2"></i>Imagen de la Promoción
                    </h6>
                </div>
                <div class="card-body text-center">
                    @if($promotion->image)
                        <img src="{{ asset('storage/promotions/' . $promotion->image) }}" 
                             alt="{{ $promotion->title }}" 
                             class="img-fluid rounded shadow"
                             style="max-height: 400px; width: auto;">
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="fas fa-file-image me-1"></i>{{ $promotion->image }}
                            </small>
                        </div>
                    @else
                        <div class="py-5">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay imagen disponible</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Detalles de la promoción -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-info-circle me-2"></i>Detalles de la Promoción
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Título -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong class="text-muted">
                                <i class="fas fa-heading me-1"></i>Título:
                            </strong>
                        </div>
                        <div class="col-md-9">
                            <h4 class="text-walpa mb-0">{{ $promotion->title }}</h4>
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($promotion->description)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <strong class="text-muted">
                                    <i class="fas fa-align-left me-1"></i>Descripción:
                                </strong>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0">{{ $promotion->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Enlace -->
                    @if($promotion->link)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <strong class="text-muted">
                                    <i class="fas fa-link me-1"></i>Enlace:
                                </strong>
                            </div>
                            <div class="col-md-9">
                                <a href="{{ $promotion->link }}" target="_blank" class="btn btn-sm btn-outline-walpa">
                                    <i class="fas fa-external-link-alt me-1"></i>Abrir enlace
                                </a>
                                <br><small class="text-muted">{{ $promotion->link }}</small>
                            </div>
                        </div>
                    @endif

                    <!-- Estado y Orden -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong class="text-muted">
                                <i class="fas fa-cog me-1"></i>Estado:
                            </strong>
                        </div>
                        <div class="col-md-9">
                            <span class="badge {{ $promotion->is_active ? 'bg-success' : 'bg-danger' }} me-3">
                                <i class="fas fa-{{ $promotion->is_active ? 'check' : 'times' }} me-1"></i>
                                {{ $promotion->is_active ? 'Activa' : 'Inactiva' }}
                            </span>
                            
                            <span class="badge {{ $promotion->is_current ? 'bg-info' : 'bg-warning' }} me-3">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $promotion->is_current ? 'Vigente' : 'No vigente' }}
                            </span>

                            <span class="badge bg-secondary">
                                <i class="fas fa-sort-numeric-up me-1"></i>
                                Orden: {{ $promotion->order }}
                            </span>
                        </div>
                    </div>

                    <!-- Fechas de vigencia -->
                    @if($promotion->start_date || $promotion->end_date)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <strong class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>Vigencia:
                                </strong>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex flex-wrap gap-3">
                                    @if($promotion->start_date)
                                        <div>
                                            <small class="text-muted d-block">Inicio:</small>
                                            <strong>{{ $promotion->start_date->format('d/m/Y') }}</strong>
                                        </div>
                                    @endif
                                    @if($promotion->end_date)
                                        <div>
                                            <small class="text-muted d-block">Fin:</small>
                                            <strong>{{ $promotion->end_date->format('d/m/Y') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                @if(!$promotion->start_date && !$promotion->end_date)
                                    <span class="text-muted">Sin fechas específicas (vigencia indefinida)</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Fechas de sistema -->
                    <div class="row">
                        <div class="col-md-3">
                            <strong class="text-muted">
                                <i class="fas fa-clock me-1"></i>Sistema:
                            </strong>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <small class="text-muted d-block">Creado:</small>
                                    <strong>{{ $promotion->created_at->format('d/m/Y H:i') }}</strong>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Actualizado:</small>
                                    <strong>{{ $promotion->updated_at->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Estadísticas rápidas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-chart-line me-2"></i>Resumen
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h3 class="text-walpa">{{ $promotion->order }}</h3>
                                <small class="text-muted">Posición</small>
                            </div>
                        </div>
                        <div class="col-6">
                            @php
                                $daysSinceCreated = $promotion->created_at->diffInDays(now());
                            @endphp
                            <h3 class="text-info">{{ $daysSinceCreated }}</h3>
                            <small class="text-muted">Días activa</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones rápidas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-bolt me-2"></i>Acciones Rápidas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-walpa">
                            <i class="fas fa-edit me-2"></i>Editar Promoción
                        </a>
                        
                        <form action="{{ route('admin.promotions.toggle', $promotion) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn {{ $promotion->is_active ? 'btn-secondary' : 'btn-success' }} w-100">
                                <i class="fas fa-{{ $promotion->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $promotion->is_active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>

                        @if($promotion->link)
                            <a href="{{ $promotion->link }}" target="_blank" class="btn btn-info">
                                <i class="fas fa-external-link-alt me-2"></i>Ver Enlace
                            </a>
                        @endif

                        <form action="{{ route('admin.promotions.destroy', $promotion) }}" 
                              method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar esta promoción? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Vista previa -->
            @if($promotion->is_active)
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-walpa">
                            <i class="fas fa-desktop me-2"></i>Vista Previa
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Así se ve en el sitio web:</p>
                        <div class="border rounded p-3 text-center bg-light">
                            @if($promotion->image)
                                <img src="{{ asset('storage/promotions/' . $promotion->image) }}" 
                                     alt="{{ $promotion->title }}" 
                                     class="img-fluid rounded mb-2"
                                     style="max-height: 150px;">
                            @endif
                            <h6 class="mb-1">{{ $promotion->title }}</h6>
                            @if($promotion->description)
                                <small class="text-muted">{{ Str::limit($promotion->description, 50) }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
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

.border-end {
    border-right: 1px solid #dee2e6 !important;
}
</style>
@endpush
@endsection