

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-white p-6"> <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Pendidikan & Berita</h1>
            <p class="text-slate-500 text-sm">Panduan mitigasi dan informasi keselamatan terbaru</p>
        </div>
        <div class="bg-slate-50 px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
            <span class="text-orange-600 font-bold text-xs uppercase tracking-widest">Status:</span> 
            <span class="text-green-600 ml-1 text-xs font-bold uppercase">Aman</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-2xl transition-all group shadow-md">
                <div class="h-2 bg-orange-500"></div>

                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-orange-100 text-orange-600 text-[10px] font-extrabold rounded-lg uppercase tracking-tighter border border-orange-200">
                            <?php echo e($guide->disaster_type); ?>

                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-orange-600 transition-colors leading-tight">
                        <?php echo e($guide->title); ?>

                    </h3>
                    
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        <?php echo e($guide->description); ?>

                    </p>

                    <div class="flex items-center justify-between mt-auto">
                        <button class="flex items-center text-orange-600 text-[10px] font-black uppercase tracking-widest hover:text-orange-500 transition-all">
                            Lihat Detail
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                        <span class="text-[9px] text-slate-400 font-bold text-right uppercase">Sentinel v1.0</span>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full py-20 text-center bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold uppercase tracking-widest">Belum Ada Data Panduan</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\disaster_alert_app\resources\views/pages/user/safety-guide.blade.php ENDPATH**/ ?>