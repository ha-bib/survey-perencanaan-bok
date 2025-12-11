<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;

    protected $table = 'usulans';

    protected $fillable = [
        'responden_id',
        'indikator_id',
        'tingkat_bok',
        'saran_kegiatan',
        'detail_kegiatan',
        'keriteria_penerima_bok',
        'volume',
        'volume_satuan',
        'frekuensi_tahun',
        'output',
        'output_satuan',
        'anggaran'
    ];

    protected $casts = [
        'volume' => 'integer',
        'frekuensi_tahun' => 'integer',
        'anggaran' => 'integer'
    ];

    public function responden()
    {
        return $this->belongsTo(Responden::class, 'responden_id');
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'indikator_id');
    }
}