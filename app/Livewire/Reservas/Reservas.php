<?php

namespace App\Livewire\Reservas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservas as ModelReservas;
use App\Models\Empresas;
use App\Models\premios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Reservas extends Component
{
    use WithPagination;

    public $filtroEstado = '';
    public $fechaFiltro = '';
    public $search = '';
    public $mostrarModalConfirmar = false;
    public $mostrarModalCancelar = false;
    public $reservaSeleccionada = null;
    public $motivoCancelacion = '';
    public $comprobanteVisible = null;
    public $empresaId = null;
    public $nombreEmpresa = '';

    protected $queryString = [
        'filtroEstado' => ['except' => ''],
        'fechaFiltro' => ['except' => ''],
        'search' => ['except' => '']
    ];

    public function mount()
    {
        $this->obtenerEmpresaUsuario();
    }

    public function obtenerEmpresaUsuario()
    {
        try {
            $userId = auth()->id();
            
            if (!$userId) {
                session()->flash('error', 'Usuario no autenticado');
                return;
            }

            $empresa = DB::table('users')
                ->join('personas', 'personas.id', '=', 'users.fk_idpersona')
                ->join('representante_legal', 'representante_legal.fk_idpersona', '=', 'personas.id')
                ->join('empresas', 'empresas.id', '=', 'representante_legal.fk_idempresa')
                ->where('users.id', $userId)
                ->select('empresas.id', 'empresas.nameempresa')
                ->first();

            if (!$empresa) {
                session()->flash('error', 'No se encontró la empresa asociada a este usuario');
                return;
            }

            $this->empresaId = $empresa->id;
            $this->nombreEmpresa = $empresa->nameempresa;
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al obtener la empresa: ' . $e->getMessage());
        }
    }

    public function mostrarComprobante($reservaId)
    {
        $this->comprobanteVisible = $reservaId;
    }

    public function ocultarComprobante()
    {
        $this->comprobanteVisible = null;
    }

    public function abrirModalConfirmar($reservaId)
    {
        $this->reservaSeleccionada = $reservaId;
        $this->mostrarModalConfirmar = true;
    }

    public function abrirModalCancelar($reservaId)
    {
        $this->reservaSeleccionada = $reservaId;
        $this->mostrarModalCancelar = true;
    }

    public function cerrarModales()
    {
        $this->mostrarModalConfirmar = false;
        $this->mostrarModalCancelar = false;
        $this->reservaSeleccionada = null;
        $this->motivoCancelacion = '';
    }

    public function confirmarReserva()
    {
        try {
            if (!$this->reservaSeleccionada) {
                session()->flash('error', 'No se ha seleccionado ninguna reserva.');
                return;
            }

            $reserva = ModelReservas::findOrFail($this->reservaSeleccionada);
            $reserva->update(['estado' => 'confirmada']);
            
            // Actualizar premios del CLIENTE que hizo la reserva
            $this->actualizarPremiosUsuario($reserva->fk_idusers);

            $this->cerrarModales();
            session()->flash('success', 'Reserva confirmada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al confirmar la reserva: ' . $e->getMessage());
        }
    }

    private function actualizarPremiosUsuario($clienteId)
    {
        // Usar el método del modelo premios que ya tienes implementado
        $premio = \App\Models\premios::registrarReservaConfirmada($clienteId);
        
        // Verificar si el cliente ganó un premio
        if ($premio->puedeReclamarPremio()) {
            // Opcional: Notificar que tiene un premio disponible
            $this->dispatch('mostrarAlerta', [
                'tipo' => 'success',
                'mensaje' => '¡El cliente ha ganado un premio! Tiene ' . $premio->cantidad_reservas . ' reservas confirmadas.'
            ]);
        }
    }
    
    public function cancelarReserva()
    {
        $this->validate([
            'motivoCancelacion' => 'required|min:10'
        ]);

        try {
            if (!$this->reservaSeleccionada) {
                session()->flash('error', 'No se ha seleccionado ninguna reserva.');
                return;
            }

            $reserva = ModelReservas::findOrFail($this->reservaSeleccionada);
            
            // Si la reserva estaba confirmada, decrementar el contador
            if ($reserva->estado == 'confirmada') {
                $this->decrementarPremiosUsuario($reserva->fk_idusers);
            }
            
            $reserva->update([
                'estado' => 'cancelada',
                'notas' => $this->motivoCancelacion
            ]);
            
            $this->cerrarModales();
            session()->flash('success', 'Reserva cancelada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cancelar la reserva: ' . $e->getMessage());
        }
    }

    // Agregar este método privado
    private function decrementarPremiosUsuario($userId)
    {
        try {
            premios::decrementarReservaConfirmada($userId);
        } catch (\Exception $e) {
            \Log::error('Error al decrementar premios del usuario: ' . $e->getMessage());
        }
    }

    public function getReservasProperty()
    {
        try {
            if (!$this->empresaId) {
                return collect();
            }

            return ModelReservas::with(['paquete', 'users', 'pago'])
                ->whereHas('paquete', function($query) {
                    $query->where('fk_idempresa', $this->empresaId);
                })
                ->when($this->filtroEstado, function($query) {
                    $query->where('estado', $this->filtroEstado);
                })
                ->when($this->fechaFiltro, function($query) {
                    $query->whereDate('fecha_viaje', $this->fechaFiltro);
                })
                ->when($this->search, function($query) {
                    $query->where(function($q) {
                        $q->whereHas('users', function($q) {
                            $q->where('name', 'like', '%'.$this->search.'%')
                              ->orWhere('email', 'like', '%'.$this->search.'%');
                        })
                        ->orWhereHas('paquete', function($q) {
                            $q->where('nombrepaquete', 'like', '%'.$this->search.'%');
                        });
                    });
                })
                ->orderBy('fecha_viaje', 'desc')
                ->paginate(10);
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar las reservas: ' . $e->getMessage());
            return collect();
        }
    }

    public function getUserHasEmpresa()
    {
        return !empty($this->empresaId);
    }

    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa ?: 'Sin empresa';
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

    public function updatingFechaFiltro()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function limpiarFiltros()
    {
        $this->filtroEstado = '';
        $this->fechaFiltro = '';
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        $reservas = $this->getReservasProperty();
        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.reservas.reservas', compact('reservas'))->layout($layout);
    }
}