<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class favoritos extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'table_favoritos';
    protected $fillable = [
        'fk_iduser',
        'favoritable_id',
        'favoritable_type'
    ];

    public function favoritable(): MorphTo
    {
        return $this->morphTo();
    }

    public function favoritos()
    {
        return $this->hasMany(Favoritos::class, 'fk_iduser');
    }
}
