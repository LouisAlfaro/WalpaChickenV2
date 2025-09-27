@extends('layouts.admin')

@section('title', 'Productos de Menú')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Productos de Menú</h3>
                    <a href="{{ route('admin.menu-products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Local</th>
                                        <th>Orden</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                @if($product->image)
                                                    <img src="{{ $product->image_url }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-utensils text-white"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $product->name ?? 'Sin nombre' }}</td>
                                            <td>{{ Str::limit($product->description ?? 'Sin descripción', 30) }}</td>
                                            <td>
                                                @if($product->price)
                                                    <span class="badge bg-success">{{ $product->formatted_price }}</span>
                                                @else
                                                    <span class="text-muted">Sin precio</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->location)
                                                    <span class="badge bg-info">{{ $product->location->name }}</span>
                                                @else
                                                    <span class="text-muted">Sin local</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->order ?? 0 }}</td>
                                            <td>
                                                @if($product->active)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.menu-products.show', $product) }}" 
                                                       class="btn btn-sm btn-info" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.menu-products.edit', $product) }}" 
                                                       class="btn btn-sm btn-warning" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.menu-products.toggle', $product) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="btn btn-sm {{ $product->active ? 'btn-secondary' : 'btn-success' }}" 
                                                                title="{{ $product->active ? 'Desactivar' : 'Activar' }}">
                                                            <i class="fas fa-{{ $product->active ? 'eye-slash' : 'eye' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.menu-products.destroy', $product) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
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
                            <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                            <h5>No hay productos registrados</h5>
                            <p class="text-muted">Comienza agregando tu primer producto de menú.</p>
                            <a href="{{ route('admin.menu-products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar Producto
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection