<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Walpa')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --color-fondo-primario: #210303;
            --color-fondo-secundario: #d03336;
            --color-fondo-terciario: #fec601;
            --color-fondo-cuaternario: #ffffff;
            --color-fondo-quinario: #e9e9e9;
            --color-fondo-senario: #b18322;
            --color-texto-primario: #210303;
            --color-texto-cuaternario: #ffffff;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            height: 100vh; /* Cambiar de min-height a height */
            background: linear-gradient(180deg, var(--color-fondo-primario), #3a0808);
            color: var(--color-texto-cuaternario);
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto; /* Permitir scroll vertical */
            display: flex;
            flex-direction: column;
        }
        
        .sidebar .brand {
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(254, 198, 1, 0.2);
            margin-bottom: 1rem;
        }
        
        .sidebar .brand h2 {
            color: var(--color-fondo-terciario);
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }
        
        .sidebar .brand p {
            color: rgba(255,255,255,0.8);
            margin: 0.5rem 0 0 0;
            font-size: 0.9rem;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(254, 198, 1, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(254, 198, 1, 0.5);
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
            border-radius: 0;
            margin: 0.2rem 0;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(254, 198, 1, 0.1);
            color: var(--color-fondo-terciario);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background-color: var(--color-fondo-terciario);
            color: var(--color-texto-primario);
            font-weight: bold;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 0.8rem;
        }
        
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }
        
        .top-bar {
            background: var(--color-fondo-cuaternario);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .top-bar h1 {
            margin: 0;
            color: var(--color-texto-primario);
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .top-bar .user-info {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .content-area {
            padding: 0 2rem 2rem;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--color-fondo-terciario), var(--color-fondo-senario));
            color: var(--color-texto-primario);
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 1.5rem;
            font-weight: bold;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--color-fondo-primario), #3a0808);
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #3a0808, var(--color-fondo-primario));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33,3,3,0.3);
        }
        
        .btn-warning {
            background: var(--color-fondo-terciario);
            border: none;
            color: var(--color-texto-primario);
            font-weight: 600;
        }
        
        .btn-danger {
            background: var(--color-fondo-secundario);
            border: none;
            font-weight: 600;
        }
        
        .stats-card {
            background: linear-gradient(135deg, var(--color-fondo-cuaternario), #f8f9fa);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--color-fondo-primario);
        }
        
        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stats-icon {
            font-size: 3rem;
            opacity: 0.2;
        }
        
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: var(--color-fondo-quinario);
            border: none;
            font-weight: 600;
            color: var(--color-texto-primario);
            padding: 1rem;
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid #f0f0f0;
        }
        
        .table tbody tr:hover {
            background-color: rgba(254, 198, 1, 0.05);
        }

        
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .top-bar {
                padding-left: 1rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <h2>
                <img src="{{ asset('images/logo1.png') }}" alt="Walpa" height="40">
            </h2>
            <p>Panel de Administración</p>
        </div>
        
        <nav class="nav flex-column">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                Gestión de Sliders
            </a>
             <a href="{{ route('admin.favorites.index') }}" class="nav-link {{ request()->routeIs('admin.favorites.*') ? 'active' : '' }}">
                <i class="fas fa-heart"></i>
                Mis Favoritos
            </a>
            <a href="{{ route('admin.locations.index') }}" class="nav-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i>
                Locales
            </a>
            <a href="{{ route('admin.menu-products.index') }}" class="nav-link {{ request()->routeIs('admin.menu-products.*') ? 'active' : '' }}">
                <i class="fas fa-utensils"></i>
                Cartas
            </a>
            <a href="{{ route('admin.promotions.index') }}" class="nav-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                <i class="fas fa-percentage"></i>
                Promociones
            </a>
            <a href="{{ route('admin.company-sections.index') }}" class="nav-link {{ request()->routeIs('admin.company-sections.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                Nuestra Empresa
            </a>
            @if(Route::has('admin.social-posts.index'))
                <a href="{{ route('admin.social-posts.index') }}" class="nav-link {{ request()->routeIs('admin.social-posts.*') ? 'active' : '' }}">
                    <i class="fas fa-share-alt"></i>
                    Comunidad Social
                </a>
            @endif
            <a href="{{ route('admin.catering.index') }}" class="nav-link {{ request()->routeIs('admin.catering.*') ? 'active' : '' }}">
                <i class="fas fa-concierge-bell"></i>
                Gestión de Catering
            </a>
            <a href="{{ route('admin.catering.clients.index') }}" class="nav-link {{ request()->routeIs('admin.catering.clients.*') ? 'active' : '' }}">
                <i class="fas fa-handshake"></i>
                Nuestros Clientes
            </a>
            <a href="{{ route('admin.opportunities.index') }}" class="nav-link {{ request()->routeIs('admin.opportunities.*') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i>
                Oportunidades
            </a>
            <a href="{{ route('admin.contact.edit') }}" 
                class="nav-link {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i>
                    Contacto
            </a>
            <a href="{{ route('admin.promotional-popups.index') }}" 
            class="nav-link {{ request()->routeIs('admin.promotional-popups.*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn"></i>
                Popups Promocionales
            </a>
            <a href="{{ route('admin.analytics.index') }}" 
            class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                Analíticas
            </a>
            <a href="{{ route('admin.social-widget.edit') }}" 
            class="nav-link {{ request()->routeIs('admin.social-widget.*') ? 'active' : '' }}">
                <i class="fas fa-share-alt"></i>
                Widget Redes Sociales
            </a>
            <a href="{{ route('admin.delivery-platforms.index') }}" 
                class="nav-link {{ request()->routeIs('admin.delivery-platforms.*') ? 'active' : '' }}">
                <i class="fas fa-motorcycle"></i>
                Pedir Online
            </a>
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                Ver Sitio Web
            </a>
            <div class="nav-link" style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem;">
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-link text-white p-0" style="text-decoration: none;">
                        <i class="fas fa-sign-out-alt"></i>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar d-flex justify-content-between align-items-center">
            <div>
                <h1>@yield('page-title', 'Dashboard')</h1>
                <div class="user-info">
                    Bienvenido, {{ auth()->user()->name }}
                </div>
            </div>
            <div class="d-md-none">
                <button class="btn btn-outline-secondary" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    @yield('scripts')
</body>
</html>