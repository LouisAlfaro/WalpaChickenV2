@extends('layouts.admin')

@section('title', 'Paquetes de Catering')
@section('page-title', 'Paquetes de Catering')
@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Listado de paquetes de catering</h2>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="mb-3">
        <a href="{{ route('admin.catering.packages.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Paquete
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Personas</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $package)
                        <tr>
                            <td>{{ $package->id }}</td>
                            <td>{{ $package->name }}</td>
                            <td>{{ Str::limit($package->description, 50) }}</td>
                            <td>S/ {{ number_format($package->price_per_person, 2) }}</td>
                            <td>{{ $package->people_range }}</td>
                            <td>
                                <span class="badge bg-{{ $package->is_active ? 'success' : 'secondary' }}">
                                    {{ $package->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.catering.packages.edit', $package) }}" class="btn btn-sm btn-primary" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.catering.packages.destroy', $package) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este paquete?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.catering.packages.toggle', $package) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-warning" title="{{ $package->is_active ? 'Desactivar' : 'Activar' }}">
                                        <i class="fas fa-toggle-{{ $package->is_active ? 'on' : 'off' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay paquetes registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection