<?php
// app/Http/Controllers/Admin/DeliveryPlatformController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeliveryPlatformController extends Controller
{
    public function index()
    {
        $platforms = DeliveryPlatform::orderBy('order')->paginate(10);
        return view('admin.delivery-platforms.index', compact('platforms'));
    }

    public function create()
    {
        return view('admin.delivery-platforms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('delivery-platforms', 'public');
        }

        DeliveryPlatform::create($data);

        return redirect()->route('admin.delivery-platforms.index')
                        ->with('success', 'Plataforma de delivery creada exitosamente.');
    }

    public function edit(DeliveryPlatform $deliveryPlatform)
    {
        return view('admin.delivery-platforms.edit', compact('deliveryPlatform'));
    }

    public function update(Request $request, DeliveryPlatform $deliveryPlatform)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($deliveryPlatform->image) {
                Storage::disk('public')->delete($deliveryPlatform->image);
            }
            $data['image'] = $request->file('image')->store('delivery-platforms', 'public');
        }

        $deliveryPlatform->update($data);

        return redirect()->route('admin.delivery-platforms.index')
                        ->with('success', 'Plataforma actualizada exitosamente.');
    }

    public function destroy(DeliveryPlatform $deliveryPlatform)
    {
        if ($deliveryPlatform->image) {
            Storage::disk('public')->delete($deliveryPlatform->image);
        }

        $deliveryPlatform->delete();

        return redirect()->route('admin.delivery-platforms.index')
                        ->with('success', 'Plataforma eliminada exitosamente.');
    }

    public function toggle(DeliveryPlatform $deliveryPlatform)
    {
        $deliveryPlatform->update(['is_active' => !$deliveryPlatform->is_active]);
        return back()->with('success', 'Estado actualizado.');
    }
}