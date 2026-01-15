<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;

    protected $table = 'usulans';

    // Allowed kategori usulan values for validation/UI use
    public const kategori_kegiatan = [
        'Pertemuan / Rapat',
        'Kunjungan Lapangan & Sasaran',
        'Monitoring & Evaluasi',
        'Belanja Barang',
        'Pelatihan / Peningkatan Kapasitas',
        'Lainnya',
    ];

    protected $fillable = [
        'responden_id',
        'indikator_id',
        'level_kegiatan',
        'kategori_kegiatan',
        'nama_kegiatan',
        'detail_kegiatan',
        'sasaran_kegiatan',
    ];

    protected $casts = [
        
    ];

    public function responden()
    {
        return $this->belongsTo(Responden::class, 'responden_id');
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'indikator_id');
    }

    public function reactions()
    {
        return $this->hasMany(UsulanReaction::class, 'usulan_id');
    }
}