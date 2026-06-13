

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<style>
    #routeMap { height: 320px; width: 100%; border-radius: 12px; background: #f8fafc; }
    .leaflet-routing-container { display: none !important; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">

    
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="<?php echo e(route('officer.kelola-data.evakuasi.index')); ?>" class="hover:text-orange-500 transition-colors">Jalur Evakuasi</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Tambah Data</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Tambah Jalur Evakuasi</h2>
            <p class="text-sm text-slate-500 mt-1">Tambahkan data jalur evakuasi baru yang dapat digunakan saat bencana terjadi.</p>
        </div>
        <a href="<?php echo e(route('officer.kelola-data.evakuasi.index')); ?>"
            class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <form action="<?php echo e(route('officer.kelola-data.evakuasi.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_300px]">

            
            <div class="flex flex-col gap-6">

                
                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-orange-500 text-white text-xs font-black">1</div>
                        <h3 class="text-sm font-bold text-slate-700">Informasi Dasar</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        
                        <div class="md:col-span-2">
                            <label for="name" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                Nama Jalur <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>"
                                placeholder="Contoh: Jalur Evakuasi A1 — Cawang"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div>
                            <label for="disaster_type" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                Tipe Bencana <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="disaster_type" name="disaster_type"
                                    class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['disaster_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="" disabled <?php echo e(old('disaster_type') ? '' : 'selected'); ?>>Pilih tipe bencana</option>
                                    <option value="banjir"        <?php echo e(old('disaster_type') === 'banjir'        ? 'selected' : ''); ?>>Banjir</option>
                                    <option value="tanah_longsor" <?php echo e(old('disaster_type') === 'tanah_longsor' ? 'selected' : ''); ?>>Tanah Longsor</option>
                                    <option value="kebakaran"     <?php echo e(old('disaster_type') === 'kebakaran'     ? 'selected' : ''); ?>>Kebakaran</option>
                                    <option value="gempa"         <?php echo e(old('disaster_type') === 'gempa'         ? 'selected' : ''); ?>>Gempa Bumi</option>
                                    <option value="angin_kencang" <?php echo e(old('disaster_type') === 'angin_kencang' ? 'selected' : ''); ?>>Angin Kencang</option>
                                    <option value="lainnya"       <?php echo e(old('disaster_type') === 'lainnya'       ? 'selected' : ''); ?>>Lainnya</option>
                                </select>
                                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                            </div>
                            <?php $__errorArgs = ['disaster_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div>
                            <label for="status" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="status" name="status"
                                    class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="active"   <?php echo e(old('status', 'active') === 'active'   ? 'selected' : ''); ?>>Aktif</option>
                                    <option value="inactive" <?php echo e(old('status') === 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
                                </select>
                                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                            </div>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div>
                            <label for="area" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                Wilayah <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                            </label>
                            <input type="text" id="area" name="area" value="<?php echo e(old('area')); ?>"
                                placeholder="Contoh: Jakarta Timur"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div>
                            <label for="distance_km" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                Jarak (km) <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                            </label>
                            <input type="number" id="distance_km" name="distance_km" value="<?php echo e(old('distance_km')); ?>"
                                placeholder="Contoh: 3.5" step="0.01" min="0"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['distance_km'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['distance_km'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="md:col-span-2">
                            <label for="description" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                Deskripsi <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                            </label>
                            <textarea id="description" name="description" rows="3"
                                placeholder="Keterangan tambahan mengenai jalur evakuasi ini..."
                                class="w-full resize-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                    </div>
                </div>

                
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

                        
                        <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-4">
                            <p class="mb-3 text-xs font-bold uppercase tracking-wider text-emerald-600">
                                <i class="fa-solid fa-circle-dot mr-1"></i> Titik Awal
                            </p>
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label for="start_latitude" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-500">Latitude</label>
                                    <input type="number" id="start_latitude" name="start_latitude"
                                        value="<?php echo e(old('start_latitude')); ?>" step="0.0000001" placeholder="-6.2088"
                                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 placeholder:text-slate-300 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['start_latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__errorArgs = ['start_latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label for="start_longitude" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-500">Longitude</label>
                                    <input type="number" id="start_longitude" name="start_longitude"
                                        value="<?php echo e(old('start_longitude')); ?>" step="0.0000001" placeholder="106.8456"
                                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 placeholder:text-slate-300 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['start_longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__errorArgs = ['start_longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        
                        <div class="rounded-lg border border-red-100 bg-red-50/50 p-4">
                            <p class="mb-3 text-xs font-bold uppercase tracking-wider text-red-500">
                                <i class="fa-solid fa-flag-checkered mr-1"></i> Titik Akhir
                            </p>
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label for="end_latitude" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-500">Latitude</label>
                                    <input type="number" id="end_latitude" name="end_latitude"
                                        value="<?php echo e(old('end_latitude')); ?>" step="0.0000001" placeholder="-6.1751"
                                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 placeholder:text-slate-300 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['end_latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__errorArgs = ['end_latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label for="end_longitude" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-500">Longitude</label>
                                    <input type="number" id="end_longitude" name="end_longitude"
                                        value="<?php echo e(old('end_longitude')); ?>" step="0.0000001" placeholder="106.8272"
                                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 placeholder:text-slate-300 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['end_longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__errorArgs = ['end_longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-xs font-bold text-red-500"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                    <a href="<?php echo e(route('officer.kelola-data.evakuasi.index')); ?>"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-6 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white shadow-sm shadow-orange-500/20 transition hover:bg-orange-600">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Data
                    </button>
                </div>

            </div>

            
            <div class="flex flex-col gap-4">
                <div class="rounded-xl bg-orange-500 p-6 text-white shadow-sm shadow-orange-500/20">
                    <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-white/20">
                        <i class="fa-solid fa-route text-white"></i>
                    </div>
                    <h3 class="mb-2 text-sm font-bold">Panduan Pengisian</h3>
                    <ul class="space-y-2 text-xs font-semibold text-orange-100">
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-dot mt-0.5 shrink-0 text-[10px]"></i> Klik kiri di peta untuk menentukan titik awal jalur (marker hijau).</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-dot mt-0.5 shrink-0 text-[10px]"></i> Klik kanan di peta untuk menentukan titik akhir jalur (marker merah).</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-dot mt-0.5 shrink-0 text-[10px]"></i> Rute akan otomatis terbentuk mengikuti jalan raya terdekat.</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-dot mt-0.5 shrink-0 text-[10px]"></i> Atau gunakan tombol deteksi lokasi untuk menggunakan posisi Anda saat ini.</li>
                    </ul>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-xs font-bold uppercase tracking-wider text-slate-500">Pratinjau Koordinat</h3>
                    <div class="flex flex-col gap-3">
                        <div class="rounded-lg bg-emerald-50 border border-emerald-100 px-3 py-2.5">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-500 mb-1">Titik Awal</p>
                            <p id="preview-start" class="text-xs font-bold text-slate-600">Belum ditentukan</p>
                        </div>
                        <div class="rounded-lg bg-red-50 border border-red-100 px-3 py-2.5">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-red-400 mb-1">Titik Akhir</p>
                            <p id="preview-end" class="text-xs font-bold text-slate-600">Belum ditentukan</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

<script>
    const map = L.map('routeMap').setView([-6.2088, 106.8456], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(map);

    let startMarker = null;
    let endMarker   = null;
    let routingControl = null;

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
        document.getElementById('start_latitude').value  = lat.toFixed(7);
        document.getElementById('start_longitude').value = lng.toFixed(7);
        document.getElementById('preview-start').textContent = lat.toFixed(5) + ', ' + lng.toFixed(5);
        updateLine();
    }

    function setEndPoint(lat, lng) {
        if (endMarker) map.removeLayer(endMarker);
        endMarker = L.marker([lat, lng], { icon: iconEnd }).addTo(map).bindPopup('Titik Akhir');
        document.getElementById('end_latitude').value  = lat.toFixed(7);
        document.getElementById('end_longitude').value = lng.toFixed(7);
        document.getElementById('preview-end').textContent = lat.toFixed(5) + ', ' + lng.toFixed(5);
        updateLine();
    }

    // Fungsi update rute menggunakan OSRM agar mengikuti jalan
    function updateLine() {
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
                    styles: [{ color: '#f97316', opacity: 0.8, weight: 5 }] // Rute warna oranye
                },
                addWaypoints: false,
                draggableWaypoints: false,
                fitSelectedRoutes: true,
                show: false, // Sembunyikan panel teks instruksi
                createMarker: function() { return null; } // Mencegah pembuatan marker bawaan
            }).addTo(map);

            // Menghitung dan mengisi form jarak secara otomatis
            routingControl.on('routesfound', function(e) {
                var routes = e.routes;
                var summary = routes[0].summary;
                var distanceInKm = (summary.totalDistance / 1000).toFixed(2);
                document.getElementById('distance_km').value = distanceInKm;
            });
        }
    }

    // Cek apakah ada old() input saat validasi error
    <?php if(old('start_latitude') && old('start_longitude')): ?>
        setStartPoint(<?php echo e(old('start_latitude')); ?>, <?php echo e(old('start_longitude')); ?>);
    <?php endif; ?>
    <?php if(old('end_latitude') && old('end_longitude')): ?>
        setEndPoint(<?php echo e(old('end_latitude')); ?>, <?php echo e(old('end_longitude')); ?>);
    <?php endif; ?>

    // Klik kiri = titik awal
    map.on('click', function (e) {
        setStartPoint(e.latlng.lat, e.latlng.lng);
    });

    // Klik kanan = titik akhir
    map.on('contextmenu', function (e) {
        e.originalEvent.preventDefault();
        setEndPoint(e.latlng.lat, e.latlng.lng);
    });

    // Sinkronisasi input manual ke preview
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

    // Deteksi geolocation
    function deteksiLokasi(callback) {
        if (!navigator.geolocation) { alert('Browser Anda tidak mendukung geolocation.'); return; }
        navigator.geolocation.getCurrentPosition(
            pos => callback(pos.coords.latitude, pos.coords.longitude),
            () => alert('Tidak dapat mendeteksi lokasi. Pastikan izin lokasi diaktifkan.')
        );
    }

    document.getElementById('btn-detect-start').addEventListener('click', function () {
        deteksiLokasi((lat, lng) => {
            setStartPoint(lat, lng);
            map.setView([lat, lng], 15);
            const el = document.getElementById('lokasi-status');
            document.getElementById('lokasi-status-text').textContent = `Titik awal diset ke lokasi Anda: ${lat.toFixed(5)}, ${lng.toFixed(5)}`;
            el.classList.remove('hidden');
            el.classList.add('flex');
        });
    });

    document.getElementById('btn-detect-end').addEventListener('click', function () {
        deteksiLokasi((lat, lng) => {
            setEndPoint(lat, lng);
            map.setView([lat, lng], 15);
            const el = document.getElementById('lokasi-status');
            document.getElementById('lokasi-status-text').textContent = `Titik akhir diset ke lokasi Anda: ${lat.toFixed(5)}, ${lng.toFixed(5)}`;
            el.classList.remove('hidden');
            el.classList.add('flex');
        });
    });

    setTimeout(() => map.invalidateSize(), 300);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views\pages\officer\kelola-data\create\jalur-evakuasi.blade.php ENDPATH**/ ?>