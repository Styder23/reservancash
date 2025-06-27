<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class favoritos extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'table_favoritos';
    protected $fillable = [
        'fk_iduser', 'favoritable_id', 'favoritable_type'
    ];

    public function favoritable()
    {
        return $this->morphTo();
    }
}