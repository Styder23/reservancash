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
        'nameempresa','rucempresa','razonsocial','direccionempresa','telefonoempresa','logoempresa'
    ];

    public function paquete()
    {
        return $this->hasMany('App\Models\Paquetes', 'fk_idempresa');
    }

    public function promos()
    {
        return $this->hasMany('App\Models\Promociones', 'fk_idempresa');
    }

    public function replegal()
    {
        return $this->hasMany('App\Models\RepreLegal', 'fk_idempresa');
    }

    public function servicio()
    {
        return $this->hasMany('App\Models\Servicios', 'fk_idempresa');
    }

    public function equipo()
    {
        return $this->hasMany('App\Models\Equipos', 'fk_idempresa');
    }
}