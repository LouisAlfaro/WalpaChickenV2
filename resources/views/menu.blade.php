@extends('layouts.app')

@section('content')
<div class="menu-page">
    <!-- Header -->
    <div class="menu-header text-center py-5">
        <h1 class="display-4 text-walpa">Nuestra Carta</h1>
        <p class="lead">Descubre los sabores únicos de Walpa Chicken</p>
    </div>

    <div class="container">
        <!-- Filtros por Local -->
        <div class="location-filters text-center mb-5">
            <h3 class="mb-4">Selecciona tu local:</h3>
            <div class="btn-group flex-wrap" role="group">
                <button type="button" class="btn btn-walpa active" data-location="all">
                    Todos los locales
                </button>
                @foreach($locations as $location)
                    <button type="button" class="btn btn-outline-walpa" data-location="{{ $location->id }}">
                        {{ $location->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Grid de Productos -->
        <div class="row" id="products-container">
            @forelse($products as $product)
                <div class="col-lg-4 col-md-6 mb-4 product-item" data-location="{{ $product->location_id }}">
                    <div class="card h-100 shadow-sm product-card">
                        <!-- Imagen del producto -->
                        <div class="product-image-container">
                            @if($product->image)
                                <img src="{{ asset('storage/menu-products/' . $product->image) }}" 
                                     class="card-img-top product-image" 
                                     alt="{{ $product->name }}">
                            @else
                                <div class="placeholder-image d-flex align-items-center justify-content-center">
                                    <i class="fas fa-utensils fa-3x text-muted"></i>
                                </div>
                            @endif
                            
                            <!-- Badge del local -->
                            <div class="location-badge">
                                {{ $product->location->name }}
                            </div>
                        </div>

                        <!-- Contenido de la tarjeta -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            
                            @if($product->description)
                                <p class="card-text text-muted small">
                                    {{ $product->description }}
                                </p>
                            @endif

                            <div class="mt-auto">
                                @if($product->price)
                                    <div class="price-section text-center">
                                        <span class="price h4 text-walpa fw-bold">
                                            S/ {{ number_format($product->price, 2) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>No hay productos disponibles</h4>
                        <p>Próximamente estaremos agregando deliciosos platos a nuestra carta.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Mensaje cuando no hay productos para el local seleccionado -->
        <div id="no-products-message" class="text-center py-5" style="display: none;">
            <div class="alert alert-warning">
                <h4>No hay productos en este local</h4>
                <p>Este local aún no tiene productos en su carta. Selecciona otro local.</p>
            </div>
        </div>
    </div>
</div>

<!-- CSS personalizado -->
<style>
.menu-page {
    background-color: #fec601;
    min-height: 100vh;
}

.menu-header {
    background: #210303;
    color: white;
    margin-bottom: 2rem;
}

.text-walpa {
     color: white;
}

/* FORZAR BOTONES COLOR #210303 SÓLIDOS SIN DEGRADADOS */
.location-filters .btn,
.location-filters .btn:active,
.location-filters .btn:focus,
.location-filters .btn:hover,
.location-filters .btn.active,
.btn-walpa,
.btn-walpa:active,
.btn-walpa:focus,
.btn-walpa.active,
.btn-outline-walpa,
.btn-outline-walpa:active,
.btn-outline-walpa:focus,
.btn-outline-walpa.active {
    background: #210303 !important;
    background-color: #210303 !important;
    background-image: none !important;
    border: none !important;
    color: white !important;
    font-weight: 700 !important;
    transition: all 0.3s ease !important;
    box-shadow: none !important;
    filter: none !important;
    text-shadow: none !important;
    opacity: 1 !important;
}

.location-filters .btn:hover,
.btn-walpa:hover {
    background: #210303 !important;
    background-color: #210303 !important;
    background-image: none !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(33, 3, 3, 0.3) !important;
    filter: none !important;
    opacity: 1 !important;
}

.btn-outline-walpa {
    opacity: 1 !important;
}

.btn-outline-walpa:hover {
    opacity: 1 !important;
    transform: translateY(-2px);
}

.product-card {
    border: 2px solid #210303 !important;
    border-radius: 0 !important;
    overflow: hidden;
    transition: all 0.3s ease;
    background: white;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(33, 3, 3, 0.2) !important;
    border-color: #d03336 !important;
}

.product-image-container {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.placeholder-image {
    width: 100%;
    height: 100%;
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.location-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #210303;
    color: #fec601;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.price {
    color: #210303 !important;
}

.location-filters .btn-group {
    gap: 10px;
}

.location-filters .btn {
    border-radius: 25px;
    padding: 10px 20px;
    margin: 5px;
}

@media (max-width: 768px) {
    .location-filters .btn-group {
        flex-direction: column;
        width: 100%;
    }
    
    .location-filters .btn {
        width: 100%;
        margin: 5px 0;
    }
}

/* SUPER OVERRIDE - Eliminar todos los degradados de Bootstrap */
.btn-group > .btn,
.btn-group > .btn:active,
.btn-group > .btn:focus,
.btn-group > .btn:hover,
.btn-group > .btn.active,
.btn-group > .btn[data-active="true"] {
    background: #210303 !important;
    background-color: #210303 !important;
    background-image: none !important;
    border-color: #210303 !important;
    box-shadow: none !important;
    filter: none !important;
    color: white !important;
    opacity: 1 !important;
}

.btn-group > .btn:first-child,
.btn-group > .btn:last-child {
    background: #210303 !important;
    background-image: none !important;
    opacity: 1 !important;
}

/* Botón activo */
.btn-group > .btn[data-active="true"] {
    opacity: 1 !important;
}

.btn-group > .btn:not([data-active="true"]) {
    opacity: 1 !important;
}

.btn-group > .btn:not([data-active="true"]):hover {
    opacity: 1 !important;
}
</style>

<!-- JavaScript para filtros -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-location]');
    const productItems = document.querySelectorAll('.product-item');
    const noProductsMessage = document.getElementById('no-products-message');
    const productsContainer = document.getElementById('products-container');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedLocation = this.getAttribute('data-location');
            
            // Actualizar botones activos - SOLO cambiar el atributo data-active
            filterButtons.forEach(btn => {
                btn.removeAttribute('data-active');
            });
            this.setAttribute('data-active', 'true');

            // Filtrar productos
            let visibleCount = 0;
            productItems.forEach(item => {
                const itemLocationId = item.getAttribute('data-location');
                
                if (selectedLocation === 'all' || itemLocationId === selectedLocation) {
                    item.style.display = 'block';
                    item.style.opacity = '1';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                    item.style.opacity = '0';
                }
            });

            // Mostrar mensaje si no hay productos
            if (visibleCount === 0 && selectedLocation !== 'all') {
                noProductsMessage.style.display = 'block';
                productsContainer.style.display = 'none';
            } else {
                noProductsMessage.style.display = 'none';
                productsContainer.style.display = 'flex';
            }
        });
    });
});
</script>
@endsection