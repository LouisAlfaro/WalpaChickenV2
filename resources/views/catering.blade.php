@extends('layouts.app')

@section('content')
<div class="catering-page">
    <!-- Header limpio -->
    <div class="catering-header">
        <div class="container">
            <div class="header-content">
                <h1 class="page-title">Catering</h1>
                
                <!-- Botones de navegación más pequeños y organizados -->
                <div class="nav-buttons">
                    <button class="nav-btn active" data-section="servicio" onclick="showSection('servicio')">
                        ¿Qué comprende el servicio?
                    </button>
                    <button class="nav-btn" data-section="solicitar" onclick="showSection('solicitar')">
                        Solicita el servicio
                    </button>
                    <button class="nav-btn" data-section="clientes" onclick="showSection('clientes')">
                        Nuestros Clientes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección: ¿Qué comprende el servicio? (activa por defecto) -->
    <section id="section-servicio" class="content-section">
        <div class="hero-banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-text">
                            <div class="service-badge">
                                <i class="fas fa-concierge-bell"></i>
                                <span>Servicio Premium</span>
                            </div>
                            <h1 class="hero-title">{{ $cateringInfo->title ?? 'Servicio de Catering Walpa' }}</h1>
                            <h2 class="hero-subtitle">El sabor <span class="highlight">INCOMPARABLE.</span> disfruta</h2>
                            <div class="rating-container">
                                <div class="stars">★ ★ ★ ★ ★</div>
                                <span class="rating-text">Calidad garantizada</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image-container">
                            <div class="image-frame">
                                @if($cateringInfo && $cateringInfo->main_image)
                                    <img src="{{ $cateringInfo->main_image_url }}" alt="Catering Walpa" class="hero-img">
                                @else
                                    <img src="{{ asset('images/catering-hero.jpg') }}" alt="Catering Walpa" class="hero-img">
                                @endif
                                <div class="image-overlay">
                                    <div class="overlay-content">
                                        <i class="fas fa-play-circle"></i>
                                        <span>Ver galería</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="hero-description">
            <div class="container">
                <div class="description-card">
                    <div class="card-header">
                        <h3><i class="fas fa-info-circle"></i> Sobre nuestro servicio</h3>
                    </div>
                    <div class="card-body">
                        <p class="description-text">{{ $cateringInfo->description ?? 'Tus invitados son los nuestros, por eso te aseguramos que nuestra Experiencia Walpa los cautivará. Nuestra familia y su cálido servicio se trasladan, con lo mejor de nuestros insumos e indumentaria, a donde tú nos indiques para hacerlos sentir como en casa.' }}</p>
                        
                        @if($cateringInfo && ($cateringInfo->phone || $cateringInfo->email || $cateringInfo->address))
                            <div class="contact-grid">
                                @if($cateringInfo->phone)
                                    <div class="contact-card">
                                        <div class="contact-icon phone">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="contact-details">
                                            <span class="contact-label">Teléfono</span>
                                            <span class="contact-value">{{ $cateringInfo->phone }}</span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($cateringInfo->email)
                                    <div class="contact-card">
                                        <div class="contact-icon email">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="contact-details">
                                            <span class="contact-label">Email</span>
                                            <span class="contact-value">{{ $cateringInfo->email }}</span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($cateringInfo->address)
                                    <div class="contact-card">
                                        <div class="contact-icon address">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="contact-details">
                                            <span class="contact-label">Ubicación</span>
                                            <span class="contact-value">{{ $cateringInfo->address }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección: Solicita el servicio -->
    <section id="section-solicitar" class="content-section" style="display: none;">
        <div class="forms-container">
            <div class="container">
                <!-- Formulario de Catering centrado -->
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-5 col-md-7">
                        <div class="catering-form">
                            <h3 class="form-title">Formulario</h3>
                            
                            @if(session('success'))
                                <div class="alert alert-success mb-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('catering.request') }}" method="POST">
                                @csrf
                                
                                <div class="form-group">
                                    <label>Nombres <span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Fecha nacimiento <span class="required">*</span></label>
                                    <input type="date" name="birth_date" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Teléfono <span class="required">*</span></label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Región <span class="required">*</span></label>
                                    <select name="region" class="form-control" required>
                                        <option value="">Seleccionar una región</option>
                                        <option value="Lima">Lima</option>
                                        <option value="Callao">Callao</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Provincia <span class="required">*</span></label>
                                    <select name="province" class="form-control" required>
                                        <option value="">Seleccionar una provincia</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Distrito <span class="required">*</span></label>
                                    <select name="district" class="form-control" required>
                                        <option value="">Seleccionar un distrito</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Comentario <span class="required">*</span></label>
                                    <textarea name="message" class="form-control" rows="3" required></textarea>
                                </div>

                                <button type="submit" class="btn-submit">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sección Reservar -->
                <div class="reservation-section">
                    <div class="reservation-header">
                        <h3>Reservar</h3>
                    </div>
                    
                    <!-- Paquetes en fila horizontal -->
                    @if($packages->count() > 0)
                        <div class="packages-section">
                            <div class="packages-header">
                                <h3><i class="fas fa-gift"></i> Nuestros Paquetes</h3>
                                <p>Elige el paquete perfecto para tu evento</p>
                            </div>
                            <div class="packages-grid">
                                @foreach($packages as $package)
                                    <div class="package-card-modern">
                                        <div class="package-badge-modern">
                                            <i class="fas fa-crown"></i>
                                            <span>{{ $loop->first ? 'Más Popular' : 'Disponible' }}</span>
                                        </div>
                                        <div class="package-content">
                                            <h5 class="package-title">{{ $package->name }}</h5>
                                            <div class="package-range">
                                                <i class="fas fa-users"></i>
                                                <span>{{ $package->people_range }}</span>
                                            </div>
                                            <p class="package-description">{{ $package->description }}</p>
                                            @if($package->price_per_person)
                                                <div class="package-price">
                                                    <span class="price-label">Desde</span>
                                                    <span class="price-value">S/ {{ number_format($package->price_per_person, 2) }}</span>
                                                    <span class="price-unit">por persona</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="package-actions">
                                            <button class="btn-package-modern" onclick="selectPackage({{ $package->id }})">
                                                <i class="fas fa-calendar-plus"></i>
                                                <span>Reservar Ahora</span>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Formulario de reserva con imagen -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="reservation-form">
                                <h4 class="reservation-title">Elige cuándo realizar TU reserva</h4>
                                
                                <form action="{{ route('catering.reservation') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="catering_package_id" id="selected_package">
                                    
                                    <div class="form-group">
                                        <label>Sede <span class="required">*</span></label>
                                        <select name="location" class="form-control" required>
                                            <option value="">Seleccionar una sede</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Fecha <span class="required">*</span></label>
                                        <input type="date" name="event_date" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Hora <span class="required">*</span></label>
                                        <select name="event_time" class="form-control" required>
                                            <option value="">Seleccionar una hora</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Número de personas <span class="required">*</span></label>
                                        <input type="number" name="number_of_people" class="form-control" min="1" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Tipo de contacto <span class="required">*</span></label>
                                        <input type="text" name="contact_type" class="form-control" placeholder="Teléfono" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Contacto <span class="required">*</span></label>
                                        <input type="text" name="contact_value" class="form-control" placeholder="Email o teléfono" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Motivo</label>
                                        <select name="reason" class="form-control">
                                            <option value="">Seleccionar un motivo</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Mensaje <span class="required">*</span></label>
                                        <textarea name="message" class="form-control" rows="3" required></textarea>
                                    </div>

                                    <button type="submit" class="btn-submit">Enviar</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="promo-image">
                                <img src="{{ asset('images/walpa-promo.jpg') }}" alt="Promoción Walpa" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección: Nuestros Clientes -->
    <section id="section-clientes" class="content-section">
    <div class="clients-section">
        <div class="container">
            <div class="clients-header">
                <h2>Nuestros Clientes</h2>
            </div>
            <div class="clients-content">
                @foreach($clients as $client)
                    <div class="client-item">
                        <div class="client-logo">
                            @if($client->logo)
                                <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}">
                            @endif
                        </div>
                        <h5>{{ strtoupper($client->name) }}</h5>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
