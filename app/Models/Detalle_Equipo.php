<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Equipo extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'detalle_equipos';

    protected $fillable = [
        'name_equipo','descripcion_equipo','precio_equipo','imagenes_equipo','fk_idcategoria','fk_idserie',
        'fk_idmarca','fk_idmodelo','fk_idtipoequipo'
    ];

    public function modelo()
    {
        return $this->belongsTo(Modelo::class ,'fk_idmodelo');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class ,'fk_idmarca');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class ,'fk_idserie');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class ,'fk_idcategoria');
    }

    public function tipoequipo()
    {
        return $this->belongsTo(TipoEquipo::class ,'fk_idtipoequipo');
    }

    public function equipos()
    {
        return $this->hasMany('App\Models\Equipos', 'fk_iddetalle_equipo');
    }
}