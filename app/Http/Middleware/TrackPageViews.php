<?php
// app/Http/Middleware/TrackPageViews.php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;
use Illuminate\Http\Request;

class TrackPageViews
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Solo trackear páginas públicas exitosas
        if ($response->getStatusCode() === 200 && !$request->is('admin/*')) {
            $this->recordPageView($request);
        }
        
        return $response;
    }
    
    private function recordPageView($request)
    {
        $route = $request->route();
        $pageName = null;
        $section = null;
        
        // Intentar obtener el nombre de la ruta primero
        if ($route && $route->getName()) {
            $pageName = $route->getName();
            $section = $this->getSection($pageName);
        } else {
            // Si no hay nombre de ruta, usar la URL path como fallback
            $path = $request->path();
            $pageName = $path === '/' ? 'home' : $path;
            $section = $this->getSectionFromPath($path);
        }
        
        // Grabar la vista si tenemos al menos un identificador de página
        if ($pageName) {
            PageView::recordView($pageName, $section);
        }
    }
    
    private function getSection($routeName)
    {
        $sections = [
            'home' => 'Inicio',
            'menu' => 'Nuestra Carta',
            'promotions' => 'Promociones',
            'catering' => 'Catering',
            'locations' => 'Locales',
            'opportunities.index' => 'Oportunidades',
            'company' => 'Empresa'
        ];
        
        return $sections[$routeName] ?? 'Otros';
    }
    
    private function getSectionFromPath($path)
    {
        // Identificar sección basada en la URL path
        if ($path === '/' || $path === 'home') {
            return 'Inicio';
        } elseif (str_contains($path, 'menu') || str_contains($path, 'carta')) {
            return 'Nuestra Carta';
        } elseif (str_contains($path, 'promotions') || str_contains($path, 'promociones')) {
            return 'Promociones';
        } elseif (str_contains($path, 'catering')) {
            return 'Catering';
        } elseif (str_contains($path, 'locations') || str_contains($path, 'locales')) {
            return 'Locales';
        } elseif (str_contains($path, 'opportunities') || str_contains($path, 'oportunidades')) {
            return 'Oportunidades';
        } elseif (str_contains($path, 'company') || str_contains($path, 'empresa')) {
            return 'Empresa';
        } elseif (str_contains($path, 'popup')) {
            return 'Popup';
        } elseif (str_contains($path, 'api')) {
            return 'API';
        } else {
            return 'Otros';
        }
    }
}