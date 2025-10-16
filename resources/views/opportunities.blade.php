@extends('layouts.app')

@section('title', 'Oportunidades - Walpa Chicken')

@section('content')
<style>
/* PÁGINA COMPLETA */
.opportunities-page {
    background: #fec601 !important;
    min-height: 100vh;
}

/* HERO SECTION */
.hero-opportunities {
    background: #210303 !important;
}
.hero-title {
    color: white !important;
    text-shadow: 3px 3px 6px rgba(0,0,0,0.5) !important;
}
.hero-subtitle {
    color: white !important;
    opacity: 1 !important;
}
.text-gradient {
    color: #fec601 !important;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3) !important;
}
.hero-badge {
    background: #fec601 !important;
    color: #210303 !important;
}
.btn-primary-walpa {
    background: #d03336 !important;
    border: none !important;
    color: white !important;
    font-weight: 700 !important;
    padding: 15px 35px !important;
    border-radius: 30px !important;
    box-shadow: 0 6px 20px rgba(208,51,54,0.4) !important;
}
.btn-primary-walpa:hover {
    background: #b02a2d !important;
    color: white !important;
    transform: translateY(-3px) !important;
    box-shadow: 0 10px 30px rgba(208,51,54,0.5) !important;
}
.btn-outline-light {
    border: 3px solid white !important;
    color: white !important;
    background: transparent !important;
    font-weight: 700 !important;
    padding: 12px 35px !important;
    border-radius: 30px !important;
}
.btn-outline-light:hover {
    background: white !important;
    color: #210303 !important;
}

/* SECCIÓN OPORTUNIDADES */
.opportunities-section {
    background: #fec601 !important;
    padding: 80px 0 !important;
}

/* HEADER DE SECCIÓN - CAJA LIMPIA */
.section-header {
    background: #210303 !important;
    padding: 3rem 2rem !important;
    border-radius: 20px !important;
    margin-bottom: 3rem !important;
    box-shadow: 0 15px 40px rgba(0,0,0,0.3) !important;
    border: none !important;
}

/* BADGE */
.section-badge {
    background: #fec601 !important;
    color: #210303 !important;
    font-size: 1rem !important;
    padding: 10px 30px !important;
    font-weight: 800 !important;
    border-radius: 25px !important;
    box-shadow: 0 4px 15px rgba(254,198,1,0.4) !important;
    display: inline-block !important;
    margin-bottom: 20px !important;
}

/* TÍTULOS */
.section-title {
    color: white !important;
    font-size: 3rem !important;
    font-weight: 900 !important;
    margin: 20px 0 15px 0 !important;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3) !important;
}

.section-subtitle {
    color: white !important;
    font-weight: 600 !important;
    font-size: 1.2rem !important;
    opacity: 0.95 !important;
}

/* TARJETAS DE OPORTUNIDADES - FONDO BLANCO */
.opportunity-card {
    background: white !important;
    border: 4px solid #210303 !important;
    box-shadow: 0 8px 25px rgba(33,3,3,0.2) !important;
    border-radius: 20px !important;
    overflow: hidden !important;
}

.opportunity-card:hover {
    transform: translateY(-10px) !important;
    box-shadow: 0 15px 40px rgba(33,3,3,0.3) !important;
}

.card-header-icon {
    background: white !important;
    padding: 30px 20px 20px !important;
    text-align: center !important;
    border-bottom: 3px solid #fec601 !important;
}

.card-icon {
    width: 80px !important;
    height: 80px !important;
    margin: 0 auto 15px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
}

.commercial-icon {
    background: #1ca0bf !important;
}

.provider-icon {
    background: #e83e8c !important;
}

.job-icon {
    background: #495057 !important;
}

.card-icon i {
    color: white !important;
    font-size: 2rem !important;
}

.card-badge {
    color: #210303 !important;
    font-weight: 800 !important;
    font-size: 1.1rem !important;
    background: transparent !important;
    text-transform: uppercase !important;
    display: block !important;
    margin-top: 10px !important;
}

.card-title {
    color: #210303 !important;
    font-weight: 800 !important;
    font-size: 1.8rem !important;
}

.card-description {
    color: #333 !important;
    font-weight: 500 !important;
    font-size: 1rem !important;
    line-height: 1.6 !important;
}

.card-body {
    background: white !important;
    padding: 2rem !important;
}

.feature-item {
    color: #210303 !important;
    font-weight: 600 !important;
}

.feature-item i {
    color: #d03336 !important;
}

