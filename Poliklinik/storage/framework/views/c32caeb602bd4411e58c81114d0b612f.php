<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Periksa Pasien']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Periksa Pasien']); ?>

    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Periksa Pasien
        </h2>

        <a href="<?php echo e(route('riwayat-pasien.index')); ?>"
            class="flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">
            <i class="fas fa-folder-open"></i>
            Riwayat Pasien
        </a>
    </div>

    
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Tanggal Daftar</th>
                            <th class="px-6 py-4">No. Antrian</th>
                            <th class="px-6 py-4">Pasien</th>
                            <th class="px-6 py-4">Keluhan</th>
                            <th class="px-6 py-4">Jadwal</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $antrians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $antrian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($antrian->created_at->format('d/m/Y')); ?>

                            </td>

                            <td class="px-6 py-4 font-bold text-[#2d4499]"><?php echo e($antrian->no_antrian); ?></td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800"><?php echo e($antrian->pasien->nama); ?></div>
                                <div class="text-xs text-slate-400">RM: <?php echo e($antrian->pasien->no_rm ?? '-'); ?></div>
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e(\Illuminate\Support\Str::limit($antrian->keluhan, 60)); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($antrian->jadwalPeriksa->hari); ?>,
                                <?php echo e(substr($antrian->jadwalPeriksa->jam_mulai, 0, 5)); ?>-<?php echo e(substr($antrian->jadwalPeriksa->jam_selesai, 0, 5)); ?>

                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="<?php echo e(route('periksa-pasien.create', $antrian->id)); ?>" class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b]
                                          text-white border-none rounded-lg px-4">
                                    <i class="fas fa-stethoscope"></i>
                                    Periksa
                                </a>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada pasien yang mengantri
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

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
<?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/dokter/periksa-pasien/index.blade.php ENDPATH**/ ?>