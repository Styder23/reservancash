{{-- resources/views/premios/index.blade.php --}}
@extends('layouts.prueba')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Paquetes Premiados</h1>

        @if ($premiosDisponibles > 0)
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                <p class="font-bold">¡Tienes {{ $premiosDisponibles }} premio(s) disponible(s)!</p>
                <p>Puedes canjear cualquiera de estos paquetes gratis.</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($paquetesPremiados as $paquete)
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $paquete->imagen_principal ? asset('storage/' . $paquete->imagen_principal) : asset('images/default-package.jpg') }}"
                            alt="{{ $paquete->nombrepaquete }}" class="w-full h-full object-cover">
                        <div
                            class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                            GRATIS
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $paquete->nombrepaquete }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $paquete->descripcion }}</p>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 line-through">S/
                                {{ number_format($paquete->preciopaquete, 2) }}</span>
                            <span class="text-green-600 font-bold">S/ 0.00</span>
                        </div>

                        @if ($premiosDisponibles > 0)
                            <button wire:click="canjearPremio({{ $paquete->id }})"
                                class="mt-4 w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                Canjear Premio
                            </button>
                        @else
                            <div class="mt-4 text-center text-sm text-gray-500">
                                Necesitas {{ $maxReservasPremio - $reservasConfirmadas }} reservas más para desbloquear
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
