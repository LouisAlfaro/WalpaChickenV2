@extends('layouts.admin')

@section('title', 'Ver Reclamo')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-book me-2"></i> Detalle del Reclamo: {{ $complaintBook->complaint_number }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.complaint-books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <a href="{{ route('admin.complaint-books.edit', $complaintBook) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <!-- Información General -->
                            <div class="card mb-3">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Información General</h5>
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
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-exclamation-triangle"></i> RECLAMO
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-comment-dots"></i> QUEJA
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Estado:</th>
                                            <td>
                                                @switch($complaintBook->status)
                                                    @case('pendiente')
                                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                                        @break
                                                    @case('en_proceso')
                                                        <span class="badge bg-info">En Proceso</span>
                                                        @break
                                                    @case('resuelto')
                                                        <span class="badge bg-success">Resuelto</span>
                                                        @break
                                                    @case('rechazado')
                                                        <span class="badge bg-danger">Rechazado</span>
                                                        @break
                                                @endswitch
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Fecha Registro:</th>
                                            <td>{{ $complaintBook->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @if($complaintBook->resolved_at)
                                        <tr>
                                            <th>Fecha Resolución:</th>
                                            <td>{{ $complaintBook->resolved_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <!-- Datos del Consumidor -->
                            <div class="card mb-3">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="fas fa-user me-2"></i> Datos del Consumidor</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Nombre Completo:</th>
                                            <td>{{ $complaintBook->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Documento:</th>
                                            <td>{{ $complaintBook->document_type }}: {{ $complaintBook->document_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Teléfono:</th>
                                            <td><a href="tel:{{ $complaintBook->phone }}">{{ $complaintBook->phone }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td><a href="mailto:{{ $complaintBook->email }}">{{ $complaintBook->email }}</a></td>
                                        </tr>
                                        @if($complaintBook->department || $complaintBook->province || $complaintBook->district)
                                        <tr>
                                            <th>Ubicación:</th>
                                            <td>
                                                {{ $complaintBook->department ? $complaintBook->department . ', ' : '' }}
                                                {{ $complaintBook->province ? $complaintBook->province . ', ' : '' }}
                                                {{ $complaintBook->district }}
                                            </td>
                                        </tr>
                                        @endif
                                        @if($complaintBook->address)
                                        <tr>
                                            <th>Dirección:</th>
                                            <td>{{ $complaintBook->address }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <!-- Bien Contratado -->
                            <div class="card mb-3">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fas fa-box me-2"></i> Bien Contratado</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Tipo:</th>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $complaintBook->product_type == 'producto' ? 'Producto' : 'Servicio' }}
                                                </span>
                                            </td>
                                        </tr>
                                        @if($complaintBook->amount)
                                        <tr>
                                            <th>Monto:</th>
                                            <td><strong>S/ {{ number_format($complaintBook->amount, 2) }}</strong></td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Descripción:</th>
                                            <td>{{ $complaintBook->description }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Detalle del Reclamo -->
                            <div class="card mb-3">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Detalle del Reclamo</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Detalle:</strong>
                                        <p class="mt-2">{{ $complaintBook->complaint_detail }}</p>
                                    </div>
                                    <div>
                                        <strong>Pedido del Consumidor:</strong>
                                        <p class="mt-2">{{ $complaintBook->request }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Notas del Administrador -->
                            @if($complaintBook->admin_notes)
                            <div class="card mb-3">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i> Notas del Administrador</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $complaintBook->admin_notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
