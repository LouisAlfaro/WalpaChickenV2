<?php

namespace App\Http\Controllers;

use App\Models\PromotionalLocation;
use Illuminate\Http\Request;

class PromotionalLocationsController extends Controller
{
    public function index()
    {
        $promotionalLocations = PromotionalLocation::active()->ordered()->get();
        
        return view('promotional-locations.index', compact('promotionalLocations'));
    }
}
