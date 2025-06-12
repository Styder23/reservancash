<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distritos extends Model
{
    use HasFactory;

    protected $fillable = [
        'namedistrito','fk_idprovincia'		
    ];

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincias', 'fk_idprovincia');
    }
    public function destinos()
    {
        return $this->hasMany('App\Models\Destinos', 'fk_iddistrito');
    }
}