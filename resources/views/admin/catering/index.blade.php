@extends('layouts.admin')

@section('title', 'Catering Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-utensils text-walpa me-2"></i>Catering Dashboard
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.catering.edit-info') }}" class="btn btn-walpa">
                <i class="fas fa-edit me-2"></i>Editar Info
            </a>
            <a href="{{ route('admin.catering.packages.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Nuevo Paquete
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

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Solicitudes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRequests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pendientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingRequests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Catering</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cateringRequests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-utensils fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Reservas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reservationRequests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Solicitudes recientes -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-walpa">Solicitudes Recientes</h6>
                    <a href="{{ route('admin.catering.requests') }}" class="btn btn-sm btn-walpa">Ver Todas</a>
                </div>
                <div class="card-body">
                    @if($recentRequests->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Fecha Evento</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentRequests as $request)
                                        <tr>
                                            <td>
                                                <span class="badge bg-{{ $request->type == 'catering' ? 'info' : 'success' }}">
                                                    {{ $request->type_label }}
                                                </span>
                                            </td>
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->phone }}</td>
                                            <td>{{ $request->event_date ? $request->event_date->format('d/m/Y') : '-' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'confirmed' ? 'success' : 'secondary') }}">
                                                    {{ $request->status_label }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.catering.requests.show', $request) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-4">No hay solicitudes recientes</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Acciones rápidas -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Acciones Rápidas</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.catering.requests') }}" class="btn btn-walpa">
                            <i class="fas fa-list me-2"></i>Ver Solicitudes
                        </a>
                        <a href="{{ route('admin.catering.packages') }}" class="btn btn-outline-walpa">
                            <i class="fas fa-box me-2"></i>Gestionar Paquetes
                        </a>
                        <a href="{{ route('admin.catering.clients.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-users me-2"></i>Gestionar Clientes
                        </a>
                        <a href="{{ route('admin.catering.export') }}" class="btn btn-success">
                            <i class="fas fa-file-excel me-2"></i>Exportar Excel
                        </a>
                        <a href="{{ route('admin.catering.edit-info') }}" class="btn btn-info">
                            <i class="fas fa-edit me-2"></i>Editar Información
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info actual -->
            @if($cateringInfo)
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-walpa">Información Actual</h6>
                    </div>
                    <div class="card-body">
                        <h6>{{ $cateringInfo->title }}</h6>
                        <p class="small text-muted">{{ Str::limit($cateringInfo->description, 100) }}</p>
                        @if($cateringInfo->main_image)
                            <img src="{{ $cateringInfo->main_image_url }}" class="img-thumbnail" style="max-width: 100px;">
                        @endif
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
</style>
@endpush
@endsection