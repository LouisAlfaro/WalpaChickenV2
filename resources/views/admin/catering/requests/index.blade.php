@extends('layouts.admin')

@section('title', 'Solicitudes de Catering')
@section('page-title', 'Solicitudes de Catering')
@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Listado de solicitudes de catering</h2>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td><span class="badge bg-{{ $request->type == 'catering' ? 'primary' : 'info' }}">{{ $request->type_label }}</span></td>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->phone }}</td>
                            <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                            <td><span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'confirmed' ? 'success' : 'secondary') }}">{{ $request->status_label }}</span></td>
                            <td>
                                <a href="{{ route('admin.catering.requests.show', $request) }}" class="btn btn-sm btn-info" title="Ver Detalle">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.catering.requests.destroy', $request) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta solicitud?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay solicitudes registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $requests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection