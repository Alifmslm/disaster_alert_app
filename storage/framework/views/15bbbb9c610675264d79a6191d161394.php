

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="<?php echo e(route('officer.kelola-data.penanggulangan.index')); ?>" class="hover:text-orange-500 transition-colors">Catatan Penanggulangan</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Edit Catatan</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Edit Data Penanggulangan</h2>
        </div>
        <a href="<?php echo e(route('officer.kelola-data.penanggulangan.index')); ?>" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
            Kembali
        </a>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        
        <form action="<?php echo e(route('officer.kelola-data.penanggulangan.update', $penanggulangan->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Judul Catatan</label>
                    <input type="text" name="title" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white" value="<?php echo e(old('title', $penanggulangan->title)); ?>">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Hubungkan dengan Laporan Bencana (Opsional)</label>
                    <select name="disaster_report_id" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white">
                        <option value="">-- Tidak Terhubung ke Laporan Spesifik --</option>
                        <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($report->id); ?>" <?php echo e(old('disaster_report_id', $penanggulangan->disaster_report_id) == $report->id ? 'selected' : ''); ?>>
                                <?php echo e(strtoupper($report->type)); ?> - <?php echo e($report->location_name ?? 'Titik Peta'); ?> (<?php echo e($report->occurred_at ? $report->occurred_at->format('d M Y') : '-'); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Tipe Bencana</label>
                    <select name="disaster_type" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white">
                        <?php $__currentLoopData = ['banjir', 'tanah_longsor', 'kebakaran', 'gempa', 'angin_kencang']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>" <?php echo e(old('disaster_type', $penanggulangan->disaster_type) == $type ? 'selected' : ''); ?>>
                                <?php echo e(ucwords(str_replace('_', ' ', $type))); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['disaster_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Area Terdampak</label>
                    <input type="text" name="affected_area" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white" value="<?php echo e(old('affected_area', $penanggulangan->affected_area)); ?>">
                    <?php $__errorArgs = ['affected_area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Tanggal Tindakan</label>
                    <input type="date" name="action_date" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white" value="<?php echo e(old('action_date', $penanggulangan->action_date ? \Carbon\Carbon::parse($penanggulangan->action_date)->format('Y-m-d') : '')); ?>">
                    <?php $__errorArgs = ['action_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Deskripsi Penanggulangan</label>
                    <textarea name="description" rows="5" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none resize-none focus:border-orange-400 focus:bg-white"><?php echo e(old('description', $penanggulangan->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">Update Catatan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views\pages\officer\kelola-data\update\catatan-penanggulangan.blade.php ENDPATH**/ ?>