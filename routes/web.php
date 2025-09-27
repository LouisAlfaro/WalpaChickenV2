<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialPostController;
use App\Http\Controllers\Admin\FavoriteController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\LocationsPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\MenuProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\Admin\CompanySectionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CateringController;
use App\Http\Controllers\CateringClientController;
use App\Http\Controllers\Admin\OpportunityController;
use App\Http\Controllers\OpportunityFrontendController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\Admin\PromotionalPopupController;
use App\Http\Controllers\Admin\DeliveryPlatformController;




// Ruta principal (página de inicio pública)
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/locales', [LocationsPageController::class, 'index'])->name('locations');
Route::get('/carta', [MenuController::class, 'index'])->name('menu');
Route::get('/promociones', [PromotionsController::class, 'index'])->name('promotions');
Route::get('/empresa', [CompanyController::class, 'index'])->name('company');
Route::get('/catering', [CateringController::class, 'index'])->name('catering');
Route::post('/catering/request', [CateringController::class, 'storeCateringRequest'])->name('catering.request');
Route::post('/catering/reservation', [CateringController::class, 'storeReservation'])->name('catering.reservation');
Route::prefix('oportunidades')->name('opportunities.')->group(function () {
    Route::get('/', [OpportunityFrontendController::class, 'index'])->name('index');
    Route::post('/{type}/apply', [OpportunityFrontendController::class, 'apply'])->name('apply');
});
Route::get('/api/popup/active', [PopupController::class, 'getActivePopup']);
// Rutas de autenticación existentes de Laravel
Auth::routes();

// Dashboard para usuarios normales
Route::get('/home', function() {
    return redirect('/admin'); // Cambiar a admin directamente
});

// Redirigir /admin/login a /login
Route::get('/admin/login', function() {
    return redirect('/login');
});

// Rutas de administración
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('sliders', SliderController::class);
    Route::resource('social-posts', SocialPostController::class);
    Route::resource('favorites', FavoriteController::class);
    Route::patch('favorites/{favorite}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::resource('locations', LocationController::class);
    Route::patch('locations/{location}/toggle', [LocationController::class, 'toggle'])->name('locations.toggle');
    Route::resource('menu-products', MenuProductController::class);
    Route::patch('menu-products/{menu_product}/toggle', [MenuProductController::class, 'toggle'])->name('menu-products.toggle');
    Route::resource('promotions', PromotionController::class);
    Route::patch('promotions/{promotion}/toggle', [PromotionController::class, 'toggle'])->name('promotions.toggle');
    Route::resource('company-sections', CompanySectionController::class);
    Route::patch('company-sections/{company_section}/toggle', [CompanySectionController::class, 'toggle'])->name('company-sections.toggle');

    Route::prefix('catering')->name('catering.')->group(function () {
    Route::get('/', [CateringController::class, 'index'])->name('index');
    Route::get('/info/edit', [CateringController::class, 'editInfo'])->name('edit-info');
    Route::put('/info', [CateringController::class, 'updateInfo'])->name('update-info');
    
    Route::get('/packages', [CateringController::class, 'packages'])->name('packages');
    Route::get('/packages/create', [CateringController::class, 'createPackage'])->name('packages.create');
    Route::post('/packages', [CateringController::class, 'storePackage'])->name('packages.store');
    Route::get('/packages/{package}/edit', [CateringController::class, 'editPackage'])->name('packages.edit');
    Route::put('/packages/{package}', [CateringController::class, 'updatePackage'])->name('packages.update');
    Route::delete('/packages/{package}', [CateringController::class, 'destroyPackage'])->name('packages.destroy');
    Route::patch('/packages/{package}/toggle', [CateringController::class, 'togglePackage'])->name('packages.toggle');
    
    Route::resource('clients', CateringClientController::class);
    
    Route::get('/requests', [CateringController::class, 'requests'])->name('requests');
    Route::get('/requests/{request}', [CateringController::class, 'showRequest'])->name('requests.show');
    Route::patch('/requests/{request}/status', [CateringController::class, 'updateRequestStatus'])->name('requests.update-status');
    Route::delete('/requests/{request}', [CateringController::class, 'destroyRequest'])->name('requests.destroy');
    Route::get('/export', [CateringController::class, 'exportRequests'])->name('export');
    });

    Route::prefix('opportunities')->name('opportunities.')->group(function () {
    Route::get('/', [OpportunityController::class, 'index'])->name('index');
    
    // Contenido
    Route::get('/content/{type}/edit', [OpportunityController::class, 'editContent'])->name('content.edit');
    Route::put('/content/{type}', [OpportunityController::class, 'updateContent'])->name('content.update');
    
    // Beneficios
    Route::get('/benefits', [OpportunityController::class, 'benefits'])->name('benefits');
    Route::get('/benefits/create', [OpportunityController::class, 'createBenefit'])->name('benefits.create');
    Route::post('/benefits', [OpportunityController::class, 'storeBenefit'])->name('benefits.store');
    Route::get('/benefits/{benefit}/edit', [OpportunityController::class, 'editBenefit'])->name('benefits.edit');
    Route::put('/benefits/{benefit}', [OpportunityController::class, 'updateBenefit'])->name('benefits.update');
    Route::delete('/benefits/{benefit}', [OpportunityController::class, 'destroyBenefit'])->name('benefits.destroy');
    Route::patch('/benefits/{benefit}/toggle', [OpportunityController::class, 'toggleBenefit'])->name('benefits.toggle');
    
    // Solicitudes
    Route::get('/applications', [OpportunityController::class, 'applications'])->name('applications');
    Route::get('/applications/{application}', [OpportunityController::class, 'showApplication'])->name('applications.show');
    Route::patch('/applications/{application}/status', [OpportunityController::class, 'updateApplicationStatus'])->name('applications.update-status');
    Route::delete('/applications/{application}', [OpportunityController::class, 'destroyApplication'])->name('applications.destroy');
    
    // Exportar
    Route::get('/export', [OpportunityController::class, 'exportApplications'])->name('export');
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [OpportunityController::class, 'reportsIndex'])->name('index');
        Route::get('/analytics', [OpportunityController::class, 'reportsAnalytics'])->name('analytics');
        Route::get('/comercial', [OpportunityController::class, 'reportsComercial'])->name('comercial');
        Route::get('/edit-content', [OpportunityController::class, 'reportsEditContent'])->name('edit-content');
        Route::put('/update-content', [OpportunityController::class, 'reportsUpdateContent'])->name('update-content');
    });
    });
    
    Route::get('/contact', [ContactInfoController::class, 'edit'])->name('contact.edit');
    Route::put('/contact', [ContactInfoController::class, 'update'])->name('contact.update');
    Route::resource('promotional-popups', PromotionalPopupController::class);
    Route::patch('promotional-popups/{promotionalPopup}/toggle', [PromotionalPopupController::class, 'toggle'])->name('promotional-popups.toggle');
    Route::get('/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/social-widget', [App\Http\Controllers\Admin\SocialWidgetController::class, 'edit'])->name('social-widget.edit');
    Route::put('/social-widget', [App\Http\Controllers\Admin\SocialWidgetController::class, 'update'])->name('social-widget.update');
    Route::resource('delivery-platforms', DeliveryPlatformController::class);
    Route::patch('delivery-platforms/{deliveryPlatform}/toggle', [DeliveryPlatformController::class, 'toggle'])->name('delivery-platforms.toggle');
});