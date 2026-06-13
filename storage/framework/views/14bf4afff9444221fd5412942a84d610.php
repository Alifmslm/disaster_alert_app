

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">

    
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="<?php echo e(route('user.tindakan-preventif.index')); ?>" class="hover:text-orange-500 transition-colors">Tindakan Preventif</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Edit Catatan</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Edit Tindakan Preventif</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui data tindakan pencegahan yang telah Anda catat.</p>
        </div>
        <a href="<?php echo e(route('user.tindakan-preventif.index')); ?>"
            class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="<?php echo e(route('user.tindakan-preventif.update', $tindakanPreventif->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                
                <div class="md:col-span-2">
                    <label for="aktivitas" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Aktivitas <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="aktivitas"
                        name="aktivitas"
                        value="<?php echo e(old('aktivitas', $tindakanPreventif->aktivitas)); ?>"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['aktivitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['aktivitas'];
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
                    <label for="waktu_tindakan" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Waktu Tindakan <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="datetime-local"
                        id="waktu_tindakan"
                        name="waktu_tindakan"
                        value="<?php echo e(old('waktu_tindakan', $tindakanPreventif->waktu_tindakan?->format('Y-m-d\TH:i'))); ?>"
                        max="<?php echo e(now()->format('Y-m-d\TH:i')); ?>"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['waktu_tindakan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['waktu_tindakan'];
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
                    <label for="lokasi" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Lokasi
                    </label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <i class="fa-solid fa-location-dot text-xs"></i>
                        </span>
                        <input
                            type="text"
                            id="lokasi"
                            name="lokasi"
                            value="<?php echo e(old('lokasi', $tindakanPreventif->lokasi)); ?>"
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-4 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10">
                    </div>
                </div>

                
                <div class="md:col-span-2 bg-orange-50/50 p-4 rounded-xl border border-orange-100">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fa-solid fa-earth-asia text-orange-500 text-sm"></i>
                        <h4 class="text-xs font-black uppercase tracking-tight text-orange-700">Geofencing & Radius Pantauan</h4>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-400">Latitude</label>
                            <input type="text" id="latitude" name="latitude" value="<?php echo e(old('latitude', $tindakanPreventif->latitude)); ?>" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-bold outline-none focus:border-orange-400">
                        </div>
                        <div>
                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-400">Longitude</label>
                            <input type="text" id="longitude" name="longitude" value="<?php echo e(old('longitude', $tindakanPreventif->longitude)); ?>" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-bold outline-none focus:border-orange-400">
                        </div>
                        <div>
                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-400">Radius (KM)</label>
                            <input type="number" step="0.1" name="radius_km" value="<?php echo e(old('radius_km', $tindakanPreventif->radius_km ?? 1.0)); ?>" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-bold outline-none focus:border-orange-400">
                        </div>
                    </div>
                    <button type="button" onclick="getLocation()" class="mt-3 text-[10px] font-black uppercase text-orange-600 hover:text-orange-700 flex items-center gap-1.5">
                        <i class="fa-solid fa-crosshairs"></i> Gunakan Lokasi Saat Ini
                    </button>
                </div>

                
                <div class="md:col-span-2">
                    <label for="deskripsi" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="4"
                        class="w-full resize-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('deskripsi', $tindakanPreventif->deskripsi)); ?></textarea>
                    <?php $__errorArgs = ['deskripsi'];
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
                    <label for="foto" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Foto Bukti <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                    </label>

                    <?php if($tindakanPreventif->foto): ?>
                        <div class="mb-3">
                            <p class="mb-2 text-[10px] font-bold uppercase text-slate-400">Foto Saat Ini:</p>
                            <img src="<?php echo e(asset('storage/' . $tindakanPreventif->foto)); ?>" class="h-32 w-48 rounded-lg object-cover border border-slate-200">
                        </div>
                    <?php endif; ?>

                    <label for="foto"
                        class="group flex cursor-pointer flex-col items-center justify-center gap-3 rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center transition hover:border-orange-400 hover:bg-orange-50/40"
                        id="foto-dropzone">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400 transition group-hover:bg-orange-100 group-hover:text-orange-500">
                            <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-600 group-hover:text-orange-600 transition">
                                Klik untuk ganti foto
                            </p>
                            <p class="mt-0.5 text-xs text-slate-400">PNG, JPG, atau JPEG — Maks. 2 MB</p>
                        </div>
                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept="image/png,image/jpg,image/jpeg"
                            class="sr-only"
                            onchange="previewFoto(this)">
                    </label>

                    
                    <div id="foto-preview-wrapper" class="mt-3 hidden">
                        <div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-white p-3">
                            <img id="foto-preview-img" src="" alt="Preview foto"
                                class="h-16 w-16 rounded-lg object-cover border border-slate-100 shrink-0">
                            <div class="min-w-0 flex-1">
                                <p id="foto-preview-name" class="truncate text-xs font-bold text-slate-700"></p>
                                <p id="foto-preview-size" class="text-[10px] text-slate-400 font-semibold mt-0.5"></p>
                            </div>
                            <button type="button" onclick="hapusFoto()"
                                class="shrink-0 flex h-7 w-7 items-center justify-center rounded-full bg-red-50 text-red-500 transition hover:bg-red-100">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <?php $__errorArgs = ['foto'];
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

            
            <div class="my-6 border-t border-slate-100"></div>

            
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="<?php echo e(route('user.tindakan-preventif.index')); ?>"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-6 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white shadow-sm shadow-orange-500/20 transition hover:bg-orange-600">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Catatan
                </button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function previewFoto(input) {
        const file = input.files[0];
        if (!file) return;

        const previewWrapper = document.getElementById('foto-preview-wrapper');
        const previewImg     = document.getElementById('foto-preview-img');
        const previewName    = document.getElementById('foto-preview-name');
        const previewSize    = document.getElementById('foto-preview-size');
        const dropzone       = document.getElementById('foto-dropzone');

        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
        };
        reader.readAsDataURL(file);

        previewName.textContent = file.name;
        previewSize.textContent = (file.size / 1024).toFixed(1) + ' KB';

        previewWrapper.classList.remove('hidden');
        dropzone.classList.add('hidden');
    }

    function hapusFoto() {
        const input          = document.getElementById('foto');
        const previewWrapper = document.getElementById('foto-preview-wrapper');
        const dropzone       = document.getElementById('foto-dropzone');

        input.value = '';
        previewWrapper.classList.add('hidden');
        dropzone.classList.remove('hidden');
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function() {
                alert('Gagal mendapatkan lokasi. Pastikan GPS aktif.');
            });
        } else {
            alert('Browser tidak mendukung geolokasi.');
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views\pages\user\tindakan-preventif\edit.blade.php ENDPATH**/ ?>