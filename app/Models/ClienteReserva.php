<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClienteReserva extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'cliente_reserva';

    protected $fillable = [
        'fechareserva','estado','confirmado_por_empresa','notas','fk_idpaquetecliente',
        'fk_idusers'
    ];

    public function cli_paquete(){

        return $this->belongsTo(ClientePaquete::class ,'fk_idpaquetecliente');
    }

    public function users(){

        return $this->belongsTo(User::class ,'fk_idusers');
    }
}