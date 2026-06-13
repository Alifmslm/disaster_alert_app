

<?php $__env->startSection('tab_content'); ?>


<?php if(session('success')): ?>
    <div class="mx-6 mt-5 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
        <i class="fa-solid fa-circle-check shrink-0"></i>
        <p class="text-sm font-bold"><?php echo e(session('success')); ?></p>
    </div>
<?php endif; ?>


<form method="GET" action="<?php echo e(route('officer.kelola-data.evakuasi.index')); ?>"
    class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 py-5 px-6">

    <div class="flex flex-col md:flex-row md:items-center gap-3 w-full lg:w-auto">
        <span class="text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Filter by:</span>

        <select name="status" onchange="this.form.submit()"
            class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all">
            <option value="semua" <?php echo e(request('status', 'semua') === 'semua' ? 'selected' : ''); ?>>Status (Semua)</option>
            <option value="active"   <?php echo e(request('status') === 'active'   ? 'selected' : ''); ?>>Aktif</option>
            <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
        </select>

        <select name="disaster_type" onchange="this.form.submit()"
            class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all">
            <option value="semua" <?php echo e(request('disaster_type', 'semua') === 'semua' ? 'selected' : ''); ?>>Tipe Bencana (Semua)</option>
            <option value="banjir"        <?php echo e(request('disaster_type') === 'banjir'        ? 'selected' : ''); ?>>Banjir</option>
            <option value="tanah_longsor" <?php echo e(request('disaster_type') === 'tanah_longsor' ? 'selected' : ''); ?>>Tanah Longsor</option>
            <option value="kebakaran"     <?php echo e(request('disaster_type') === 'kebakaran'     ? 'selected' : ''); ?>>Kebakaran</option>
            <option value="gempa"         <?php echo e(request('disaster_type') === 'gempa'         ? 'selected' : ''); ?>>Gempa Bumi</option>
            <option value="angin_kencang" <?php echo e(request('disaster_type') === 'angin_kencang' ? 'selected' : ''); ?>>Angin Kencang</option>
        </select>
    </div>

    <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto">
        <a href="<?php echo e(route('officer.kelola-data.evakuasi.create')); ?>"
            class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg text-[11px] font-black uppercase tracking-wide transition-all shadow-sm">
            <i class="fa-solid fa-plus"></i>
            Tambah Data
        </a>
        <span class="text-slate-500 text-[11px] font-extrabold whitespace-nowrap">
            Showing <?php echo e($routes->firstItem() ?? 0); ?>–<?php echo e($routes->lastItem() ?? 0); ?> of <?php echo e($routes->total()); ?> results
        </span>
    </div>
</form>


<div class="overflow-x-auto w-full">
    <table class="w-full min-w-[900px] border-collapse">
        <thead class="bg-slate-100">
            <tr>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Nama Jalur</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Wilayah</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Tipe Bencana</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Jarak</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Status</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-slate-50 transition-colors">

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-slate-900 text-[13px] font-black align-middle">
                        <?php echo e($route->name); ?>

                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">
                        <?php echo e($route->area ?? '—'); ?>

                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        <?php
                            $typeColors = [
                                'banjir'        => 'bg-blue-50 text-blue-600',
                                'tanah_longsor' => 'bg-orange-50 text-orange-600',
                                'kebakaran'     => 'bg-red-50 text-red-600',
                                'gempa'         => 'bg-rose-50 text-rose-600',
                                'angin_kencang' => 'bg-slate-100 text-slate-600',
                            ];
                            $typeLabels = [
                                'banjir'        => 'Banjir',
                                'tanah_longsor' => 'Tanah Longsor',
                                'kebakaran'     => 'Kebakaran',
                                'gempa'         => 'Gempa Bumi',
                                'angin_kencang' => 'Angin Kencang',
                            ];
                            $typeClass = $typeColors[$route->disaster_type] ?? 'bg-slate-100 text-slate-600';
                            $typeLabel = $typeLabels[$route->disaster_type] ?? ucfirst(str_replace('_', ' ', $route->disaster_type));
                        ?>
                        <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase <?php echo e($typeClass); ?>">
                            <?php echo e($typeLabel); ?>

                        </span>
                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">
                        <?php echo e($route->distance_km ? number_format($route->distance_km, 1) . ' km' : '—'); ?>

                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        <?php if($route->status === 'active'): ?>
                            <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase bg-emerald-100 text-emerald-600">Aktif</span>
                        <?php else: ?>
                            <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase bg-slate-100 text-slate-500">Tidak Aktif</span>
                        <?php endif; ?>
                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('officer.kelola-data.evakuasi.edit', $route)); ?>"
                                class="border border-slate-200 rounded bg-white text-slate-700 py-2 px-3 text-[10px] font-black cursor-pointer hover:border-orange-400 hover:text-orange-500 transition-colors">
                                EDIT
                            </a>
                            <form action="<?php echo e(route('officer.kelola-data.evakuasi.destroy', $route)); ?>" method="POST" class="inline-block"
                                onsubmit="return confirm('Hapus jalur evakuasi ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    class="border-0 rounded bg-red-50 text-red-500 py-2 px-3 text-[10px] font-black cursor-pointer hover:bg-red-100 transition-colors">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="py-12 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-400">
                            <i class="fa-solid fa-route text-3xl"></i>
                            <p class="text-sm font-semibold">Belum ada data jalur evakuasi.</p>
                            <a href="<?php echo e(route('officer.kelola-data.evakuasi.create')); ?>"
                                class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-4 py-2 text-xs font-bold text-white hover:bg-orange-600 transition-colors">
                                <i class="fa-solid fa-plus"></i> Tambah Sekarang
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<?php if($routes->hasPages()): ?>
    <div class="px-6 py-4 border-t border-slate-100">
        <?php echo e($routes->links()); ?>

    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.officer.kelola-data.manage-data', ['activeTab' => 'evakuasi'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views\pages\officer\kelola-data\jalur-evakuasi.blade.php ENDPATH**/ ?>