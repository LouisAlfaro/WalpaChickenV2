@extends('layouts.admin')

@section('title', 'Oportunidades Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-briefcase text-walpa me-2"></i>Oportunidades Dashboard
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.opportunities.benefits.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Nuevo Beneficio
            </a>
            <a href="{{ route('admin.opportunities.export') }}" class="btn btn-walpa">
                <i class="fas fa-file-excel me-2"></i>Exportar Excel
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalApplications }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingApplications }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Comercial</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $comercialApplications }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Proveedores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proveedoresApplications }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Trabajo</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $trabajoApplications }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                    <a href="{{ route('admin.opportunities.applications') }}" class="btn btn-sm btn-walpa">Ver Todas</a>
                </div>
                <div class="card-body">
                    @if($recentApplications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Empresa/Nombre</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentApplications as $application)
                                        <tr>
                                            <td>
                                                <span class="badge bg-{{ $application->type == 'comercial' ? 'info' : ($application->type == 'proveedores' ? 'success' : 'danger') }}">
                                                    {{ $application->type_label }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $application->type === 'trabajo' ? $application->full_name : $application->company_name }}
                                            </td>
                                            <td>{{ $application->email }}</td>
                                            <td>
                                                <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'contacted' ? 'success' : 'secondary') }}">
                                                    {{ $application->status_label }}
                                                </span>
                                            </td>
                                            <td>{{ $application->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.opportunities.applications.show', $application) }}" class="btn btn-sm btn-info">
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

        <!-- Panel de gestión -->
        <div class="col-lg-4">
            <!-- Gestión de contenido -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Gestión de Contenido</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.opportunities.content.edit', 'comercial') }}" class="btn btn-outline-info">
                            <i class="fas fa-handshake me-2"></i>Editar Comercial
                        </a>
                        <a href="{{ route('admin.opportunities.content.edit', 'proveedores') }}" class="btn btn-outline-success">
                            <i class="fas fa-truck me-2"></i>Editar Proveedores
                        </a>
                        <a href="{{ route('admin.opportunities.content.edit', 'trabajo') }}" class="btn btn-outline-danger">
                            <i class="fas fa-users me-2"></i>Editar Trabajo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Acciones rápidas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Acciones Rápidas</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.opportunities.applications') }}" class="btn btn-walpa">
                            <i class="fas fa-list me-2"></i>Ver Solicitudes
                        </a>
                        <a href="{{ route('admin.opportunities.benefits') }}" class="btn btn-outline-walpa">
                            <i class="fas fa-star me-2"></i>Gestionar Beneficios
                        </a>
                        <a href="{{ route('admin.opportunities.export') }}" class="btn btn-success">
                            <i class="fas fa-file-excel me-2"></i>Exportar Excel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Beneficios activos -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Beneficios Activos ({{ $benefits->count() }})</h6>
                </div>
                <div class="card-body">
                    @if($benefits->count() > 0)
                        @foreach($benefits->take(3) as $benefit)
                            <div class="mb-2">
                                <h6 class="mb-1">{{ $benefit->title }}</h6>
                                <p class="small text-muted mb-0">{{ Str::limit($benefit->description, 60) }}</p>
                            </div>
                            @if(!$loop->last)<hr>@endif
                        @endforeach
                        @if($benefits->count() > 3)
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.opportunities.benefits') }}" class="btn btn-sm btn-outline-walpa">
                                    Ver todos ({{ $benefits->count() }})
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-muted text-center">No hay beneficios creados</p>
                        <div class="text-center">
                            <a href="{{ route('admin.opportunities.benefits.create') }}" class="btn btn-sm btn-walpa">
                                Crear Primer Beneficio
                            </a>
                        </div>
                    @endif
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