@extends('admin.layouts.app')

@section('title', 'Commercial Report - Opportunities')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Commercial Report - Opportunities</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.opportunities.index') }}">Opportunities</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.opportunities.reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item active">Commercial</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- ROI Metrics -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Cost per Hire</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">S/ <span class="counter-value" data-target="850">850</span></h4>
                            <span class="badge bg-success-subtle text-success fs-12">-12% from last quarter</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                <i class="bx bx-dollar-circle text-success"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Investment</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">S/ <span class="counter-value" data-target="45600">45,600</span></h4>
                            <span class="badge bg-info-subtle text-info fs-12">This quarter</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                <i class="bx bx-wallet text-info"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">ROI Benefits</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="285">285</span>%</h4>
                            <span class="badge bg-success-subtle text-success fs-12">+18% from last quarter</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                <i class="bx bx-trending-up text-warning"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Revenue Impact</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">S/ <span class="counter-value" data-target="125800">125,800</span></h4>
                            <span class="badge bg-primary-subtle text-primary fs-12">Generated this quarter</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-bar-chart-alt text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cost Analysis Charts -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Cost Analysis Over Time</h4>
                </div>
                <div class="card-body">
                    <canvas id="costAnalysisChart" height="350"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Investment Breakdown</h4>
                </div>
                <div class="card-body">
                    <canvas id="investmentChart" height="350"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- ROI Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">ROI by Department</h4>
                    <button class="btn btn-success btn-sm">
                        <i class="ri-download-line me-1"></i> Export Report
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Department</th>
                                    <th scope="col">Investment</th>
                                    <th scope="col">Hires</th>
                                    <th scope="col">Cost per Hire</th>
                                    <th scope="col">Revenue Generated</th>
                                    <th scope="col">ROI</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                    <i class="ri-restaurant-line"></i>
                                                </span>
                                            </div>
                                            <h6 class="mb-0">Kitchen</h6>
                                        </div>
                                    </td>
                                    <td>S/ 15,200</td>
                                    <td>18</td>
                                    <td>S/ 844</td>
                                    <td>S/ 42,500</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success">
                                            <i class="ri-arrow-up-line align-bottom"></i> 279%
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Excellent</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-info-subtle text-info">
                                                    <i class="ri-customer-service-line"></i>
                                                </span>
                                            </div>
                                            <h6 class="mb-0">Service</h6>
                                        </div>
                                    </td>
                                    <td>S/ 12,800</td>
                                    <td>15</td>
                                    <td>S/ 853</td>
                                    <td>S/ 38,200</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success">
                                            <i class="ri-arrow-up-line align-bottom"></i> 298%
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Excellent</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-warning-subtle text-warning">
                                                    <i class="ri-truck-line"></i>
                                                </span>
                                            </div>
                                            <h6 class="mb-0">Delivery</h6>
                                        </div>
                                    </td>
                                    <td>S/ 8,500</td>
                                    <td>12</td>
                                    <td>S/ 708</td>
                                    <td>S/ 22,100</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success">
                                            <i class="ri-arrow-up-line align-bottom"></i> 260%
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Good</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-secondary-subtle text-secondary">
                                                    <i class="ri-settings-line"></i>
                                                </span>
                                            </div>
                                            <h6 class="mb-0">Management</h6>
                                        </div>
                                    </td>
                                    <td>S/ 9,100</td>
                                    <td>8</td>
                                    <td>S/ 1,137</td>
                                    <td>S/ 23,000</td>
                                    <td>
                                        <span class="badge bg-warning-subtle text-warning">
                                            <i class="ri-arrow-up-line align-bottom"></i> 252%
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Good</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Cost Analysis -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Benefits Cost vs Value</h4>
                </div>
                <div class="card-body">
                    <canvas id="benefitsCostChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quarterly Performance</h4>
                </div>
                <div class="card-body">
                    <canvas id="quarterlyChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Cost Analysis Chart
const costCtx = document.getElementById('costAnalysisChart').getContext('2d');
new Chart(costCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Recruitment Costs',
            data: [8500, 7200, 9100, 8800, 7900, 8400],
            borderColor: '#dc3545',
            backgroundColor: 'rgba(220, 53, 69, 0.1)',
            tension: 0.4,
            fill: true
        }, {
            label: 'Benefits Costs',
            data: [4200, 4800, 5100, 4900, 5300, 5600],
            borderColor: '#D4AF37',
            backgroundColor: 'rgba(212, 175, 55, 0.1)',
            tension: 0.4,
            fill: true
        }, {
            label: 'Revenue Generated',
            data: [25000, 28000, 32000, 30000, 34000, 36000],
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
                position: 'top'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Investment Breakdown Chart
const investmentCtx = document.getElementById('investmentChart').getContext('2d');
new Chart(investmentCtx, {
    type: 'doughnut',
    data: {
        labels: ['Recruitment', 'Benefits', 'Training', 'Marketing', 'Other'],
        datasets: [{
            data: [35, 25, 20, 15, 5],
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
                position: 'bottom'
            }
        }
    }
});

// Benefits Cost vs Value Chart
const benefitsCostCtx = document.getElementById('benefitsCostChart').getContext('2d');
new Chart(benefitsCostCtx, {
    type: 'radar',
    data: {
        labels: ['Health Insurance', 'Meal Vouchers', 'Transport', 'Training', 'Bonus'],
        datasets: [{
            label: 'Cost',
            data: [80, 60, 40, 70, 90],
            borderColor: '#dc3545',
            backgroundColor: 'rgba(220, 53, 69, 0.2)'
        }, {
            label: 'Employee Value',
            data: [95, 85, 65, 90, 88],
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.2)'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            }
        },
        scales: {
            r: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});

// Quarterly Performance Chart
const quarterlyCtx = document.getElementById('quarterlyChart').getContext('2d');
new Chart(quarterlyCtx, {
    type: 'bar',
    data: {
        labels: ['Q1 2024', 'Q2 2024', 'Q3 2024', 'Q4 2024'],
        datasets: [{
            label: 'Investment',
            data: [42000, 38000, 45600, 41000],
            backgroundColor: '#D4AF37'
        }, {
            label: 'Revenue',
            data: [118000, 125000, 135000, 128000],
            backgroundColor: '#28a745'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endpush
@endsection