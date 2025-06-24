<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RepreLegal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'representante_legal';

    protected $fillable = [
        'fecha','fk_idempresa','fk_idpersona'	
    ];

    public function empresa(){
        return $this->belongsTo(Empresas::class, 'fk_idempresa');
    }

    public function persona(){
        return $this->belongsTo(Personas::class, 'fk_idpersona');
    }
}