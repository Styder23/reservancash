<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class canjeos extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'table_canjeos';

    protected $fillable = [
        'fk_iduser','fk_idreserva','fk_idclientereserva','fecha_canjeo'
    ];
    
    protected $casts = [
        'fecha_canjeo' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_iduser');
    }

    public function reserva()
    {
        return $this->belongsTo(Reservas::class, 'fk_idreserva');
    }

    // Esta relación debe apuntar a la tabla correcta según tu base de datos
    // Si 'fk_idclientereserva' apunta a 'cliente_reserva', necesitas el modelo correspondiente
    public function clienteReserva()
    {
        return $this->belongsTo(ClienteReserva::class, 'fk_idclientereserva');
    }
}