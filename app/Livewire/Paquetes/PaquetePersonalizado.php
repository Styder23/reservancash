<?php
namespace App\Livewire\Paquetes;

use Livewire\Component;
use App\Models\ClientePaquete;
use App\Models\Paquetes;
use App\Models\Reservas;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
class PaquetePersonalizado extends Component
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

    public function getReservasProperty()
    {
        return Reservas::with(['paquete', 'users'])
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
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.paquetes.paquete-personalizado',[
            'reservas' => $this->reservas
        ])->layout($layout);
    }
    
}