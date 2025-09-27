@extends('layouts.admin')

@section('title', 'Promociones')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-percentage text-walpa me-2"></i>Promociones
        </h1>
        <a href="{{ route('admin.promotions.create') }}" class="btn btn-walpa">
            <i class="fas fa-plus me-2"></i>Nueva Promoción
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Promociones Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-walpa">
                <i class="fas fa-list me-2"></i>Lista de Promociones
            </h6>
        </div>
        <div class="card-body">
            @if($promotions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="table-light">
                            <tr>
                                <th width="60">Orden</th>
                                <th width="80">Imagen</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th width="100">Estado</th>
                                <th width="120">Vigencia</th>
                                <th width="100">Fecha</th>
                                <th width="150">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promotions as $promotion)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ $promotion->order }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($promotion->image)
                                            <img src="{{ asset('storage/promotions/' . $promotion->image) }}" 
                                                 alt="{{ $promotion->title }}" 
                                                 class="rounded img-thumbnail"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $promotion->title }}</strong>
                                        @if($promotion->link)
                                            <br><small class="text-muted">
                                                <i class="fas fa-link"></i> 
                                                <a href="{{ $promotion->link }}" target="_blank">Ver enlace</a>
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($promotion->description)
                                            <small>{{ Str::limit($promotion->description, 80) }}</small>
                                        @else
                                            <span class="text-muted">Sin descripción</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($promotion->is_active)
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
                                        @if($promotion->is_current)
                                            <span class="badge bg-info">
                                                <i class="fas fa-calendar-check"></i> Vigente
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-calendar-times"></i> No vigente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <small class="text-muted">
                                            {{ $promotion->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.promotions.show', $promotion) }}" 
                                               class="btn btn-sm btn-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.promotions.edit', $promotion) }}" 
                                               class="btn btn-sm btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.promotions.toggle', $promotion) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-sm {{ $promotion->is_active ? 'btn-secondary' : 'btn-success' }}" 
                                                        title="{{ $promotion->is_active ? 'Desactivar' : 'Activar' }}">
                                                    <i class="fas fa-{{ $promotion->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.promotions.destroy', $promotion) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar esta promoción?')">
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
                    <i class="fas fa-percentage fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay promociones registradas</h5>
                    <p class="text-muted">Comienza creando tu primera promoción.</p>
                    <a href="{{ route('admin.promotions.create') }}" class="btn btn-walpa">
                        <i class="fas fa-plus me-2"></i>Crear Primera Promoción
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