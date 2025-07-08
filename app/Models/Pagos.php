<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'table_pagos';

    protected $fillable = [
        'metodo','comprobante_pago','estado','fecha_pago','fk_idreserva'	
    ];

    protected $casts = [
        'fecha_pago' => 'datetime',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reservas::class, 'fk_idreserva');
    }
}