<?php

namespace App\Events;

use App\Models\JadwalPeriksa;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AntrianDiperbarui implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public function __construct(public int $idJadwal)
    {
    }

    public function broadcastOn(): array
    {
        return [new Channel('antrian.' . $this->idJadwal)];
    }

    public function broadcastAs(): string
    {
        return 'antrian.diperbarui';
    }

    public function broadcastWith(): array
    {
        return [
            'id_jadwal'      => $this->idJadwal,
            'nomor_dilayani' => JadwalPeriksa::findOrFail($this->idJadwal)->nomorDilayani(),
        ];
    }
}
