<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetallePaquetes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'detalle_paquetes';

    protected $fillable = [
        'descripciondetalle',
        'precioequipo',
        'precioservicio',
        'preciototal',
        'fk_idpaquete',
        'fk_iddestino',
        'fk_idpromociones'
    ];

    public function paquete()
    {
        return $this->belongsTo(Paquetes::class, 'fk_idpaquete');
    }

    public function destino()
    {
        return $this->belongsTo(Destinos::class, 'fk_iddestino');
    }

    public function promos()
    {
        return $this->belongsTo(Promociones::class, 'fk_idpromociones');
    }

    public function favoritos()
    {
        return $this->morphMany(favoritos::class, 'favoritable');
    }

    public function promocion()
    {
        return $this->belongsTo(\App\Models\Promociones::class, 'fk_idpromociones');
    }
}