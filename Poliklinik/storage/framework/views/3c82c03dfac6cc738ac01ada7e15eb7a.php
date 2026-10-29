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

    
    <div class="flex items-center gap-3 mb-6">
        <a href="<?php echo e(route('periksa-pasien.index')); ?>"
            class="flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
            <i class="fas fa-arrow-left text-xs"></i>
        </a>
        <h2 class="text-xl font-bold text-slate-800">
            Periksa Pasien
        </h2>
    </div>

    
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 text-sm">
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Pasien</div>
                    <div class="font-semibold text-slate-800"><?php echo e($daftarPoli->pasien->nama); ?></div>
                    <div class="text-slate-500">RM: <?php echo e($daftarPoli->pasien->no_rm ?? '-'); ?></div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">No. Antrian</div>
                    <div class="text-2xl font-extrabold text-[#2d4499]"><?php echo e($daftarPoli->no_antrian); ?></div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Keluhan</div>
                    <div class="text-slate-700 whitespace-pre-line"><?php echo e($daftarPoli->keluhan); ?></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7">

            <form action="<?php echo e(route('periksa-pasien.store', $daftarPoli->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Tanggal Periksa <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input type="text" name="tgl_periksa"
                        value="<?php echo e(old('tgl_periksa', now()->format('Y-m-d H:i'))); ?>"
                        class="tgl-picker input input-bordered w-full rounded-lg text-sm <?php $__errorArgs = ['tgl_periksa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>

                    <?php $__errorArgs = ['tgl_periksa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500"><?php echo e($message); ?></span>
                    </label>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Catatan Pemeriksaan <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <textarea name="catatan" rows="4" maxlength="1000" placeholder="Diagnosa, tindakan, dan anjuran..."
                        class="textarea textarea-bordered w-full rounded-lg text-sm resize-none <?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> textarea-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required><?php echo e(old('catatan')); ?></textarea>

                    <?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500"><?php echo e($message); ?></span>
                    </label>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">Obat dan jumlah yang harus dibeli (opsional)</span>
                    </label>

                    <div class="border border-slate-200 rounded-lg divide-y divide-slate-100 max-h-72 overflow-y-auto">
                        <?php $__empty_1 = true; $__currentLoopData = $obats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $obat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50">
                            <label class="flex items-center gap-3 flex-1 cursor-pointer">
                                <input type="checkbox" name="obat[]" value="<?php echo e($obat->id); ?>" data-harga="<?php echo e($obat->harga); ?>"
                                    class="checkbox checkbox-sm obat-check"
                                    <?php echo e($obat->stok < 1 ? 'disabled' : ''); ?>

                                    <?php echo e(in_array($obat->id, old('obat', [])) ? 'checked' : ''); ?>>
                                <span class="flex-1">
                                    <span class="font-semibold text-slate-800 text-sm"><?php echo e($obat->nama_obat); ?></span>
                                    <span class="text-xs text-slate-400 ml-1"><?php echo e($obat->kemasan); ?></span>
                                    <span class="block text-xs <?php echo e($obat->stok < 1 ? 'text-red-500' : 'text-slate-400'); ?>">
                                        <?php echo e($obat->stok < 1 ? 'Stok habis' : 'Stok: ' . $obat->stok); ?>

                                    </span>
                                </span>
                            </label>

                            <div class="flex items-center gap-2">
                                <span class="text-xs text-slate-400">Jumlah</span>
                                <input type="number" name="jumlah[<?php echo e($obat->id); ?>]" min="1" max="<?php echo e($obat->stok); ?>" step="1"
                                    value="<?php echo e(old('jumlah.' . $obat->id, 1)); ?>"
                                    class="input input-bordered input-sm w-20 rounded-lg text-sm obat-jumlah" disabled>
                            </div>

                            <span class="text-sm text-slate-600 w-28 text-right">Rp <?php echo e(number_format($obat->harga, 0, ',', '.')); ?></span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="px-4 py-6 text-center text-slate-400 text-sm">Belum ada data obat</div>
                        <?php endif; ?>
                    </div>

                    <?php $__errorArgs = ['obat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500"><?php echo e($message); ?></span>
                    </label>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['obat.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500"><?php echo e($message); ?></span>
                    </label>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['jumlah.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500"><?php echo e($message); ?></span>
                    </label>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="flex items-center justify-between bg-slate-50 rounded-lg px-5 py-4 mb-6 text-sm">
                    <div class="text-slate-500">
                        Jasa dokter Rp <?php echo e(number_format(\App\Models\Periksa::BIAYA_JASA, 0, ',', '.')); ?> + total obat
                    </div>
                    <div class="font-bold text-slate-800 text-lg">
                        Total: Rp <span id="totalBiaya"><?php echo e(number_format(\App\Models\Periksa::BIAYA_JASA, 0, ',', '.')); ?></span>
                    </div>
                </div>

                
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-save"></i>
                        Simpan Pemeriksaan
                    </button>

                    <a href="<?php echo e(route('periksa-pasien.index')); ?>"
                        class="flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-lg text-sm font-semibold transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">

    <?php $__env->startPush('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script>
        flatpickr('.tgl-picker', {
            enableTime: true,
            time_24hr: true,
            dateFormat: 'Y-m-d H:i'
        });

        (function () {
            var jasa = <?php echo e(\App\Models\Periksa::BIAYA_JASA); ?>;
            var checks = document.querySelectorAll('.obat-check');
            var out = document.getElementById('totalBiaya');

            function hitung() {
                var total = jasa;
                checks.forEach(function (c) {
                    var jumlah = c.closest('div.flex').querySelector('.obat-jumlah');
                    jumlah.disabled = !c.checked;
                    if (c.checked) total += (parseInt(c.dataset.harga, 10) || 0) * (parseInt(jumlah.value, 10) || 0);
                });
                out.textContent = total.toLocaleString('id-ID');
            }

            checks.forEach(function (c) { c.addEventListener('change', hitung); });
            document.querySelectorAll('.obat-jumlah').forEach(function (j) { j.addEventListener('input', hitung); });
            hitung();
        })();
    </script>
    <?php $__env->stopPush(); ?>

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
<?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/dokter/periksa-pasien/create.blade.php ENDPATH**/ ?>