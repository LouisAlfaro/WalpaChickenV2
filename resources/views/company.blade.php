@extends('layouts.app')

@section('content')
<div class="company-page">
    <!-- Header -->
    <div class="company-header text-center py-2">
        <h1 class="display-4 text-white">Nuestra Empresa</h1>
        <p class="lead text-white">Conoce más sobre Walpa Chicken y nuestros valores</p>
    </div>

    <div class="container py-2">
        <!-- Secciones principales: Misión y Valores lado a lado -->
        @if($mission || $values)
            <div class="row mb-3">
                <!-- Misión -->
                @if($mission)
                    <div class="col-lg-6 mb-2">
                        <div class="company-section h-100">
                            <div class="section-header">
                                <h2 class="section-title">{{ $mission->title }}</h2>
                            </div>
                            
                            @if($mission->image)
                                <div class="section-image mb-4">
                                    <img src="{{ asset('storage/company/' . $mission->image) }}" 
                                         alt="{{ $mission->title }}" 
                                         class="img-fluid rounded">
                                </div>
                            @endif
                            
                            <div class="section-content">
                                <p>{{ $mission->content }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Valores -->
                @if($values)
                    <div class="col-lg-6 mb-2">
                        <div class="company-section h-100">
                            <div class="section-header">
                                <h2 class="section-title">{{ $values->title }}</h2>
                            </div>
                            
                            @if($values->image)
                                <div class="section-image mb-4">
                                    <img src="{{ asset('storage/company/' . $values->image) }}" 
                                         alt="{{ $values->title }}" 
                                         class="img-fluid rounded">
                                </div>
                            @endif
                            
                            <div class="section-content">
                                <p>{{ $values->content }}</p>
                                
                                @if($values->list_items && count($values->list_items) > 0)
                                    <div class="values-list mt-4">
                                        @foreach($values->list_items as $item)
                                            <div class="value-item">
                                                <i class="fas fa-circle text-walpa me-2"></i>
                                                <span>{{ $item }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- Visión (ancho completo si existe) -->
        @if($vision)
            <div class="row mb-5">
                <div class="col-12">
                    <div class="company-section vision-section">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="section-header">
                                    <h2 class="section-title">{{ $vision->title }}</h2>
                                </div>
                                <div class="section-content">
                                    <p class="lead">{{ $vision->content }}</p>
                                </div>
                            </div>
                            @if($vision->image)
                                <div class="col-lg-4">
                                    <div class="section-image">
                                        <img src="{{ asset('storage/company/' . $vision->image) }}" 
                                             alt="{{ $vision->title }}" 
                                             class="img-fluid rounded">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Historia y Objetivos -->
        @if($history || $objectives)
            <div class="row mb-5">
                <!-- Historia -->
                @if($history)
                    <div class="col-lg-6 mb-4">
                        <div class="company-section h-100">
                            <div class="section-header">
                                <h2 class="section-title">{{ $history->title }}</h2>
                            </div>
                            
                            @if($history->image)
                                <div class="section-image mb-4">
                                    <img src="{{ asset('storage/company/' . $history->image) }}" 
                                         alt="{{ $history->title }}" 
                                         class="img-fluid rounded">
                                </div>
                            @endif
                            
                            <div class="section-content">
                                <p>{{ $history->content }}</p>
                                
                                @if($history->list_items && count($history->list_items) > 0)
                                    <div class="timeline mt-4">
                                        @foreach($history->list_items as $item)
                                            <div class="timeline-item">
                                                <div class="timeline-marker"></div>
                                                <div class="timeline-content">{{ $item }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Objetivos -->
                @if($objectives)
                    <div class="col-lg-6 mb-4">
                        <div class="company-section h-100">
                            <div class="section-header">
                                <h2 class="section-title">{{ $objectives->title }}</h2>
                            </div>
                            
                            @if($objectives->image)
                                <div class="section-image mb-4">
                                    <img src="{{ asset('storage/company/' . $objectives->image) }}" 
                                         alt="{{ $objectives->title }}" 
                                         class="img-fluid rounded">
                                </div>
                            @endif
                            
                            <div class="section-content">
                                <p>{{ $objectives->content }}</p>
                                
                                @if($objectives->list_items && count($objectives->list_items) > 0)
                                    <div class="objectives-list mt-4">
                                        @foreach($objectives->list_items as $index => $item)
                                            <div class="objective-item">
                                                <span class="objective-number">{{ $index + 1 }}</span>
                                                <span>{{ $item }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- Equipo (si existe) -->
        @if($team)
            <div class="row mb-5">
                <div class="col-12">
                    <div class="company-section team-section">
                        <div class="section-header text-center">
                            <h2 class="section-title">{{ $team->title }}</h2>
                        </div>
                        
                        <div class="row align-items-center">
                            @if($team->image)
                                <div class="col-lg-6">
                                    <div class="section-image">
                                        <img src="{{ asset('storage/company/' . $team->image) }}" 
                                             alt="{{ $team->title }}" 
                                             class="img-fluid rounded">
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-{{ $team->image ? '6' : '12' }}">
                                <div class="section-content">
                                    <p class="lead">{{ $team->content }}</p>
                                    
                                    @if($team->list_items && count($team->list_items) > 0)
                                        <div class="team-values mt-4">
                                            @foreach($team->list_items as $item)
                                                <div class="team-value">
                                                    <i class="fas fa-users text-walpa me-2"></i>
                                                    <span>{{ $item }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Otras secciones adicionales -->
        @foreach($sections->whereNotIn('type', ['mission', 'vision', 'values', 'history', 'team', 'objectives']) as $section)
            <div class="row mb-5">
                <div class="col-12">
                    <div class="company-section">
                        <div class="section-header">
                            <h2 class="section-title">{{ $section->title }}</h2>
                        </div>
                        
                        <div class="row align-items-center">
                            <div class="col-lg-{{ $section->image ? '8' : '12' }}">
                                <div class="section-content">
                                    <p>{{ $section->content }}</p>
                                    
                                    @if($section->list_items && count($section->list_items) > 0)
                                        <div class="section-list mt-4">
                                            @foreach($section->list_items as $item)
                                                <div class="list-item">
                                                    <i class="fas fa-check text-walpa me-2"></i>
                                                    <span>{{ $item }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if($section->image)
                                <div class="col-lg-4">
                                    <div class="section-image">
                                        <img src="{{ asset('storage/company/' . $section->image) }}" 
                                             alt="{{ $section->title }}" 
                                             class="img-fluid rounded">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Llamada a la acción -->
        <div class="text-center mt-5">
            <div class="cta-section py-5">
                <h3 class="text-walpa mb-3">¿Quieres conocer más?</h3>
                <p class="text-muted mb-4">Visita nuestros locales y descubre el sabor auténtico de Walpa Chicken</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('locations') }}" class="btn btn-walpa btn-lg">
                        <i class="fas fa-map-marker-alt me-2"></i>Nuestros Locales
                    </a>
                    <a href="{{ route('menu') }}" class="btn btn-outline-walpa btn-lg">
                        <i class="fas fa-utensils me-2"></i>Ver Nuestra Carta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS personalizado -->
<style>
.company-page {
    background-color: #fec601;
    min-height: 100vh;
}

.company-header {
    background: #210303;
    color: white;
    margin-bottom: 0;
    position: relative;
}

.company-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50px;
    background: transparent;
}

.text-walpa {
    color: #210303 !important;
}

.btn-walpa {
    background-color: #210303;
    border-color: #210303;
    color: #fec601;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-walpa:hover {
    background-color: #2c1810;
    border-color: #2c1810;
    color: #fec601;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(33,3,3, 0.3);
}

.btn-outline-walpa {
    border-color: #210303;
    color: #210303;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-walpa:hover {
    background-color: #210303;
    border-color: #210303;
    color: #fec601;
    transform: translateY(-2px);
}

.company-section {
    background: white;
    border-radius: 15px;
    padding: 1rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
    border-left: 4px solid #210303;
}

.company-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
}

.section-header {
    margin-bottom: 0.5rem;
}

.section-badge {
    background: #210303;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: bold;
    letter-spacing: 0.5px;
    display: inline-block;
    margin-bottom: 0.5rem;
}

.section-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 0;
}

.section-content {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #555;
}

.section-image img {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Estilos específicos para valores */
.values-list .value-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    padding: 0.5rem;
    background: rgba(33,3,3, 0.1);
    border-radius: 8px;
}

/* Estilos para timeline (historia) */
.timeline .timeline-item {
    position: relative;
    padding-left: 2rem;
    margin-bottom: 1rem;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 0.5rem;
    width: 12px;
    height: 12px;
    background: #210303;
    border-radius: 50%;
}

.timeline-marker::before {
    content: '';
    position: absolute;
    left: 5px;
    top: 12px;
    width: 2px;
    height: 20px;
    background: #210303;
}

.timeline-item:last-child .timeline-marker::before {
    display: none;
}

/* Estilos para objetivos */
.objectives-list .objective-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 10px;
    border-left: 3px solid #210303;
}

