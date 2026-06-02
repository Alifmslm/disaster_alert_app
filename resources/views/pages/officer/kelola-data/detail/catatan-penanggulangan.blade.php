@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="{{ route('officer.kelola-data.penanggulangan.index') }}" class="hover:text-orange-500 transition-colors">Catatan Penanggulangan</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Detail Catatan</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Detail Data Penanggulangan</h2>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('officer.kelola-data.penanggulangan.edit', $penanggulangan->id) }}" class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">
                Edit Data
            </a>
            <a href="{{ route('officer.kelola-data.penanggulangan.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
                Kembali
            </a>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="mb-6 text-sm font-black uppercase tracking-wider text-slate-800 border-b border-slate-100 pb-4">Informasi Penanggulangan</h3>
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="md:col-span-2">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Judul Catatan</p>
                <p class="text-sm font-bold text-slate-800 mt-1">{{ $penanggulangan->title }}</p>
            </div>

            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Tipe Bencana</p>
                <p class="text-sm font-bold text-slate-800 mt-1 uppercase">{{ str_replace('_', ' ', $penanggulangan->disaster_type) }}</p>
            </div>

            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Tanggal Tindakan</p>
                <p class="text-sm font-bold text-slate-800 mt-1">{{ \Carbon\Carbon::parse($penanggulangan->action_date)->format('d F Y') }}</p>
            </div>

            <div class="md:col-span-2">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Area Terdampak</p>
                <p class="text-sm font-bold text-slate-800 mt-1">{{ $penanggulangan->affected_area }}</p>
            </div>

            <div class="md:col-span-2">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Deskripsi Penanggulangan</p>
                <div class="mt-2 rounded-lg border border-slate-100 bg-slate-50 p-4 text-sm font-medium text-slate-700 whitespace-pre-wrap">{{ $penanggulangan->description }}</div>
            </div>
        </div>
    </div>
</div>
@endsection