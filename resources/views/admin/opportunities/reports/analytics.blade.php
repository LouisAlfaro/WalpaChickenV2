@extends('admin.layouts.app')

@section('title', 'Analytics - Opportunities Reports')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Opportunities Analytics</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.opportunities.index') }}">Opportunities</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.opportunities.reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item active">Analytics</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Analytics Filters</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Time Period</label>
                            <select class="form-select" id="timePeriod">
                                <option value="7">Last 7 days</option>
                                <option value="30" selected>Last 30 days</option>
                                <option value="90">Last 90 days</option>
                                <option value="365">Last year</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Department</label>
                            <select class="form-select" id="department">
                                <option value="">All Departments</option>
                                <option value="kitchen">Kitchen</option>
                                <option value="service">Service</option>
                                <option value="management">Management</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Location</label>
                            <select class="form-select" id="location">
                                <option value="">All Locations</option>
                                <option value="location1">Canto Rey</option>
                                <option value="location2">Canto Grande</option>
                                <option value="location3">Bayóvar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-primary w-100" onclick="updateCharts()">
                                <i class="ri-refresh-line me-1"></i> Update Charts
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Applications Timeline</h4>
                </div>
                <div class="card-body">
                    <canvas id="applicationsChart" height="350"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Application Status</h4>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" height="350"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Benefits Usage</h4>
                </div>
                <div class="card-body">
                    <canvas id="benefitsChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Conversion Funnel</h4>
                </div>
                <div class="card-body">
                    <canvas id="funnelChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Metrics -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Performance Metrics</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="mt-4">
                                <p class="text-muted mb-2">Avg. Time to Hire</p>
                                <h5 class="text-primary">14.5 days</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4">
                                <p class="text-muted mb-2">Cost per Hire</p>
                                <h5 class="text-success">S/ 850</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4">
                                <p class="text-muted mb-2">Employee Retention</p>
                                <h5 class="text-info">87%</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4">
                                <p class="text-muted mb-2">Benefits Satisfaction</p>
                                <h5 class="text-warning">4.2/5</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Applications Timeline Chart
const applicationsCtx = document.getElementById('applicationsChart').getContext('2d');
const applicationsChart = new Chart(applicationsCtx, {
    type: 'line',
    data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
        datasets: [{
            label: 'Applications',
            data: [12, 19, 15, 25, 22, 30],
            borderColor: '#D4AF37',
            backgroundColor: 'rgba(212, 175, 55, 0.1)',
            tension: 0.4,
            fill: true
        }, {
            label: 'Hired',
            data: [2, 3, 2, 5, 4, 6],
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Status Distribution Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
const statusChart = new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Reviewed', 'Contacted', 'Hired', 'Rejected'],
        datasets: [{
            data: [25, 35, 20, 15, 5],
            backgroundColor: [
                '#ffc107',
                '#17a2b8',
                '#D4AF37',
                '#28a745',
                '#dc3545'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Benefits Usage Chart
const benefitsCtx = document.getElementById('benefitsChart').getContext('2d');
const benefitsChart = new Chart(benefitsCtx, {
    type: 'bar',
    data: {
        labels: ['Health Insurance', 'Meal Vouchers', 'Transport', 'Training', 'Bonus'],
        datasets: [{
            label: 'Usage Count',
            data: [45, 67, 23, 34, 12],
            backgroundColor: [
                '#D4AF37',
                '#28a745', 
                '#17a2b8',
                '#ffc107',
                '#dc3545'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Conversion Funnel Chart
const funnelCtx = document.getElementById('funnelChart').getContext('2d');
const funnelChart = new Chart(funnelCtx, {
    type: 'bar',
    data: {
        labels: ['Applied', 'Screened', 'Interviewed', 'Offered', 'Hired'],
        datasets: [{
            label: 'Candidates',
            data: [100, 75, 45, 25, 18],
            backgroundColor: [
                '#dc3545',
                '#ffc107', 
                '#17a2b8',
                '#D4AF37',
                '#28a745'
            ]
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                beginAtZero: true
            }
        }
    }
});

function updateCharts() {
    // Aquí irían las llamadas AJAX para actualizar los datos
    console.log('Updating charts...');
}
</script>
@endpush
@endsection