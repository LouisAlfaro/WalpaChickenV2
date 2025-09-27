@extends('layouts.admin')

@section('title', 'Beneficios')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-star text-walpa me-2"></i>Beneficios
        </h1>
        <a href="{{ route('admin.opportunities.benefits.create') }}" class="btn btn-walpa">
            <i class="fas fa-plus me-2"></i>Nuevo Beneficio
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Beneficios Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-walpa">
                <i class="fas fa-list me-2"></i>Lista de Beneficios
            </h6>
        </div>
        <div class="card-body">
            @if($benefits->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="table-light">
                            <tr>
                                <th width="60">Orden</th>
                                <th width="80">Icono</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th width="100">Estado</th>
                                <th width="100">Fecha</th>
                                <th width="150">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($benefits as $benefit)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ $benefit->order }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($benefit->icon)
                                            <i class="{{ $benefit->icon }} fa-lg text-walpa"></i>
                                        @else
                                            <i class="fas fa-star text-muted"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $benefit->title }}</strong>
                                    </td>
                                    <td>
                                        <small>{{ Str::limit($benefit->description, 100) }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if($benefit->is_active)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check"></i> Activo
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times"></i> Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <small class="text-muted">
                                            {{ $benefit->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.opportunities.benefits.edit', $benefit) }}" 
                                               class="btn btn-sm btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.opportunities.benefits.toggle', $benefit) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-sm {{ $benefit->is_active ? 'btn-secondary' : 'btn-success' }}" 
                                                        title="{{ $benefit->is_active ? 'Desactivar' : 'Activar' }}">
                                                    <i class="fas fa-{{ $benefit->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.opportunities.benefits.destroy', $benefit) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este beneficio?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-star fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay beneficios registrados</h5>
                    <p class="text-muted">Comienza creando beneficios para mostrar en la sección de trabajo.</p>
                    <a href="{{ route('admin.opportunities.benefits.create') }}" class="btn btn-walpa">
                        <i class="fas fa-plus me-2"></i>Crear Primer Beneficio
                    </a>
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

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.badge {
    font-size: 0.75em;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        },
        "order": [[ 0, "asc" ]],
        "pageLength": 25,
        "responsive": true
    });
});
</script>
@endpush
@endsection