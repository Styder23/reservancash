<?php






namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'namemodelo',
    ];

    public function det_equipos()
    {
        return $this->hasMany('App\Models\Detalle_Equipo', 'fk_idmodelo');
    }
}