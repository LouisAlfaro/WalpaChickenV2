@extends('layouts.admin')

@section('title', 'Ver Producto')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalle del Producto</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.menu-products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <a href="{{ route('admin.menu-products.edit', $menuProduct) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Nombre:</th>
                                    <td>{{ $menuProduct->name ?? 'Sin nombre' }}</td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td>{{ $menuProduct->description ?? 'Sin descripción' }}</td>
                                </tr>
                                <tr>
                                    <th>Precio:</th>
                                    <td>
                                        @if($menuProduct->price)
                                            <span class="badge bg-success fs-6">{{ $menuProduct->formatted_price }}</span>
                                        @else
                                            <span class="text-muted">Sin precio</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Local:</th>
                                    <td>
                                        @if($menuProduct->location)
                                            <span class="badge bg-info fs-6">{{ $menuProduct->location->name }}</span>
                                        @else
                                            <span class="text-muted">Sin local asignado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Orden:</th>
                                    <td>{{ $menuProduct->order ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($menuProduct->active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $menuProduct->created_at ? $menuProduct->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $menuProduct->updated_at ? $menuProduct->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <label class="form-label">Imagen del Producto:</label>
                                @if($menuProduct->image)
                                    <div>
                                        <img src="{{ $menuProduct->image_url }}" 
                                             alt="{{ $menuProduct->name }}" 
                                             class="img-fluid img-thumbnail"
                                             style="max-height: 300px;">
                                    </div>
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <div class="text-muted">
                                            <i class="fas fa-utensils fa-3x"></i>
                                            <p class="mt-2">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.menu-products.edit', $menuProduct) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('admin.menu-products.toggle', $menuProduct) }}" 
                          method="POST" 
                          class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $menuProduct->active ? 'btn-secondary' : 'btn-success' }}">
                            <i class="fas fa-{{ $menuProduct->active ? 'eye-slash' : 'eye' }}"></i> 
                            {{ $menuProduct->active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.menu-products.destroy', $menuProduct) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
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