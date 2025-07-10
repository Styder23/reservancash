<?php

namespace App\Livewire\Reservas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservas;
use Illuminate\Support\Facades\Auth;

class ReservaCliente extends Component
{
    use WithPagination;

    public $filtroEstado = '';
    public $fechaFiltro = '';
    public $modalCancelarVisible = false; // Cambié el nombre aquí
    public $reservaACancelar = null;
    public $motivoCliente;
    
    //para ver los detalles
    public $modalDetallesVisible = false;
    public $reservaSeleccionada = null;
    
    protected $queryString = [
        'filtroEstado' => ['except' => ''],
        'fechaFiltro' => ['except' => '']
    ];

    public function mostrarModalCancelar($reservaId)
    {
        $this->reservaACancelar = $reservaId;
        $this->modalCancelarVisible = true; // Y aquí
    }

    public function cerrarModal()
    {
        $this->modalCancelarVisible = false; // Y aquí
        $this->reservaACancelar = null;
        $this->motivoCliente = '';
    }

    // para los detalles 
    public function mostrarModalDetalles($reservaId)
    {
        $this->reservaSeleccionada = Reservas::with(['paquete', 'users'])
            ->where('id', $reservaId)
            ->where('fk_idusers', Auth::id())
            ->first();
        
        if ($this->reservaSeleccionada) {
            $this->modalDetallesVisible = true;
        }
    }

    public function cerrarModalDetalles()
    {
        $this->modalDetallesVisible = false;
        $this->reservaSeleccionada = null;
    }

    public function solicitarCancelacion()
    {
        $this->validate([
            'motivoCliente' => 'required|string|min:10',
        ], [
            'motivoCliente.required' => 'El motivo es obligatorio.',
            'motivoCliente.min' => 'El motivo debe tener al menos 10 caracteres.',
        ]);

        try {
            $reserva = Reservas::where('id', $this->reservaACancelar)
                            ->where('fk_idusers', Auth::id())
                            ->first();
            
            if (!$reserva) {
                session()->flash('error', 'Reserva no encontrada o no tienes permisos para cancelarla.');
                return;
            }
            
            if (in_array($reserva->estado, ['pendiente', 'confirmada'])) {
                // Si la reserva estaba confirmada, decrementar el contador
                if ($reserva->estado == 'confirmada') {
                    \App\Models\premios::decrementarReservaConfirmada(Auth::id());
                }
                
                $reserva->update([
                    'estado' => 'cancelada',
                    'motivo_cliente' => $this->motivoCliente,
                    'fecha_solicitud_cancelacion' => now()
                ]);
                
                $this->cerrarModal();
                session()->flash('message', 'Solicitud de cancelación enviada. La empresa se pondrá en contacto contigo para el proceso de reembolso.');
                
            } else {
                session()->flash('error', 'Esta reserva no puede ser cancelada.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error al enviar la solicitud: ' . $e->getMessage());
        }
    }

    public function getReservasProperty()
    {
        return Reservas::with(['paquete', 'users'])
            ->where('fk_idusers', Auth::id())
            ->whereIn('estado', ['pendiente', 'confirmada']) // Solo mostrar pendientes y confirmadas
            ->when($this->filtroEstado, function($query) {
                // Solo permitir filtrar por los estados permitidos
                if (in_array($this->filtroEstado, ['pendiente', 'confirmada'])) {
                    $query->where('estado', $this->filtroEstado);
                }
            })
            ->when($this->fechaFiltro, function($query) {
                $query->whereDate('fechareserva', $this->fechaFiltro);
            })
            ->orderBy('fechareserva', 'desc')
            ->paginate(10);
  
    $query->when($this->fechaFiltro, function($q) {
        $q->whereDate('fechareserva', $this->fechaFiltro);
    });
    
    return $query->orderBy('fechareserva', 'desc')->paginate(10);
}
    
    
    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.reservas.reserva-cliente', [
            'reservas' => $this->reservas
        ])->layout($layout);
    }
}