@extends('pages.officer.kelola-data.manage-data', ['activeTab' => 'laporan'])

@section('tab_content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 py-5 px-6">
    <form method="GET" action="{{ route('officer.kelola-data.laporan') }}" class="flex flex-col md:flex-row md:items-center gap-3 w-full lg:w-auto">
        <span class="text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Filter by:</span>
        <select name="status" onchange="this.form.submit()" class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 transition-all">
            <option value="Semua">Status (Semua)</option>
            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Kritis</option>
            <option value="handled" {{ request('status') == 'handled' ? 'selected' : '' }}>Terkendali</option>
        </select>
        <select name="type" onchange="this.form.submit()" class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 transition-all">
            <option value="Semua">Tipe Bencana (Semua)</option>
            <option value="banjir" {{ request('type') == 'banjir' ? 'selected' : '' }}>Banjir</option>
            <option value="tanah_longsor" {{ request('type') == 'tanah_longsor' ? 'selected' : '' }}>Tanah Longsor</option>
        </select>
    </form>
    
    <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto">
        <a href="{{ route('officer.kelola-data.laporan.create') }}" class="bg-[#FF7F3E] hover:bg-[#e66a2e] text-white py-2 px-4 rounded-lg text-[11px] font-black uppercase tracking-wide transition-all shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Data
        </a>
    </div>
</div>

<div class="overflow-x-auto w-full">
    <table class="w-full min-w-[860px] border-collapse">
        <thead class="bg-slate-100">
            <tr>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Tipe Bencana</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Lokasi</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Status</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Pelapor</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-900 font-black text-[13px]">{{ strtoupper(str_replace('_', ' ', $report->type)) }}</td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px]">{{ $report->location_name }}</td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-[13px]">
                    <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase bg-slate-100">{{ $report->status }}</span>
                </td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px]">{{ $report->reporter_name }}</td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-[13px]">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('officer.kelola-data.laporan.edit', $report) }}" class="border border-slate-200 rounded bg-white text-slate-700 py-2 px-3 text-[10px] font-black hover:border-orange-400 transition-colors">EDIT</a>
                        
                        <a href="{{ route('officer.kelola-data.laporan.show', $report->id) }}" class="rounded bg-slate-900 text-white py-2 px-3 text-[10px] font-black hover:bg-slate-700 transition-colors">DETAIL</a>
                        
                        <form action="{{ route('officer.kelola-data.laporan.destroy', $report) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-[10px] font-black uppercase">HAPUS</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection