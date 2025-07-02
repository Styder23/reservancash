<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoUsuarios extends Model
{
    use HasFactory;

    protected $table='tipo_usuarios';
    protected $fillable = [
        'nametipo_usuarios',
    ];

    public function tipousu()
    {
        return $this->hasMany(User::class, 'fk_idtipousu'); 
    }
}