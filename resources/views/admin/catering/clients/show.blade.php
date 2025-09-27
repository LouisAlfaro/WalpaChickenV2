@extends('layouts.admin')

@section('title', 'Detalles del Cliente')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0"><i class="fas fa-user me-2"></i>{{ $client->name }}</h1>
                <div class="btn-group">
                    <a href="{{ route('admin.catering.clients.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Volver
                    </a>
                    <a href="{{ route('admin.catering.clients.edit', $client) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Editar
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Información del Cliente</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nombre:</label>
                                        <p class="mb-0">{{ $client->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Estado:</label>
                                        <p class="mb-0">
                                            @if($client->is_active)
                                                <span class="badge bg-success fs-6">Activo</span>
                                            @else
                                                <span class="badge bg-danger fs-6">Inactivo</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($client->description)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Descripción:</label>
                                    <p class="mb-0">{{ $client->description }}</p>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Industria:</label>
                                        <p class="mb-0">
                                            @if($client->industry)
                                                <span class="badge bg-secondary fs-6">{{ $client->industry }}</span>
                                            @else
                                                <span class="text-muted">No especificada</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Orden de Visualización:</label>
                                        <p class="mb-0">
                                            <span class="badge bg-info fs-6">{{ $client->order }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($client->website)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Sitio Web:</label>
                                    <p class="mb-0">
                                        <a href="{{ $client->website }}" target="_blank" class="text-decoration-none">
                                            <i class="fas fa-external-link-alt me-1"></i>{{ $client->website }}
                                        </a>
                                    </p>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Fecha de Creación:</label>
                                        <p class="mb-0">{{ $client->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Última Actualización:</label>
                                        <p class="mb-0">{{ $client->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-image me-2"></i>Logo</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ $client->logo_url }}" 
                                 alt="{{ $client->name }}" 
                                 class="img-fluid rounded"
                                 style="max-height: 200px; width: 100%; object-fit: contain;">
                        </div>
                    </div>

                    <div class="card shadow-sm mt-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-cogs me-2"></i>Acciones</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.catering.clients.edit', $client) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Editar Cliente
                                </a>
                                
                                <form action="{{ route('admin.catering.clients.destroy', $client) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de eliminar este cliente? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-trash me-2"></i>Eliminar Cliente
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection