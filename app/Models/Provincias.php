<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provincias extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'provincias';

    protected $fillable = [
        'nameprovincia','fk_iddepartamento'	
    ];

}