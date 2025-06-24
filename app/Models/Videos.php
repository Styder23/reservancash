<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Videos extends Model
{
    use HasFactory;
    
    protected $table = 'videos';
    protected $fillable = [
        'url', 'tipo', 'videoable_type', 'videoable_id'
    ];

    public function videoable()
    {
        return $this->morphTo();
    }
}