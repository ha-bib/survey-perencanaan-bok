<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsulanReaction extends Model
{
    protected $table = 'usulan_reactions';

    protected $fillable = [
        'usulan_id',
        'responden_id',
        'reaction',
    ];

    public function usulan()
    {
        return $this->belongsTo(Usulan::class);
    }

    public function responden()
    {
        return $this->belongsTo(Responden::class);
    }
}
