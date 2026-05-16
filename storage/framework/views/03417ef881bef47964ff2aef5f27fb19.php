

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-white p-6 text-slate-800">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Profil Pengguna</h1>
        <p class="text-slate-500 text-sm">Kelola informasi pribadi, riwayat laporan, dan keamanan akun Sentinel Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="card-sentinel-light p-0 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-orange-400 p-8 text-center text-white relative">
                    <div class="w-24 h-24 bg-white/30 rounded-full mx-auto mb-4 border-4 border-white/50 flex items-center justify-center">
                        <i class="fa-solid fa-user text-4xl text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold">Andi Pratama <i class="fa-solid fa-circle-check text-white/70 text-sm ml-1"></i></h2>
                    <p class="text-white/80 text-xs font-medium uppercase tracking-widest mt-1">Masyarakat Umum • ID SENTINEL: SNT-M-00123</p>
                </div>
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" value="Andi Pratama" class="form-input-sentinel" placeholder="Andi Pratama">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nomor NIK (Sesuai KTP)</label>
                        <input type="text" value="3271231234567890" class="form-input-sentinel" placeholder="NIK">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Email Utama</label>
                        <input type="email" value="andi.pratama@email.com" class="form-input-sentinel" placeholder="email@contoh.com">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">No. Telepon / WhatsApp</label>
                        <input type="text" value="081234567890" class="form-input-sentinel" placeholder="08xxxx">
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <button class="btn-orange-sentinel">Simpan Perubahan</button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card-sentinel-light p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Riwayat Laporan Anda</h3>
                        <span class="px-3 py-1 bg-slate-100 text-[10px] font-bold rounded-lg text-slate-600 uppercase border border-slate-200">Total: 12</span>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Banjir Luapan Citarum</p>
                                <p class="text-[10px] text-slate-500">12 Feb 2026</p>
                            </div>
                            <span class="badge-status-sentinel bg-green-100 text-green-700 border-green-200">SELESAI</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Pohon Tumbang Jl. Sudirman</p>
                                <p class="text-[10px] text-slate-500">10 Feb 2026</p>
                            </div>
                            <span class="badge-status-sentinel bg-orange-100 text-orange-700 border-orange-200">PROSES</span>
                        </div>
                    </div>
                    <button class="mt-4 text-xs font-bold text-orange-600 hover:underline flex items-center">
                        Lihat Semua Laporan <i class="fa-solid fa-arrow-right ml-1"></i>
                    </button>
                </div>

                <div class="card-sentinel-light p-6">
                    <h3 class="text-lg font-bold mb-4">Preferensi Notifikasi & Keamanan</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <span class="text-sm font-medium">Notifikasi Gempa (Radius 5km)</span>
                            <div class="toggle-sentinel-orange"></div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <span class="text-sm font-medium">Autentikasi 2FA (WhatsApp)</span>
                            <div class="toggle-sentinel-orange"></div>
                        </div>
                        <button class="w-full btn-outline-slate text-xs font-bold flex items-center justify-center p-2.5">
                            <i class="fa-solid fa-key mr-2"></i> Ganti Password Akun
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="card-sentinel-light p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mr-3 border border-orange-200">
                        <i class="fa-solid fa-headset text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold">Bantuan & Dukungan</h3>
                        <p class="text-slate-500 text-xs">Butuh panduan? Tim IT Sentinel siap membantu Anda.</p>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <button class="menu-item-light-sentinel">
                        <div class="flex items-center">
                            <i class="fa-solid fa-book-open w-5 text-orange-500 mr-2"></i>
                            <span class="text-sm font-medium">Panduan Aplikasi (Masyarakat)</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-300 text-xs"></i>
                    </button>
                    <button class="menu-item-light-sentinel">
                        <div class="flex items-center">
                            <i class="fa-solid fa-comment-dots w-5 text-orange-500 mr-2"></i>
                            <span class="text-sm font-medium">Hubungi Admin Sentinel</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-300 text-xs"></i>
                    </button>
                </div>
            </div>

            <div class="card-sentinel-light p-4">
                <button class="w-full p-4 bg-red-600 text-white rounded-xl font-extrabold uppercase text-xs tracking-widest hover:bg-red-700 transition-all flex items-center justify-center">
                    <i class="fa-solid fa-right-from-bracket mr-2 text-lg"></i> Logout dari Akun
                </button>
            </div>
        </div>

    </div>

    <div class="mt-12 py-4 border-t border-slate-200 text-center text-slate-400">
        <p class="text-[9px] font-bold uppercase tracking-widest">© 2024 SENTINEL PUBLIC SAFETY COMMAND • HIGH-PRIORITY SYSTEM | TERMS OF SERVICE</p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\disaster_alert_app\resources\views/pages/user/profile.blade.php ENDPATH**/ ?>