<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Paquetes;
use App\Models\premios as Modelpremios;
use App\Models\canjeos;
use App\Models\Reservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Premios extends Component
{
    public function index()
    {
        $user = Auth::user();
        $premioUsuario = Modelpremios::where('fk_iduser', $user->id)->first();
        
        $paquetesPremiados = Paquetes::where('preciopaquete', '<=', 20)
                                    ->where('estado', 1)
                                    ->with(['imagenes', 'empresa'])
                                    ->get();

        return view('premios', [
            'paquetesPremiados' => $paquetesPremiados,
            'premiosDisponibles' => $premioUsuario ? $premioUsuario->premios_disponibles : 0,
            'reservasConfirmadas' => $premioUsuario ? $premioUsuario->cantidad_reservas : 0,
            'maxReservasPremio' => 5
        ]);
    }

    public function canjear(Request $request, $idPaquete)
    {
        $user = Auth::user();
        $paquete = Paquetes::findOrFail($idPaquete);
        
        // Verificar que el paquete es elegible como premio
        if ($paquete->preciopaquete > 20) {
            return back()->with('error', 'Este paquete no es elegible como premio');
        }

        $premioUsuario = Modelpremios::where('fk_iduser', $user->id)->first();
        
        if (!$premioUsuario || $premioUsuario->premios_disponibles <= 0) {
            return back()->with('error', 'No tienes premios disponibles para canjear');
        }

        // Registrar el canjeo
        canjeos::create([
            'fk_iduser' => $user->id,
            'fecha_canjeo' => now()
        ]);

        // Reducir los premios disponibles
        $premioUsuario->canjearPremio();

        // Aquí deberías crear la reserva gratuita
        // ...

        return redirect()->route('premios')->with('success', '¡Premio canjeado con éxito!');
    }
    
    public function render()
    {
        return view('livewire.premios');
    }
}