<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Paquetes;
use App\Models\Empresas;
use App\Models\DetallePaquete;
use App\Models\Destinos;

class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        $mensaje = strtolower($request->input('message'));

        // Buscar paquetes
        if (str_contains($mensaje, 'paquetes')) {
            $paquetes = Paquete::with(['empresa', 'detalles.destino'])->take(3)->get();
            $respuestas = [];

            foreach ($paquetes as $paq) {
                $empresa = $paq->empresa->nameempresa;
                $telefono = $paq->empresa->telefonoempresa;
                $destinos = $paq->detalles->pluck('destino.nombredestino')->join(', ');
                $respuestas[] = "📦 *{$paq->nombrepaquete}*\n🗺️ Destino(s): $destinos\n🏷️ Precio base: S/. {$paq->precio_base}\n🏢 Empresa: $empresa\n📞 Teléfono: $telefono";
            }

            return response()->json(['reply' => implode("\n\n", $respuestas)]);
        }

        // Si no entiende
        return response()->json([
            'reply' => 'Lo siento, no entendí tu mensaje. Puedes preguntar por: *paquetes disponibles*, *precio*, *empresa*, etc.'
        ]);
    }

 public function listarPaquetes()
{
    return Paquetes::where('estado', 1)->select('id', 'nombrepaquete')->get();
}


public function detallePaquete($id)
{
    $paquete = Paquetes::with(['empresa', 'detalles.destino'])->findOrFail($id);
    $destinos = $paquete->detalles->map(function ($d) {
        return optional($d->destino)->nombredestino;
    })->filter()->unique()->implode(', ');

    return response()->json([
        'nombrepaquete' => $paquete->nombrepaquete,
        'precio_base' => $paquete->precio_base,
        'personas_incluidas' => $paquete->personas_incluidas,
        'empresa' => $paquete->empresa->nameempresa,
        'telefono' => $paquete->empresa->telefonoempresa,
        'destinos' => $destinos ?: 'No especificado'
    ]);
}

public function listarEmpresas()
{
    return Empresas::select('nameempresa', 'direccionempresa', 'telefonoempresa')->get();
}

public function listarDestinos()
{
    return Destinos::select('nombredestino')->distinct()->get();
}
}