.objective-number {
    background: #210303;
    color: #fec601;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 1rem;
    flex-shrink: 0;
}

/* Estilos para equipo */
.team-values .team-value {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    padding: 0.5rem;
    background: rgba(33,3,3, 0.1);
    border-radius: 8px;
}

/* Estilos para listas generales */
.section-list .list-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    padding: 0.5rem;
    background: rgba(33,3,3, 0.1);
    border-radius: 8px;
}

/* Sección CTA */
.cta-section {
    background: white;
    border-radius: 15px;
    border: 3px solid #210303;
    box-shadow: 0 10px 30px rgba(33,3,3,0.2);
}

.cta-section h3 {
    font-size: 2rem;
    font-weight: 800;
}

.cta-section p {
    font-size: 1.1rem;
    color: #555;
}

/* Sección especial para visión */
.vision-section {
    background: white;
    border-left-color: #210303;
}

/* Responsive */
@media (max-width: 768px) {
    .company-header h1 {
        font-size: 2.5rem;
    }
    
    .company-section {
        padding: 1.5rem;
    }
    
    .section-content {
        font-size: 1rem;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
    
    .cta-section {
        margin: 0 1rem;
    }
}

@media (max-width: 576px) {
    .company-header h1 {
        font-size: 2rem;
    }
    
    .company-section {
        padding: 1rem;
    }
    
    .objective-item,
    .value-item,
    .team-value,
    .list-item {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    
    .objective-number {
        margin-bottom: 0.5rem;
        margin-right: 0;
    }
}
</style>
@endsection