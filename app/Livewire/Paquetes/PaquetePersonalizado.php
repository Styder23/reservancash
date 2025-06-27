<?php

namespace App\Livewire\Paquetes;

use Livewire\Component;
use App\Models\ClientePaquete;
use App\Models\Paquetes;
use Illuminate\Support\Facades\Auth;
class PaquetePersonalizado extends Component
{
    public function confirmarReserva($clientePaqueteId)
    {
        $clientePaquete = \App\Models\ClientePaquete::findOrFail($clientePaqueteId);

        // Verificar que no tenga ya una reserva
        if (!$clientePaquete->reserva) {
            \App\Models\ClienteReserva::create([
                'fechareserva' => now(),
                'estado' => 'pendiente',
                'fk_idpaquetecliente' => $clientePaquete->id,
                'fk_idusers' => Auth::id()
            ]);

            $clientePaquete->update(['estado' => 'confirmado']);
            session()->flash('success', 'Reserva confirmada con éxito');
        }

        return redirect()->route('reservacli');
    }

    public function render()
    {
        $paquetes = \App\Models\ClientePaquete::with([
            'paquetes',
            'servicios.cli_equipo.Det_servicio',
            'equipos.cli_equipo.Det_equipo',
            'destinos.cli_destino'
        ])->where('fk_iduser', Auth::id())
          ->where('estado', 'borrador')
          ->get();

        $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.paquetes.paquete-personalizado',[
            'paquetes' => $paquetes
        ])->layout($layout);
    }
    
    public function eliminarPersonalizacion($id)
    {
        $clientePaquete = ClientePaquete::findOrFail($id);
        $clientePaquete->delete();
        
        $this->dispatch('mostrar-toast', tipo: 'success', mensaje: 'Personalización eliminada correctamente');
    }
}