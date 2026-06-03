<?php

namespace App\Http\Controllers\Web\Officer;

use App\Http\Controllers\Controller;
use App\Models\DisasterReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisasterReportManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = DisasterReport::query();

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('type') && $request->type !== 'Semua') {
            $query->where('type', $request->type);
        }

        $reports = $query->latest()->paginate(15)->withQueryString();

        return view('pages.officer.kelola-data.laporan-bencana', compact('reports'));
    }

    public function create()
    {
        return view('pages.officer.kelola-data.create.laporan-bencana');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'location_name' => 'nullable|string|max:255',
            'occurred_at' => 'required|date',
            'description' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'reporter_name' => 'nullable|string|max:255',
            'status' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();

        DisasterReport::create($validated);

        return redirect()->route('officer.kelola-data.laporan')
            ->with('success', 'Laporan bencana berhasil ditambahkan.');
    }

    public function show(DisasterReport $report)
    {
        $report->load(['attachments', 'user']);
        
        return view('pages.officer.kelola-data.detail.laporan-bencana', compact('report'));
    }

    public function edit(DisasterReport $report)
    {
        return view('pages.officer.kelola-data.update.laporan-bencana', compact('report'));
    }

    public function update(Request $request, DisasterReport $report)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'location_name' => 'nullable|string|max:255',
            'occurred_at' => 'required|date',
            'description' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'reporter_name' => 'nullable|string|max:255',
            'status' => 'required|string',
        ]);

        $report->update($validated);

        return redirect()->route('officer.kelola-data.laporan')
            ->with('success', 'Laporan bencana berhasil diperbarui.');
    }

    public function destroy(DisasterReport $report)
    {
        $report->delete();
        return redirect()->route('officer.kelola-data.laporan')
            ->with('success', 'Laporan bencana berhasil dihapus.');
    }
}