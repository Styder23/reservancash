<div class="bg-white rounded-xl shadow-lg overflow-hidden mt-4">
    <!-- Imagen del paquete -->
    <div class="relative h-48 overflow-hidden">
        @if ($paquete->imagen_principal)
            <img src="{{ asset('storage/' . $paquete->imagen_principal) }}" alt="{{ $paquete->nombrepaquete }}"
                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        @endif

        <!-- Precio -->
        <div class="absolute bottom-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-lg font-bold">
            @if ($paquete->det_paquete->first()->promos)
                <span class="text-xs line-through mr-1">S/.{{ number_format($paquete->preciopaquete, 2) }}</span>
                S/.{{ number_format($paquete->preciopaquete * (1 - $paquete->det_paquete->first()->promos->descuento / 100), 2) }}
            @else
                S/.{{ number_format($paquete->preciopaquete, 2) }}
            @endif
        </div>
    </div>

    <!-- Contenido -->
    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $paquete->nombrepaquete }}</h3>

        <div class="flex items-center text-gray-600 mb-3">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>{{ $paquete->det_paquete->first()->destino->namedestino }}</span>
        </div>

        <div class="flex items-center text-gray-600 mb-4">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ $paquete->itinerarios->count() }} días</span>
        </div>

        <!-- Servicios incluidos (mostrar solo los primeros 3) -->
        <div class="mb-4">
            <h4 class="font-semibold text-gray-800 mb-2">Servicios incluidos:</h4>
            <ul class="space-y-1">
                @foreach ($paquete->ser_paquete->take(3) as $servicio)
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm">{{ $servicio->servicio->Det_servicio->nombreservicio }}</span>
                    </li>
                @endforeach
                @if ($paquete->ser_paquete->count() > 3)
                    <li class="text-sm text-gray-500">+{{ $paquete->ser_paquete->count() - 3 }} más</li>
                @endif
            </ul>
        </div>

        <!-- Botones -->
        <div class="flex space-x-2">
            <a href="{{ route('paquetes.show', $paquete->id) }}"
                class="flex-1 bg-blue-100 text-blue-600 hover:bg-blue-200 text-center py-2 px-4 rounded-lg transition">
                Ver detalles
            </a>
            <button wire:click="reservar({{ $paquete->id }})"
                class="flex-1 bg-blue-600 text-white hover:bg-blue-700 py-2 px-4 rounded-lg transition">
                Reservar
            </button>
        </div>
    </div>
</div>
