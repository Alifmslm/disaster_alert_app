@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />

<style>
    #routeMap { height: 320px; width: 100%; border-radius: 12px; background: #f8fafc; }
    
    .leaflet-routing-container {
        display: none !important;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">

    {{-- Header --}}
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="{{ route('officer.kelola-data.evakuasi.index') }}" class="hover:text-orange-500 transition-colors">Jalur Evakuasi</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Edit</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Edit Jalur Evakuasi</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui informasi jalur evakuasi yang sudah ada.</p>
        </div>
        <a href="{{ route('officer.kelola-data.evakuasi.index') }}"
            class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- GRID UTAMA: Memisahkan Form Update (Kiri) dan Form Delete (Kanan) --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_300px]">

        {{-- ========================================== --}}
        {{-- KOLOM KIRI: FORM UTAMA (UPDATE) --}}
        {{-- ========================================== --}}
        <form action="{{ route('officer.kelola-data.evakuasi.update', $route) }}" method="POST" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            {{-- Card Informasi Dasar --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-5">
                    <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-orange-500 text-white text-xs font-black">1</div>
                    <h3 class="text-sm font-bold text-slate-700">Informasi Dasar</h3>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Nama Jalur --}}
                    <div class="md:col-span-2">
                        <label for="name" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                            Nama Jalur <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                            value="{{ old('name', $route->name) }}"
                            placeholder="Contoh: Jalur Evakuasi A1 — Cawang"
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 @error('name') border-red-400 bg-red-50 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tipe Bencana --}}
                    <div>
                        <label for="disaster_type" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                            Tipe Bencana <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="disaster_type" name="disaster_type"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 @error('disaster_type') border-red-400 bg-red-50 @enderror">
                                <option value="banjir"        {{ old('disaster_type', $route->disaster_type) === 'banjir'        ? 'selected' : '' }}>Banjir</option>
                                <option value="tanah_longsor" {{ old('disaster_type', $route->disaster_type) === 'tanah_longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                                <option value="kebakaran"     {{ old('disaster_type', $route->disaster_type) === 'kebakaran'     ? 'selected' : '' }}>Kebakaran</option>
                                <option value="gempa"         {{ old('disaster_type', $route->disaster_type) === 'gempa'         ? 'selected' : '' }}>Gempa Bumi</option>
                                <option value="angin_kencang" {{ old('disaster_type', $route->disaster_type) === 'angin_kencang' ? 'selected' : '' }}>Angin Kencang</option>
                                <option value="lainnya"       {{ old('disaster_type', $route->disaster_type) === 'lainnya'       ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                        </div>
                        @error('disaster_type')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="status" name="status"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 @error('status') border-red-400 bg-red-50 @enderror">
                                <option value="active"   {{ old('status', $route->status) === 'active'   ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status', $route->status) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                        </div>
                        @error('status')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Wilayah --}}
                    <div>
                        <label for="area" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                            Wilayah <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                        </label>
                        <input type="text" id="area" name="area"
                            value="{{ old('area', $route->area) }}"
                            placeholder="Contoh: Jakarta Timur"
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 @error('area') border-red-400 bg-red-50 @enderror">
                        @error('area')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jarak --}}
                    <div>
                        <label for="distance_km" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                            Jarak (km) <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                        </label>
                        <input type="number" id="distance_km" name="distance_km"
                            value="{{ old('distance_km', $route->distance_km) }}"
                            step="0.01" min="0" placeholder="Contoh: 3.5"
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 @error('distance_km') border-red-400 bg-red-50 @enderror">
                        @error('distance_km')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-2">
                        <label for="description" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                            Deskripsi <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                        </label>
                        <textarea id="description" name="description" rows="3"
                            placeholder="Keterangan tambahan mengenai jalur evakuasi ini..."
                            class="w-full resize-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 @error('description') border-red-400 bg-red-50 @enderror">{{ old('description', $route->description) }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Card Koordinat & Peta --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-5">
                    <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-orange-500 text-white text-xs font-black">2</div>
                    <h3 class="text-sm font-bold text-slate-700">Koordinat Jalur</h3>
                </div>

                <div class="mb-4 flex flex-wrap gap-2">
                    <button type="button" id="btn-detect-start"
                        class="inline-flex items-center gap-2 rounded-lg border border-orange-200 bg-orange-50 px-3 py-2 text-xs font-bold text-orange-600 transition hover:bg-orange-100">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        Deteksi sebagai Titik Awal
                    </button>
                    <button type="button" id="btn-detect-end"
                        class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-xs font-bold text-blue-600 transition hover:bg-blue-100">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        Deteksi sebagai Titik Akhir
                    </button>
                </div>

                <div id="lokasi-status" class="hidden mb-4 flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-xs shrink-0"></i>
                    <p id="lokasi-status-text" class="text-xs font-bold text-emerald-700"></p>
                </div>

                <div id="routeMap" class="mb-4 z-0 relative"></div>
                <p class="text-[11px] font-semibold text-slate-400 mb-5 text-center">
                    <i class="fa-solid fa-hand-pointer mr-1"></i>
                    Klik kiri di peta = Titik Awal (hijau) &nbsp;·&nbsp; Klik kanan = Titik Akhir (merah)
                </p>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    {{-- Titik Awal --}}
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-4">
                        <p class="mb-3 text-xs font-bold uppercase tracking-wider text-emerald-600">
                            <i class="fa-solid fa-circle-dot mr-1"></i> Titik Awal
                        </p>
                        <div class="flex flex-col gap-3">
                            <div>
                                <label for="start_latitude" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-500">Latitude</label>
                                <input type="number" id="start_latitude" name="start_latitude"
                                    value="{{ old('start_latitude', $route->start_latitude) }}"
                                    step="0.0000001"
                                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-500/10 @error('start_latitude') border-red-400 @enderror">
                            </div>
                            <div>
                                <label for="start_longitude" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-500">Longitude</label>
                                <input type="number" id="start_longitude" name="start_longitude"
                                    value="{{ old('start_longitude', $route->start_longitude) }}"
                                    step="0.0000001"
                                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-500/10 @error('start_longitude') border-red-400 @enderror">
                            </div>
                        </div>
                    </div>

                    {{-- Titik Akhir --}}
                    <div class="rounded-lg border border-red-100 bg-red-50/50 p-4">
                        <p class="mb-3 text-xs font-bold uppercase tracking-wider text-red-500">
                            <i class="fa-solid fa-flag-checkered mr-1"></i> Titik Akhir
                        </p>
                        <div class="flex flex-col gap-3">
                            <div>
                                <label for="end_latitude" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-500">Latitude</label>
                                <input type="number" id="end_latitude" name="end_latitude"
                                    value="{{ old('end_latitude', $route->end_latitude) }}"
                                    step="0.0000001"
                                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-500/10 @error('end_latitude') border-red-400 @enderror">
                            </div>
                            <div>
                                <label for="end_longitude" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-500">Longitude</label>
                                <input type="number" id="end_longitude" name="end_longitude"
                                    value="{{ old('end_longitude', $route->end_longitude) }}"
                                    step="0.0000001"
                                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-500/10 @error('end_longitude') border-red-400 @enderror">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('officer.kelola-data.evakuasi.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-6 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white shadow-sm shadow-orange-500/20 transition hover:bg-orange-600">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>

        {{-- ========================================== --}}
        {{-- KOLOM KANAN: PANDUAN & FORM HAPUS --}}
        {{-- ========================================== --}}
        <div class="flex flex-col gap-4">
            
            <div class="rounded-xl bg-orange-500 p-6 text-white shadow-sm shadow-orange-500/20">
                <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-white/20">
                    <i class="fa-solid fa-route text-white"></i>
                </div>
                <h3 class="mb-2 text-sm font-bold">Panduan Edit</h3>
                <ul class="space-y-2 text-xs font-semibold text-orange-100">
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-dot mt-0.5 shrink-0 text-[10px]"></i> Koordinat lama sudah dimuat di peta.</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-dot mt-0.5 shrink-0 text-[10px]"></i> Klik kiri di peta untuk memindahkan titik awal.</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-dot mt-0.5 shrink-0 text-[10px]"></i> Klik kanan di peta untuk memindahkan titik akhir.</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-dot mt-0.5 shrink-0 text-[10px]"></i> Rute akan otomatis terbentuk mengikuti jalan raya terdekat.</li>
                </ul>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-xs font-bold uppercase tracking-wider text-slate-500">Pratinjau Koordinat</h3>
                <div class="flex flex-col gap-3">
                    <div class="rounded-lg bg-emerald-50 border border-emerald-100 px-3 py-2.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-500 mb-1">Titik Awal</p>
                        <p id="preview-start" class="text-xs font-bold text-slate-600">
                            {{ $route->start_latitude && $route->start_longitude ? number_format($route->start_latitude, 5) . ', ' . number_format($route->start_longitude, 5) : 'Belum ditentukan' }}
                        </p>
                    </div>
                    <div class="rounded-lg bg-red-50 border border-red-100 px-3 py-2.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-red-400 mb-1">Titik Akhir</p>
                        <p id="preview-end" class="text-xs font-bold text-slate-600">
                            {{ $route->end_latitude && $route->end_longitude ? number_format($route->end_latitude, 5) . ', ' . number_format($route->end_longitude, 5) : 'Belum ditentukan' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form Hapus Terpisah (Tidak lagi Nested) --}}
            <div class="rounded-xl border border-red-100 bg-red-50/50 p-6 shadow-sm">
                <h3 class="mb-1 text-xs font-bold uppercase tracking-wider text-red-400">Zona Berbahaya</h3>
                <p class="mb-4 text-xs font-semibold text-slate-500">Tindakan berikut tidak dapat dibatalkan.</p>
                
                <form action="{{ route('officer.kelola-data.evakuasi.destroy', $route) }}" method="POST"
                    onsubmit="return confirm('Hapus jalur evakuasi ini secara permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-bold text-red-600 transition hover:bg-red-600 hover:text-white hover:border-red-600">
                        <i class="fa-solid fa-trash"></i>
                        Hapus Jalur Ini
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

<script>
    // Data koordinat existing dari server
    const existingStart = {
        lat: {{ $route->start_latitude ?? 'null' }},
        lng: {{ $route->start_longitude ?? 'null' }},
    };
    const existingEnd = {
        lat: {{ $route->end_latitude ?? 'null' }},
        lng: {{ $route->end_longitude ?? 'null' }},
    };

    // Tentukan center peta awal
    const centerLat = existingStart.lat ?? -6.2088;
    const centerLng = existingStart.lng ?? 106.8456;

    const map = L.map('routeMap').setView([centerLat, centerLng], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(map);

    let startMarker = null;
    let endMarker   = null;
    let routingControl = null; // Menyimpan instance rute OSRM

    const iconStart = L.divIcon({
        className: 'bg-transparent border-0',
        html: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width:26px;height:36px;filter:drop-shadow(0 3px 4px rgba(0,0,0,0.2))"><path fill="#10b981" stroke="#fff" stroke-width="18" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>`,
        iconSize: [26, 36], iconAnchor: [13, 36], popupAnchor: [0, -38]
    });

    const iconEnd = L.divIcon({
        className: 'bg-transparent border-0',
        html: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width:26px;height:36px;filter:drop-shadow(0 3px 4px rgba(0,0,0,0.2))"><path fill="#ef4444" stroke="#fff" stroke-width="18" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>`,
        iconSize: [26, 36], iconAnchor: [13, 36], popupAnchor: [0, -38]
    });

    function setStartPoint(lat, lng) {
        if (startMarker) map.removeLayer(startMarker);
        startMarker = L.marker([lat, lng], { icon: iconStart }).addTo(map).bindPopup('Titik Awal');
        document.getElementById('start_latitude').value  = lat.toFixed ? lat.toFixed(7) : lat;
        document.getElementById('start_longitude').value = lng.toFixed ? lng.toFixed(7) : lng;
        document.getElementById('preview-start').textContent = parseFloat(lat).toFixed(5) + ', ' + parseFloat(lng).toFixed(5);
        updateLine();
    }

    function setEndPoint(lat, lng) {
        if (endMarker) map.removeLayer(endMarker);
        endMarker = L.marker([lat, lng], { icon: iconEnd }).addTo(map).bindPopup('Titik Akhir');
        document.getElementById('end_latitude').value  = lat.toFixed ? lat.toFixed(7) : lat;
        document.getElementById('end_longitude').value = lng.toFixed ? lng.toFixed(7) : lng;
        document.getElementById('preview-end').textContent = parseFloat(lat).toFixed(5) + ', ' + parseFloat(lng).toFixed(5);
        updateLine();
    }

    // FUNGSI BARU: Menggunakan Leaflet Routing Machine agar jalur mengikuti jalan raya
    function updateLine() {
        // Hapus rute sebelumnya jika ada
        if (routingControl) {
            map.removeControl(routingControl);
        }

        if (startMarker && endMarker) {
            routingControl = L.Routing.control({
                waypoints: [
                    startMarker.getLatLng(),
                    endMarker.getLatLng()
                ],
                lineOptions: {
                    styles: [{ color: '#f97316', opacity: 0.8, weight: 5 }] // Gaya garis rute warna oranye tebal
                },
                addWaypoints: false,
                draggableWaypoints: false,
                fitSelectedRoutes: true,
                show: false, // Menyembunyikan panel instruksi default
                createMarker: function() { return null; } // Mencegah pembuatan marker bawaan plugin agar tidak dobel
            }).addTo(map);

            // Opsional: Hitung jarak rute dan isi otomatis field 'distance_km'
            routingControl.on('routesfound', function(e) {
                var routes = e.routes;
                var summary = routes[0].summary;
                // summary.totalDistance dalam meter, konversi ke KM
                var distanceInKm = (summary.totalDistance / 1000).toFixed(2); 
                document.getElementById('distance_km').value = distanceInKm;
            });
        }
    }

    // Load koordinat existing ke peta saat halaman dimuat
    if (existingStart.lat && existingStart.lng) setStartPoint(existingStart.lat, existingStart.lng);
    if (existingEnd.lat && existingEnd.lng)     setEndPoint(existingEnd.lat, existingEnd.lng);

    // Klik kiri = titik awal
    map.on('click', function (e) { setStartPoint(e.latlng.lat, e.latlng.lng); });

    // Klik kanan = titik akhir
    map.on('contextmenu', function (e) {
        e.originalEvent.preventDefault();
        setEndPoint(e.latlng.lat, e.latlng.lng);
    });

    // Sinkronisasi input manual
    ['start_latitude', 'start_longitude', 'end_latitude', 'end_longitude'].forEach(id => {
        document.getElementById(id).addEventListener('change', function () {
            const sLat = parseFloat(document.getElementById('start_latitude').value);
            const sLng = parseFloat(document.getElementById('start_longitude').value);
            const eLat = parseFloat(document.getElementById('end_latitude').value);
            const eLng = parseFloat(document.getElementById('end_longitude').value);
            if (!isNaN(sLat) && !isNaN(sLng)) setStartPoint(sLat, sLng);
            if (!isNaN(eLat) && !isNaN(eLng)) setEndPoint(eLat, eLng);
        });
    });

    function deteksiLokasi(callback) {
        if (!navigator.geolocation) { alert('Browser Anda tidak mendukung geolocation.'); return; }
        navigator.geolocation.getCurrentPosition(
            pos => callback(pos.coords.latitude, pos.coords.longitude),
            () => alert('Tidak dapat mendeteksi lokasi.')
        );
    }

    document.getElementById('btn-detect-start').addEventListener('click', function () {
        deteksiLokasi((lat, lng) => {
            setStartPoint(lat, lng);
            map.setView([lat, lng], 15);
            const el = document.getElementById('lokasi-status');
            document.getElementById('lokasi-status-text').textContent = `Titik awal diperbarui ke lokasi Anda: ${lat.toFixed(5)}, ${lng.toFixed(5)}`;
            el.classList.remove('hidden');
            el.classList.add('flex');
        });
    });

    document.getElementById('btn-detect-end').addEventListener('click', function () {
        deteksiLokasi((lat, lng) => {
            setEndPoint(lat, lng);
            map.setView([lat, lng], 15);
            const el = document.getElementById('lokasi-status');
            document.getElementById('lokasi-status-text').textContent = `Titik akhir diperbarui ke lokasi Anda: ${lat.toFixed(5)}, ${lng.toFixed(5)}`;
            el.classList.remove('hidden');
            el.classList.add('flex');
        });
    });

    setTimeout(() => map.invalidateSize(), 300);
</script>
@endpush