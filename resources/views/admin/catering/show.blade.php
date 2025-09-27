@extends('layouts.admin')

@section('title', 'Ver Solicitud')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-eye text-walpa me-2"></i>Solicitud #{{ $request->id }}
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.catering.requests') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
            <form action="{{ route('admin.catering.requests.destroy', $request) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('¿Estás seguro de eliminar esta solicitud?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Eliminar
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Información Personal -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Información Personal</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Nombre:</strong> {{ $request->name }}<br>
                            <strong>Teléfono:</strong> {{ $request->phone }}<br>
                            <strong>Email:</strong> {{ $request->email }}<br>
                            @if($request->birth_date)
                                <strong>Fecha Nacimiento:</strong> {{ $request->birth_date->format('d/m/Y') }}<br>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($request->region)
                                <strong>Región:</strong> {{ $request->region }}<br>
                            @endif
                            @if($request->province)
                                <strong>Provincia:</strong> {{ $request->province }}<br>
                            @endif
                            @if($request->district)
                                <strong>Distrito:</strong> {{ $request->district }}<br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del Evento -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Información del Evento</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if($request->event_date)
                                <strong>Fecha del Evento:</strong> {{ $request->event_date->format('d/m/Y') }}<br>
                            @endif
                            @if($request->event_time)
                                <strong>Hora del Evento:</strong> {{ $request->event_time->format('H:i') }}<br>
                            @endif
                            @if($request->number_of_people)
                                <strong>Número de Personas:</strong> {{ $request->number_of_people }}<br>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($request->contact_type)
                                <strong>Tipo de Contacto:</strong> {{ $request->contact_type }}<br>
                            @endif
                            @if($request->contact_value)
                                <strong>Contacto:</strong> {{ $request->contact_value }}<br>
                            @endif
                            @if($request->reason)
                                <strong>Motivo:</strong> {{ $request->reason }}<br>
                            @endif
                        </div>
                    </div>

                    @if($request->cateringPackage)
                        <hr>
                        <strong>Paquete Seleccionado:</strong> {{ $request->cateringPackage->name }}<br>
                    @endif

                    @if($request->event_type)
                        <strong>Tipo de Evento:</strong> {{ $request->event_type }}<br>
                    @endif

                    @if($request->special_requirements)
                        <hr>
                        <strong>Requerimientos Especiales:</strong><br>
                        <p>{{ $request->special_requirements }}</p>
                    @endif

                    @if($request->message)
                        <hr>
                        <strong>Mensaje:</strong><br>
                        <p>{{ $request->message }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Estado y Acciones -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Estado y Acciones</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.catering.requests.update-status', $request) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status" required>
                                @foreach(App\Models\CateringRequest::getStatuses() as $key => $label)
                                    <option value="{{ $key }}" {{ $request->status == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">Notas del Admin</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3">{{ $request->admin_notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-walpa w-100">
                            <i class="fas fa-save me-2"></i>Actualizar Estado
                        </button>
                    </form>
                </div>
            </div>

            <!-- Información del Sistema -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">Información del Sistema</h6>
                </div>
                <div class="card-body">
                    <small class="text-muted">Tipo de Solicitud:</small><br>
                    <span class="badge bg-{{ $request->type == 'catering' ? 'info' : 'success' }} mb-2">
                        {{ $request->type_label }}
                    </span><br>

                    <small class="text-muted">Estado Actual:</small><br>
                    <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'confirmed' ? 'success' : 'secondary') }} mb-2">
                        {{ $request->status_label }}
                    </span><br>

                    <small class="text-muted">Fecha de Solicitud:</small><br>
                    <strong>{{ $request->created_at->format('d/m/Y H:i') }}</strong><br>

                    <small class="text-muted">Última Actualización:</small><br>
                    <strong>{{ $request->updated_at->format('d/m/Y H:i') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.btn-walpa {
    background-color: #D4AF37;
    border-color: #D4AF37;
    color: white;
}

.btn-walpa:hover {
    background-color: #B8860B;
    border-color: #B8860B;
    color: white;
}

.text-walpa {
    color: #D4AF37 !important;
}
</style>
@endpush
@endsection