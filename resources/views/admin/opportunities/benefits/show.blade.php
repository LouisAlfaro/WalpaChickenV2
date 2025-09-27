@extends('layouts.admin')

@section('title', 'Ver Beneficio')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-eye text-walpa me-2"></i>Ver Beneficio
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.opportunities.benefits.edit', $benefit) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Editar
            </a>
            <form action="{{ route('admin.opportunities.benefits.toggle', $benefit) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn {{ $benefit->is_active ? 'btn-secondary' : 'btn-success' }}">
                    <i class="fas fa-{{ $benefit->is_active ? 'pause' : 'play' }} me-2"></i>
                    {{ $benefit->is_active ? 'Desactivar' : 'Activar' }}
                </button>
            </form>
            <a href="{{ route('admin.opportunities.benefits') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Contenido del beneficio -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-info-circle me-2"></i>Información del Beneficio
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h2 class="text-walpa mb-0">{{ $benefit->title }}</h2>
                        </div>
                        <div class="col-md-4 text-end">
                            @if($benefit->icon)
                                <i class="{{ $benefit->icon }} fa-3x text-walpa"></i>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted mb-3">
                            <i class="fas fa-align-left me-2"></i>Descripción
                        </h5>
                        <div class="content-display p-3 bg-light rounded">
                            <p class="mb-0">{{ $benefit->description }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-sort-numeric-up me-1"></i>Orden de visualización:
                            </h6>
                            <span class="badge bg-secondary fs-6">{{ $benefit->order }}</span>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-cog me-1"></i>Estado:
                            </h6>
                            <span class="badge {{ $benefit->is_active ? 'bg-success' : 'bg-danger' }} fs-6">
                                <i class="fas fa-{{ $benefit->is_active ? 'check' : 'times' }} me-1"></i>
                                {{ $benefit->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del sistema -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-clock me-2"></i>Información del Sistema
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="text-muted d-block">Fecha de creación:</strong>
                            <p class="mb-0">{{ $benefit->created_at->format('d/m/Y H:i:s') }}</p>
                            <small class="text-muted">{{ $benefit->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-md-6">
                            <strong class="text-muted d-block">Última actualización:</strong>
                            <p class="mb-0">{{ $benefit->updated_at->format('d/m/Y H:i:s') }}</p>
                            <small class="text-muted">{{ $benefit->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Vista previa -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-desktop me-2"></i>Vista Previa
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Así se verá en el sitio web:</p>
                    <div class="border rounded p-3 bg-light">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                @if($benefit->icon)
                                    <i class="{{ $benefit->icon }} fa-2x text-walpa"></i>
                                @else
                                    <i class="fas fa-star fa-2x text-walpa"></i>
                                @endif
                            </div>
                            <div>
                                <h6 class="mb-1 text-walpa">{{ $benefit->title }}</h6>
                                <p class="small text-muted mb-0">{{ $benefit->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones rápidas -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-bolt me-2"></i>Acciones Rápidas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.opportunities.benefits.edit', $benefit) }}" class="btn btn-walpa">
                            <i class="fas fa-edit me-2"></i>Editar Beneficio
                        </a>
                        
                        <form action="{{ route('admin.opportunities.benefits.toggle', $benefit) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $benefit->is_active ? 'btn-secondary' : 'btn-success' }} w-100">
                                <i class="fas fa-{{ $benefit->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $benefit->is_active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.opportunities.benefits.destroy', $benefit) }}" 
                              method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar este beneficio?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Eliminar
                            </button>
                        </form>
                    </div>
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

.content-display {
    font-size: 1.1rem;
    line-height: 1.6;
}

.fs-6 {
    font-size: 0.875rem !important;
}
</style>
@endpush
@endsection