/* BOTONES */
.btn-commercial,
.btn-provider,
.btn-job {
    font-weight: 700 !important;
    font-size: 1rem !important;
    text-transform: uppercase !important;
}

/* SECCIÓN BENEFICIOS - FONDO MARRÓN */
.benefits-section {
    background: #210303 !important;
    position: relative;
    padding: 80px 0 !important;
}

.benefits-section .section-title {
    color: #fec601 !important;
    font-size: 3.5rem !important;
    font-weight: 900 !important;
    text-shadow: 3px 3px 6px rgba(0,0,0,0.5) !important;
    margin-bottom: 20px !important;
}

.benefits-section .section-subtitle {
    color: white !important;
    font-size: 1.4rem !important;
    font-weight: 600 !important;
    opacity: 1 !important;
}

/* CARDS DE BENEFICIOS */
.benefit-card {
    background: white !important;
    border: 3px solid #fec601 !important;
    padding: 2rem !important;
    border-radius: 20px !important;
}

.benefit-card:hover {
    background: white !important;
    border-color: #fec601 !important;
    transform: translateY(-5px) !important;
    box-shadow: 0 10px 30px rgba(254,198,1,0.4) !important;
}

.benefit-card h4 {
    color: #210303 !important;
    font-weight: 800 !important;
    font-size: 1.5rem !important;
    margin-bottom: 15px !important;
}

.benefit-card p {
    color: #333 !important;
    font-weight: 500 !important;
    font-size: 1rem !important;
}

.benefit-icon {
    background: #fec601 !important;
    width: 80px !important;
    height: 80px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 auto 20px !important;
}

