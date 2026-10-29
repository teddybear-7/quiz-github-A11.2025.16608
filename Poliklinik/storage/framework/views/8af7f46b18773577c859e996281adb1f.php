<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Data Dokter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Dokter']); ?>

    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Data Dokter
        </h2>

        <div class="flex gap-2">
            <a href="<?php echo e(route('dokter.export')); ?>"
                class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-semibold transition">
                <i class="fas fa-file-excel"></i>
                Export Excel
            </a>

            <a href="<?php echo e(route('dokter.create')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary/90 
                      text-white rounded-xl text-sm font-semibold transition">
                <i class="fas fa-plus text-sm"></i>
                Tambah Dokter
            </a>
        </div>
    </div>

    
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table w-full">

                    
                    <thead class="bg-slate-100 text-slate-600 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Nama Dokter</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">No. KTP</th>
                            <th class="px-6 py-4">No. HP</th>
                            <th class="px-6 py-4">Alamat</th>
                            <th class="px-6 py-4">Poli</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    
                    <tbody class="text-sm text-slate-700">

                        <?php $__empty_1 = true; $__currentLoopData = $dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dokter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                <?php echo e($dokter->nama); ?>

                            </td>

                            <td class="px-6 py-4">
                                <?php echo e($dokter->email); ?>

                            </td>

                            <td class="px-6 py-4">
                                <?php echo e($dokter->no_ktp ?? '-'); ?>

                            </td>

                            <td class="px-6 py-4">
                                <?php echo e($dokter->no_hp ?? '-'); ?>

                            </td>

                            <td class="px-6 py-4">
                                <?php echo e($dokter->alamat ?? '-'); ?>

                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                    <?php echo e($dokter->poli->nama_poli ?? 'Belum Dipilih'); ?>

                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">

                                    
                                    <a href="<?php echo e(route('dokter.edit', $dokter->id)); ?>" class="inline-flex items-center gap-1 px-3 py-2 
                                        bg-amber-500 hover:bg-amber-600 
                                        text-white rounded-lg text-xs font-semibold transition">
                                        <i class="fas fa-pen-to-square text-xs"></i>
                                        Edit
                                    </a>

                                    
                                    <form action="<?php echo e(route('dokter.destroy', $dokter->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus dokter ini?')" class="inline-flex items-center gap-1 px-3 py-2 
                                             bg-red-500 hover:bg-red-600 
                                             text-white rounded-lg text-xs font-semibold transition">
                                            <i class="fas fa-trash text-xs"></i>
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-16 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada data dokter
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/admin/dokter/index.blade.php ENDPATH**/ ?>