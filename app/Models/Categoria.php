<?php






namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'namecategorias',
    ];

    public function det_equipos()
    {
        return $this->hasMany('App\Models\Detalle_Equipo', 'fk_idcategoria');
    }
}