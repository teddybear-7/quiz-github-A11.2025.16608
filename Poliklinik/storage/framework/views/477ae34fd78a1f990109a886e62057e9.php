<header class="bg-base-100 border-b border-base-300 h-16 flex items-center px-6 gap-4 sticky top-0 z-30 shadow-sm">

    
    <button onclick="toggleSidebar()" class="btn btn-square btn-ghost lg:hidden">
        <i data-lucide="menu" class="w-5 h-5"></i>
    </button>

    
    <div class="flex-1">
        <div class="flex items-center gap-2 text-sm">
            <span class="text-base-content/50">Poliklinik</span>
            <i data-lucide="chevron-right" class="w-4 h-4 text-base-content/30"></i>
            <span class="font-semibold text-base-content">
                <?php echo e($title ?? 'Dashboard'); ?>

            </span>
        </div>
    </div>

    
    <button onclick="toggleFullscreen()" class="btn btn-square btn-ghost">
        <i id="fsIcon" class="fas fa-expand w-5 h-5"></i>
    </button>

    
    <?php if(in_array(auth()->user()->role, ['dokter', 'pasien'])): ?>
    <?php ($belumDibaca = auth()->user()->unreadNotifications()->count()); ?>
    <a href="<?php echo e(route(auth()->user()->role . '.notifikasi.index')); ?>" class="btn btn-square btn-ghost relative">
        <i class="fas fa-bell w-5 h-5"></i>
        <?php if($belumDibaca > 0): ?>
        <span class="badge badge-error badge-sm text-white absolute -top-1 -right-1">
            <?php echo e($belumDibaca > 99 ? '99+' : $belumDibaca); ?>

        </span>
        <?php endif; ?>
    </a>
    <?php endif; ?>

    
    <div class="flex items-center gap-3">

        <div class="text-right hidden sm:block">
            <div class="text-sm font-semibold leading-tight">
                <?php echo e(auth()->user()->nama ?? 'Pengguna'); ?>

            </div>
            <div class="text-xs text-base-content/50 leading-tight">
                <?php echo e(auth()->user()->role ?? 'Admin Sistem'); ?>

            </div>
        </div>

        <div class="avatar">
            <div class="w-10 h-10 rounded-full bg-primary text-primary-content flex items-center justify-center">
                <span class="text-sm font-semibold leading-none">
                    <?php echo e(strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1))); ?>

                </span>
            </div>
        </div>
    </div>

</header>

<script>
    function toggleFullscreen() {
    const icon = document.getElementById('fsIcon');

    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
        icon.classList.remove('fa-expand');
        icon.classList.add('fa-compress');
    } else {
        document.exitFullscreen();
        icon.classList.remove('fa-compress');
        icon.classList.add('fa-expand');
    }
}
</script><?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/components/partials/header.blade.php ENDPATH**/ ?>