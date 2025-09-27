@extends('layouts.admin')

@section('title', 'Ver Solicitud')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-eye text-walpa me-2"></i>Solicitud #{{ $application->id }}
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.opportunities.applications') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
            <form action="{{ route('admin.opportunities.applications.destroy', $application) }}" method="POST" class="d-inline"
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
            <!-- Información de la solicitud -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-walpa">
                        <i class="fas fa-info-circle me-2"></i>Información de la Solicitud
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            @if($application->type === 'trabajo')
                                <strong>Nombre Completo:</strong> {{ $application->full_name }}<br>
                                <strong>Especialidad:</strong> {{ $application->business_area }}<br>
                            @else
                                <strong>Empresa:</strong> {{ $application->company_name }}<br>
                                <strong>Rubro:</strong> {{ $application->business_area }}<br>
                            @endif
                            <strong>Teléfono:</strong> {{ $application->phone }}<br>
                            <strong>Email:</strong> {{ $application->email }}<br>
                        </div>
                        <div class="col-md-6">
                            @if($application->region)
                                <strong>Región:</strong> {{ $application->region }}<br>
                            @endif
                            @if($application->province)
                                <strong>Provincia:</strong> {{ $application->province }}<br>
                            @endif
                            @if($application->district)
                                <strong>Distrito:</strong> {{ $application->district }}<br>
                            @endif
                        </div>
                    </div>

                    @if($application->comment)
                        <hr>
                        <strong>Comentario:</strong><br>
                        <p>{{ $application->comment }}</p>
                    @endif

                    @if($application->attachment)
                        <hr>
                        <strong>Archivo Adjunto:</strong><br>
                        <a href="{{ $application->attachment_url }}" class="btn btn-success" target="_blank">
                            <i class="fas fa-download me-2"></i>Descargar {{ $application->attachment }}
                        </a>
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
                    <form action="{{ route('admin.opportunities.applications.update-status', $application) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status" required>
                                @foreach(App\Models\OpportunityApplication::getStatuses() as $key => $label)
                                    <option value="{{ $key }}" {{ $application->status == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">Notas del Admin</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3">{{ $application->admin_notes }}</textarea>
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
                    <span class="badge bg-{{ $application->type == 'comercial' ? 'info' : ($application->type == 'proveedores' ? 'success' : 'danger') }} mb-2">
                        {{ $application->type_label }}
                    </span><br>

                    <small class="text-muted">Estado Actual:</small><br>
                    <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'contacted' ? 'success' : 'secondary') }} mb-2">
                        {{ $application->status_label }}
                    </span><br>

                    <small class="text-muted">Fecha de Solicitud:</small><br>
                    <strong>{{ $application->created_at->format('d/m/Y H:i') }}</strong><br>

                    <small class="text-muted">Última Actualización:</small><br>
                    <strong>{{ $application->updated_at->format('d/m/Y H:i') }}</strong>
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