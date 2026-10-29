<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Riwayat Pendaftaran']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Riwayat Pendaftaran']); ?>

    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Riwayat Pendaftaran
        </h2>

        <a href="<?php echo e(route('daftar-poli.index')); ?>" class="btn bg-[#2d4499] hover:bg-[#1e2d6b]
                  text-white border-none rounded-lg px-5">
            <i class="fas fa-plus"></i>
            Daftar Poli
        </a>
    </div>

    
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Tanggal Daftar</th>
                            <th class="px-6 py-4">Poli</th>
                            <th class="px-6 py-4">Dokter</th>
                            <th class="px-6 py-4">Jadwal</th>
                            <th class="px-6 py-4">No. Antrian</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $riwayats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $riwayat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-500"><?php echo e($loop->iteration); ?></td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($riwayat->created_at->format('d/m/Y')); ?>

                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                <?php echo e($riwayat->jadwalPeriksa->dokter->poli->nama_poli ?? '-'); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($riwayat->jadwalPeriksa->dokter->nama ?? '-'); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($riwayat->jadwalPeriksa->hari); ?>,
                                <?php echo e(substr($riwayat->jadwalPeriksa->jam_mulai, 0, 5)); ?>-<?php echo e(substr($riwayat->jadwalPeriksa->jam_selesai, 0, 5)); ?>

                            </td>

                            <td class="px-6 py-4 font-bold text-[#2d4499]"><?php echo e($riwayat->no_antrian); ?></td>

                            <td class="px-6 py-4">
                                <?php if($riwayat->periksa): ?>
                                <span class="badge badge-success text-white">Sudah diperiksa</span>
                                <?php else: ?>
                                <span class="badge badge-warning">Belum diperiksa</span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <?php if($riwayat->periksa): ?>
                                <a href="<?php echo e(route('riwayat-pendaftaran.show', $riwayat->periksa->id)); ?>" class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b]
                                          text-white border-none rounded-lg px-4">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                                <?php else: ?>
                                <span class="text-slate-300">-</span>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada riwayat pendaftaran
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
<?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/pasien/riwayat/index.blade.php ENDPATH**/ ?>