</div>

<style>
/* Variables CSS mejoradas */
:root {
    --walpa-gold: #D4AF37;
    --walpa-brown: #8B4513;
    --walpa-dark-brown: #5D2F1A;
    --walpa-yellow: #FFD700;
    --walpa-orange: #FF8C00;
    --text-dark: #2C3E50;
    --text-light: #7F8C8D;
    --bg-light: #F8F9FA;
    --white: #FFFFFF;
    --shadow: 0 8px 25px rgba(0,0,0,0.1);
    --shadow-hover: 0 15px 35px rgba(0,0,0,0.15);
}

.catering-page {
    background: linear-gradient(135deg, #F8F9FA 0%, #E9ECEF 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
}

/* Hero Banner rediseñado */
.hero-banner {
    background: linear-gradient(135deg, var(--walpa-dark-brown) 0%, var(--walpa-brown) 50%, #A0522D 100%);
    color: white;
    padding: 5rem 0 4rem;
    position: relative;
    overflow: hidden;
}

.hero-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 30% 50%, rgba(255,215,0,0.1) 0%, transparent 50%);
}

.service-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--walpa-gold), var(--walpa-yellow));
    color: var(--walpa-dark-brown);
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
    box-shadow: var(--shadow);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.hero-text {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    line-height: 1.2;
    color: white;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 2.8rem;
    font-weight: 900;
    margin-bottom: 1.5rem;
    line-height: 1.1;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.highlight {
    background: linear-gradient(45deg, var(--walpa-yellow), var(--walpa-orange));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 900;
    text-shadow: none;
}

.rating-container {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stars {
    color: #00FF7F;
    font-size: 2rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    filter: drop-shadow(0 0 10px rgba(0,255,127,0.3));
}

.rating-text {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 5px 15px;
    border-radius: 15px;
    font-size: 0.9rem;
    font-weight: 600;
    border: 1px solid rgba(255,255,255,0.3);
}

/* Contenedor de imagen mejorado */
.hero-image-container {
    position: relative;
    z-index: 2;
    text-align: center;
}

.image-frame {
    position: relative;
    display: inline-block;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-hover);
    transition: all 0.3s ease;
}

.image-frame:hover {
    transform: scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.hero-img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 20px;
    border: 5px solid var(--walpa-gold);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(0,0,0,0.3));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    border-radius: 15px;
}

