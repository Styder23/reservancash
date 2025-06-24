<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'personas';

    protected $fillable = [
        'dni','nombre','apellidos','telefono','email'	
    ];

    public function replegal()
    {
        return $this->hasMany('App\Models\RepreLegal', 'fk_idpersona');
    }

    public function empresa()
    {
        return $this->hasMany('App\Models\RepreLegal', 'fk_idempresa');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User', 'fk_idpersona');
    }
}