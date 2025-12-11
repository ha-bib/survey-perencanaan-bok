<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responden extends Model
{
    protected $table = 'respondens';

    protected $fillable = [
        'nama',
        'instansi',
        'jabatan',
    ];

    public function usulans()
    {
        return $this->hasMany(Usulan::class, 'responden_id');
    }
}
