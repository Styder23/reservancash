<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaqueteEquipos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'paquete_equipo';

    protected $fillable = [
        'fk_idpaquete','fk_idequipo'	
    ];

    public function paquete()
    {
        return $this->belongsTo(Paquetes::class ,'fk_idpaquete');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipos::class ,'fk_idequipo');
    }
}