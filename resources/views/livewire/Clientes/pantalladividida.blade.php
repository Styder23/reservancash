{{-- filepath: resources/views/livewire/Paquetes/detalle-paquete.blade.php --}}
@php
    $mostrarFormularioPersonalizacion = $mostrarFormularioPersonalizacion ?? false;
@endphp

<div class="min-h-screen bg-gray-50 p-4">
    <div class="max-w-8xl mx-auto">
        <h1 class="text-2xl font-bold text-center text-green-700 mb-6">Compara Paquetes Turísticos</h1>

        <!-- Contenedor principal de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Columna Izquierda -->
            <div class="bg-white p-4 rounded-xl shadow-sm">

                <div class="flex items-center mb-4">
                    <button wire:click="$set('paqueteIzquierdaId', null)"
                        class="mr-3 p-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 focus:outline-none"
                        title="Regresar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div class="flex-1">
                        <!-- Aquí va el input del buscador -->
                        <input type="text" wire:model.defer="busquedaIzquierda" wire:keydown.enter="filtrarIzquierda"
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
                </div>

                <!-- Filtros -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <!-- Select Precio (mitad) -->
                    <div>
                        <select class="w-full p-2 border rounded-lg text-sm" wire:model.defer="filtroPrecioIzquierdaTemp">
                            <option value="">Precio</option>
                            <option value="asc">Menor a mayor</option>
                            <option value="desc">Mayor a menor</option>
                        </select>
                    </div>
                    <!-- Fechas (mitad) -->
                    <div class="flex gap-2">
                        <input type="date" wire:model.defer="filtroFechaInicioIzquierdaTemp"
                            class="w-1/2 p-2 border rounded-lg">
                        <input type="date" wire:model.defer="filtroFechaFinIzquierdaTemp"
                            class="w-1/2 p-2 border rounded-lg">
                    </div>
                    <!-- Select Tipo de Destino (mitad) -->
                    <div>
                        <select class="w-full p-2 border rounded-lg text-sm"
                            wire:model.defer="filtroDestinoIzquierdaTemp">
                            <option value="">Tipo de Destino</option>
                            @foreach ($tiposDestino as $tipo)
                                <option value="{{ $tipo }}">{{ $tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Botón aplicar (mitad) -->
                    <div>
                        <button wire:click="aplicarFiltrosIzquierda"
                            class="w-full px-3 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition text-sm"
                            title="Aplicar filtros">
                            Aplicar
                        </button>
                    </div>
                </div>

                <!-- Columna Izquierda -->
                <div class="bg-white p-4 rounded-xl shadow-sm h-[calc(100vh-120px)] overflow-y-auto">
                    @if ($paqueteIzquierdaId)
                        @php
                            $paquete = $paquetesIzquierda->firstWhere('id', $paqueteIzquierdaId);
                        @endphp
                        @include('livewire.Paquetes.detalle-paquete', ['paquete' => $paquete])
                        <button wire:click="$set('paqueteIzquierdaId', null)"
                            class="mt-4 text-sm text-blue-600 hover:underline">Volver a la lista</button>
                    @else
                        <h2 class="text-lg font-bold mb-4 text-green-700">Selecciona un paquete para la izquierda</h2>
                        <div class="grid grid-cols-1 gap-8">
                            @foreach ($paquetesIzquierda as $paquete)
                                <div wire:click="seleccionarIzquierda({{ $paquete->id }})"
                                    class="cursor-pointer bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 relative flex flex-col h-[420px] min-h-[420px] max-h-[420px]
            {{ $paqueteIzquierdaId == $paquete->id ? 'ring-2 ring-green-500' : '' }}">
                                    @php
                                        $detalles = $paquete->detalles ?? collect();
                                        $detallePromo = $detalles->first(function ($d) {
                                            return $d->promocion && $d->promocion->descuento > 0;
                                        });
                                        $descuento = $detallePromo ? $detallePromo->promocion->descuento : 0;
                                        $precioOriginal = $paquete->preciopaquete;
                                        $precioDescuento =
                                            $descuento > 0
                                                ? $precioOriginal - ($precioOriginal * $descuento) / 100
                                                : $precioOriginal;
                                    @endphp
                                    @if ($descuento > 0)
                                        <!-- Badge de descuento -->
                                        <div
                                            class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                            -{{ $descuento }}%
                                        </div>
                                    @endif

                                    <div class="relative h-48 w-full">
                                        <img src="{{ asset('storage/' . ($paquete->imagen_principal ?? 'images.jfif')) }}"
                                            alt="{{ $paquete->nombrepaquete }}" class="w-full h-full object-cover">
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
                                        <h3 class="text-xl font-bold text-gray-800">{{ $paquete->nombrepaquete }}</h3>
                                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $paquete->descripcion }}</p>
                                        <div class="flex items-center mb-4">
                                            <span class="text-sm text-gray-500 ml-2">
                                                Incluye {{ $paquete->detalles->count() }} servicios/equipos
                                            </span>
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <div class="flex items-center mb-4">
                                                @php
                                                    $detalles = $paquete->detalles ?? collect();
                                                    $detallePromo = $detalles->first(function ($d) {
                                                        return $d->promocion && $d->promocion->descuento > 0;
                                                    });
                                                    $descuento = $detallePromo
                                                        ? $detallePromo->promocion->descuento
                                                        : 0;
                                                    $precioOriginal = $paquete->preciopaquete;
                                                    $precioDescuento =
                                                        $descuento > 0
                                                            ? $precioOriginal - ($precioOriginal * $descuento) / 100
                                                            : $precioOriginal;
                                                @endphp

                                                @if ($descuento > 0)
                                                    <span class="text-sm text-gray-400 line-through ml-2">
                                                        S/ {{ number_format($precioOriginal, 2) }}
                                                    </span>
                                                    <span class="text-lg font-bold text-red-600 ml-2">
                                                        S/ {{ number_format($precioDescuento, 2) }}
                                                    </span>
                                                    <span
                                                        class="text-xs bg-yellow-300 text-yellow-900 font-bold px-2 py-1 rounded ml-2">¡Promoción!</span>
                                                @else
                                                    <span class="text-lg font-bold text-blue-600 ml-2">
                                                        S/ {{ number_format($precioOriginal, 2) }}
                                                    </span>
                                                @endif
                                                <span class="text-sm text-gray-500"> /por persona</span>
                                            </div>

                                            <div class="flex-1"></div>
                                            <div class="w-full flex justify-end mt-4">
                                                <a href=""
                                                    class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                                    Ver detalles
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>


            </div>





            <!-- Columna Derecha -->
            <div class="bg-white p-4 rounded-xl shadow-sm">
                {{-- boton atras y buscador --}}
                <div class="flex items-center mb-4">
                    <button wire:click="$set('paqueteDerechaId', null)"
                        class="mr-3 p-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 focus:outline-none"
                        title="Regresar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div class="flex-1">
                        <!-- Aquí va el input del buscador -->
                        <input type="text" wire:model.defer="busquedaDerecha" wire:keydown.enter="filtrarDerecha"
                            class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Buscar destino...">
                        <div class="absolute left-3 top-3.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <!-- Select Precio (mitad) -->
                    <div>
                        <select class="w-full p-2 border rounded-lg text-sm"
                            wire:model.defer="filtroPrecioDerechaTemp">
                            <option value="">Precio</option>
                            <option value="asc">Menor a mayor</option>
                            <option value="desc">Mayor a menor</option>
                        </select>
                    </div>
                    <!-- Fechas (mitad) -->
                    <div class="flex gap-2">
                        <input type="date" wire:model.defer="filtroFechaInicioDerechaTemp"
                            class="w-1/2 p-2 border rounded-lg">
                        <input type="date" wire:model.defer="filtroFechaFinDerechaTemp"
                            class="w-1/2 p-2 border rounded-lg">
                    </div>
                    <!-- Select Tipo de Destino (mitad) -->
                    <div>
                        <select class="w-full p-2 border rounded-lg text-sm"
                            wire:model.defer="filtroDestinoDerechaTemp">
                            <option value="">Tipo de Destino</option>
                            @foreach ($tiposDestino as $tipo)
                                <option value="{{ $tipo }}">{{ $tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Botón aplicar (mitad) -->
                    <div>
                        <button wire:click="aplicarFiltrosDerecha"
                            class="w-full px-3 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition text-sm"
                            title="Aplicar filtros">
                            Aplicar
                        </button>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="bg-white p-4 rounded-xl shadow-sm h-[calc(100vh-120px)] overflow-y-auto">
                    @if ($paqueteDerechaId)
                        @php
                            $paquete = $paquetes->firstWhere('id', $paqueteDerechaId);
                        @endphp
                        @include('livewire.Paquetes.detalle-paquete', ['paquete' => $paquete])
                        <button wire:click="$set('paqueteDerechaId', null)"
                            class="mt-4 text-sm text-blue-600 hover:underline">Volver a la lista</button>
                    @else
                        <h2 class="text-lg font-bold mb-4 text-blue-700">Selecciona un paquete para la derecha</h2>
                        <div class="grid grid-cols-1 gap-8">
                            @foreach ($paquetesDerecha as $paquete)
                                <div wire:click="seleccionarDerecha({{ $paquete->id }})"
                                    class="cursor-pointer bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 relative flex flex-col h-[420px] min-h-[420px] max-h-[420px]">

                                    @php
                                        $detalles = $paquete->detalles ?? collect();
                                        $detallePromo = $detalles->first(function ($d) {
                                            return $d->promocion && $d->promocion->descuento > 0;
                                        });
                                        $descuento = $detallePromo ? $detallePromo->promocion->descuento : 0;
                                        $precioOriginal = $paquete->preciopaquete;
                                        $precioDescuento =
                                            $descuento > 0
                                                ? $precioOriginal - ($precioOriginal * $descuento) / 100
                                                : $precioOriginal;
                                    @endphp
                                    @if ($descuento > 0)
                                        <!-- Badge de descuento -->
                                        <div
                                            class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                            -{{ $descuento }}%
                                        </div>
                                    @endif

                                    <div class="relative h-48 w-full">
                                        <img src="{{ asset('storage/' . ($paquete->imagen_principal ?? 'images.jfif')) }}"
                                            alt="{{ $paquete->nombrepaquete }}" class="w-full h-full object-cover">
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
                                        <h3 class="text-xl font-bold text-gray-800">{{ $paquete->nombrepaquete }}</h3>
                                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $paquete->descripcion }}</p>
                                        <div class="flex items-center mb-4">
                                            <span class="text-sm text-gray-500 ml-2">
                                                Incluye {{ $paquete->detalles->count() }} servicios/equipos
                                            </span>
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <div class="flex items-center mb-4">
                                                @php
                                                    $detalles = $paquete->detalles ?? collect();
                                                    $detallePromo = $detalles->first(function ($d) {
                                                        return $d->promocion && $d->promocion->descuento > 0;
                                                    });
                                                    $descuento = $detallePromo
                                                        ? $detallePromo->promocion->descuento
                                                        : 0;
                                                    $precioOriginal = $paquete->preciopaquete;
                                                    $precioDescuento =
                                                        $descuento > 0
                                                            ? $precioOriginal - ($precioOriginal * $descuento) / 100
                                                            : $precioOriginal;
                                                @endphp

                                                @if ($descuento > 0)
                                                    <span class="text-sm text-gray-400 line-through ml-2">
                                                        S/ {{ number_format($precioOriginal, 2) }}
                                                    </span>
                                                    <span class="text-lg font-bold text-red-600 ml-2">
                                                        S/ {{ number_format($precioDescuento, 2) }}
                                                    </span>
                                                    <span
                                                        class="text-xs bg-yellow-300 text-yellow-900 font-bold px-2 py-1 rounded ml-2">¡Promoción!</span>
                                                @else
                                                    <span class="text-lg font-bold text-blue-600 ml-2">
                                                        S/ {{ number_format($precioOriginal, 2) }}
                                                    </span>
                                                @endif
                                                <span class="text-sm text-gray-500"> /por persona</span>
                                            </div>
                                            <div class="flex-1"></div>
                                            <div class="w-full flex justify-end mt-4">
                                                <a href=""
                                                    class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                                    Ver detalles
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
