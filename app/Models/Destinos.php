<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'namedestino','descripciondestino','imagenes','ubicaciondestino','fk_iddistrito','fk_idtipodestino'	
    ];

    protected $casts = [
        'ubicacion' => 'array'
    ];

    public function distrito()
    {
        return $this->belongsTo(Distritos::class ,'fk_iddistrito');
    }
    public function tipoDestino()
    {
        return $this->belongsTo(TipoDestinos::class, 'fk_idtipodestino');
    }
}