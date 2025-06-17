<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServicios extends Model
{
    use HasFactory;

    protected $table='tipo_servicios';
    protected $fillable = [
        'nametipo_servicios',
    ];

    public function det_servicios()
    {
        return $this->hasMany('App\Models\Detalle_Servicio', 'fk_idtiposervicio');
    }
}