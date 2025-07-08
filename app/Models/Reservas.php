<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'reservas';

    protected $fillable = [
        'fechareserva','fecha_viaje','fk_idpaquete','fk_idusers','cantidad_personas','estado','metodo_pago',
        'total_pago','notas','motivo_cliente','fecha_solicitud_cancelacion'	
    ];
    
    protected $dates = [
        'fechareserva',
        'fecha_viaje',
        'created_at'
    ];

    public function paquete(){
        return $this->belongsTo(Paquetes::class, 'fk_idpaquete');
    }

    public function users(){
        return $this->belongsTo(User::class, 'fk_idusers');
    }

    public function pago()
    {
        return $this->hasOne(Pagos::class, 'fk_idreserva');
    }
}