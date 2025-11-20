@extends('layouts.admin')

@section('title', 'Ver Promoción')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalle de la Promoción</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.promotional-locations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <a href="{{ route('admin.promotional-locations.edit', $promotionalLocation) }}" class="btn btn-warning">
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
                                    <td>{{ $promotionalLocation->name ?? 'Sin nombre' }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td>{{ $promotionalLocation->address ?? 'Sin dirección' }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $promotionalLocation->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>Horario:</th>
                                    <td>{{ $promotionalLocation->schedule ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>WhatsApp:</th>
                                    <td>
                                        @if($promotionalLocation->whatsapp_url)
                                            <a href="{{ $promotionalLocation->whatsapp_url }}" target="_blank" class="btn btn-sm btn-success">
                                                <i class="fab fa-whatsapp"></i> Abrir WhatsApp
                                            </a>
                                        @else
                                            No configurado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td>{{ $promotionalLocation->description ?? 'Sin descripción' }}</td>
                                </tr>
                                <tr>
                                    <th>Orden:</th>
                                    <td>{{ $promotionalLocation->order ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th>PDF Promoción:</th>
                                    <td>
                                        @if($promotionalLocation->promotion_pdf)
                                            <a href="{{ $promotionalLocation->promotion_pdf_url }}" 
                                            target="_blank" 
                                            class="btn btn-sm btn-danger">
                                                <i class="fas fa-file-pdf"></i> Descargar/Ver PDF
                                            </a>
                                            <br><small class="text-muted">{{ $promotionalLocation->promotion_pdf }}</small>
                                        @else
                                            No disponible
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($promotionalLocation->active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $promotionalLocation->created_at ? $promotionalLocation->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $promotionalLocation->updated_at ? $promotionalLocation->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <label class="form-label">Imagen de la Promoción:</label>
                                @if($promotionalLocation->image)
                                    <div>
                                        <img src="{{ $promotionalLocation->image_url }}" 
                                             alt="{{ $promotionalLocation->name }}" 
                                             class="img-fluid img-thumbnail"
                                             style="max-height: 400px;">
                                    </div>
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 300px;">
                                        <div class="text-muted">
                                            <i class="fas fa-gift fa-3x"></i>
                                            <p class="mt-2">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($promotionalLocation->whatsapp_url || $promotionalLocation->promotion_pdf_url)
                                <div class="mt-4 text-center">
                                    <h6>Enlaces Rápidos:</h6>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        @if($promotionalLocation->whatsapp_url)
                                            <a href="{{ $promotionalLocation->whatsapp_url }}" target="_blank" class="btn btn-success">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </a>
                                        @endif
                                        @if($promotionalLocation->promotion_pdf_url)
                                            <a href="{{ $promotionalLocation->promotion_pdf_url }}" target="_blank" class="btn btn-danger">
                                                <i class="fas fa-file-pdf"></i> Ver Promoción
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.promotional-locations.edit', $promotionalLocation) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('admin.promotional-locations.toggle', $promotionalLocation) }}" 
                          method="POST" 
                          class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $promotionalLocation->active ? 'btn-secondary' : 'btn-success' }}">
                            <i class="fas fa-{{ $promotionalLocation->active ? 'eye-slash' : 'eye' }}"></i> 
                            {{ $promotionalLocation->active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.promotional-locations.destroy', $promotionalLocation) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar esta promoción?')">
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
