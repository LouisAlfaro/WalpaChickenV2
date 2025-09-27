<?php
// app/Http/Controllers/Admin/AnalyticsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageView;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        $stats = [
            'today' => $this->getTodayStats(),
            'week' => $this->getWeekStats(),
            'month' => $this->getMonthStats(),
            'popular_pages' => $this->getPopularPages(),
            'chart_data' => $this->getChartData()
        ];
        
        return view('admin.analytics.index', compact('stats'));
    }
    
    private function getTodayStats()
    {
        return PageView::where('viewed_at', '>=', now()->startOfDay())
                      ->selectRaw('section, COUNT(*) as views')
                      ->groupBy('section')
                      ->get()
                      ->keyBy('section');
    }
    
    private function getWeekStats()
    {
        return PageView::where('viewed_at', '>=', now()->startOfWeek())
                      ->selectRaw('section, COUNT(*) as views')
                      ->groupBy('section')
                      ->get()
                      ->keyBy('section');
    }
    
    private function getMonthStats()
    {
        return PageView::where('viewed_at', '>=', now()->startOfMonth())
                      ->selectRaw('section, COUNT(*) as views')
                      ->groupBy('section')
                      ->get()
                      ->keyBy('section');
    }
    
    private function getPopularPages()
    {
        return PageView::where('viewed_at', '>=', now()->subDays(30))
                      ->selectRaw('section, COUNT(*) as views')
                      ->groupBy('section')
                      ->orderBy('views', 'desc')
                      ->limit(10)
                      ->get();
    }
    
    private function getChartData()
    {
        $days = [];
        $views = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $days[] = $date->format('M d');
            $views[] = PageView::whereDate('viewed_at', $date)->count();
        }
        
        return compact('days', 'views');
    }
}