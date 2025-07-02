<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEquipo extends Model
{
    use HasFactory;

    protected $table='tipoequipos';
    public $timestamps = false;
    
    protected $fillable = [
        'nametipoequipos',
    ];

    public function det_equipos()
    {
        return $this->hasMany('App\Models\Detalle_Equipo', 'fk_idtipoequipo');
    }
}