<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClienteServicio extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'cliente_servicio';

    protected $fillable = [
        'fk_idclientepaquete','fk_idservicio'
    ];

    public function cli_paquete(){

        return $this->belongsTo(ClientePaquete::class ,'fk_idclientepaquete');
    }

    public function cli_equipo(){

        return $this->belongsTo(Servicios::class ,'fk_idservicio');
    }
}