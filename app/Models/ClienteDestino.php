<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClienteDestino extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'cliente_destinos';

    protected $fillable = [
        'fk_idclientepaquete','fk_iddestino'
    ];

    public function cli_paquete(){

        return $this->belongsTo(ClientePaquete::class ,'fk_idclientepaquete');
    }

    public function cli_destino(){

        return $this->belongsTo(Destinos::class ,'fk_iddestino');
    }
}