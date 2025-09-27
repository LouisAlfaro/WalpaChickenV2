@extends('admin.layouts.app')

@section('title', 'Opportunities Reports')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Opportunities Reports</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.opportunities.index') }}">Opportunities</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Métricas Principales -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Applications</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="245">245</span></h4>
                            <a href="{{ route('admin.opportunities.applications.index') }}" class="text-decoration-underline">View Applications</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                <i class="bx bx-user-plus text-success"></i>
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
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Active Benefits</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="15">15</span></h4>
                            <a href="{{ route('admin.opportunities.benefits.index') }}" class="text-decoration-underline">Manage Benefits</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                <i class="bx bx-gift text-info"></i>
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
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending Reviews</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="32">32</span></h4>
                            <span class="badge bg-warning-subtle text-warning fs-12">Needs Attention</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                <i class="bx bx-time text-warning"></i>
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
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Conversion Rate</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="18.5">18.5</span>%</h4>
                            <span class="badge bg-success-subtle text-success fs-12">+2.3% from last month</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-line-chart text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Cards -->
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Analytics Report</h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="avatar-lg mx-auto mb-4">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-1">
                                <i class="ri-bar-chart-2-line"></i>
                            </div>
                        </div>
                        <h5 class="fs-16 mb-3">Advanced Analytics</h5>
                        <p class="text-muted mb-4">Detailed charts, trends analysis and performance metrics for applications and benefits.</p>
                        <a href="{{ route('admin.opportunities.reports.analytics') }}" class="btn btn-primary">
                            <i class="ri-eye-line me-1"></i> View Analytics
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Commercial Report</h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="avatar-lg mx-auto mb-4">
                            <div class="avatar-title bg-success-subtle text-success rounded-circle fs-1">
                                <i class="ri-line-chart-line"></i>
                            </div>
                        </div>
                        <h5 class="fs-16 mb-3">Commercial Performance</h5>
                        <p class="text-muted mb-4">ROI analysis, cost per hire, and commercial impact of opportunities program.</p>
                        <a href="{{ route('admin.opportunities.reports.comercial') }}" class="btn btn-success">
                            <i class="ri-eye-line me-1"></i> View Commercial
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Recent Activity Summary</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Period</th>
                                    <th scope="col">Applications</th>
                                    <th scope="col">Reviewed</th>
                                    <th scope="col">Hired</th>
                                    <th scope="col">Benefits Used</th>
                                    <th scope="col">Conversion Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>This Week</td>
                                    <td><span class="badge bg-primary-subtle text-primary">23</span></td>
                                    <td><span class="badge bg-info-subtle text-info">18</span></td>
                                    <td><span class="badge bg-success-subtle text-success">4</span></td>
                                    <td><span class="badge bg-warning-subtle text-warning">12</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <span class="text-success">17.4%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>This Month</td>
                                    <td><span class="badge bg-primary-subtle text-primary">89</span></td>
                                    <td><span class="badge bg-info-subtle text-info">67</span></td>
                                    <td><span class="badge bg-success-subtle text-success">16</span></td>
                                    <td><span class="badge bg-warning-subtle text-warning">45</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <span class="text-success">18.0%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Last Month</td>
                                    <td><span class="badge bg-primary-subtle text-primary">156</span></td>
                                    <td><span class="badge bg-info-subtle text-info">134</span></td>
                                    <td><span class="badge bg-success-subtle text-success">25</span></td>
                                    <td><span class="badge bg-warning-subtle text-warning">78</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <span class="text-success">16.0%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
</style>
@endpush