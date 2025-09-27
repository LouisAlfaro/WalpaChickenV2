@extends('layouts.admin')

@section('title', 'Gestionar Sliders - Admin Panel')
@section('page-title', 'Gestionar Sliders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Sliders</h2>
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Nuevo Slider
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($sliders->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="80">Imagen</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Sección</th>
                            <th>Orden</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th width="150">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slider)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $slider->image) }}" 
                                     alt="{{ $slider->title }}" 
                                     class="img-thumbnail"
                                     style="width: 60px; height: 45px; object-fit: cover;">
                            </td>
                            <td>
                                <strong>{{ $slider->title }}</strong>
                                @if($slider->link)
                                    <br><small class="text-muted">
                                        <i class="fas fa-link"></i> Tiene enlace
                                    </small>
                                @endif
                            </td>
                            <td>
                                @if($slider->description)
                                    {{ Str::limit($slider->description, 50) }}
                                @else
                                    <span class="text-muted">Sin descripción</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                    @if($slider->section === 'main') bg-primary
                                    @elseif($slider->section === 'promotions') bg-warning text-dark
                                    @elseif($slider->section === 'favorites') bg-danger
                                    @else bg-info
                                    @endif">
                                    {{ ucfirst($slider->section) }}
                                </span>
                            </td>
                            <td>{{ $slider->order }}</td>
                            <td>
                                <span class="badge {{ $slider->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $slider->active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>{{ $slider->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.sliders.show', $slider) }}" 
                                       class="btn btn-outline-info" 
                                       title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" 
                                       class="btn btn-outline-warning" 
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este slider?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger" 
                                                title="Eliminar">
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
        </div>
    </div>

    <!-- Paginación si es necesaria -->
    @if($sliders instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center mt-4">
            {{ $sliders->links() }}
        </div>
    @endif
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-images fa-4x text-muted mb-3"></i>
            <h4>No hay sliders creados</h4>
            <p class="text-muted mb-4">Comienza creando tu primer slider para mostrar contenido en el sitio web.</p>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Crear Primer Slider
            </a>
        </div>
    </div>
@endif
@endsection

@section('scripts')
<script>
// Auto-cerrar alertas después de 5 segundos
setTimeout(function() {
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);
</script>
@endsection