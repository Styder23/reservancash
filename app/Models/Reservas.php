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
        'fechareserva','fk_idpaquete','fk_idusers'	
    ];

    public function paquete(){
        return $this->belongsTo(Paquetes::class, 'fk_idpaquete');
    }

    public function users(){
        return $this->belongsTo(Users::class, 'fk_idusers');
    }
}