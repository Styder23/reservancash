@php
    use Carbon\Carbon;
@endphp

<div>
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            <span class="text-purple-600">Los paquetes Turisticos</span> para tu Aventura
        </h2>

        <!-- Buscador de servicios turísticos -->
        

        <!-- Contenedor de los N paquetes -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($paquetes as $paquete)
                @php
                    // CAMBIO: Buscar detalle con promoción y calcular descuento
                    $detallePromo = $paquete->detalles->first(function ($d) {
                        return $d->promocion && $d->promocion->descuento > 0;
                    });
                    $descuento = $detallePromo ? $detallePromo->promocion->descuento : 0;
                    $precioOriginal = $paquete->preciopaquete;
                    $precioDescuento =
                        $descuento > 0 ? $precioOriginal - ($precioOriginal * $descuento) / 100 : $precioOriginal;
                    $esNuevo = \Carbon\Carbon::parse($paquete->created_at)->diffInDays(now()) <= 10;
                @endphp
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 relative flex flex-col h-full">
                    @if ($descuento > 0)
                        <!-- CAMBIO: Badge de descuento en la esquina superior izquierda -->
                        <div
                            class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                            -{{ $descuento }}%
                        </div>
                    @endif
                    <div class="relative">
                        <img src="{{ asset('storage/' . ($paquete->imagen_principal ?? 'images.jfif')) }}"
                            alt="{{ $paquete->nombrepaquete }}" class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            {{ $paquete->estado ?? 'Disponible' }}
                        </div>
                        <!-- Botones superpuestos, debajo del badge -->
                        <div class="absolute top-12 right-2 flex flex-col items-end space-y-2 z-20">
                            <!-- Botón WhatsApp en el card -->
                            <button
                                class="w-10 h-10 rounded-full {{ in_array($paquete->id, $paquetesContactados ?? []) ? 'bg-green-500' : 'bg-white' }} flex items-center justify-center shadow-lg focus:outline-none border border-gray-300 transition"
                                title="Contactar por WhatsApp" disabled>
                                <i
                                    class="fab fa-whatsapp text-xl {{ in_array($paquete->id, $paquetesContactados ?? []) ? 'text-white' : 'text-green-500' }}"></i>
                            </button>
                            <!-- Favoritos (activable) -->
                            <button wire:click="toggleFavorito({{ $paquete->id }})"
                                class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-lg focus:outline-none border border-gray-300 hover:bg-red-100 transition"
                                title="Añadir a favoritos">
                                <i
                                    class="fa{{ in_array($paquete->id, $favoritos ?? []) ? 's' : 'r' }} fa-heart text-red-500 text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">{{ $paquete->nombrepaquete }}</h3>
                            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded">
                                <!-- CAMBIO: Mostrar "Promoción" si tiene descuento, si no "Nuevo"/"Disponible" -->
                                @if ($descuento > 0)
                                    Promoción
                                @else
                                    {{ $esNuevo ? 'Nuevo' : 'Disponible' }}
                                @endif
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $paquete->descripcion }}</p>
                        <div class="flex items-center mb-4">
                            <span class="text-sm text-gray-500 ml-2">
                                Incluye {{ $paquete->detalles->count() }} servicios/equipos
                            </span>
                        </div>
                        <div>
                            <!-- CAMBIO: Mostrar precio tachado y precio con descuento si aplica -->
                            @if ($descuento > 0)
                                <span class="text-sm text-gray-400 line-through">
                                    S/ {{ number_format($precioOriginal, 2) }}
                                </span><br>
                                <span class="text-lg font-bold text-red-600">
                                    S/ {{ number_format($precioDescuento, 2) }}
                                </span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            @else
                                <span class="text-lg font-bold text-blue-600">
                                    S/ {{ number_format($precioOriginal, 2) }}
                                </span>
                                <span class="text-sm text-gray-500">/por persona</span>
                            @endif
                        </div>
                        <div class="flex-1"></div>
                        <div class="w-full flex justify-end mt-4">
                            <a href="{{ route('vistapaquete', ['id' => $paquete->id]) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                Ver detalles
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No hay paquetes disponibles por ahora.
                </div>
            @endforelse
        </div>


        <!-- Paginación -->
        {{-- <div class="mt-8">
            {{ $equipos->links() }}
        </div> --}}
    </div>
</div>
