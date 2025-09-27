{{-- resources/views/admin/analytics/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Analíticas Web')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Analíticas de Visitas</h2>
    
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Hoy</h5>
                    <h2>{{ $stats['today']->sum('views') }}</h2>
                    <small>Total de visitas</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Esta Semana</h5>
                    <h2>{{ $stats['week']->sum('views') }}</h2>
                    <small>Total de visitas</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Este Mes</h5>
                    <h2>{{ $stats['month']->sum('views') }}</h2>
                    <small>Total de visitas</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Página Popular</h5>
                    <h6>{{ $stats['popular_pages']->first()->section ?? 'N/A' }}</h6>
                    <small>{{ $stats['popular_pages']->first()->views ?? 0 }} visitas</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Secciones Stats -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Visitas por Sección - Últimos 7 días</h5>
                </div>
                <div class="card-body">
                    <canvas id="visitsChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Páginas Más Visitadas</h5>
                </div>
                <div class="card-body">
                    @foreach($stats['popular_pages'] as $page)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>{{ $page->section }}</span>
                        <span class="badge bg-primary">{{ $page->views }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabla Detallada -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Estadísticas Detalladas por Sección</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sección</th>
                            <th>Hoy</th>
                            <th>Esta Semana</th>
                            <th>Este Mes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(['Inicio', 'Nuestra Carta', 'Promociones', 'Catering', 'Locales', 'Oportunidades', 'Empresa'] as $section)
                        <tr>
                            <td><strong>{{ $section }}</strong></td>
                            <td>{{ $stats['today'][$section]->views ?? 0 }}</td>
                            <td>{{ $stats['week'][$section]->views ?? 0 }}</td>
                            <td>{{ $stats['month'][$section]->views ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('visitsChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($stats['chart_data']['days']) !!},
        datasets: [{
            label: 'Visitas',
            data: {!! json_encode($stats['chart_data']['views']) !!},
            borderColor: '#fec601',
            backgroundColor: 'rgba(254, 198, 1, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endsection