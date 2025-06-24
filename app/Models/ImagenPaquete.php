<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagenPaquete extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'imagenes_paquete';

    protected $fillable = [
        'ruta_imagen','descripcion','fk_idpaquete'
    ];

    public function paquete()
    {
        return $this->belongsTo(Paquetes::class ,'fk_idpaquete');
    }
}