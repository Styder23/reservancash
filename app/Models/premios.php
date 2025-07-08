<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class premios extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'table_premios';

    protected $fillable = [
        'fk_iduser','cantidad_reservas','premios_disponibles','premios_usados'	
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_iduser'); 
    }

    // Método para registrar una nueva reserva confirmada
    public static function registrarReservaConfirmada($userId)
    {
        $premio = self::firstOrCreate(
            ['fk_iduser' => $userId],
            ['cantidad_reservas' => 0, 'premios_disponibles' => 0, 'premios_usados' => 0]
        );

        $premio->increment('cantidad_reservas');
        
        // Verificar si alcanzó el límite para un nuevo premio (5 reservas)
        if ($premio->cantidad_reservas >= 5) {
            $premio->increment('premios_disponibles');
            $premio->cantidad_reservas = 0;
            $premio->save();
        }

        return $premio;
    }

    // Método para canjear un premio - CORREGIDO
    public function canjearPremio()
    {
        // Verificar si tiene al menos 5 reservas para canjear
        if ($this->cantidad_reservas >= 5) {
            // Incrementar premios usados
            $this->increment('premios_usados');
            
            // Resetear contador de reservas
            $this->cantidad_reservas = 0;
            $this->save();
            
            return true;
        }
        return false;
    }

    // Método para verificar si el usuario puede canjear un premio
    public function puedeReclamarPremio()
    {
        return $this->cantidad_reservas >= 5;
    }
}