@extends('layouts.admin')

@section('title', 'Ver Slider - Admin Panel')
@section('page-title', 'Detalles del Slider')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $slider->title }}</h2>
    <div class="btn-group">
        <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Editar
        </a>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Imagen Principal -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-image me-2"></i>Imagen del Slider</h5>
    </div>
    <div class="card-body text-center">
        <div class="position-relative d-inline-block">
            <img src="{{ asset('storage/' . $slider->image) }}" 
                 alt="{{ $slider->title }}" 
                 class="img-fluid rounded shadow"
                 style="max-width: 100%; max-height: 400px; object-fit: contain;">
            
            <!-- Badge de estado superpuesto -->
            <span class="position-absolute top-0 start-0 m-2 badge {{ $slider->active ? 'bg-success' : 'bg-danger' }} fs-6">
                {{ $slider->active ? 'ACTIVO' : 'INACTIVO' }}
            </span>
            
            <!-- Badge de sección superpuesto -->
            <span class="position-absolute top-0 end-0 m-2 badge 
                @if($slider->section === 'main') bg-primary
                @elseif($slider->section === 'promotions') bg-warning text-dark
                @elseif($slider->section === 'favorites') bg-danger
                @else bg-info
                @endif fs-6">
                {{ strtoupper($slider->section) }}
            </span>
        </div>
        
        @if($slider->link)
            <div class="mt-3">
                <a href="{{ $slider->link }}" 
                   target="_blank" 
                   class="btn btn-outline-primary">
                    <i class="fas fa-external-link-alt me-2"></i>Ir al Enlace
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Información del Slider -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información General</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">Título:</dt>
                            <dd class="col-sm-8">{{ $slider->title }}</dd>
                            
                            <dt class="col-sm-4">Sección:</dt>
                            <dd class="col-sm-8">
                                <span class="badge 
                                    @if($slider->section === 'main') bg-primary
                                    @elseif($slider->section === 'promotions') bg-warning text-dark
                                    @elseif($slider->section === 'favorites') bg-danger
                                    @else bg-info
                                    @endif">
                                    {{ ucfirst($slider->section) }}
                                </span>
                                <div class="small text-muted mt-1">
                                    @if($slider->section === 'main')
                                        Se muestra en el carousel principal
                                    @elseif($slider->section === 'promotions')
                                        Aparece en la sección de promociones
                                    @elseif($slider->section === 'favorites')
                                        Se muestra en mis favoritos
                                    @endif
                                </div>
                            </dd>
                            
                            <dt class="col-sm-4">Estado:</dt>
                            <dd class="col-sm-8">
                                <span class="badge {{ $slider->active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $slider->active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </dd>
                            
                            <dt class="col-sm-4">Orden:</dt>
                            <dd class="col-sm-8">{{ $slider->order }}</dd>
                        </dl>
                    </div>
                    
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">Creado:</dt>
                            <dd class="col-sm-8">
                                {{ $slider->created_at->format('d/m/Y') }}
                                <div class="small text-muted">{{ $slider->created_at->format('H:i') }}</div>
                            </dd>
                            
                            <dt class="col-sm-4">Actualizado:</dt>
                            <dd class="col-sm-8">
                                {{ $slider->updated_at->format('d/m/Y') }}
                                <div class="small text-muted">{{ $slider->updated_at->format('H:i') }}</div>
                            </dd>
                            
                            <dt class="col-sm-4">ID:</dt>
                            <dd class="col-sm-8"><code>#{{ $slider->id }}</code></dd>
                            
                            <dt class="col-sm-4">Archivo:</dt>
                            <dd class="col-sm-8">
                                <code>{{ basename($slider->image) }}</code>
                                @if(file_exists(storage_path('app/public/' . $slider->image)))
                                    <div class="small text-muted">
                                        {{ number_format(filesize(storage_path('app/public/' . $slider->image)) / 1024, 2) }} KB
                                    </div>
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
                
                @if($slider->description)
                    <hr>
                    <h6>Descripción:</h6>
                    <p class="text-muted">{{ $slider->description }}</p>
                @endif
                
                @if($slider->link)
                    <hr>
                    <h6>Enlace:</h6>
                    <p>
                        <a href="{{ $slider->link }}" target="_blank" class="text-decoration-none">
                            <i class="fas fa-external-link-alt me-1"></i>{{ $slider->link }}
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Acciones -->
        <div class="