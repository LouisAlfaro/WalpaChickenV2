<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintBook;
use Illuminate\Http\Request;

class ComplaintBookController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:reclamo,queja',
            'full_name' => 'required|string|max:255',
            'document_type' => 'required|string',
            'document_number' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'department' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'product_type' => 'required|in:producto,servicio',
            'amount' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'complaint_detail' => 'required|string',
            'request' => 'required|string',
        ]);

        $complaint = ComplaintBook::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Reclamo registrado exitosamente',
            'complaint_number' => $complaint->complaint_number
        ]);
    }
}
