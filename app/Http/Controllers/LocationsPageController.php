<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationsPageController extends Controller
{
    public function index()
    {
        $locations = Location::active()->ordered()->get();
        return view('locations', compact('locations'));
    }
}