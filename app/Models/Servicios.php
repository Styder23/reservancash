<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'servicios';

    protected $fillable = [
        'cantidadservicio','fk_iddetalle_servicios','fk_idempresa'	
    ];

    public function Det_servicio()
    {
        return $this->belongsTo(Detalle_Servicio::class ,'fk_iddetalle_servicios');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresas::class ,'fk_idempresa');
    }

    public function ser_paquete()
    {
        return $this->hasMany('App\Models\PaqueteServicios', 'fk_idservicio');
    }

}