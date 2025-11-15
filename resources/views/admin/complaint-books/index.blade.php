@extends('layouts.admin')

@section('title', 'Libro de Reclamaciones')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-book me-2"></i> Libro de Reclamaciones
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.complaint-books.export', request()->all()) }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Exportar a Excel
                        </a>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('admin.complaint-books.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Buscar</label>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="N° reclamo, nombre, documento..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipo</label>
                            <select name="type" class="form-select">
                                <option value="">Todos</option>
                                <option value="reclamo" {{ request('type') == 'reclamo' ? 'selected' : '' }}>Reclamo</option>
                                <option value="queja" {{ request('type') == 'queja' ? 'selected' : '' }}>Queja</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estado</label>
                            <select name="status" class="form-select">
                                <option value="">Todos</option>
                                <option value="pendiente" {{ request('status') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en_proceso" {{ request('status') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="resuelto" {{ request('status') == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                                <option value="rechazado" {{ request('status') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                            <a href="{{ route('admin.complaint-books.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>N° Reclamo</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Documento</th>
                                    <th>Contacto</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaints as $complaint)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $complaint->complaint_number }}</td>
                                        <td>
                                            @if($complaint->type == 'reclamo')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-exclamation-triangle"></i> Reclamo
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-comment-dots"></i> Queja
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $complaint->full_name }}</td>
                                        <td>{{ $complaint->document_type }}: {{ $complaint->document_number }}</td>
                                        <td>
                                            <div><i class="fas fa-phone"></i> {{ $complaint->phone }}</div>
                                            <div class="text-muted small"><i class="fas fa-envelope"></i> {{ $complaint->email }}</div>
                                        </td>
                                        <td>
                                            @switch($complaint->status)
                                                @case('pendiente')
                                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                                    @break
                                                @case('en_proceso')
                                                    <span class="badge bg-info">En Proceso</span>
                                                    @break
                                                @case('resuelto')
                                                    <span class="badge bg-success">Resuelto</span>
                                                    @break
                                                @case('rechazado')
                                                    <span class="badge bg-danger">Rechazado</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.complaint-books.show', $complaint) }}" 
                                                   class="btn btn-sm btn-info" title="Ver detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.complaint-books.edit', $complaint) }}" 
                                                   class="btn btn-sm btn-primary" title="Actualizar estado">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.complaint-books.destroy', $complaint) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('¿Estás seguro de eliminar este reclamo?');"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                            No se encontraron reclamos
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $complaints->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
