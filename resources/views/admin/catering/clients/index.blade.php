@extends('layouts.admin')

@section('title', 'Gestión de Clientes de Catering')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0"><i class="fas fa-users me-2"></i>Nuestros Clientes</h1>
                <a href="{{ route('admin.catering.clients.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Agregar Cliente
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    @if($clients->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Logo</th>
                                        <th>Nombre</th>
                                        <th>Industria</th>
                                        <th>Website</th>
                                        <th>Orden</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>
                                                <img src="{{ $client->logo_url }}" 
                                                     alt="{{ $client->name }}" 
                                                     class="img-thumbnail"
                                                     style="width: 50px; height: 50px; object-fit: contain;">
                                            </td>
                                            <td>
                                                <strong>{{ $client->name }}</strong>
                                                @if($client->description)
                                                    <br><small class="text-muted">{{ Str::limit($client->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $client->industry ?? 'No especificada' }}</span>
                                            </td>
                                            <td>
                                                @if($client->website)
                                                    <a href="{{ $client->website }}" target="_blank" class="text-decoration-none">
                                                        <i class="fas fa-external-link-alt"></i> Ver sitio
                                                    </a>
                                                @else
                                                    <span class="text-muted">No disponible</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $client->order }}</span>
                                            </td>
                                            <td>
                                                @if($client->is_active)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.catering.clients.show', $client) }}" 
                                                       class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.catering.clients.edit', $client) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.catering.clients.destroy', $client) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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
                        <div class="d-flex justify-content-center mt-4">
                            {{ $clients->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No hay clientes registrados</h5>
                            <p class="text-muted">Comienza agregando tu primer cliente.</p>
                            <a href="{{ route('admin.catering.clients.create') }}" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Agregar Primer Cliente
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection