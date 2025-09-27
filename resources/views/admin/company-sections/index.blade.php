@extends('layouts.admin')

@section('title', 'Nuestra Empresa')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-building text-walpa me-2"></i>Nuestra Empresa
        </h1>
        <a href="{{ route('admin.company-sections.create') }}" class="btn btn-walpa">
            <i class="fas fa-plus me-2"></i>Nueva Sección
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Secciones Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-walpa">
                <i class="fas fa-list me-2"></i>Secciones de la Empresa
            </h6>
        </div>
        <div class="card-body">
            @if($sections->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="table-light">
                            <tr>
                                <th width="60">Orden</th>
                                <th width="80">Imagen</th>
                                <th width="120">Tipo</th>
                                <th>Título</th>
                                <th>Contenido</th>
                                <th width="80">Items</th>
                                <th width="100">Estado</th>
                                <th width="100">Fecha</th>
                                <th width="150">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ $section->order }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($section->image)
                                            <img src="{{ asset('storage/company/' . $section->image) }}" 
                                                 alt="{{ $section->title }}" 
                                                 class="rounded img-thumbnail"
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ App\Models\CompanySection::getTypes()[$section->type] }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $section->title }}</strong>
                                    </td>
                                    <td>
                                        <small>{{ Str::limit($section->content, 80) }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if($section->list_items && count($section->list_items) > 0)
                                            <span class="badge bg-success">
                                                {{ count($section->list_items) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($section->is_active)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check"></i> Activa
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times"></i> Inactiva
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <small class="text-muted">
                                            {{ $section->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.company-sections.show', $section) }}" 
                                               class="btn btn-sm btn-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.company-sections.edit', $section) }}" 
                                               class="btn btn-sm btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.company-sections.toggle', $section) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-sm {{ $section->is_active ? 'btn-secondary' : 'btn-success' }}" 
                                                        title="{{ $section->is_active ? 'Desactivar' : 'Activar' }}">
                                                    <i class="fas fa-{{ $section->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.company-sections.destroy', $section) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar esta sección?')">
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
                    <i class="fas fa-building fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay secciones registradas</h5>
                    <p class="text-muted">Comienza creando secciones para mostrar información de tu empresa.</p>
                    <a href="{{ route('admin.company-sections.create') }}" class="btn btn-walpa">
                        <i class="fas fa-plus me-2"></i>Crear Primera Sección
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Información adicional -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-left-walpa shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-walpa text-uppercase mb-1">
                                Tipos de Secciones Disponibles
                            </div>
                            <div class="row">
                                @foreach(App\Models\CompanySection::getTypes() as $key => $type)
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-circle me-1" style="color: {{ ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14'][array_search($key, array_keys(App\Models\CompanySection::getTypes()))] }}"></i>
                                            {{ $type }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                        </div>
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

.border-left-walpa {
    border-left: 0.25rem solid #D4AF37 !important;
}

.img-thumbnail {
    border: 2px solid #dee2e6;
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