<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagenes extends Model
{
    use HasFactory;
    
    protected $table = 'imagenes';
    protected $fillable = [
        'url', 'tipo', 'imageable_id', 'imageable_type'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}