<?php

namespace App\Notifications;

use App\Models\Periksa;
use Illuminate\Notifications\Notification;

class PembayaranDiverifikasi extends Notification
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
        return [
            'judul' => 'Pembayaran diverifikasi',
            'pesan' => 'Pembayaran pemeriksaan Anda telah diverifikasi oleh admin.',
            'url'   => route('riwayat-pendaftaran.show', $this->periksa->id),
        ];
    }
}
