<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RespuestasComentarios extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'table_respuestacomentario';

    protected $fillable = [
        'fk_idcomentario','fk_idusers','respuesta','fecha_respuesta'	
    ];

    protected $casts = [
        'fecha_respuesta' => 'datetime'
    ];

    public function comentario()
    {
        return $this->belongsTo(UserItinerario::class, 'fk_idcomentario'); 
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_idusers'); 
    }
}