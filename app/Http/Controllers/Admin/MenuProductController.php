<?php
// app/Http/Controllers/Admin/MenuProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuProduct;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuProductController extends Controller
{
    public function index()
    {
        $products = MenuProduct::with('location')
                              ->orderBy('order', 'asc')
                              ->get();
        return view('admin.menu-products.index', compact('products'));
    }

    public function create()
    {
        $locations = Location::active()->ordered()->get();
        return view('admin.menu-products.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location_id' => 'nullable|exists:locations,id',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'description', 'price', 'location_id', 'order', 'active']);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('menu-products')) {
                Storage::disk('public')->makeDirectory('menu-products');
            }
            
            $image->storeAs('menu-products', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        MenuProduct::create($data);

        return redirect()->route('admin.menu-products.index')
                        ->with('success', 'Producto creado exitosamente.');
    }

    public function show(MenuProduct $menuProduct)
    {
        $menuProduct->load('location');
        return view('admin.menu-products.show', compact('menuProduct'));
    }

    public function edit(MenuProduct $menuProduct)
    {
        $locations = Location::active()->ordered()->get();
        return view('admin.menu-products.edit', compact('menuProduct', 'locations'));
    }

    public function update(Request $request, MenuProduct $menuProduct)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location_id' => 'nullable|exists:locations,id',
            'order' => 'nullable|integer|min:0',
            'active' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'description', 'price', 'location_id', 'order', 'active']);

        if ($request->hasFile('image')) {
            if ($menuProduct->image && Storage::disk('public')->exists('menu-products/' . $menuProduct->image)) {
                Storage::disk('public')->delete('menu-products/' . $menuProduct->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            if (!Storage::disk('public')->exists('menu-products')) {
                Storage::disk('public')->makeDirectory('menu-products');
            }
            
            $image->storeAs('menu-products', $imageName, 'public');
            $data['image'] = $imageName;
        }

        $data['order'] = $data['order'] ?? 0;
        $data['active'] = $data['active'] ?? true;

        $menuProduct->update($data);

        return redirect()->route('admin.menu-products.index')
                        ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(MenuProduct $menuProduct)
    {
        if ($menuProduct->image && Storage::disk('public')->exists('menu-products/' . $menuProduct->image)) {
            Storage::disk('public')->delete('menu-products/' . $menuProduct->image);
        }

        $menuProduct->delete();

        return redirect()->route('admin.menu-products.index')
                        ->with('success', 'Producto eliminado exitosamente.');
    }

    public function toggle(MenuProduct $menuProduct)
    {
        $menuProduct->update(['active' => !$menuProduct->active]);
        $status = $menuProduct->active ? 'activado' : 'desactivado';
        
        return redirect()->route('admin.menu-products.index')
                        ->with('success', "Producto {$status} exitosamente.");
    }
}