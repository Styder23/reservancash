<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDestinos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nametipo_destinos'		
    ];

    public function destinos()
    {
        return $this->hasMany('App\Models\Destinos', 'fk_idtipodestino');
    }
}