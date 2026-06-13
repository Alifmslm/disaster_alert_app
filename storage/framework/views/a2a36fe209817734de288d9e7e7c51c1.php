

<?php $__env->startSection('tab_content'); ?>


<?php if(session('success')): ?>
<div class="px-6 pt-5">
    <div class="flex items-center gap-3 p-4 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600">
        <i class="fa-solid fa-circle-check"></i>
        <p class="text-sm font-bold"><?php echo e(session('success')); ?></p>
    </div>
</div>
<?php endif; ?>

<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 py-5 px-6">
    
    <form id="filterForm" method="GET" action="<?php echo e(route('officer.kelola-data.shelter.index')); ?>" class="flex flex-col md:flex-row md:items-center gap-3 w-full lg:w-auto">
        <span class="text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Filter by:</span>
        
        
        <select name="type" onchange="document.getElementById('filterForm').submit()" class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all cursor-pointer">
            <option value="">Tipe (Semua)</option>
            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($type->value); ?>" <?php echo e(request('type') == $type->value ? 'selected' : ''); ?>>
                    <?php echo e($type->label()); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        
        <select name="status" onchange="document.getElementById('filterForm').submit()" class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all cursor-pointer">
            <option value="">Status (Semua)</option>
            <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Tersedia / Aktif</option>
            <option value="full" <?php echo e(request('status') == 'full' ? 'selected' : ''); ?>>Kapasitas Penuh</option>
            <option value="maintenance" <?php echo e(request('status') == 'maintenance' ? 'selected' : ''); ?>>Perbaikan</option>
            <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
        </select>

        
        <?php if(request()->filled('type') || request()->filled('status')): ?>
            <a href="<?php echo e(route('officer.kelola-data.shelter.index')); ?>" class="text-[10px] font-black text-red-500 hover:text-red-700 uppercase tracking-widest transition-colors">Reset</a>
        <?php endif; ?>
    </form>

    <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto">
        <span class="text-slate-500 text-[11px] font-extrabold whitespace-nowrap">Showing <?php echo e($places->total()); ?> results</span>
        
        
        <a href="<?php echo e(route('officer.kelola-data.shelter.create')); ?>" class="bg-[#FF7F3E] hover:bg-[#e66a2e] text-white py-2.5 px-4 rounded-lg text-[11px] font-black uppercase tracking-wide transition-all shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Data
        </a>
    </div>
</div>

<div class="overflow-x-auto w-full">
    <table class="w-full min-w-[980px] border-collapse">
        <thead class="bg-slate-100">
            <tr>
                <th class="py-[17px] px-6 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Nama Shelter / Posko</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Lokasi</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Tipe</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Status</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    
                    <td class="py-[18px] px-6 border-t border-slate-100 text-slate-900 text-[13px] font-black align-middle">
                        <?php echo e($place->name); ?>

                        <?php if($place->capacity): ?>
                            <div class="text-[10px] text-slate-400 font-bold mt-1 uppercase tracking-wider">
                                Kapasitas: <?php echo e(number_format($place->capacity)); ?> Orang
                            </div>
                        <?php endif; ?>
                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">
                        <div class="font-bold text-slate-700 mb-0.5"><?php echo e($place->area ?? '-'); ?></div>
                        <div class="text-[11px] text-slate-400 leading-tight max-w-[250px] truncate" title="<?php echo e($place->address); ?>">
                            <?php echo e($place->address ?? 'Alamat belum diatur'); ?>

                        </div>
                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase <?php echo e($place->type->color() ?? 'bg-slate-100 text-slate-600'); ?>">
                            <?php echo e($place->type->label() ?? $place->type); ?>

                        </span>
                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        <?php
                            $statusColor = match($place->status) {
                                'active' => 'bg-emerald-100 text-emerald-600',
                                'full' => 'bg-rose-100 text-rose-600',
                                'maintenance' => 'bg-orange-100 text-orange-600',
                                default => 'bg-slate-100 text-slate-500'
                            };
                            $statusLabel = match($place->status) {
                                'active' => 'Tersedia',
                                'full' => 'Penuh',
                                'maintenance' => 'Perbaikan',
                                default => 'Tidak Aktif'
                            };
                        ?>
                        <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase <?php echo e($statusColor); ?>">
                            <?php echo e($statusLabel); ?>

                        </span>
                    </td>

                    
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('officer.kelola-data.shelter.edit', $place->id)); ?>" class="border border-slate-200 rounded bg-white text-slate-700 py-1.5 px-3 text-[10px] font-black cursor-pointer hover:border-orange-400 transition-colors">
                                EDIT
                            </a>
                            
                            <form action="<?php echo e(route('officer.kelola-data.shelter.destroy', $place->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data fasilitas ini secara permanen?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="border border-rose-200 rounded bg-rose-50 text-rose-600 py-1.5 px-3 text-[10px] font-black cursor-pointer hover:bg-rose-600 hover:text-white transition-colors">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <i class="fa-solid fa-box-open text-3xl mb-3"></i>
                            <p class="text-sm font-bold">Belum ada data fasilitas darurat.</p>
                            <p class="text-xs mt-1">Silakan klik "Tambah Data" untuk memulai.</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<?php if($places->hasPages()): ?>
<div class="px-6 py-4 border-t border-slate-100 bg-white">
    <?php echo e($places->links()); ?>

</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.officer.kelola-data.manage-data', ['activeTab' => 'shelter'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views\pages\officer\kelola-data\shelter-posko.blade.php ENDPATH**/ ?>