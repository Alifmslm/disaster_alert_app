@extends('layouts.app')

@section('content')
<div class="p-8 bg-[#f8fafc] min-h-screen">
    <!-- Header Profile Card -->
    <div class="bg-white p-8 rounded-4xl border border-slate-100 shadow-sm mb-6 relative overflow-hidden">
        <div class="flex items-center justify-between relative z-10">
            <div class="flex items-center gap-8">
                <!-- Profile Image with Ring & Online Status -->
                <div class="relative">
                    <div class="w-32 h-32 rounded-full ring-4 ring-orange-500/20 p-1">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=fff7ed&color=ff782d" alt="Profile" class="w-full h-full rounded-full object-cover shadow-lg">
                    </div>
                    <div class="absolute bottom-2 right-2 w-6 h-6 bg-emerald-500 border-4 border-white rounded-full"></div>
                </div>
                
                <div>
                    <span class="bg-orange-500 text-white text-[10px] font-black px-3 py-1 rounded-lg uppercase tracking-wider">Masyarakat</span>
                    <h1 class="text-4xl font-bold text-[#0f172a] mt-2">Budi Santoso</h1>
                    <p class="text-slate-400 flex items-center gap-2 mt-1">
                        <i class="fas fa-map-marker-alt"></i>
                        Jakarta Selatan, DKI Jakarta
                    </p>
                </div>
            </div>

            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-6 py-3 bg-slate-50 text-slate-600 font-bold rounded-2xl hover:bg-slate-100 transition-all">
                    <i class="fas fa-share-alt"></i> Bagikan
                </button>
                <button class="flex items-center gap-2 px-6 py-3 bg-orange-500 text-white font-bold rounded-2xl shadow-lg shadow-orange-200 hover:bg-orange-600 transition-all">
                    <i class="fas fa-edit"></i> Ubah Profil
                </button>
            </div>
        </div>
    </div>

    <!-- Main Grid Content -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- Left Side: Info & Table (Span 8) -->
        <div class="col-span-12 lg:col-span-8 space-y-6">
            
            <!-- Contact Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-4xl border border-slate-100 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-slate-400 font-black">Email</p>
                        <p class="text-[#0f172a] font-bold text-lg">budi.santoso@email.com</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-4xl border border-slate-100 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-slate-400 font-black">Nomor Telepon</p>
                        <p class="text-[#0f172a] font-bold text-lg">+62 812 3456 7890</p>
                    </div>
                </div>
            </div>

           <!-- Riwayat Laporan Table Section -->
            <div class="bg-white p-8 rounded-4xl border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-bold text-[#0f172a] border-l-4 border-orange-500 pl-4">Riwayat Laporan</h3>
                    <a href="#" style="color: #ff782d !important; font-weight: 900 !important;" class="text-sm uppercase tracking-tight">Lihat Semua</a>
                </div>

                <div class="-mx-8 overflow-hidden">
                    <table class="w-full border-collapse">
                        <thead class="bg-[#f8fafc]">
                            <tr>
                                <th class="px-8 py-5 text-left text-[#64748B] font-black uppercase tracking-[0.2em] text-[10px] border-b border-slate-100">Tanggal</th>
                                <th class="px-8 py-5 text-left text-[#64748B] font-black uppercase tracking-[0.2em] text-[10px] border-b border-slate-100">Jenis Kejadian</th>
                                <th class="px-8 py-5 text-center text-[#64748B] font-black uppercase tracking-[0.2em] text-[10px] border-b border-slate-100">Status</th>
                                <th class="px-8 py-5 text-right text-[#64748B] font-black uppercase tracking-[0.2em] text-[10px] border-b border-slate-100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 text-slate-500 font-bold border-b border-slate-50 text-sm">12 Okt 2023</td>
                                <td class="px-8 py-6 border-b border-slate-50">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center"><i class="fas fa-fire"></i></div>
                                        <span class="font-bold text-[#0f172a] text-base">Kebakaran Lahan</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center border-b border-slate-50">
                                    <span class="bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">Selesai</span>
                                </td>
                                <td class="px-8 py-6 text-right border-b border-slate-50">
                                    <a href="#" style="color: #ff782d !important; font-weight: 900 !important;" class="text-sm hover:underline">Lihat Detail</a>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 text-slate-500 font-bold border-b border-slate-50 text-sm">08 Okt 2023</td>
                                <td class="px-8 py-6 border-b border-slate-50">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center"><i class="fas fa-water"></i></div>
                                        <span class="font-bold text-[#0f172a] text-base">Genangan Air</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center border-b border-slate-50">
                                    <span class="bg-orange-50 text-orange-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border border-orange-100">Diproses</span>
                                </td>
                                <td class="px-8 py-6 text-right border-b border-slate-50">
                                    <a href="#" style="color: #ff782d !important; font-weight: 900 !important;" class="text-sm hover:underline">Lihat Detail</a>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 text-slate-500 font-bold border-b border-slate-50 text-sm">25 Sep 2023</td>
                                <td class="px-8 py-6 border-b border-slate-50">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center"><i class="fas fa-car-crash"></i></div>
                                        <span class="font-bold text-[#0f172a] text-base">Kecelakaan Lalu Lintas</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center border-b border-slate-50">
                                    <span class="bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">Selesai</span>
                                </td>
                                <td class="px-8 py-6 text-right border-b border-slate-50">
                                    <a href="#" style="color: #ff782d !important; font-weight: 900 !important;" class="text-sm hover:underline">Lihat Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!-- TUTUP BOX RIWAYAT -->

            <!-- Tombol Logout: Sejajar kanan, misah dari kotak -->
            <div class="flex justify-end mt-8">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-8 py-3 border-2 border-[#ff782d] text-[#ff782d] font-black rounded-2xl hover:bg-orange-50 transition-all uppercase tracking-widest text-xs">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div> <!-- Tutup col-span-8 -->

        <!-- Right Side: Sidebar (Span 4) -->
        <div class="col-span-12 lg:col-span-4 space-y-6">
            <div class="bg-white p-8 rounded-4xl border border-slate-100 shadow-sm">
                <h3 class="text-xl font-bold text-[#0f172a] border-l-4 border-orange-500 pl-4 mb-8">Pengaturan & Keamanan</h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between group cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center group-hover:bg-orange-50 group-hover:text-orange-500 transition-all">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div>
                                <p class="font-bold text-[#0f172a]">Preferensi Notifikasi</p>
                                <p class="text-[10px] text-slate-400">Peringatan bencana & laporan</p>
                            </div>
                        </div>
                        <div class="w-11 h-6 bg-orange-500 rounded-full relative">
                            <div class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full shadow-sm"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between group cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center group-hover:bg-orange-50 group-hover:text-orange-500 transition-all">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div>
                                <p class="font-bold text-[#0f172a]">Keamanan Akun</p>
                                <p class="text-[10px] text-slate-400">Password & Biometric</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-center justify-between group cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center group-hover:bg-orange-50 group-hover:text-orange-500 transition-all">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <p class="font-bold text-[#0f172a]">Pengaturan Privasi</p>
                                <p class="text-[10px] text-slate-400">Data lokasi & riwayat</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-slate-300 text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="bg-[#1e293b] p-8 rounded-4xl shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-white mb-2">Butuh Bantuan?</h3>
                    <p class="text-slate-400 text-sm mb-8 leading-relaxed">Hubungi tim respon pusat 24/7 jika Anda mengalami kendala teknis.</p>
                    <button class="w-full py-4 bg-white text-[#1e293b] font-black rounded-2xl shadow-lg hover:bg-slate-50 transition-all uppercase tracking-widest text-xs">
                        Hubungi Sekarang
                    </button>
                </div>
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/5 rounded-full"></div>
            </div>
        </div>
    </div> <!-- Tutup Grid Utama -->

   <!-- Footer Section -->
    <footer class="mt-20 pb-10 border-t border-slate-100 w-full">
        <!-- Baris Menu: Sejajar 3 Item -->
        <div class="flex justify-between items-center px-4 md:px-20 pt-10 mb-12">
            <!-- Item 1 -->
            <a href="#" class="flex items-center gap-3 no-underline">
                <div style="color: #475569 !important; border: 2px solid #475569 !important; border-radius: 4px; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 800;">?</div>
                <span style="color: #475569 !important; font-family: 'Plus Jakarta Sans', sans-serif !important; font-weight: 600; font-size: 14px;">Pusat Bantuan & Tutorial</span>
            </a>
            
            <!-- Item 2 -->
            <a href="#" class="flex items-center gap-3 no-underline">
                <i class="fas fa-address-book text-xl" style="color: #475569 !important;"></i>
                <span style="color: #475569 !important; font-family: 'Plus Jakarta Sans', sans-serif !important; font-weight: 600; font-size: 14px;">Kontak Darurat Pusat</span>
            </a>

            <!-- Item 3: Kebijakan Privasi -->
            <a href="#" class="flex items-center gap-3 no-underline">
                <i class="fas fa-shield-alt text-xl" style="color: #475569 !important;"></i>
                <span style="color: #475569 !important; font-family: 'Plus Jakarta Sans', sans-serif !important; font-weight: 600; font-size: 14px;">Kebijakan Privasi</span>
            </a>
        </div>

        <!-- Baris Copyright -->
        <div class="text-center w-full overflow-hidden">
            <div class="flex items-center justify-center gap-2 whitespace-nowrap">
                <span style="color: #94a3b8 !important; font-weight: 700; letter-spacing: 0.1em; font-size: 9px; text-transform: uppercase;">
                    © 2024 SENTINEL PUBLIC SAFETY COMMAND. HIGH-PRIORITY SYSTEM. | |
                </span>
                
                    TERMS OF SERVICE
                </a>
            </div>
        </div>
    </footer>
</div>
@endsection