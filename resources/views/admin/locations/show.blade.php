@extends('layouts.admin')

@section('title', 'Ver Ubicación')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalle de la Ubicación</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <a href="{{ route('admin.locations.edit', $location) }}" class="btn btn-warning">
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
                                    <td>{{ $location->name ?? 'Sin nombre' }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td>{{ $location->address ?? 'Sin dirección' }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $location->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>WhatsApp:</th>
                                    <td>
                                        @if($location->whatsapp_url)
                                            <a href="{{ $location->whatsapp_url }}" target="_blank" class="btn btn-sm btn-success">
                                                <i class="fab fa-whatsapp"></i> Abrir WhatsApp
                                            </a>
                                        @else
                                            No configurado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Google Maps:</th>
                                    <td>
                                        @if($location->maps_url)
                                            <a href="{{ $location->maps_url }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fas fa-map-marker-alt"></i> Ver en Mapa
                                            </a>
                                        @else
                                            No configurado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td>{{ $location->description ?? 'Sin descripción' }}</td>
                                </tr>
                                <tr>
                                    <th>Orden:</th>
                                    <td>{{ $location->order ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th>Carta PDF:</th>
                                    <td>
                                        @if($location->menu_pdf)
                                            <a href="{{ $location->menu_pdf_url }}" 
                                            target="_blank" 
                                            class="btn btn-sm btn-danger">
                                                <i class="fas fa-file-pdf"></i> Descargar/Ver PDF
                                            </a>
                                            <br><small class="text-muted">{{ $location->menu_pdf }}</small>
                                        @else
                                            No disponible
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($location->active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $location->created_at ? $location->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $location->updated_at ? $location->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <label class="form-label">Imagen del Local:</label>
                                @if($location->image)
                                    <div>
                                        <img src="{{ $location->image_url }}" 
                                             alt="{{ $location->name }}" 
                                             class="img-fluid img-thumbnail"
                                             style="max-height: 400px;">
                                    </div>
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 300px;">
                                        <div class="text-muted">
                                            <i class="fas fa-store fa-3x"></i>
                                            <p class="mt-2">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($location->whatsapp_url || $location->maps_url)
                                <div class="mt-4 text-center">
                                    <h6>Enlaces Rápidos:</h6>
                                    <div class="d-flex justify-content-center gap-2">
                                        @if($location->whatsapp_url)
                                            <a href="{{ $location->whatsapp_url }}" target="_blank" class="btn btn-success">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </a>
                                        @endif
                                        @if($location->maps_url)
                                            <a href="{{ $location->maps_url }}" target="_blank" class="btn btn-primary">
                                                <i class="fas fa-map-marker-alt"></i> Google Maps
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.locations.edit', $location) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('admin.locations.toggle', $location) }}" 
                          method="POST" 
                          class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $location->active ? 'btn-secondary' : 'btn-success' }}">
                            <i class="fas fa-{{ $location->active ? 'eye-slash' : 'eye' }}"></i> 
                            {{ $location->active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.locations.destroy', $location) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar esta ubicación?')">
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