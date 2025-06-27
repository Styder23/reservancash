<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Servicio extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'detalle_servicios';

    protected $fillable = [
        'nombreservicio','descripcionservicio','imageneservicio','precioservicio','fk_idtiposervicio'
    ];

    public function tiposervicio()
    {
        return $this->belongsTo(TipoServicios::class ,'fk_idtiposervicio');
    }

    public function servicios()
    {
        return $this->hasMany('App\Models\Servicios', 'fk_iddetalle_servicios');
    }

    public function imagenes()
    {
        return $this->morphMany(imagenes::class, 'imageable');
    }

    public function imagenPrincipal()
    {
        return $this->morphOne(imagenes::class, 'imageable')->where('tipo', 'principal');
    }
    
    public function favoritos()
    {
        return $this->morphMany(favoritos::class, 'favoritable');
    }
}