.image-frame:hover .image-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    color: white;
}

.overlay-content i {
    font-size: 3rem;
    margin-bottom: 0.5rem;
    color: var(--walpa-gold);
}

.overlay-content span {
    display: block;
    font-weight: 600;
    font-size: 1.1rem;
}

/* Header mejorado */
.catering-header {
    background-color: white;
    padding: 2rem 0 1rem;
    border-bottom: 1px solid #eee;
}

.header-content {
    text-align: center;
}

.page-title {
    font-size: 2rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    display: inline-block;
    border-left: 4px solid var(--text-dark);
    padding-left: 1rem;
}

/* Botones de navegación más compactos */
.nav-buttons {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.nav-btn {
    background-color: var(--text-light);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.nav-btn:hover,
.nav-btn.active {
    background-color: var(--walpa-gold);
    transform: translateY(-1px);
}

/* Sección de descripción rediseñada */
.hero-description {
    background: linear-gradient(135deg, #F8F9FA 0%, #E9ECEF 100%);
    padding: 4rem 0;
    position: relative;
}

.hero-description::before {
    content: '';
    position: absolute;
    top: -20px;
    left: 0;
    right: 0;
    height: 40px;
    background: linear-gradient(135deg, var(--walpa-dark-brown) 0%, var(--walpa-brown) 50%, #A0522D 100%);
    clip-path: polygon(0 0, 100% 0, 95% 100%, 5% 100%);
}

.description-card {
    background: var(--white);
    border-radius: 25px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
}

.description-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-5px);
}

.card-header {
    background: linear-gradient(135deg, var(--walpa-gold) 0%, var(--walpa-yellow) 100%);
    color: var(--walpa-dark-brown);
    padding: 1.5rem 2rem;
    text-align: center;
}

.card-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.card-header i {
    font-size: 1.3rem;
}

.card-body {
    padding: 2.5rem;
}

.description-text {
    font-size: 1.1rem;
    line-height: 1.7;
    color: var(--text-dark);
    text-align: center;
    margin-bottom: 2rem;
    font-weight: 500;
}

/* Grid de contacto rediseñado */
.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.contact-card {
    background: linear-gradient(135deg, #F8F9FA, var(--white));
    padding: 1.5rem;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(212, 175, 55, 0.2);
}

.contact-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    border-color: var(--walpa-gold);
}

.contact-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: white;
    flex-shrink: 0;
}

.contact-icon.phone {
    background: linear-gradient(135deg, #4CAF50, #45a049);
}

.contact-icon.email {
    background: linear-gradient(135deg, #2196F3, #1976D2);
}

.contact-icon.address {
    background: linear-gradient(135deg, #FF5722, #E64A19);
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}

.contact-label {
    font-size: 0.9rem;
    color: var(--text-light);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.contact-value {
    font-size: 1.1rem;
    color: var(--text-dark);
    font-weight: 700;
}

/* Formularios más compactos */
.forms-container {
    padding: 2rem 0;
}

.catering-form,
.reservation-form {
    background: linear-gradient(135deg, var(--walpa-brown) 0%, var(--walpa-dark-brown) 100%);
    padding: 1.5rem;
    border-radius: 10px;
    color: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.form-title {
    color: var(--walpa-yellow);
    text-align: center;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.3rem;
    font-size: 0.9rem;
    font-weight: 500;
}

.required {
    color: #FF6B6B;
}

.form-control {
    width: 100%;
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    font-size: 0.9rem;
    background: white;
    color: var(--text-dark);
}

.form-control:focus {
    outline: none;
    box-shadow: 0 0 0 2px var(--walpa-yellow);
}

.btn-submit {
    background: var(--walpa-yellow);
    color: var(--walpa-brown);
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
    width: 100%;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.btn-submit:hover {
    background: #FFA500;
    transform: translateY(-1px);
}

/* Sección de reservas optimizada */
.reservation-section {
    background: linear-gradient(135deg, var(--walpa-yellow) 0%, #FFA500 100%);
    padding: 2rem;
    border-radius: 10px;
    margin-top: 2rem;
}

.reservation-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.reservation-header h3 {
    background: rgba(139, 69, 19, 0.8);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    display: inline-block;
    margin: 0;
    font-size: 1.2rem;
}

/* Paquetes rediseñados */
.packages-section {
    margin-bottom: 3rem;
}

.packages-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.packages-header h3 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--walpa-dark-brown);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.packages-header h3 i {
    color: var(--walpa-gold);
}

.packages-header p {
    color: var(--text-light);
    font-size: 1.1rem;
    margin: 0;
}

.packages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
}

.package-card-modern {
    background: var(--white);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    position: relative;
    border: 2px solid transparent;
}

.package-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-hover);
    border-color: var(--walpa-gold);
}

.package-card-modern:first-child {
    border-color: var(--walpa-gold);
    background: linear-gradient(135deg, #FFFEF7 0%, var(--white) 100%);
}

.package-badge-modern {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, var(--walpa-gold), var(--walpa-yellow));
    color: var(--walpa-dark-brown);
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 3px 10px rgba(212, 175, 55, 0.3);
    z-index: 1;
}

.package-content {
    padding: 2rem;
    padding-top: 3rem;
}

.package-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--walpa-dark-brown);
    margin-bottom: 1rem;
    text-align: center;
}

.package-range {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #E3F2FD, #BBDEFB);
    color: #1976D2;
    padding: 8px 15px;
    border-radius: 15px;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.package-description {
    font-size: 1rem;
    line-height: 1.6;
    color: var(--text-light);
    text-align: center;
    margin-bottom: 1.5rem;
    min-height: 60px;
}

.package-price {
    background: linear-gradient(135deg, #F3E5F5, #E1BEE7);
    border-radius: 15px;
    padding: 1rem;
    text-align: center;
    margin-bottom: 1.5rem;
}

.price-label {
    display: block;
    font-size: 0.9rem;
    color: var(--text-light);
    font-weight: 600;
}

.price-value {
    display: block;
    font-size: 2rem;
    font-weight: 900;
    color: var(--walpa-dark-brown);
    margin: 0.2rem 0;
}

.price-unit {
    font-size: 0.9rem;
    color: var(--text-light);
    font-weight: 500;
}

.package-actions {
    padding: 0 2rem 2rem;
}

.btn-package-modern {
    width: 100%;
    background: linear-gradient(135deg, var(--walpa-dark-brown), var(--walpa-brown));
    color: white;
    border: none;
    padding: 15px 25px;
    border-radius: 15px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-package-modern:hover {
    background: linear-gradient(135deg, var(--walpa-brown), var(--walpa-dark-brown));
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(139, 69, 19, 0.3);
}

.package-card-modern:first-child .btn-package-modern {
    background: linear-gradient(135deg, var(--walpa-gold), var(--walpa-yellow));
    color: var(--walpa-dark-brown);
}

.package-card-modern:first-child .btn-package-modern:hover {
    background: linear-gradient(135deg, var(--walpa-yellow), var(--walpa-gold));
}

.reservation-title {
    color: var(--walpa-yellow);
    font-size: 1.2rem;
    margin-bottom: 1rem;
    text-align: center;
}

/* Clientes optimizado */
.clients-section {
    padding: 2rem 0;
}

.clients-header {
    background: var(--walpa-yellow);
    text-align: center;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.clients-header h2 {
    margin: 0;
    color: var(--text-dark);
    font-size: 1.8rem;
    font-weight: 600;
}

.clients-content {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
}

.client-item {
    text-align: center;
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.client-logo img {
    max-width: 80px;
    height: auto;
    margin-bottom: 0.5rem;
}

.client-item h5 {
    margin: 0;
    color: var(--text-dark);
    font-size: 1rem;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .nav-buttons {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .nav-btn {
        width: 100%;
        margin-bottom: 0.25rem;
        padding: 12px 16px;
        font-size: 0.9rem;
    }
    
    .hero-banner {
        padding: 2rem 0;
        text-align: center;
    }
    
    .hero-title {
        font-size: 1.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.8rem;
    }
    
    .hero-image {
        margin-top: 2rem;
    }
    
    .hero-description {
        padding: 2rem 0;
    }
    
    .description-text {
        font-size: 1rem;
        text-align: left;
    }
    
    .contact-info {
        padding: 1.5rem;
    }
    
    .contact-item {
        justify-content: flex-start;
        margin-bottom: 1rem;
    }
    
    .packages-row {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .package-card {
        padding: 1.5rem;
    }
    
    .clients-content {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .catering-form,
    .reservation-form {
        padding: 1rem;
    }
    
    .reservation-section {
        padding: 1.5rem;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 1.3rem;
    }
    
    .hero-subtitle {
        font-size: 1.5rem;
    }
    
    .form-title {
        font-size: 1.3rem;
    }
    
    .reservation-section {
        padding: 1rem;
    }
    
    .package-card {
        padding: 1rem;
    }
    
    .contact-info {
        padding: 1rem;
    }
    
    .hero-description {
        padding: 1.5rem 0;
    }
}
</style>

<script>
function showSection(sectionName) {
    // Ocultar todas las secciones
    document.querySelectorAll('.content-section').forEach(section => {
        section.style.display = 'none';
    });
    
    // Remover clase active de todos los botones
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Mostrar la sección seleccionada
    document.getElementById('section-' + sectionName).style.display = 'block';
    
    // Agregar clase active al botón correspondiente
    document.querySelector('[data-section="' + sectionName + '"]').classList.add('active');
}

function selectPackage(packageId) {
    document.getElementById('selected_package').value = packageId;
    // Scroll suave al formulario de reserva
    document.querySelector('.reservation-form').scrollIntoView({
        behavior: 'smooth'
    });
}

// Establecer fecha mínima para reservas
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.querySelector('input[name="event_date"]');
    if (dateInput) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        dateInput.min = tomorrow.toISOString().split('T')[0];
    }
});
</script>
@endsection