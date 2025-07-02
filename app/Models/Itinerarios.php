<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerarios extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'itinerarios';

    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_fin',
        'descripcion',
        'fk_idpaquete'
    ];

    public function paquete()
    {
        return $this->belongsTo(Paquetes::class, 'fk_idpaquete');
    }

    public function itinixrutas()
    {
        return $this->hasMany('App\Models\itinerarioxruta', 'fk_iditinerario');
    }

    public function itinerariosRutas()
    {
        return $this->hasMany(\App\Models\itinerarioxruta::class, 'fk_iditinerario');
    }



    
}
