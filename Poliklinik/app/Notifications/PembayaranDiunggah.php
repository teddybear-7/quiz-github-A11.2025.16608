<?php

namespace App\Notifications;

use App\Models\Periksa;
use Illuminate\Notifications\Notification;

class PembayaranDiunggah extends Notification
{
    public function __construct(public Periksa $periksa)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $pasien = $this->periksa->daftarPoli->pasien;

        return [
            'judul' => 'Bukti pembayaran diunggah',
            'pesan' => $pasien->nama . ' telah mengunggah bukti pembayaran.',
            'url'   => route('riwayat-pasien.show', $this->periksa->id),
        ];
    }
}
