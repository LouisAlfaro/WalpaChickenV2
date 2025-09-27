@extends('layouts.admin')

@section('title', 'Solicitudes de Oportunidades')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-clipboard-list text-walpa me-2"></i>Solicitudes de Oportunidades
        </h1>
        <a href="{{ route('admin.opportunities.export') }}" class="btn btn-success">
            <i class="fas fa-file-excel me-2"></i>Exportar Excel
        </a>
    </div>

    <!-- Filtros -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.opportunities.applications') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="type" class="form-label">Tipo</label>
                    <select name="type" id="type" class="form-select">
                        <option value="all">Todos los tipos</option>
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Estado</label>
                    <select name="status" id="status" class="form-select">
                        <option value="all">Todos los estados</option>
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-walpa me-2">
                        <i class="fas fa-filter me-1"></i>Filtrar
                    </button>
                    <a href="{{ route('admin.opportunities.applications') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Limpiar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Solicitudes -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-walpa">
                <i class="fas fa-list me-2"></i>Lista de Solicitudes ({{ $applications->total() }})
            </h6>
        </div>
        <div class="card-body">
            @if($applications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Empresa/Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>#{{ $application->id }}</td>
                                    <td>
                                        <span class="badge bg-{{ $application->type == 'comercial' ? 'info' : ($application->type == 'proveedores' ? 'success' : 'danger') }}">
                                            {{ $application->type_label }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $application->type === 'trabajo' ? $application->full_name : $application->company_name }}</strong>
                                        @if($application->business_area)
                                            <br><small class="text-muted">{{ $application->business_area }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->phone }}</td>
                                    <td>
                                        <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'contacted' ? 'success' : 'secondary') }}">
                                            {{ $application->status_label }}
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.opportunities.applications.show', $application) }}" 
                                               class="btn btn-sm btn-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($application->attachment)
                                                <a href="{{ $application->attachment_url }}" 
                                                   class="btn btn-sm btn-success" title="Descargar archivo" target="_blank">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('admin.opportunities.applications.destroy', $application) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar esta solicitud?')">
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

                <!-- Paginación -->
                <div class="d-flex justify-content-center">
                    {{ $applications->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay solicitudes</h5>
                    <p class="text-muted">No se encontraron solicitudes con los filtros aplicados.</p>
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
@endsection