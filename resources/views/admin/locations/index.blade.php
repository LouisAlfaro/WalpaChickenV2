@extends('layouts.admin')

@section('title', 'Gestión de Ubicaciones')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Ubicaciones de Walpa</h3>
                    <a href="{{ route('admin.locations.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Ubicación
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($locations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Carta PDF</th>
                                        <th>Orden</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($locations as $location)
                                        <tr>
                                            <td>
                                                @if($location->image)
                                                    <img src="{{ $location->image_url }}" 
                                                         alt="{{ $location->name }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-store text-white"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $location->name ?? 'Sin nombre' }}</td>
                                            <td>{{ Str::limit($location->address ?? 'Sin dirección', 50) }}</td>
                                            <td>{{ $location->phone ?? 'N/A' }}</td>
                                            <td>
                                                @if($location->menu_pdf)
                                                    <a href="{{ $location->menu_pdf_url }}" 
                                                    target="_blank" 
                                                    class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                @else
                                                    <span class="text-muted">Sin PDF</span>
                                                @endif
                                            </td>
                                            <td>{{ $location->order ?? 0 }}</td>
                                            <td>
                                                @if($location->active)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.locations.show', $location) }}" 
                                                       class="btn btn-sm btn-info" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.locations.edit', $location) }}" 
                                                       class="btn btn-sm btn-warning" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.locations.toggle', $location) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="btn btn-sm {{ $location->active ? 'btn-secondary' : 'btn-success' }}" 
                                                                title="{{ $location->active ? 'Desactivar' : 'Activar' }}">
                                                            <i class="fas fa-{{ $location->active ? 'eye-slash' : 'eye' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.locations.destroy', $location) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('¿Estás seguro de eliminar esta ubicación?')">
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
                        <div class="text-center py-4">
                            <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                            <h5>No hay ubicaciones registradas</h5>
                            <p class="text-muted">Comienza agregando tu primera ubicación.</p>
                            <a href="{{ route('admin.locations.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar Ubicación
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection