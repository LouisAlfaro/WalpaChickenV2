<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function edit()
    {
        // Siempre usaremos el primer registro
        $contact = ContactInfo::first();

        // Si no existe, lo creamos vacío para no romper la vista
        if (!$contact) {
            $contact = ContactInfo::create([]);
        }

        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'     => 'nullable|string|max:255',
            'schedule'  => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:255',
            'email'     => 'nullable|email|max:255',
            'address'   => 'nullable|string|max:255',
            'facebook'  => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'tiktok'    => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
        ]);

        $contact = ContactInfo::first();

        if ($contact) {
            $contact->update($request->all());
        } else {
            $contact = ContactInfo::create($request->all());
        }

        return redirect()
            ->route('admin.contact.edit')
            ->with('success', 'Información de contacto actualizada correctamente.');
    }
}
