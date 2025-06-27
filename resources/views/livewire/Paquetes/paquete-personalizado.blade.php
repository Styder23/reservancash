<!-- resources/views/livewire/mis-paquetes-personalizados.blade.php -->
<div class="container mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Mis Paquetes Personalizados</h1>

    <div class="grid gap-6">
        @forelse ($paquetes as $paquete)
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-start">
                    <h2 class="text-xl font-semibold">{{ $paquete->paquetes->nombrepaquete }}</h2>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                        S/. {{ number_format($paquete->preciototal, 2) }}
                    </span>
                </div>

                @if ($paquete->servicios->count())
                    <div class="mt-4">
                        <h3 class="font-medium text-gray-700">Servicios adicionales:</h3>
                        <ul class="mt-2 space-y-1">
                            @foreach ($paquete->servicios as $servicio)
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $servicio->cli_equipo->Det_servicio->nombreservicio }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-6 flex justify-end">
                    <button wire:click="confirmarReserva({{ $paquete->id }})"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                        Confirmar Reserva
                    </button>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-500">No tienes paquetes personalizados guardados.</p>
                <a href="{{ route('paquetes') }}" class="mt-4 inline-block text-blue-600 hover:underline">
                    Ver paquetes disponibles
                </a>
            </div>
        @endforelse
    </div>
</div>
