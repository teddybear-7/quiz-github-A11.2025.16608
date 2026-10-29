<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    public const BIAYA_JASA = 150000;

    protected $table = 'periksa';

    protected $casts = [
        'tgl_periksa' => 'datetime',
    ];

    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'bukti_pembayaran',
        'status_pembayaran',
    ];

    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }

    public function detailPeriksas()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksa', 'id_periksa', 'id_obat')
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}
