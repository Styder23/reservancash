<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'equipos';

    protected $fillable = [
        'cantidadequipo','fk_iddetalle_equipo','fk_idempresa'	
    ];

    public function Det_equipo()
    {
        return $this->belongsTo(Detalle_Equipo::class ,'fk_iddetalle_equipo');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresas::class ,'fk_idempresa');
    }
    
    public function equi_paquete()
    {
        return $this->hasMany('App\Models\PaqueteEquipos', 'fk_idequipo');
    }

}