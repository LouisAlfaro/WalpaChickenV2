<?php

namespace App\Http\Controllers;

use App\Models\CateringClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CateringClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = CateringClient::ordered()->paginate(10);
        return view('admin.catering.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.catering.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('catering/clients', 'public');
        }

        CateringClient::create($data);

        return redirect()->route('admin.catering.clients.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CateringClient $client)
    {
        return view('admin.catering.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CateringClient $client)
    {
        return view('admin.catering.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CateringClient $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($client->logo) {
                Storage::disk('public')->delete($client->logo);
            }
            $data['logo'] = $request->file('logo')->store('catering/clients', 'public');
        }

        $client->update($data);

        return redirect()->route('admin.catering.clients.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CateringClient $client)
    {
        // Delete logo if exists
        if ($client->logo) {
            Storage::disk('public')->delete($client->logo);
        }

        $client->delete();

        return redirect()->route('admin.catering.clients.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}
