<?php
// app/Models/PageView.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PageView extends Model
{
    protected $fillable = ['page', 'section', 'ip_address', 'user_agent', 'viewed_at'];
    
    protected $casts = [
        'viewed_at' => 'datetime'
    ];

    public static function recordView($page, $section = null)
    {
        // Siempre intentar grabar la vista, incluso si page es null
        // (para casos extremos donde no podemos identificar la página)
        $ipAddress = request()->ip() ?? 'unknown';
        $userAgent = request()->userAgent() ?? 'unknown';
        
        // Evitar contar múltiples vistas de la misma IP y página en 1 hora
        $query = self::where('ip_address', $ipAddress)
                    ->where('viewed_at', '>', now()->subHour());
        
        // Si tenemos página, incluirla en la verificación
        if ($page) {
            $query->where('page', $page);
        }
        
        // Si tenemos sección, incluirla en la verificación
        if ($section) {
            $query->where('section', $section);
        }
        
        $recentView = $query->first();
        
        if (!$recentView) {
            try {
                self::create([
                    'page' => $page,
                    'section' => $section,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'viewed_at' => now()
                ]);
            } catch (\Exception $e) {
                // Log el error pero no romper la aplicación
                \Log::error('Error recording page view: ' . $e->getMessage(), [
                    'page' => $page,
                    'section' => $section,
                    'ip' => $ipAddress
                ]);
            }
        }
    }

    public static function getStats($period = 30)
    {
        $startDate = now()->subDays($period);
        
        return self::where('viewed_at', '>=', $startDate)
                  ->selectRaw('page, section, COUNT(*) as views')
                  ->groupBy('page', 'section')
                  ->orderBy('views', 'desc')
                  ->get();
    }
}