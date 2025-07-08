<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'empresas';

    protected $fillable = [
        'nameempresa','rucempresa','razonsocial','direccionempresa','telefonoempresa','logoempresa',
        'nombrebanco','numero_cuenta','numero_cci','qr_yape','qr_plin'
    ];

    public function paquete()
    {
        return $this->hasMany(Paquetes::class, 'fk_idempresa');
    }

    public function promos()
    {
        return $this->hasMany(Promociones::class, 'fk_idempresa');
    }

    public function replegal()
    {
        return $this->hasMany(RepreLegal::class, 'fk_idempresa');
    }

    public function servicio()
    {
        return $this->hasMany(Servicios::class, 'fk_idempresa');
    }

    public function equipo()
    {
        return $this->hasMany(Equipos::class, 'fk_idempresa');
    }

    public function videos()
    {
        return $this->morphMany(Videos::class, 'videoable');
    }
    
    public function getVideoPrincipalAttribute()
    {
        return $this->videos()->where('tipo', 'principal')->first();
    }
}