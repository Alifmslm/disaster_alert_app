<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['activeTab']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['activeTab']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="flex items-center gap-0 border-b border-slate-200 px-6 overflow-x-auto" role="tablist" aria-label="Kategori kelola data">
    <a href="<?php echo e(route('officer.kelola-data.laporan.index')); ?>" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors <?php echo e($activeTab === 'laporan' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800'); ?>">
        Laporan Bencana
    </a>

    <a href="<?php echo e(route('officer.kelola-data.evakuasi.index')); ?>" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors <?php echo e($activeTab === 'evakuasi' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800'); ?>">
        Jalur Evakuasi
    </a>

    <a href="<?php echo e(route('officer.kelola-data.shelter.index')); ?>" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors <?php echo e($activeTab === 'shelter' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800'); ?>">
        Shelter dan Posko
    </a>

    <a href="<?php echo e(route('officer.kelola-data.faskes.index')); ?>" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors <?php echo e($activeTab === 'kesehatan' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800'); ?>">
        Fasilitas Kesehatan
    </a>

    <a href="<?php echo e(route('officer.kelola-data.penanggulangan.index')); ?>" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors <?php echo e($activeTab === 'penanggulangan' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800'); ?>">
        Catatan Penanggulangan
    </a>
</div><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views\components\data-tabs.blade.php ENDPATH**/ ?>