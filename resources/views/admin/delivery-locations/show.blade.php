@extends('layouts.admin')

@section('title', 'Ver Delivery')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalle del Delivery</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.delivery-locations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <a href="{{ route('admin.delivery-locations.edit', $deliveryLocation) }}" class="btn btn-warning">
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
                                    <td>{{ $deliveryLocation->name ?? 'Sin nombre' }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td>{{ $deliveryLocation->address ?? 'Sin dirección' }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $deliveryLocation->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>Horario:</th>
                                    <td>{{ $deliveryLocation->schedule ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>WhatsApp:</th>
                                    <td>
                                        @if($deliveryLocation->whatsapp_url)
                                            <a href="{{ $deliveryLocation->whatsapp_url }}" target="_blank" class="btn btn-sm btn-success">
                                                <i class="fab fa-whatsapp"></i> Abrir WhatsApp
                                            </a>
                                        @else
                                            No configurado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>PedidosYa:</th>
                                    <td>
                                        @if($deliveryLocation->pedidosya_url)
                                            <a href="{{ $deliveryLocation->pedidosya_url }}" target="_blank" class="btn btn-sm btn-danger">
                                                <i class="fas fa-external-link-alt"></i> Ver en PedidosYa
                                            </a>
                                        @else
                                            No configurado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Didi Food:</th>
                                    <td>
                                        @if($deliveryLocation->didifood_url)
                                            <a href="{{ $deliveryLocation->didifood_url }}" target="_blank" class="btn btn-sm btn-warning">
                                                <i class="fas fa-external-link-alt"></i> Ver en Didi Food
                                            </a>
                                        @else
                                            No configurado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Rappi:</th>
                                    <td>
                                        @if($deliveryLocation->rappi_url)
                                            <a href="{{ $deliveryLocation->rappi_url }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fas fa-external-link-alt"></i> Ver en Rappi
                                            </a>
                                        @else
                                            No configurado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td>{{ $deliveryLocation->description ?? 'Sin descripción' }}</td>
                                </tr>
                                <tr>
                                    <th>Orden:</th>
                                    <td>{{ $deliveryLocation->order ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($deliveryLocation->active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $deliveryLocation->created_at ? $deliveryLocation->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $deliveryLocation->updated_at ? $deliveryLocation->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <label class="form-label">Imagen del Delivery:</label>
                                @if($deliveryLocation->image)
                                    <div>
                                        <img src="{{ $deliveryLocation->image_url }}" 
                                             alt="{{ $deliveryLocation->name }}" 
                                             class="img-fluid img-thumbnail"
                                             style="max-height: 400px;">
                                    </div>
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 300px;">
                                        <div class="text-muted">
                                            <i class="fas fa-truck fa-3x"></i>
                                            <p class="mt-2">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($deliveryLocation->whatsapp_url || $deliveryLocation->pedidosya_url || $deliveryLocation->didifood_url || $deliveryLocation->rappi_url)
                                <div class="mt-4 text-center">
                                    <h6>Enlaces Rápidos:</h6>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        @if($deliveryLocation->whatsapp_url)
                                            <a href="{{ $deliveryLocation->whatsapp_url }}" target="_blank" class="btn btn-success">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </a>
                                        @endif
                                        @if($deliveryLocation->pedidosya_url)
                                            <a href="{{ $deliveryLocation->pedidosya_url }}" target="_blank" class="btn btn-danger">
                                                PedidosYa
                                            </a>
                                        @endif
                                        @if($deliveryLocation->didifood_url)
                                            <a href="{{ $deliveryLocation->didifood_url }}" target="_blank" class="btn btn-warning">
                                                Didi Food
                                            </a>
                                        @endif
                                        @if($deliveryLocation->rappi_url)
                                            <a href="{{ $deliveryLocation->rappi_url }}" target="_blank" class="btn btn-primary">
                                                Rappi
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.delivery-locations.edit', $deliveryLocation) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('admin.delivery-locations.toggle', $deliveryLocation) }}" 
                          method="POST" 
                          class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $deliveryLocation->active ? 'btn-secondary' : 'btn-success' }}">
                            <i class="fas fa-{{ $deliveryLocation->active ? 'eye-slash' : 'eye' }}"></i> 
                            {{ $deliveryLocation->active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.delivery-locations.destroy', $deliveryLocation) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar este delivery?')">
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
