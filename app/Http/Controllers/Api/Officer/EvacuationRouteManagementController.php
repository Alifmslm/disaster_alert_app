<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Officer\StoreEvacuationRouteRequest;
use App\Models\EvacuationRoute;
use Illuminate\Http\Request;

class EvacuationRouteManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = EvacuationRoute::query();

        // Filter status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Filter tipe bencana
        if ($request->filled('disaster_type') && $request->disaster_type !== 'semua') {
            $query->where('disaster_type', $request->disaster_type);
        }

        // Filter area/wilayah
        if ($request->filled('area') && $request->area !== 'semua') {
            $query->where('area', $request->area);
        }

        $routes = $query->latest()->paginate(15)->withQueryString();

        return view('pages.officer.kelola-data.jalur-evakuasi', compact('routes'));
    }

    /**
     * Tampilkan form tambah jalur evakuasi.
     */
    public function create()
    {
        return view('pages.officer.kelola-data.create.jalur-evakuasi');
    }

    /**
     * Simpan jalur evakuasi baru ke database.
     */
    public function store(StoreEvacuationRouteRequest $request)
    {
        EvacuationRoute::create($request->validated());

        return redirect()
            ->route('officer.kelola-data.evakuasi.index')
            ->with('success', 'Jalur evakuasi berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail jalur evakuasi.
     */
    public function show(EvacuationRoute $route)
    {
        return view('pages.officer.kelola-data.show.jalur-evakuasi', compact('route'));
    }

    /**
     * Tampilkan form edit jalur evakuasi.
     */
    public function edit(EvacuationRoute $route)
    {
        return view('pages.officer.kelola-data.update.jalur-evakuasi', compact('route'));
    }

    /**
     * Perbarui data jalur evakuasi di database.
     */
    public function update(StoreEvacuationRouteRequest $request, EvacuationRoute $route)
    {
        $route->update($request->validated());

        return redirect()
            ->route('officer.kelola-data.evakuasi.index')
            ->with('success', 'Jalur evakuasi berhasil diperbarui.');
    }

    /**
     * Hapus jalur evakuasi dari database.
     */
    public function destroy(EvacuationRoute $route)
    {
        $route->delete();

        return redirect()
            ->route('officer.kelola-data.evakuasi.index')
            ->with('success', 'Jalur evakuasi berhasil dihapus.');
    }
}