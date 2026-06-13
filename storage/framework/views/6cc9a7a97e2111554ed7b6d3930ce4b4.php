

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">

    
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="<?php echo e(route('officer.kelola-data.shelter.index')); ?>" class="hover:text-orange-500 transition-colors">Kelola Data</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Edit Shelter & Posko</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Edit Fasilitas Darurat</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui informasi untuk <strong><?php echo e($place->name); ?></strong>.</p>
        </div>
        <a href="<?php echo e(route('officer.kelola-data.shelter.index')); ?>"
            class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="<?php echo e(route('officer.kelola-data.shelter.update', $place->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                
                <div class="md:col-span-2">
                    <label for="name" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Nama Fasilitas <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name', $place->name)); ?>" required
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['name'];
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
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="type" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Tipe <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="type" name="type" required class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->value); ?>" <?php echo e(old('type', $place->type->value ?? $place->type) == $type->value ? 'selected' : ''); ?>>
                                    <?php echo e($type->label()); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    </div>
                    <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="status" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="status" name="status" required class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="active" <?php echo e(old('status', $place->status) == 'active' ? 'selected' : ''); ?>>Tersedia / Aktif</option>
                            <option value="full" <?php echo e(old('status', $place->status) == 'full' ? 'selected' : ''); ?>>Kapasitas Penuh</option>
                            <option value="inactive" <?php echo e(old('status', $place->status) == 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
                        </select>
                        <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    </div>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="capacity" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Kapasitas Orang <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                    </label>
                    <input type="number" id="capacity" name="capacity" value="<?php echo e(old('capacity', $place->capacity)); ?>" min="0"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="contact" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Nomor Kontak <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                    </label>
                    <input type="text" id="contact" name="contact" value="<?php echo e(old('contact', $place->contact)); ?>"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="md:col-span-2">
                    <label for="area" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Wilayah / Area <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                    </label>
                    <input type="text" id="area" name="area" value="<?php echo e(old('area', $place->area)); ?>"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['area'];
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
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="md:col-span-2">
                    <label for="address" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Alamat Lengkap <span class="text-slate-400 text-[10px] normal-case font-semibold">(opsional)</span>
                    </label>
                    <textarea id="address" name="address" rows="3"
                        class="w-full resize-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10 <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('address', $place->address)); ?></textarea>
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-xs font-bold text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                        Titik Lokasi Peta <span class="text-slate-400 text-[10px] normal-case font-semibold">(geser pin atau klik peta)</span>
                    </label>
                    
                    <div id="mapPicker" class="w-full h-[300px] rounded-lg border border-slate-200 bg-slate-100 z-0 mb-3 relative"></div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="latitude" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Latitude</label>
                            <input type="text" id="latitude" name="latitude" value="<?php echo e(old('latitude', $place->latitude ?? '')); ?>" readonly
                                class="w-full rounded-lg border border-slate-200 bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-500 outline-none">
                        </div>
                        <div>
                            <label for="longitude" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Longitude</label>
                            <input type="text" id="longitude" name="longitude" value="<?php echo e(old('longitude', $place->longitude ?? '')); ?>" readonly
                                class="w-full rounded-lg border border-slate-200 bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-500 outline-none">
                        </div>
                    </div>
                </div>

            </div>

            
            <div class="my-6 border-t border-slate-100"></div>

            
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="<?php echo e(route('officer.kelola-data.shelter.index')); ?>"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-6 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white shadow-sm shadow-orange-500/20 transition hover:bg-orange-600">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Perbarui Data
                </button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const addressInput = document.getElementById('address');

    const initialLat = latInput.value ? parseFloat(latInput.value) : -6.2000;
    const initialLng = lngInput.value ? parseFloat(lngInput.value) : 106.8166;

    const map = L.map('mapPicker', {
        zoomControl: false
    }).setView([initialLat, initialLng], 13);

    L.control.zoom({ position: 'bottomright' }).addTo(map);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    const marker = L.marker([initialLat, initialLng], {
        draggable: true
    }).addTo(map);

    async function fetchAddress(lat, lng) {
        const originalAddress = addressInput.value;
        addressInput.value = 'Mendeteksi alamat...';
        
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`);
            const data = await response.json();
            
            if (data && data.display_name) {
                addressInput.value = data.display_name;
            } else {
                addressInput.value = originalAddress;
            }
        } catch (error) {
            addressInput.value = originalAddress;
        }
    }

    function updateCoordinates(lat, lng) {
        latInput.value = lat.toFixed(7);
        lngInput.value = lng.toFixed(7);
        fetchAddress(lat, lng);
    }

    marker.on('dragend', function () {
        const position = marker.getLatLng();
        updateCoordinates(position.lat, position.lng);
    });

    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        updateCoordinates(e.latlng.lat, e.latlng.lng);
    });

    setTimeout(() => {
        map.invalidateSize();
    }, 400);
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views\pages\officer\kelola-data\update\shelter-posko.blade.php ENDPATH**/ ?>