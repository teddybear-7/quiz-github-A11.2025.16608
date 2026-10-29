<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Pembayaran']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pembayaran']); ?>

    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Pembayaran
        </h2>
    </div>

    
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    
                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Tanggal Periksa</th>
                            <th class="px-6 py-4">Poli</th>
                            <th class="px-6 py-4">Dokter</th>
                            <th class="px-6 py-4">Total Biaya</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Bukti Pembayaran</th>
                        </tr>
                    </thead>

                    
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $tagihans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-500">
                                <?php echo e($loop->iteration); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($tagihan->tgl_periksa->format('d-m-Y H:i')); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($tagihan->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli); ?>

                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                <?php echo e($tagihan->daftarPoli->jadwalPeriksa->dokter->nama); ?>

                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                Rp <?php echo e(number_format($tagihan->biaya_periksa, 0, ',', '.')); ?>

                            </td>

                            <td class="px-6 py-4">
                                <?php if($tagihan->status_pembayaran === 'Lunas'): ?>
                                <span class="badge badge-success text-white">Lunas</span>
                                <?php elseif($tagihan->status_pembayaran === 'Menunggu Verifikasi'): ?>
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                                <?php else: ?>
                                <span class="badge badge-ghost">Belum Dibayar</span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-4">
                                <?php if($tagihan->status_pembayaran === 'Belum Dibayar'): ?>
                                <form action="<?php echo e(route('pembayaran.store', $tagihan->id)); ?>" method="POST"
                                    enctype="multipart/form-data" class="flex items-center gap-2">
                                    <?php echo csrf_field(); ?>
                                    <input type="file" name="bukti" accept="image/png,image/jpeg"
                                        class="file-input file-input-bordered file-input-sm w-56 <?php $__errorArgs = ['bukti'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> file-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        required>
                                    <button type="submit"
                                        class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-4">
                                        <i class="fas fa-upload"></i>
                                        Upload
                                    </button>
                                </form>
                                <?php $__errorArgs = ['bukti'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="label-text-alt text-red-500"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php else: ?>
                                <a href="<?php echo e(asset('storage/' . $tagihan->bukti_pembayaran)); ?>" target="_blank"
                                    class="btn btn-sm bg-slate-100 hover:bg-slate-200 text-slate-600 border-none rounded-lg px-4">
                                    <i class="fas fa-image"></i>
                                    Lihat Bukti
                                </a>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada tagihan
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
<?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/pasien/pembayaran/index.blade.php ENDPATH**/ ?>