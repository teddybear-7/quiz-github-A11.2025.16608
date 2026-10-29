<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Daftar Poli']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Poli']); ?>

    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Daftar Poli
        </h2>

        <a href="<?php echo e(route('riwayat-pendaftaran.index')); ?>"
            class="flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">
            <i class="fas fa-clock-rotate-left"></i>
            Riwayat Pendaftaran
        </a>
    </div>

    
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Nama Pasien</div>
                    <div class="font-semibold text-slate-800"><?php echo e(auth()->user()->nama); ?></div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">No. Rekam Medis</div>
                    <div class="font-semibold text-slate-800"><?php echo e(auth()->user()->no_rm ?? '-'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php if($aktif): ?>
    <div class="card bg-base-100 shadow-md rounded-2xl border border-amber-300">
        <div class="card-body p-7">
            <div class="flex items-center gap-2 mb-4">
                <i class="fas fa-ticket text-amber-500"></i>
                <h3 class="font-bold text-slate-800">Anda sudah terdaftar</h3>
                <span class="badge badge-warning">Belum diperiksa</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 text-sm">
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Poli</div>
                    <div class="font-semibold text-slate-800"><?php echo e($aktif->jadwalPeriksa->dokter->poli->nama_poli); ?></div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Dokter</div>
                    <div class="font-semibold text-slate-800"><?php echo e($aktif->jadwalPeriksa->dokter->nama); ?></div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Jadwal</div>
                    <div class="font-semibold text-slate-800">
                        <?php echo e($aktif->jadwalPeriksa->hari); ?>,
                        <?php echo e(substr($aktif->jadwalPeriksa->jam_mulai, 0, 5)); ?> - <?php echo e(substr($aktif->jadwalPeriksa->jam_selesai, 0, 5)); ?>

                    </div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">No. Antrian</div>
                    <div class="text-3xl font-extrabold text-[#2d4499]"><?php echo e($aktif->no_antrian); ?></div>
                </div>
            </div>

            <p class="text-sm text-slate-500 mt-5">
                Anda baru bisa mendaftar lagi setelah pemeriksaan ini selesai.
            </p>
        </div>
    </div>

    <?php elseif($jadwals->isEmpty()): ?>
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7 text-center text-slate-400 py-14">
            <i class="fas fa-calendar-xmark text-3xl mb-3 block"></i>
            Belum ada jadwal dokter yang aktif. Silakan coba lagi nanti.
        </div>
    </div>

    <?php else: ?>
    
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7">

            <form action="<?php echo e(route('daftar-poli.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Poli dan Jadwal Dokter <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <select name="id_jadwal"
                        class="select select-bordered w-full rounded-lg text-sm <?php $__errorArgs = ['id_jadwal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> select-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                        <option value="" disabled <?php echo e(old('id_jadwal') ? '' : 'selected'); ?>>Pilih poli dan jadwal dokter</option>
                        <?php $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namaPoli => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <optgroup label="<?php echo e($namaPoli); ?>">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jadwal->id); ?>" <?php echo e((string) old('id_jadwal') === (string) $jadwal->id ? 'selected' : ''); ?>>
                                <?php echo e($jadwal->dokter->nama); ?> - <?php echo e($jadwal->hari); ?>,
                                <?php echo e(substr($jadwal->jam_mulai, 0, 5)); ?>-<?php echo e(substr($jadwal->jam_selesai, 0, 5)); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <?php $__errorArgs = ['id_jadwal'];
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

                
                <div class="form-control mb-6">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Keluhan <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <textarea name="keluhan" rows="4" maxlength="1000" placeholder="Tuliskan keluhan Anda..."
                        class="textarea textarea-bordered w-full rounded-lg text-sm resize-none <?php $__errorArgs = ['keluhan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> textarea-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required><?php echo e(old('keluhan')); ?></textarea>

                    <?php $__errorArgs = ['keluhan'];
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

                <button type="submit"
                    class="flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                    <i class="fas fa-paper-plane"></i>
                    Daftar
                </button>

            </form>
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
<?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/pasien/daftar-poli/index.blade.php ENDPATH**/ ?>