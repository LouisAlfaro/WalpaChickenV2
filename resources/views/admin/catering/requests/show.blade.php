@extends('layouts.admin')

@section('title', 'Ver Solicitud de Catering')
@section('page-title', 'Ver Solicitud de Catering')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-eye me-2"></i>Solicitud #{{ $request->id }}
        </h1>
        <a href="{{ route('admin.catering.requests') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Detalles de la Solicitud</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Tipo:</strong>
                            <span class="badge bg-{{ $request->type == 'catering' ? 'primary' : 'info' }} ms-2">
                                {{ $request->type_label }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'confirmed' ? 'success' : 'secondary') }} ms-2">
                                {{ $request->status_label }}
                            </span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        @if($request->type == 'catering')
                            <div class="col-md-6">
                                <strong>Nombre:</strong> {{ $request->name }}
                            </div>
                            <div class="col-md-6">
                                <strong>Email:</strong> {{ $request->email }}
                            </div>
                            <div class="col-md-6">
                                <strong>Teléfono:</strong> {{ $request->phone }}
                            </div>
                            @if($request->birth_date)
                                <div class="col-md-6">
                                    <strong>Fecha de Nacimiento:</strong> {{ $request->birth_date->format('d/m/Y') }}
                                </div>
                            @endif
                            @if($request->full_address)
                                <div class="col-12">
                                    <strong>Dirección:</strong> {{ $request->full_address }}
                                </div>
                            @endif
                        @else
                            <!-- Datos de reserva -->
                            <div class="col-md-6">
                                <strong>Fecha del Evento:</strong> {{ $request->event_date ? $request->event_date->format('d/m/Y') : '-' }}
                            </div>
                            <div class="col-md-6">
                                <strong>Hora del Evento:</strong> {{ $request->event_time }}
                            </div>
                            <div class="col-md-6">
                                <strong>Número de Personas:</strong> {{ $request->number_of_people }}
                            </div>
                            <div class="col-md-6">
                                <strong>Tipo de Contacto:</strong> {{ $request->contact_type }}
                            </div>
                            <div class="col-md-6">
                                <strong>Contacto:</strong> {{ $request->contact_value }}
                            </div>
                            @if($request->reason)
                                <div class="col-md-6">
                                    <strong>Motivo:</strong> {{ $request->reason }}
                                </div>
                            @endif
                            @if($request->cateringPackage)
                                <div class="col-12">
                                    <strong>Paquete Seleccionado:</strong> {{ $request->cateringPackage->name }}
                                </div>
                            @endif
                        @endif
                    </div>
                    
                    @if($request->message)
                        <hr>
                        <div>
                            <strong>Mensaje:</strong>
                            <p class="mt-2">{{ $request->message }}</p>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Fecha de Solicitud:</strong> {{ $request->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Última Actualización:</strong> {{ $request->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Acciones</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.catering.requests.update-status', $request) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <div class="mb-2">
                            <label for="status" class="form-label">Cambiar Estado:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                                <option value="in_progress" {{ $request->status == 'in_progress' ? 'selected' : '' }}>En Proceso</option>
                                <option value="completed" {{ $request->status == 'completed' ? 'selected' : '' }}>Completado</option>
                                <option value="cancelled" {{ $request->status == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Actualizar Estado
                        </button>
                    </form>
                    
                    <hr>
                    
                    <form action="{{ route('admin.catering.requests.destroy', $request) }}" method="POST" 
                          onsubmit="return confirm('¿Seguro que deseas eliminar esta solicitud?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Eliminar Solicitud
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection