<?php
    $daftar = $periksa->daftarPoli;
    $jadwal = $daftar->jadwalPeriksa;
    $totalObat = $periksa->obats->sum(fn ($o) => $o->harga * $o->pivot->jumlah);
?>

<div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
    <div class="card-body p-7">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 text-sm">
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Pasien</div>
                <div class="font-semibold text-slate-800"><?php echo e($daftar->pasien->nama); ?></div>
                <div class="text-slate-500">RM: <?php echo e($daftar->pasien->no_rm ?? '-'); ?></div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Poli</div>
                <div class="font-semibold text-slate-800"><?php echo e($jadwal->dokter->poli->nama_poli ?? '-'); ?></div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Dokter</div>
                <div class="font-semibold text-slate-800"><?php echo e($jadwal->dokter->nama); ?></div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Jadwal</div>
                <div class="font-semibold text-slate-800">
                    <?php echo e($jadwal->hari); ?>, <?php echo e(substr($jadwal->jam_mulai, 0, 5)); ?>-<?php echo e(substr($jadwal->jam_selesai, 0, 5)); ?>

                </div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">No. Antrian</div>
                <div class="font-semibold text-slate-800"><?php echo e($daftar->no_antrian); ?></div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Tanggal Periksa</div>
                <div class="font-semibold text-slate-800"><?php echo e($periksa->tgl_periksa?->format('d/m/Y H:i')); ?></div>
            </div>
        </div>

        <div class="divider my-2"></div>

        <div class="mb-4">
            <div class="text-xs uppercase tracking-wider text-slate-400 mb-1">Keluhan</div>
            <p class="text-slate-700 whitespace-pre-line"><?php echo e($daftar->keluhan); ?></p>
        </div>

        <div>
            <div class="text-xs uppercase tracking-wider text-slate-400 mb-1">Catatan Dokter</div>
            <p class="text-slate-700 whitespace-pre-line"><?php echo e($periksa->catatan ?: '-'); ?></p>
        </div>
    </div>
</div>

<div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
    <div class="card-body p-0">
        <div class="px-7 pt-6 pb-2 font-bold text-slate-800">Obat yang Diberikan</div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Obat</th>
                        <th class="px-6 py-3">Kemasan</th>
                        <th class="px-6 py-3 text-right">Harga</th>
                        <th class="px-6 py-3 text-right">Jumlah</th>
                        <th class="px-6 py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $periksa->obats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $obat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-3 text-slate-500"><?php echo e($loop->iteration); ?></td>
                        <td class="px-6 py-3 font-semibold text-slate-800"><?php echo e($obat->nama_obat); ?></td>
                        <td class="px-6 py-3 text-slate-500"><?php echo e($obat->kemasan); ?></td>
                        <td class="px-6 py-3 text-right text-slate-700">Rp <?php echo e(number_format($obat->harga, 0, ',', '.')); ?></td>
                        <td class="px-6 py-3 text-right text-slate-700"><?php echo e($obat->pivot->jumlah); ?></td>
                        <td class="px-6 py-3 text-right text-slate-700">Rp <?php echo e(number_format($obat->harga * $obat->pivot->jumlah, 0, ',', '.')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-8 text-slate-400">Tidak ada obat yang diberikan</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="px-7 py-5 border-t border-slate-100 text-sm">
            <div class="flex justify-between text-slate-500">
                <span>Jasa dokter</span>
                <span>Rp <?php echo e(number_format(\App\Models\Periksa::BIAYA_JASA, 0, ',', '.')); ?></span>
            </div>
            <div class="flex justify-between text-slate-500">
                <span>Total obat</span>
                <span>Rp <?php echo e(number_format($totalObat, 0, ',', '.')); ?></span>
            </div>
            <div class="flex justify-between font-bold text-slate-800 text-base mt-2">
                <span>Total Biaya</span>
                <span>Rp <?php echo e(number_format($periksa->biaya_periksa, 0, ',', '.')); ?></span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/components/partials/detail-periksa.blade.php ENDPATH**/ ?>