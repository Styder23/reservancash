<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaqueteServicios extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'paquete_servicio';

    protected $fillable = [
        'fk_idpaquete','fk_idservicio'	
    ];

    public function paquete()
    {
        return $this->belongsTo(Paquetes::class ,'fk_idpaquete');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicios::class ,'fk_idservicio');
    }
}