<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\SocialPost;
use App\Models\Favorite;
use App\Models\Location;


class WelcomeController extends Controller
{
    public function index()
    {
        // Usar collect() vacío si no hay sliders para evitar errores
        $mainSliders = collect();
        $promotionSliders = collect();
        $favoriteSliders = collect();
        $socialPosts = collect();
        $favorites = collect();
        $locations = collect();

        // Intentar obtener sliders si la tabla existe
        try {
            $mainSliders = Slider::active()->bySection('main')->ordered()->get();
            $promotionSliders = Slider::active()->bySection('promotions')->ordered()->get();
            $favoriteSliders = Slider::active()->bySection('favorites')->ordered()->get();
            $socialPosts = SocialPost::active()->ordered()->get();
            $favorites = Favorite::where('active', true)->orderBy('order', 'asc')->take(3)->get();
            $locations = Location::where('active', true)->orderBy('order', 'asc')->get();
        } catch (\Exception $e) {
            // Si hay error (tabla no existe), usar colecciones vacías
        }

        return view('home', compact('mainSliders', 'promotionSliders', 'favoriteSliders','socialPosts', 'favorites', 'locations'));
    }
}