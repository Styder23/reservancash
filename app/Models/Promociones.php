<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promociones extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'promociones';

    protected $fillable = [
        'namepromocion','descripcion','descuento','fechainicio','fechafin','estado','fk_idempresa'	
    ];

    public function empresa(){
        return $this->belongsTo(Empresas::class, 'fk_idempresa');
    }

    public function imagenes()
    {
        return $this->morphMany(imagenes::class, 'imageable');
    }

    public function videos()
    {
        return $this->morphMany(Videos::class, 'videoable');
    }
}