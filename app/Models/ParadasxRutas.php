<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParadasxRutas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'rutasparadas';

    protected $fillable = [
        'ordenparada',
        'fk_idruta',
        'fk_idparada'
    ];

    public function ruta()
    {
        return $this->belongsTo(Rutas::class, 'fk_idruta');
    }

    public function paradas()
    {
        return $this->belongsTo(Paradas::class, 'fk_idparada');
    }

    public function parada()
    {
        return $this->belongsTo(\App\Models\Paradas::class, 'fk_idparada');
    }
}
