<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySection;

class CompanyController extends Controller
{
    public function index()
    {
        $sections = CompanySection::active()
                                  ->ordered()
                                  ->get();
        
        // Separar por tipos para mejor organización
        $mission = $sections->where('type', 'mission')->first();
        $vision = $sections->where('type', 'vision')->first();
        $values = $sections->where('type', 'values')->first();
        $history = $sections->where('type', 'history')->first();
        $team = $sections->where('type', 'team')->first();
        $objectives = $sections->where('type', 'objectives')->first();
        
        return view('company', compact(
            'sections',
            'mission', 
            'vision', 
            'values', 
            'history', 
            'team', 
            'objectives'
        ));
    }
}