.benefit-icon i {
    color: #210303 !important;
    font-size: 2rem !important;
}
</style>
<div class="opportunities-page">
    <!-- Hero Section -->
    <section class="hero-opportunities">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row align-items-center min-vh-80">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <i class="fas fa-rocket me-2"></i>
                            Únete al Equipo
                        </div>
                        <h1 class="hero-title">
                            Descubre las <span class="text-gradient">Oportunidades</span><br>
                            que tenemos para ti
                        </h1>
                        <p class="hero-subtitle">
                            Forma parte de la familia Walpa y haz crecer tu futuro profesional con nosotros
                        </p>
                        <div class="hero-buttons">
                            <a href="#comercial" class="btn btn-primary-walpa me-3">
                                <i class="fas fa-handshake me-2"></i>Comercial
                            </a>
                            <a href="#trabajo" class="btn btn-outline-light">
                                <i class="fas fa-briefcase me-2"></i>Trabajo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        @if(!empty($contents['trabajo']->image))
                            <img src="{{ asset('storage/opportunities/' . $contents['trabajo']->image) }}" 
                                alt="{{ $contents['trabajo']->title ?? 'Equipo Walpa' }}" 
                                class="img-fluid rounded-4 shadow-lg">
                        @else
                            <img src="{{ asset('images/default-team.jpg') }}" 
                                alt="Equipo Walpa" 
                                class="img-fluid rounded-4 shadow-lg">
                        @endif
                        <div class="stats-badge">
                            <i class="fas fa-users text-primary"></i>
                            <span>+500 Colaboradores</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show m-4 rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Oportunidades Section -->
    <section class="opportunities-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="section-badge">Oportunidades</span>
                <h2 class="section-title">¿Qué oportunidad es para ti?</h2>
                <p class="section-subtitle">
                    Elige la opción que mejor se adapte a tus objetivos y comienza tu aventura con nosotros
                </p>
            </div>
            
            <div class="row g-4">
                <!-- Comercial -->
                <div class="col-lg-4" id="comercial">
                    <div class="opportunity-card commercial-card h-100">
                        <div class="card-header-icon">
                            <div class="card-icon commercial-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <span class="card-badge">Comercial</span>
                        </div>
                        
                        <div class="card-body">
                            <h3 class="card-title">{{ $contents['comercial']->title ?? 'Oportunidades Comerciales' }}</h3>
                            <p class="card-description">{{ $contents['comercial']->description ?? 'Sé parte de nuestro crecimiento comercial y expande tu red de negocios' }}</p>
                            
                            <div class="card-features">
                                <div class="feature-item">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Crecimiento</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-users"></i>
                                    <span>Networking</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>Rentabilidad</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button class="btn btn-commercial w-100" data-bs-toggle="modal" data-bs-target="#comercialModal">
                                Aplicar Ahora
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Proveedores -->
                <div class="col-lg-4">
                    <div class="opportunity-card provider-card h-100">
                        <div class="card-header-icon">
                            <div class="card-icon provider-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span class="card-badge">Proveedores</span>
                        </div>
                        
                        <div class="card-body">
                            <h3 class="card-title">{{ $contents['proveedores']->title ?? 'Proveedores' }}</h3>
                            <p class="card-description">{{ $contents['proveedores']->description ?? 'Conviértete en nuestro proveedor de confianza y crece junto a nosotros' }}</p>
                            
                            <div class="card-features">
                                <div class="feature-item">
                                    <i class="fas fa-handshake"></i>
                                    <span>Alianzas</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Contratos</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-award"></i>
                                    <span>Calidad</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button class="btn btn-provider w-100" data-bs-toggle="modal" data-bs-target="#proveedoresModal">
                                Aplicar Ahora
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Trabajo -->
                <div class="col-lg-4" id="trabajo">
                    <div class="opportunity-card job-card h-100 featured">
                        <div class="featured-ribbon">Más Popular</div>
                        <div class="card-header-icon">
                            <div class="card-icon job-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <span class="card-badge">Trabajo</span>
                        </div>
                        
                        <div class="card-body">
                            <h3 class="card-title">{{ $contents['trabajo']->title ?? 'Oportunidades de Trabajo' }}</h3>
                            <p class="card-description">{{ $contents['trabajo']->description ?? 'Únete a nuestro equipo y crece profesionalmente en un ambiente dinámico' }}</p>
                            
                            <div class="card-features">
                                <div class="feature-item">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Capacitación</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-heart"></i>
                                    <span>Beneficios</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-rocket"></i>
                                    <span>Crecimiento</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button class="btn btn-job w-100" data-bs-toggle="modal" data-bs-target="#trabajoModal">
                                Aplicar Ahora
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios Section -->
    @if($benefits->count() > 0)
    <section class="benefits-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">¿Por qué elegir Walpa?</h2>
                <p class="section-subtitle">Descubre todos los beneficios de formar parte de nuestra familia</p>
            </div>
            
            <div class="row g-4">
                @foreach($benefits as $benefit)
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card text-center h-100">
                        <div class="benefit-icon">
                            <i class="{{ $benefit->icon ?? 'fas fa-gift' }}"></i>
                        </div>
                        <h4>{{ $benefit->title }}</h4>
                        <p>{{ $benefit->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>

<!-- Modales -->
<!-- Modal Comercial -->
<div class="modal fade" id="comercialModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-commercial text-white">
                <h5 class="modal-title">
                    <i class="fas fa-handshake me-2"></i>Oportunidad Comercial
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('opportunities.apply', 'comercial') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre Completo *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Empresa *</label>
                            <input type="text" class="form-control" name="company" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tipo de Negocio *</label>
                            <input type="text" class="form-control" name="business_type" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mensaje *</label>
                            <textarea class="form-control" name="message" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-commercial">
                        Enviar Solicitud
                        <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Proveedores -->
<div class="modal fade" id="proveedoresModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-provider text-white">
                <h5 class="modal-title">
                    <i class="fas fa-truck me-2"></i>Ser Proveedor
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('opportunities.apply', 'proveedores') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre Completo *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Empresa *</label>
                            <input type="text" class="form-control" name="company" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Productos/Servicios *</label>
                            <textarea class="form-control" name="products_services" rows="3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mensaje *</label>
                            <textarea class="form-control" name="message" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-provider">
                        Enviar Solicitud
                        <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Trabajo -->
<div class="modal fade" id="trabajoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-job text-white">
                <h5 class="modal-title">
                    <i class="fas fa-briefcase me-2"></i>Oportunidad de Trabajo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('opportunities.apply', 'trabajo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre Completo *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Posición de Interés *</label>
                            <select class="form-control" name="position" required>
                                <option value="">Seleccionar...</option>
                                <option value="cajero">Cajero</option>
                                <option value="cocinero">Cocinero</option>
                                <option value="delivery">Delivery</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="gerente">Gerente</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Experiencia</label>
                            <textarea class="form-control" name="experience" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">CV (PDF, DOC, DOCX)</label>
                            <input type="file" class="form-control" name="attachment" accept=".pdf,.doc,.docx">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mensaje *</label>
                            <textarea class="form-control" name="message" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-job">
                        Enviar Solicitud
                        <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
/* =========================
   Variables CSS
========================= */
:root {
    --walpa-primary: #fec601;
    --walpa-yellow: #fec601;
    --walpa-dark: #210303;
    --walpa-brown: #210303;
    --commercial-color: #1ca0bf;
    --provider-color: #e83e8c;
    --job-color: #495057;
    --text-dark: #2c3e50;
    --text-muted: #6c757d;
    --border-light: #dee2e6;
    --bg-light: #f8f9fa;
    --shadow-light: rgba(0,0,0,0.1);
    --shadow-medium: rgba(0,0,0,0.15);
}

/* =========================
   Reset y Base
========================= */
.opportunities-page {
    background: #fec601 !important;
    font-family: 'Inter', sans-serif;
}

.opportunities-page * {
    box-sizing: border-box;
}

/* =========================
   HERO SECTION
========================= */
.hero-opportunities {
    background: #210303 !important;
    color: white;
    padding: 100px 0 80px;
    position: relative;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: transparent;
}

.min-vh-80 {
    min-height: 80vh;
    display: flex;
    align-items: center;
}

.hero-badge {
    display: inline-block;
    background: #fec601;
    color: #210303;
    padding: 12px 25px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(254,198,1,0.4);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.text-gradient {
    color: #fec601;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.95;
    margin-bottom: 30px;
    line-height: 1.6;
}

.hero-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-primary-walpa {
    background: #fec601;
    border: none;
    color: #210303;
    padding: 15px 35px;
    font-weight: 700;
    border-radius: 30px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(254,198,1,0.4);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-primary-walpa:hover {
    background: #f8d000;
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(254,198,1,0.5);
    color: #210303;
    text-decoration: none;
}

.btn-outline-light {
    border: 3px solid white;
    color: white;
    padding: 12px 35px;
    font-weight: 700;
    border-radius: 30px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    background: transparent;
}

.btn-outline-light:hover {
    background: white;
    color: var(--walpa-dark);
    transform: translateY(-3px);
    text-decoration: none;
}

.hero-image {
    position: relative;
    margin-top: 30px;
}

.stats-badge {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: rgba(255,255,255,0.95);
    padding: 12px 20px;
    border-radius: 15px;
    font-weight: 600;
    color: var(--text-dark);
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stats-badge i {
    color: var(--walpa-primary);
    margin-right: 8px;
}

/* =========================
   SUCCESS ALERT
========================= */
.success-alert {
    background: #28a745;
    border: none;
    color: white;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(32,201,151,0.3);
    margin: 20px;
}

/* =========================
   OPPORTUNITIES SECTION
========================= */
.opportunities-section {
    padding: 80px 0;
    background: #fec601 !important;
}

.section-header {
    margin-bottom: 60px;
}

.section-badge {
    background: #fec601;
    color: #210303;
    padding: 12px 30px;
    border-radius: 25px;
    font-size: 15px;
    font-weight: 700;
    display: inline-block;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(254,198,1,0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.section-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #210303;
    margin-bottom: 15px;
    line-height: 1.2;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #555;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* =========================
   OPPORTUNITY CARDS
========================= */
.opportunity-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px var(--shadow-light);
    transition: all 0.3s ease;
    border: 2px solid var(--border-light);
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.opportunity-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px var(--shadow-medium);
}

.opportunity-card.featured {
    border: 3px solid var(--job-color);
    box-shadow: 0 10px 30px rgba(111,66,193,0.2);
}

.opportunity-card.featured:hover {
    box-shadow: 0 25px 50px rgba(111,66,193,0.3);
}

.featured-ribbon {
    position: absolute;
    top: 25px;
    right: -35px;
    background: var(--job-color);
    color: white;
    padding: 8px 45px;
    font-size: 12px;
    font-weight: 700;
    transform: rotate(45deg);
    z-index: 3;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(111,66,193,0.3);
}

.card-header-icon {
    padding: 40px 25px 20px;
    text-align: center;
    background: white;
}

.card-icon {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2.5rem;
    color: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    position: relative;
}

.commercial-icon {
    background: #1ca0bf;
}

.provider-icon {
    background: #e83e8c;
}

.job-icon {
    background: #495057;
}

.card-badge {
    background: white;
    color: var(--text-dark);
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 700;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 2px solid var(--border-light);
}

.card-body {
    padding: 25px 30px;
    text-align: center;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-title {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 15px;
    line-height: 1.3;
}

.card-description {
    color: var(--text-muted);
    margin-bottom: 25px;
    line-height: 1.6;
    flex: 1;
}

.card-features {
    display: flex;
    justify-content: space-around;
    padding: 20px 0;
    border-top: 2px solid var(--border-light);
    border-bottom: 2px solid var(--border-light);
    margin-bottom: 25px;
    background: var(--bg-light);
}

.feature-item {
    text-align: center;
    flex: 1;
    transition: transform 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
}

.feature-item i {
    display: block;
    font-size: 1.4rem;
    margin-bottom: 8px;
    color: var(--text-muted);
    transition: color 0.3s ease;
}

.feature-item:hover i {
    color: var(--walpa-primary);
}

.feature-item span {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-muted);
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.card-footer {
    padding: 0 30px 30px;
}

/* =========================
   BOTONES
========================= */
.btn-commercial {
    background: #1ca0bf;
    border: none;
    color: white;
    padding: 15px 30px;
    border-radius: 30px;
    font-weight: 700;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 8px 25px rgba(28,160,191,0.4);
    width: 100%;
    border: none;
    cursor: pointer;
}

.btn-provider {
    background: #e83e8c;
    border: none;
    color: white;
    padding: 15px 30px;
    border-radius: 30px;
    font-weight: 700;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 8px 25px rgba(232,62,140,0.4);
    width: 100%;
    border: none;
    cursor: pointer;
}

.btn-job {
    background: #495057;
    border: none;
    color: white;
    padding: 15px 30px;
    border-radius: 30px;
    font-weight: 700;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 8px 25px rgba(73,80,87,0.4);
    width: 100%;
    border: none;
    cursor: pointer;
}

.btn-commercial:hover,
.btn-provider:hover,
.btn-job:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    color: white;
}

.btn-secondary {
    background: #6c757d;
    border: none;
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #5a6268;
    color: white;
    transform: translateY(-2px);
}

/* =========================
   BENEFITS SECTION
========================= */
.benefits-section {
    background: #210303 !important;
    color: white;
    padding: 80px 0;
}

.benefits-section .section-title {
    color: white;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 15px;
}

.benefits-section .section-subtitle {
    color: rgba(255,255,255,0.9);
    font-size: 1.1rem;
    margin-bottom: 40px;
}

.benefit-card {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.2);
    border-radius: 20px;
    padding: 35px 25px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    height: 100%;
    text-align: center;
}

.benefit-card:hover {
    background: rgba(255,255,255,0.15);
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}

.benefit-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 2rem;
    transition: all 0.3s ease;
}

.benefit-card:hover .benefit-icon {
    background: var(--walpa-primary);
    color: var(--walpa-dark);
    transform: scale(1.1);
}

.benefit-card h4 {
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 1.2rem;
}

.benefit-card p {
    opacity: 0.9;
    line-height: 1.6;
    margin-bottom: 0;
}

/* =========================
   MODALES
========================= */
.modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    overflow: hidden;
}

.modal-header {
    border-radius: 20px 20px 0 0;
    padding: 25px 30px;
    border: none;
}

.modal-header.bg-commercial {
    background: #1ca0bf !important;
}

.modal-header.bg-provider {
    background: #e83e8c !important;
}

.modal-header.bg-job {
    background: #495057 !important;
}

.modal-title {
    font-weight: 700;
    font-size: 1.3rem;
}

.btn-close-white {
    filter: invert(1) grayscale(1);
    opacity: 0.9;
}

.modal-body {
    padding: 35px 30px;
}

.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 8px;
    font-size: 14px;
}

.form-control {
    border-radius: 10px;
    border: 2px solid var(--border-light);
    padding: 12px 15px;
    transition: all 0.3s ease;
    font-size: 14px;
    background: white;
}

.form-control:focus {
    border-color: var(--walpa-primary);
    box-shadow: 0 0 0 0.25rem rgba(212,175,55,0.25);
    outline: none;
}

.modal-footer {
    padding: 20px 30px 30px;
    border-top: none;
    gap: 10px;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2.2rem;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .btn-primary-walpa,
    .btn-outline-light {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }
    
    .card-features {
        flex-direction: column;
        gap: 15px;
        padding: 20px 10px;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .feature-item i {
        margin-bottom: 0;
    }
    
    .stats-badge {
        position: static;
        margin-top: 20px;
        display: inline-block;
    }
    
    .hero-image {
        margin-top: 40px;
    }
    
    .modal-body {
        padding: 25px 20px;
    }
    
    .opportunity-card {
        margin-bottom: 30px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll para anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Manejo de formularios - estado de loading
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
                
                // Restaurar el botón después de 5 segundos por si falla el envío
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }, 5000);
            }
        });
    });

    // Auto-hide alerts después de 5 segundos
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            if (alert && alert.classList.contains('show')) {
                alert.classList.remove('show');
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 300);
            }
        }, 5000);
    });

    // Animación de entrada para las cards
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    // Aplicar animación a las cards
    document.querySelectorAll('.opportunity-card, .benefit-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endpush
@endsection