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
    $query = Reservas::with(['paquete', 'users'])
        ->where('fk_idusers', Auth::id());
        // Quita o haz condicional el ->whereIn('estado', ['pendiente', 'confirmada'])

    $query->when($this->filtroEstado, function($q) {
        $q->where('estado', $this->filtroEstado);
    });
    if (empty($this->filtroEstado)) {
        $query->whereIn('estado', ['pendiente', 'confirmada','cancelada']); // Default view
    } else {
        $query->where('estado', $this->filtroEstado); // Specific filter
    }


    $query->when($this->fechaFiltro, function($q) {
        $q->whereDate('fechareserva', $this->fechaFiltro);
    });
    
    return $query->orderBy('fechareserva', 'desc')->paginate(10);
}

    public function render()
    {
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.paquetes.paquete-personalizado',[
            'reservas' => $this->reservas
        ])->layout($layout);
    }
    
}