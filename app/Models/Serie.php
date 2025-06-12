<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $table = 'serie_equipos';
    
    protected $fillable = [
        'nameserie',
    ];

    public function det_equipos()
    {
        return $this->hasMany('App\Models\Detalle_Equipo', 'fk_idserie');
    }
}