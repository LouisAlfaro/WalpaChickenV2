@extends('layouts.admin')

@section('title', 'Ver Sección de Empresa')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-eye text-walpa me-2"></i>Ver Sección de Empresa
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.company-sections.edit', $companySection) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Editar
            </a>
            <form action="{{ route('admin.company-sections.toggle', $companySection) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn {{ $companySection->is_active ? 'btn-secondary' : 'btn-success' }}">
                    <i class="fas fa-{{ $companySection->is_active ? 'pause' : 'play' }} me-2"></i>
                    {{ $companySection->is_active ? 'Desactivar' : 'Activar' }}
                </button>
            </form>
            <a href="{{ route('admin.company-sections.index') }}" class="btn btn-secondary">
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
            <!-- Imagen de la sección -->
            @if($companySection->image)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-walpa">
                            <i class="fas fa-image me-2"></i>Imagen de la Sección
                        </h6>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/company/' . $companySection->image) }}" 
                             alt="{{ $companySection->title }}" 
                             class="img-fluid rounded shadow"
                             style="max-height: 400px; width: auto;">
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="fas fa-file-image me-1"></i>{{ $companySection->image }}
                            </small>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contenido de la sección -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-info-circle me-2"></i>Contenido de la Sección
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Título y Tipo -->
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <h2 class="text-walpa mb-0">{{ $companySection->title }}</h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="badge bg-info fs-6">
                                {{ App\Models\CompanySection::getTypes()[$companySection->type] }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="mb-4">
                        <h5 class="text-muted mb-3">
                            <i class="fas fa-align-left me-2"></i>Descripción
                        </h5>
                        <div class="content-display p-3 bg-light rounded">
                            <p class="mb-0" style="white-space: pre-line;">{{ $companySection->content }}</p>
                        </div>
                    </div>

                    <!-- Lista de Items -->
                    @if($companySection->list_items && count($companySection->list_items) > 0)
                        <div class="mb-4">
                            <h5 class="text-muted mb-3">
                                <i class="fas fa-list me-2"></i>Items ({{ count($companySection->list_items) }})
                            </h5>
                            <div class="row">
                                @foreach($companySection->list_items as $index => $item)
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex align-items-center p-2 bg-light rounded">
                                            <span class="badge bg-walpa me-3">{{ $index + 1 }}</span>
                                            <span>{{ $item }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Estado y configuración -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-cog me-1"></i>Estado:
                            </h6>
                            <span class="badge {{ $companySection->is_active ? 'bg-success' : 'bg-danger' }} fs-6">
                                <i class="fas fa-{{ $companySection->is_active ? 'check' : 'times' }} me-1"></i>
                                {{ $companySection->is_active ? 'Activa' : 'Inactiva' }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-sort-numeric-up me-1"></i>Orden de visualización:
                            </h6>
                            <span class="badge bg-secondary fs-6">{{ $companySection->order }}</span>
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
                            <p class="mb-0">{{ $companySection->created_at->format('d/m/Y H:i:s') }}</p>
                            <small class="text-muted">{{ $companySection->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-md-6">
                            <strong class="text-muted d-block">Última actualización:</strong>
                            <p class="mb-0">{{ $companySection->updated_at->format('d/m/Y H:i:s') }}</p>
                            <small class="text-muted">{{ $companySection->updated_at->diffForHumans() }}</small>
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
                                <h3 class="text-walpa">{{ $companySection->order }}</h3>
                                <small class="text-muted">Posición</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="text-info">{{ $companySection->list_items ? count($companySection->list_items) : 0 }}</h3>
                            <small class="text-muted">Items</small>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                @php
                                    $wordCount = str_word_count($companySection->content);
                                @endphp
                                <h5 class="text-secondary">{{ $wordCount }}</h5>
                                <small class="text-muted">Palabras</small>
                            </div>
                        </div>
                        <div class="col-6">
                            @php
                                $daysSinceCreated = $companySection->created_at->diffInDays(now());
                            @endphp
                            <h5 class="text-secondary">{{ $daysSinceCreated }}</h5>
                            <small class="text-muted">Días creada</small>
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
                        <a href="{{ route('admin.company-sections.edit', $companySection) }}" class="btn btn-walpa">
                            <i class="fas fa-edit me-2"></i>Editar Sección
                        </a>
                        
                        <form action="{{ route('admin.company-sections.toggle', $companySection) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $companySection->is_active ? 'btn-secondary' : 'btn-success' }} w-100">
                                <i class="fas fa-{{ $companySection->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $companySection->is_active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.company-sections.destroy', $companySection) }}" 
                              method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar esta sección? Esta acción no se puede deshacer.')">
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
            @if($companySection->is_active)
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-walpa">
                            <i class="fas fa-desktop me-2"></i>Vista Previa
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Así se verá en el sitio web:</p>
                        <div class="border rounded p-3 bg-light">
                            @if($companySection->image)
                                <img src="{{ asset('storage/company/' . $companySection->image) }}" 
                                     alt="{{ $companySection->title }}" 
                                     class="img-fluid rounded mb-3"
                                     style="max-height: 120px; width: 100%; object-fit: cover;">
                            @endif
                            <h6 class="text-walpa fw-bold">{{ $companySection->title }}</h6>
                            <p class="mb-2 small">{{ Str::limit($companySection->content, 100) }}</p>
                            @if($companySection->list_items && count($companySection->list_items) > 0)
                                <small class="text-muted">
                                    <i class="fas fa-list me-1"></i>
                                    {{ count($companySection->list_items) }} items
                                </small>
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

.text-walpa {
    color: #D4AF37 !important;
}

.bg-walpa {
    background-color: #D4AF37 !important;
}

.border-end {
    border-right: 1px solid #dee2e6 !important;
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