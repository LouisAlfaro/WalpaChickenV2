@extends('layouts.admin')

@section('title', 'Gestión de Favoritos')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Mis Favoritos</h3>
                    <a href="{{ route('admin.favorites.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Favorito
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($favorites->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Orden</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($favorites as $favorite)
                                        <tr>
                                            <td>
                                                @if($favorite->image)
                                                    <img src="{{ $favorite->image_url }}" 
                                                         alt="{{ $favorite->title }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-white"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $favorite->title ?? 'Sin título' }}</td>
                                            <td>{{ Str::limit($favorite->description ?? 'Sin descripción', 50) }}</td>
                                            <td>{{ $favorite->order ?? 0 }}</td>
                                            <td>
                                                @if($favorite->active)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.favorites.show', $favorite) }}" 
                                                       class="btn btn-sm btn-info" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.favorites.edit', $favorite) }}" 
                                                       class="btn btn-sm btn-warning" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.favorites.toggle', $favorite) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="btn btn-sm {{ $favorite->active ? 'btn-secondary' : 'btn-success' }}" 
                                                                title="{{ $favorite->active ? 'Desactivar' : 'Activar' }}">
                                                            <i class="fas fa-{{ $favorite->active ? 'eye-slash' : 'eye' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.favorites.destroy', $favorite) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('¿Estás seguro de eliminar este favorito?')">
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
                            <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                            <h5>No hay favoritos registrados</h5>
                            <p class="text-muted">Comienza agregando tu primer favorito.</p>
                            <a href="{{ route('admin.favorites.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar Favorito
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection