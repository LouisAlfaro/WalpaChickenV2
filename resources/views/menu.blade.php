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
    background-color: #f8f9fa;
    min-height: 100vh;
}

.menu-header {
    background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);
    color: white;
    margin-bottom: 2rem;
}

.text-walpa {
     color: white;
}

.btn-walpa {
    background-color: #D4AF37;
    border-color: #D4AF37;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-walpa:hover {
    background-color: #B8860B;
    border-color: #B8860B;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(212, 175, 55, 0.3);
}

.btn-outline-walpa {
    border-color: #D4AF37;
    color: #D4AF37;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-walpa:hover,
.btn-outline-walpa.active {
    background-color: #D4AF37;
    border-color: #D4AF37;
    color: white;
}

.product-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
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
    background-color: rgba(212, 175, 55, 0.9);
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.price {
    color: #D4AF37 !important;
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
</style>

<!-- JavaScript para filtros -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-location]');
    const productItems = document.querySelectorAll('.product-item');
    const noProductsMessage = document.getElementById('no-products-message');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedLocation = this.getAttribute('data-location');
            
            // Actualizar botones activos
            filterButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.classList.add('btn-outline-walpa');
                btn.classList.remove('btn-walpa');
            });
            
            this.classList.add('active');
            this.classList.remove('btn-outline-walpa');
            this.classList.add('btn-walpa');

            // Filtrar productos
            let visibleCount = 0;
            productItems.forEach(item => {
                const itemLocationId = item.getAttribute('data-location');
                
                if (selectedLocation === 'all' || itemLocationId === selectedLocation) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Mostrar mensaje si no hay productos
            if (visibleCount === 0 && selectedLocation !== 'all') {
                noProductsMessage.style.display = 'block';
            } else {
                noProductsMessage.style.display = 'none';
            }
        });
    });
});
</script>
@endsection