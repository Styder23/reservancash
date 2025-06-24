<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisponibilidadPaquete extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'paquete_disponibilidad';

    protected $fillable = [
        'fecha_inicio','fecha_fin','cupo','fk_idpaquete'
    ];

    public function paquete()
    {
        return $this->belongsTo(Paquetes::class ,'fk_idpaquete');
    }
}