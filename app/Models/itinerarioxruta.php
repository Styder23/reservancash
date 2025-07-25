<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class itinerarioxruta extends Model
{
    public $timestamps = false;
    protected $table = 'itinerarios_ruta';

    protected $fillable = [
        'fk_iditinerario',
        'fk_idruta'
    ];

    public function itinerario()
    {
        return $this->belongsTo(Itinerarios::class, 'fk_iditinerario');
    }

    public function ruta()
    {
        return $this->belongsTo(Rutas::class, 'fk_idruta');
    }

    public function itinerariosRutas()
    {
        return $this->hasMany(\App\Models\itinerarioxruta::class, 'fk_iditinerario');
    }
}
