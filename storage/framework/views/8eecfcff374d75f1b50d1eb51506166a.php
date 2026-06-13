

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="<?php echo e(route('officer.kelola-data.laporan')); ?>" class="hover:text-orange-500 transition-colors">Laporan Bencana</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Edit Laporan</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Edit Laporan Bencana</h2>
        </div>
        <a href="<?php echo e(route('officer.kelola-data.laporan')); ?>" class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
            Kembali
        </a>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="<?php echo e(route('officer.kelola-data.laporan.update', $report)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                
                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Tipe Bencana</label>
                    <select name="type" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="banjir" <?php echo e(old('type', $report->type) == 'banjir' ? 'selected' : ''); ?>>Banjir</option>
                        <option value="tanah_longsor" <?php echo e(old('type', $report->type) == 'tanah_longsor' ? 'selected' : ''); ?>>Tanah Longsor</option>
                        <option value="kebakaran" <?php echo e(old('type', $report->type) == 'kebakaran' ? 'selected' : ''); ?>>Kebakaran</option>
                        <option value="gempa" <?php echo e(old('type', $report->type) == 'gempa' ? 'selected' : ''); ?>>Gempa</option>
                        <option value="angin_kencang" <?php echo e(old('type', $report->type) == 'angin_kencang' ? 'selected' : ''); ?>>Angin Kencang</option>
                    </select>
                    <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Status</label>
                    <select name="status" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="submitted" <?php echo e(old('status', $report->status) == 'submitted' ? 'selected' : ''); ?>>Darurat (Baru)</option>
                        <option value="verified" <?php echo e(old('status', $report->status) == 'verified' ? 'selected' : ''); ?>>Divalidasi</option>
                        <option value="in_progress" <?php echo e(old('status', $report->status) == 'in_progress' ? 'selected' : ''); ?>>Diproses</option>
                        <option value="handled" <?php echo e(old('status', $report->status) == 'handled' ? 'selected' : ''); ?>>Selesai</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Nama Pelapor (Opsional)</label>
                    <input type="text" name="reporter_name" value="<?php echo e(old('reporter_name', $report->reporter_name)); ?>" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white <?php $__errorArgs = ['reporter_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['reporter_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Waktu Kejadian</label>
                    <input type="datetime-local" name="occurred_at" value="<?php echo e(old('occurred_at', \Carbon\Carbon::parse($report->occurred_at)->format('Y-m-d\TH:i'))); ?>" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white <?php $__errorArgs = ['occurred_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['occurred_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Deskripsi Kejadian</label>
                    <textarea name="description" rows="4" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none resize-none focus:border-orange-400 focus:bg-white <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description', $report->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Lokasi Teks</label>
                    <input type="text" name="location_name" id="location_name" value="<?php echo e(old('location_name', $report->location_name)); ?>" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white <?php $__errorArgs = ['location_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['location_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Pilih Lokasi Peta</label>
                    <div id="mapPicker" class="w-full h-[300px] rounded-lg border border-slate-200 z-0 mb-3"></div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <input type="text" id="latitude" name="latitude" value="<?php echo e(old('latitude', $report->latitude)); ?>" readonly class="w-full rounded-lg border border-slate-200 bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-500 outline-none">
                            <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <input type="text" id="longitude" name="longitude" value="<?php echo e(old('longitude', $report->longitude)); ?>" readonly class="w-full rounded-lg border border-slate-200 bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-500 outline-none">
                            <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                
                <div id="mitigation_note_section" class="md:col-span-2 mt-4 p-5 bg-orange-50 border border-orange-200 rounded-xl hidden">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="p-1.5 bg-orange-500 rounded-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </div>
                        <h3 class="text-sm font-bold text-orange-900 uppercase tracking-tight">Input Catatan Penanggulangan</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Judul Tindakan <span class="text-red-500">*</span></label>
                            <input type="text" name="mitigation_title" id="mitigation_title" placeholder="Contoh: Pengiriman Logistik, Evakuasi Warga..." class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400">
                            <?php $__errorArgs = ['mitigation_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Deskripsi Penanggulangan <span class="text-red-500">*</span></label>
                            <textarea name="mitigation_description" id="mitigation_description" rows="3" placeholder="Jelaskan tindakan yang telah atau sedang dilakukan secara detail..." class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold outline-none resize-none focus:border-orange-400"></textarea>
                            <?php $__errorArgs = ['mitigation_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">Perbarui Data Laporan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let defaultLat = <?php echo e(old('latitude', $report->latitude ?? -6.2088)); ?>;
    let defaultLng = <?php echo e(old('longitude', $report->longitude ?? 106.8456)); ?>;
    
    const map = L.map('mapPicker').setView([defaultLat, defaultLng], 14);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
    const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    function updateInputs(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(7);
        document.getElementById('longitude').value = lng.toFixed(7);
        
        document.getElementById('location_name').value = 'Mencari lokasi...';

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.display_name) {
                    document.getElementById('location_name').value = data.display_name;
                } else {
                    document.getElementById('location_name').value = '';
                }
            })
            .catch(() => {
                document.getElementById('location_name').value = '';
            });
    }

    marker.on('dragend', () => updateInputs(marker.getLatLng().lat, marker.getLatLng().lng));
    
    map.on('click', e => {
        marker.setLatLng(e.latlng);
        updateInputs(e.latlng.lat, e.latlng.lng);
    });

    // Logic Tampilkan Catatan Penanggulangan
    const statusSelect = document.querySelector('select[name="status"]');
    const mitigationSection = document.getElementById('mitigation_note_section');
    const mitigationTitle = document.getElementById('mitigation_title');
    const mitigationDesc = document.getElementById('mitigation_description');

    function toggleMitigationSection() {
        if (statusSelect.value === 'in_progress' || statusSelect.value === 'handled') {
            mitigationSection.classList.remove('hidden');
            mitigationTitle.setAttribute('required', 'required');
            mitigationDesc.setAttribute('required', 'required');
        } else {
            mitigationSection.classList.add('hidden');
            mitigationTitle.removeAttribute('required');
            mitigationDesc.removeAttribute('required');
        }
    }

    statusSelect.addEventListener('change', toggleMitigationSection);
    toggleMitigationSection(); // Run on load
    
    setTimeout(() => map.invalidateSize(), 300);
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views\pages\officer\kelola-data\update\laporan-bencana.blade.php ENDPATH**/ ?>