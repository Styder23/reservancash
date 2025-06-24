<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rutas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'rutas';

    protected $fillable = [
        'namerutas'	
    ];

    public function itinixrutas()
    {
        return $this->hasMany('App\Models\itinerarioxruta', 'fk_idruta');
    }
}