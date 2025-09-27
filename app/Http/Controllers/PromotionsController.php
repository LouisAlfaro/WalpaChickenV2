<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionsController extends Controller
{
    public function index()
    {
        $promotions = Promotion::active()
                              ->current()
                              ->ordered()
                              ->get();
        
        return view('promotions', compact('promotions'));
    }
}