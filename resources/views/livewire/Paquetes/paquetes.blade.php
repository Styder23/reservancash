@php
    use Carbon\Carbon;
@endphp

<div class="bg-purple-300">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            <span class="text-purple-600">Los paquetes Turisticos</span> para tu Aventura
        </h2>
        <div class="flex-1 mb-8">
            <input type="text" wire:model.live="busquedaIzquierda"
                class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                placeholder="Buscar destino...">
            <div class="absolute left-3 top-3.5 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 mb-8">
            <div>
                <select class="w-full p-2 border rounded-lg text-sm" wire:model.live="filtroPrecioIzquierda">
                    <option value="">Precio</option>
                    <option value="asc">Menor a mayor</option>
                    <option value="desc">Mayor a menor</option>
                </select>
            </div>
            <div>
                <select class="w-full p-2 border rounded-lg text-sm" wire:model.live="filtroDestinoIzquierda">
                    <option value="">Tipo de Destino</option>
                    @foreach ($tiposDestino as $tipo)
                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select class="w-full p-2 border rounded-lg text-sm" wire:model.live="filtroDistritoIzquierda">
                    <option value="">Distritos</option>
                    @foreach ($distritos as $distrito)
                        <option value="{{ $distrito->namedistrito }}">{{ $distrito->namedistrito }}</option>
                    @endforeach
                </select>
            </div>
            <div></div>
            {{-- <div class="col-span-1 flex justify-center">
                <button wire:click="aplicarFiltrosIzquierda"
                    class="w-full max-w-xs px-8 py-3 rounded bg-green-600 text-white hover:bg-green-700 transition text-lg"
                    title="Aplicar filtros">
                    Aplicar
                </button>
            </div> --}}
            {{-- Botón Limpiar centrado --}}
            <div class="col-span-2 flex justify-center">
                <button wire:click="limpiarFiltrosIzquierda" {{-- Asegúrate de que esto sea correcto --}}
                    class="w-full max-w-xs px-8 py-3 rounded bg-red-500 text-white hover:bg-red-700 transition text-lg"
                    title="Reestablecer filtros">
                    Reestablecer
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($paquetes as $paquete)
                @php
                    $detallePromo = $paquete->det_paquete->first(function ($d) {
                        // Usar det_paquete
                        return $d->promos && $d->promos->descuento > 0; // Usar promos
                    });
                    $descuento = $detallePromo ? $detallePromo->promos->descuento : 0; // Usar promos
                    $precioOriginal = $paquete->preciopaquete;
                    $precioDescuento =
                        $descuento > 0 ? $precioOriginal - ($precioOriginal * $descuento) / 100 : $precioOriginal;
                    $esNuevo = \Carbon\Carbon::parse($paquete->created_at)->diffInDays(now()) <= 10;
                @endphp
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 relative flex flex-col h-full">
                    @if ($descuento > 0)
                        <div
                            class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                            -{{ $descuento }}%
                        </div>
                    @endif
                    <div class="relative">
                            <img src="{{ asset('storage/' . ($paquete->imagen_principal ?? 'images.jfif')) }}" alt="{{ $paquete->nombrepaquete }}" class="w-full h-48 object-cover">
                        <div
                            class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            {{ $paquete->estado ?? 'Disponible' }}
                        </div>
                        <div class="absolute top-12 right-2 flex flex-col items-end space-y-2 z-20">
                            <button
                                class="w-10 h-10 rounded-full {{ in_array($paquete->id, $paquetesContactados ?? []) ? 'bg-green-500' : 'bg-white' }} flex items-center justify-center shadow-lg focus:outline-none border border-gray-300 transition"
                                title="Contactar por WhatsApp" disabled>
                                <i
                                    class="fab fa-whatsapp text-xl {{ in_array($paquete->id, $paquetesContactados ?? []) ? 'text-white' : 'text-green-500' }}"></i>
                            </button>
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
                                Incluye {{ $paquete->det_paquete->count() }} servicios/equipos
                            </span>
                        </div>
                        <div>
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
        {{-- Si implementas paginación, asegúrate de que $paquetes sea un objeto Paginator --}}
        {{-- <div class="mt-8">
            {{ $paquetes->links() }} 
        </div> --}}

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const notifications = document.querySelectorAll('.fixed.top-4.right-4');
                notifications.forEach(function(notification) {
                    notification.style.display = 'none';
                });
            }, 3000);
        });
    </script>
</div>
