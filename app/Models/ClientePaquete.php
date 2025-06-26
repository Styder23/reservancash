<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientePaquete extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'cliente_paquete';

    protected $fillable = [
        'preciototal','fechacreacion','estado','fk_iduser','fk_idpaquete'
    ];

    public function users(){

        return $this->belongsTo(User::class ,'fk_iduser');
    }

    public function paquetes(){

        return $this->belongsTo(Paquetes::class ,'fk_idpaquete');
    }

    public function servicios()
    {
        return $this->hasMany(ClienteServicio::class, 'fk_idclientepaquete');
    }

    public function equipos()
    {
        return $this->hasMany(ClienteEquipo::class, 'fk_idclientepaquete');
    }

    public function destinos()
    {
        return $this->hasMany(ClienteDestino::class, 'fk_idclientepaquete');
    }

    public function reserva()
    {
        return $this->hasOne(ClienteReserva::class, 'fk_idpaquetecliente');
    }
}