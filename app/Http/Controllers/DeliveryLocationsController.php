<?php

namespace App\Http\Controllers;

use App\Models\DeliveryLocation;
use Illuminate\Http\Request;

class DeliveryLocationsController extends Controller
{
    public function index()
    {
        $deliveryLocations = DeliveryLocation::active()->ordered()->get();
        
        return view('delivery-locations.index', compact('deliveryLocations'));
    }
}
