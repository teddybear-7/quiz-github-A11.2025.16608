<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Notifikasi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Notifikasi']); ?>

    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Notifikasi
        </h2>

        <?php if($notifikasis->whereNull('read_at')->isNotEmpty()): ?>
        <form action="<?php echo e(route(auth()->user()->role . '.notifikasi.baca-semua')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit"
                class="flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">
                <i class="fas fa-check-double"></i>
                Tandai Semua Dibaca
            </button>
        </form>
        <?php endif; ?>
    </div>

    
    <?php $__empty_1 = true; $__currentLoopData = $notifikasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notifikasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card shadow-md rounded-2xl border mb-3
        <?php echo e($notifikasi->read_at ? 'bg-base-100 border-slate-200' : 'bg-indigo-50 border-indigo-300'); ?>">
        <div class="card-body p-5 flex-row items-center justify-between gap-4">

            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="<?php echo e($notifikasi->read_at ? 'font-semibold text-slate-600' : 'font-bold text-slate-800'); ?>">
                        <?php echo e($notifikasi->data['judul']); ?>

                    </span>
                    <?php if (! ($notifikasi->read_at)): ?>
                    <span class="badge badge-primary badge-sm">Baru</span>
                    <?php endif; ?>
                </div>
                <div class="text-sm text-slate-600"><?php echo e($notifikasi->data['pesan']); ?></div>
                <div class="text-xs text-slate-400 mt-1"><?php echo e($notifikasi->created_at->diffForHumans()); ?></div>
            </div>

            <div class="flex gap-2 shrink-0">
                <a href="<?php echo e($notifikasi->data['url']); ?>"
                    class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-4">
                    <i class="fas fa-eye"></i>
                    Lihat
                </a>

                <?php if (! ($notifikasi->read_at)): ?>
                <form action="<?php echo e(route(auth()->user()->role . '.notifikasi.baca', $notifikasi->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm bg-slate-100 hover:bg-slate-200 text-slate-600 border-none rounded-lg px-4">
                        <i class="fas fa-check"></i>
                        Tandai Dibaca
                    </button>
                </form>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7 text-center text-slate-400 py-14">
            <i class="fas fa-bell-slash text-3xl mb-3 block"></i>
            Belum ada notifikasi
        </div>
    </div>
    <?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/notifikasi/index.blade.php ENDPATH**/ ?>