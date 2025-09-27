<?php

namespace App\Http\Controllers;

use App\Models\OpportunityContent;
use App\Models\OpportunityBenefit;
use App\Models\OpportunityApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OpportunityFrontendController extends Controller
{
    public function index()
    {
        $contents = OpportunityContent::active()->get()->keyBy('type');
        $benefits = OpportunityBenefit::active()->ordered()->get();
        
        return view('opportunities', compact('contents', 'benefits'));
    }

    public function apply(Request $request, $type)
    {
        $validTypes = ['comercial', 'proveedores', 'trabajo'];
        
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ];

        if ($type === 'trabajo') {
            $rules['position'] = 'required|string|max:255';
            $rules['experience'] = 'nullable|string|max:500';
            $rules['attachment'] = 'nullable|file|mimes:pdf,doc,docx|max:2048';
        } elseif ($type === 'comercial') {
            $rules['company'] = 'required|string|max:255';
            $rules['business_type'] = 'required|string|max:255';
        } elseif ($type === 'proveedores') {
            $rules['company'] = 'required|string|max:255';
            $rules['products_services'] = 'required|string|max:500';
        }

        $validated = $request->validate($rules);
        
        $applicationData = [
            'type' => $type,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
            'status' => 'pending'
        ];

        if ($type === 'trabajo') {
            $applicationData['position'] = $validated['position'] ?? null;
            $applicationData['experience'] = $validated['experience'] ?? null;
        } elseif (in_array($type, ['comercial', 'proveedores'])) {
            $applicationData['company'] = $validated['company'] ?? null;
            
            if ($type === 'comercial') {
                $applicationData['business_type'] = $validated['business_type'] ?? null;
            } else {
                $applicationData['products_services'] = $validated['products_services'] ?? null;
            }
        }

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('opportunities/attachments')) {
                Storage::disk('public')->makeDirectory('opportunities/attachments');
            }
            
            $file->storeAs('opportunities/attachments', $fileName, 'public');
            $applicationData['attachment'] = $fileName;
        }

        OpportunityApplication::create($applicationData);

        return redirect()->back()->with('success', 'Tu solicitud ha sido enviada exitosamente! Nos pondremos en contacto contigo pronto.');
    }
}