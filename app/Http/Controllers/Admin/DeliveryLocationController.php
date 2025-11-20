<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeliveryLocationController extends Controller
{
    public function index()
    {
        $deliveryLocations = DeliveryLocation::orderBy('order', 'asc')->get();
        return view('admin.delivery-locations.index', compact('deliveryLocations'));
    }

    public function create()
    {
        return view('admin.delivery-locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:50',
            'schedule' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pedidosya_url' => 'nullable|url',
            'didifood_url' => 'nullable|url',
            'rappi_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'address', 'phone', 'schedule', 'description', 'pedidosya_url', 'didifood_url', 'rappi_url', 'whatsapp_url', 'order', 'active']);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('delivery-locations')) {
                Storage::disk('public')->makeDirectory('delivery-locations');
            }
            
            $image->storeAs('delivery-locations', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        DeliveryLocation::create($data);

        return redirect()->route('admin.delivery-locations.index')
                        ->with('success', 'Delivery creado exitosamente.');
    }

    public function show(DeliveryLocation $deliveryLocation)
    {
        return view('admin.delivery-locations.show', compact('deliveryLocation'));
    }

    public function edit(DeliveryLocation $deliveryLocation)
    {
        return view('admin.delivery-locations.edit', compact('deliveryLocation'));
    }

    public function update(Request $request, DeliveryLocation $deliveryLocation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:50',
            'schedule' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pedidosya_url' => 'nullable|url',
            'didifood_url' => 'nullable|url',
            'rappi_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'address', 'phone', 'schedule', 'description', 'pedidosya_url', 'didifood_url', 'rappi_url', 'whatsapp_url', 'order', 'active']);

        if ($request->hasFile('image')) {
            if ($deliveryLocation->image && Storage::disk('public')->exists('delivery-locations/' . $deliveryLocation->image)) {
                Storage::disk('public')->delete('delivery-locations/' . $deliveryLocation->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('delivery-locations')) {
                Storage::disk('public')->makeDirectory('delivery-locations');
            }
            
            $image->storeAs('delivery-locations', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        $deliveryLocation->update($data);

        return redirect()->route('admin.delivery-locations.index')
                        ->with('success', 'Delivery actualizado exitosamente.');
    }

    public function destroy(DeliveryLocation $deliveryLocation)
    {
        if ($deliveryLocation->image && Storage::disk('public')->exists('delivery-locations/' . $deliveryLocation->image)) {
            Storage::disk('public')->delete('delivery-locations/' . $deliveryLocation->image);
        }

        $deliveryLocation->delete();

        return redirect()->route('admin.delivery-locations.index')
                        ->with('success', 'Delivery eliminado exitosamente.');
    }

    public function toggle(DeliveryLocation $deliveryLocation)
    {
        $deliveryLocation->update([
            'active' => !$deliveryLocation->active
        ]);

        $status = $deliveryLocation->active ? 'activado' : 'desactivado';
        
        return redirect()->route('admin.delivery-locations.index')
                        ->with('success', "Delivery {$status} exitosamente.");
    }
}
