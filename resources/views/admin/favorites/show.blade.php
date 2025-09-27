@extends('layouts.admin')

@section('title', 'Ver Favorito')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalle del Favorito</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.favorites.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <a href="{{ route('admin.favorites.edit', $favorite) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Título:</th>
                                    <td>{{ $favorite->title ?? 'Sin título' }}</td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td>{{ $favorite->description ?? 'Sin descripción' }}</td>
                                </tr>
                                <tr>
                                    <th>Orden:</th>
                                    <td>{{ $favorite->order ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($favorite->active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $favorite->created_at ? $favorite->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $favorite->updated_at ? $favorite->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <label class="form-label">Imagen:</label>
                                @if($favorite->image)
                                    <div>
                                        <img src="{{ $favorite->image_url }}" 
                                             alt="{{ $favorite->title }}" 
                                             class="img-fluid img-thumbnail"
                                             style="max-height: 300px;">
                                    </div>
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <div class="text-muted">
                                            <i class="fas fa-image fa-3x"></i>
                                            <p class="mt-2">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.favorites.edit', $favorite) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('admin.favorites.destroy', $favorite) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar este favorito?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection