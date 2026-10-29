<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Verifikasi Pembayaran']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Verifikasi Pembayaran']); ?>

    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Verifikasi Pembayaran
        </h2>
    </div>

    
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    
                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Pasien</th>
                            <th class="px-6 py-4">Poli</th>
                            <th class="px-6 py-4">Tanggal Periksa</th>
                            <th class="px-6 py-4">Total Biaya</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $tagihans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-500">
                                <?php echo e($loop->iteration); ?>

                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                <?php echo e($tagihan->daftarPoli->pasien->nama); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($tagihan->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($tagihan->tgl_periksa->format('d-m-Y H:i')); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                Rp <?php echo e(number_format($tagihan->biaya_periksa, 0, ',', '.')); ?>

                            </td>

                            <td class="px-6 py-4">
                                <?php if($tagihan->status_pembayaran === 'Lunas'): ?>
                                <span class="badge badge-success text-white">Lunas</span>
                                <?php else: ?>
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">

                                    
                                    <a href="<?php echo e(asset('storage/' . $tagihan->bukti_pembayaran)); ?>" target="_blank"
                                        class="btn btn-sm bg-slate-100 hover:bg-slate-200 text-slate-600 border-none rounded-lg px-4">
                                        <i class="fas fa-image"></i>
                                        Lihat Bukti
                                    </a>

                                    
                                    <?php if($tagihan->status_pembayaran === 'Menunggu Verifikasi'): ?>
                                    <form action="<?php echo e(route('verifikasi-pembayaran.update', $tagihan->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit"
                                            onclick="return confirm('Yakin pembayaran ini sudah sesuai?')"
                                            class="btn btn-sm bg-emerald-600 hover:bg-emerald-700 text-white border-none rounded-lg px-4">
                                            <i class="fas fa-check"></i>
                                            Verifikasi
                                        </button>
                                    </form>
                                    <?php endif; ?>

                                </div>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada pembayaran yang perlu diverifikasi
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
<?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/admin/pembayaran/index.blade.php ENDPATH**/ ?>