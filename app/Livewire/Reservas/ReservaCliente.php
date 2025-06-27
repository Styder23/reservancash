<?php

namespace App\Livewire\Reservas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ClienteReserva;
use Illuminate\Support\Facades\Auth;

class ReservaCliente extends Component
{
    use WithPagination;

    public $reservas;
    public $filtroEstado = '';
    public $fechaFiltro = '';
    public $mostrarModalCancelar = false;
    public $reservaACancelar = null;

    protected $queryString = [
        'filtroEstado' => ['except' => ''],
        'fechaFiltro' => ['except' => '']
    ];

    public function mount(){
        $this->reservas=ClienteReserva::all();
    }
    public function mostrarModalCancelar($reservaId)
    {
        $this->reservaACancelar = $reservaId;
        $this->mostrarModalCancelar = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModalCancelar = false;
        $this->reservaACancelar = null;
    }

    public function cancelarReserva()
    {
        $reserva = ClienteReserva::findOrFail($this->reservaACancelar);
        $reserva->update(['estado' => 'cancelado']);
        
        $this->cerrarModal();
        session()->flash('message', 'Reserva cancelada correctamente');
    }

    public function confirmarReserva($reservaId)
    {
        $reserva = ClienteReserva::findOrFail($reservaId);
        $reserva->update(['estado' => 'confirmado']);
        
        session()->flash('message', 'Reserva confirmada correctamente');
    }

    public function getReservasProperty()
    {
        return ClienteReserva::with(['cli_paquete.paquetes'])
            ->where('fk_idusers', Auth::id())
            ->when($this->filtroEstado, function($query) {
                $query->where('estado', $this->filtroEstado);
            })
            ->when($this->fechaFiltro, function($query) {
                $query->whereDate('fechareserva', $this->fechaFiltro);
            })
            ->orderBy('fechareserva', 'desc')
            ->paginate(10);
    }
    
    public function render()
    {
        $reservas = $this->reservas ?? collect();
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.reservas.reserva-cliente')->layout($layout);
    }
}