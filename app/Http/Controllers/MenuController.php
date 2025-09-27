<?php
// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\MenuProduct;

class MenuController extends Controller
{
    public function index()
    {
        $locations = Location::active()->ordered()->get();
        $products = MenuProduct::active()->with('location')->ordered()->get();
        
        return view('menu', compact('locations', 'products'));
    }
}