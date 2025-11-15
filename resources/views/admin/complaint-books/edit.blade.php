@extends('layouts.admin')

@section('title', 'Editar Reclamo')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit me-2"></i> Actualizar Estado del Reclamo: {{ $complaintBook->complaint_number }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.complaint-books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.complaint-books.update', $complaintBook) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Información del Reclamo -->
                                <div class="card mb-3 border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Información del Reclamo</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <tr>
                                                <th width="40%">N° Reclamo:</th>
                                                <td><strong class="text-primary">{{ $complaintBook->complaint_number }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th>Tipo:</th>
                                                <td>
                                                    @if($complaintBook->type == 'reclamo')
                                                        <span class="badge bg-danger">RECLAMO</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">QUEJA</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Cliente:</th>
                                                <td>{{ $complaintBook->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Fecha Registro:</th>
                                                <td>{{ $complaintBook->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        </table>

                                        <div class="mt-3">
                                            <strong>Detalle del Reclamo:</strong>
                                            <p class="mt-2 p-3 bg-light rounded">{{ $complaintBook->complaint_detail }}</p>
                                        </div>

                                        <div class="mt-3">
                                            <strong>Pedido del Cliente:</strong>
                                            <p class="mt-2 p-3 bg-light rounded">{{ $complaintBook->request }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Actualización de Estado -->
                                <div class="card mb-3 border-warning">
                                    <div class="card-header bg-warning text-dark">
                                        <h5 class="mb-0"><i class="fas fa-tasks me-2"></i> Actualizar Estado y Notas</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Estado -->
                                        <div class="mb-4">
                                            <label for="status" class="form-label fw-bold">Estado del Reclamo *</label>
                                            <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                                    id="status" 
                                                    name="status" 
                                                    required>
                                                <option value="pendiente" {{ $complaintBook->status == 'pendiente' ? 'selected' : '' }}>
                                                    ⏳ Pendiente
                                                </option>
                                                <option value="en_proceso" {{ $complaintBook->status == 'en_proceso' ? 'selected' : '' }}>
                                                    🔄 En Proceso
                                                </option>
                                                <option value="resuelto" {{ $complaintBook->status == 'resuelto' ? 'selected' : '' }}>
                                                    ✅ Resuelto
                                                </option>
                                                <option value="rechazado" {{ $complaintBook->status == 'rechazado' ? 'selected' : '' }}>
                                                    ❌ Rechazado
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-info-circle"></i> 
                                                Seleccione el estado actual del reclamo
                                            </div>
                                        </div>

                                        <!-- Notas del Administrador -->
                                        <div class="mb-3">
                                            <label for="admin_notes" class="form-label fw-bold">Notas del Administrador</label>
                                            <textarea class="form-control @error('admin_notes') is-invalid @enderror" 
                                                      id="admin_notes" 
                                                      name="admin_notes" 
                                                      rows="8" 
                                                      placeholder="Agregue comentarios, acciones tomadas o cualquier información relevante sobre el seguimiento de este reclamo...">{{ old('admin_notes', $complaintBook->admin_notes) }}</textarea>
                                            @error('admin_notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="fas fa-lightbulb"></i> 
                                                Estas notas son internas y no se muestran al cliente
                                            </div>
                                        </div>

                                        <!-- Información Adicional -->
                                        <div class="alert alert-info">
                                            <h6 class="alert-heading"><i class="fas fa-clock me-2"></i> Información Temporal</h6>
                                            <p class="mb-0">
                                                <strong>Última actualización:</strong> 
                                                {{ $complaintBook->updated_at->format('d/m/Y H:i') }}
                                            </p>
                                            @if($complaintBook->resolved_at)
                                            <p class="mb-0 mt-2">
                                                <strong>Fecha de resolución:</strong> 
                                                {{ $complaintBook->resolved_at->format('d/m/Y H:i') }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.complaint-books.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
