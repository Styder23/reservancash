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
        'preciopaquete','nombrepaquete','descripcion','imagen_principal',
        'estado','fk_idempresa','precio_base','personas_incluidas','precio_extra_persona'	
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

    public function imagenes()
    {
        return $this->morphMany(imagenes::class, 'imageable');
    }

    // CORREGIDO: Para que coincida con la vista
    public function itinerarios()
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

    public function favoritos()
    {
        return $this->morphMany(favoritos::class, 'favoritable');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicios::class, 'paquete_servicio', 'fk_idpaquete', 'fk_idservicio');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipos::class, 'paquete_equipo', 'fk_idpaquete', 'fk_idequipo');
    }

    // Funcion para buscar paquetes por nombre
    public function detalles()
    {
        return $this->hasMany(\App\Models\DetallePaquetes::class, 'fk_idpaquete');
    }
}