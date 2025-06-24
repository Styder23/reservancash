<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserItinerario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user_itinerario';

    protected $fillable = [
        'comentario','fecha','foto','fk_idusers','fk_idpaquete'	
    ];

    public function users(){
        return $this->belongsTo(User::class, 'fk_idusers');
    }

    public function paquete(){
        return $this->belongsTo(Paquetes::class, 'fk_idpaquete');
    }
}