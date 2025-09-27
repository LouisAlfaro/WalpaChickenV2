{{-- resources/views/admin/delivery-platforms/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Plataformas de Delivery')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Plataformas de Delivery</h2>
        <a href="{{ route('admin.delivery-platforms.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Agregar Plataforma
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if($platforms->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Enlace</th>
                                <th>Estado</th>
                                <th>Orden</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($platforms as $platform)
                            <tr>
                                <td>
                                    <img src="{{ $platform->image_url }}" 
                                         alt="{{ $platform->name }}" 
                                         class="img-thumbnail"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>{{ $platform->name }}</td>
                                <td>
                                    <a href="{{ $platform->link }}" target="_blank" class="text-primary">
                                        Ver enlace <i class="fas fa-external-link-alt ms-1"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.delivery-platforms.toggle', $platform) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $platform->is_active ? 'btn-success' : 'btn-secondary' }}">
                                            {{ $platform->is_active ? 'Activo' : 'Inactivo' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $platform->order }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.delivery-platforms.edit', $platform) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.delivery-platforms.destroy', $platform) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('¿Eliminar esta plataforma?')">
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
                {{ $platforms->links() }}
            @else
                <div class="text-center py-5">
                    <i class="fas fa-motorcycle fa-3x text-muted mb-3"></i>
                    <h5>No hay plataformas configuradas</h5>
                    <a href="{{ route('admin.delivery-platforms.create') }}" class="btn btn-primary">Agregar Primera Plataforma</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection