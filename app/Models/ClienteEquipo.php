<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClienteEquipo extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'cliente_equipo';

    protected $fillable = [
        'fk_idclientepaquete','fk_idequipo'
    ];

    public function cli_paquete(){

        return $this->belongsTo(ClientePaquete::class ,'fk_idclientepaquete');
    }

    public function cli_equipo(){

        return $this->belongsTo(Equipos::class ,'fk_idequipo');
    }
}