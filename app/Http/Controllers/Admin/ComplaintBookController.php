<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplaintBook;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ComplaintBooksExport;

class ComplaintBookController extends Controller
{
    public function index(Request $request)
    {
        $query = ComplaintBook::orderBy('created_at', 'desc');

        // Filtros
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('complaint_number', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $complaints = $query->paginate(20);

        return view('admin.complaint-books.index', compact('complaints'));
    }

    public function show(ComplaintBook $complaintBook)
    {
        return view('admin.complaint-books.show', compact('complaintBook'));
    }

    public function edit(ComplaintBook $complaintBook)
    {
        return view('admin.complaint-books.edit', compact('complaintBook'));
    }

    public function update(Request $request, ComplaintBook $complaintBook)
    {
        $validated = $request->validate([
            'status' => 'required|in:pendiente,en_proceso,resuelto,rechazado',
            'admin_notes' => 'nullable|string'
        ]);

        if ($request->status === 'resuelto' && !$complaintBook->resolved_at) {
            $validated['resolved_at'] = now();
        }

        $complaintBook->update($validated);

        return redirect()->route('admin.complaint-books.index')
                        ->with('success', 'Reclamo actualizado exitosamente.');
    }

    public function destroy(ComplaintBook $complaintBook)
    {
        $complaintBook->delete();

        return redirect()->route('admin.complaint-books.index')
                        ->with('success', 'Reclamo eliminado exitosamente.');
    }

    public function export(Request $request)
    {
        $query = ComplaintBook::query();

        // Aplicar los mismos filtros
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('complaint_number', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $complaints = $query->orderBy('created_at', 'desc')->get();

        return Excel::download(new ComplaintBooksExport($complaints), 'libro-reclamaciones-' . date('Y-m-d') . '.xlsx');
    }
}
