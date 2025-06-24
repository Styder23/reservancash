<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paradas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'paradas';

    protected $fillable = [
        'nameparadas'	
    ];
}