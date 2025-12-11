<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $table = 'indikators';

    protected $fillable = [
        'nomor',
        'tingkat',
        'nama',
        'unit_timker',
        'is_RENSTRA',
        'is_RIBK',
        'is_RPJMN',
        'is_display'
    ];

    protected $casts = [
        'is_RENSTRA' => 'boolean',
        'is_RIBK' => 'boolean',
        'is_RPJMN' => 'boolean',
        'is_display' => 'boolean',
    ];

    public function usulan()
    {
        return $this->hasMany(Usulan::class, 'indikator_id');
    }
}