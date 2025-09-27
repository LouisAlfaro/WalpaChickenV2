@extends('layouts.admin')

@section('title', 'Popups Promocionales')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">Popups Promocionales</h2>
                <a href="{{ route('admin.promotional-popups.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Crear Popup
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    @if($popups->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Preview</th>
                                        <th>Título</th>
                                        <th>Estado</th>
                                        <th>Frecuencia</th>
                                        <th>Vigencia</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popups as $popup)
                                    <tr>
                                        <td>
                                            <img src="{{ $popup->image_url }}" 
                                                 alt="{{ $popup->title }}" 
                                                 class="img-thumbnail"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $popup->title }}</div>
                                            @if($popup->link)
                                                <small class="text-muted">
                                                    <i class="fas fa-link me-1"></i>
                                                    <a href="{{ $popup->link }}" target="_blank">Ver enlace</a>
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.promotional-popups.toggle', $popup) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm {{ $popup->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                    {{ $popup->is_active ? 'Activo' : 'Inactivo' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $popup->display_frequency }}h
                                            </span>
                                        </td>
                                        <td>
                                            @if($popup->start_date || $popup->end_date)
                                                <small class="text-muted">
                                                    @if($popup->start_date)
                                                        Desde: {{ $popup->start_date->format('d/m/Y') }}<br>
                                                    @endif
                                                    @if($popup->end_date)
                                                        Hasta: {{ $popup->end_date->format('d/m/Y') }}
                                                    @endif
                                                </small>
                                            @else
                                                <span class="text-muted">Sin límite</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.promotional-popups.edit', $popup) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.promotional-popups.destroy', $popup) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('¿Estás seguro de eliminar este popup?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
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

                        <div class="d-flex justify-content-center mt-4">
                            {{ $popups->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <h5>No hay popups promocionales</h5>
                            <p class="text-muted">Crea tu primer popup promocional para comenzar.</p>
                            <a href="{{ route('admin.promotional-popups.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Crear Popup
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection