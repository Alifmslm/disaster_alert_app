<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MitigationNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitigationNoteController extends Controller
{
    public function index(Request $request)
    {
        $query = MitigationNote::query();

        if ($request->filled('disaster_type') && $request->disaster_type !== 'Semua') {
            $query->where('disaster_type', $request->disaster_type);
        }

        $notes = $query->latest()->paginate(15)->withQueryString();

        return view('pages.officer.kelola-data.catatan-penanggulangan', compact('notes'));
    }

    public function create()
    {
        return view('pages.officer.kelola-data.create.catatan-penanggulangan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'disaster_type' => 'required|string',
            'affected_area' => 'required|string|max:255',
            'action_date' => 'required|date',
            'description' => 'required|string',
            'metadata' => 'nullable|array',
        ]);

        $validated['officer_id'] = Auth::id();

        MitigationNote::create($validated);

        return redirect()->route('officer.kelola-data.penanggulangan.index')
            ->with('success', 'Catatan penanggulangan berhasil dibuat.');
    }

    public function show(MitigationNote $penanggulangan)
    {
        return view('pages.officer.kelola-data.detail.catatan-penanggulangan', compact('penanggulangan'));
    }

    public function edit(MitigationNote $penanggulangan)
    {
        return view('pages.officer.kelola-data.update.catatan-penanggulangan', compact('penanggulangan'));
    }

    public function update(Request $request, MitigationNote $penanggulangan)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'disaster_type' => 'required|string',
            'affected_area' => 'required|string|max:255',
            'action_date' => 'required|date',
            'description' => 'required|string',
            'metadata' => 'nullable|array',
        ]);

        $penanggulangan->update($validated);

        return redirect()->route('officer.kelola-data.penanggulangan.index')
            ->with('success', 'Catatan penanggulangan berhasil diperbarui.');
    }

    public function destroy(MitigationNote $penanggulangan)
    {
        $penanggulangan->delete();

        return redirect()->route('officer.kelola-data.penanggulangan.index')
            ->with('success', 'Catatan penanggulangan berhasil dihapus.');
    }
}
