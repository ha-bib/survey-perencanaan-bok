<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;

    protected $table = 'usulans';

    // Allowed kategori usulan values for validation/UI use
    public const KATEGORI_USULAN = [
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
        'tingkat_bok',
        'kategori_usulan',
        'rincian_menu',
        'detail_kegiatan',
        'sasaran_rincian_menu',
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