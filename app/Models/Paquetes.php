<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paquetes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'paquetes';

    protected $fillable = [
        'preciopaquete','nombrepaquete','cantidadpaquete','descripcion','imagen_principal',
        'estado','fk_idempresa'	
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresas::class ,'fk_idempresa');
    }

    public function det_paquete()
    {
        return $this->hasMany('App\Models\DetallePaquetes', 'fk_idpaquete');
    }

    public function dis_paquete()
    {
        return $this->hasMany('App\Models\DisponibilidadPaquete', 'fk_idpaquete');
    }

    public function img_paquete()
    {
        return $this->hasMany('App\Models\ImagenPaquete', 'fk_idpaquete');
    }

    public function iti_paquete()
    {
        return $this->hasMany('App\Models\Itinerarios', 'fk_idpaquete');
    }

    public function equi_paquete()
    {
        return $this->hasMany('App\Models\PaqueteEquipos', 'fk_idpaquete');
    }

    public function ser_paquete()
    {
        return $this->hasMany('App\Models\PaqueteServicios', 'fk_idpaquete');
    }

    public function useritine()
    {
        return $this->hasMany('App\Models\UserItinerario', 'fk_idpaquete');
    }

    public function reservas()
    {
        return $this->hasMany('App\Models\Reservas', 'fk_idpaquete');
    }
}