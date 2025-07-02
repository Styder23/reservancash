<div class="container mx-auto px-4 py-10">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Comparador de Paquetes Turísticos</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Selecciona dos paquetes para comparar características, precios y
            servicios incluidos</p>
    </div>

    <!-- Selectores de paquetes -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <label class="block mb-2 font-medium text-gray-700">Primer paquete</label>
            <div class="relative">
                <select wire:model="paqueteAId" class="w-full border-gray-300 rounded-lg shadow-sm pr-10">
                    <option value="">-- Selecciona un paquete --</option>
                    @foreach ($paquetes as $paq)
                        <option value="{{ $paq->id }}">{{ $paq->nombrepaquete }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Segundo paquete</label>
            <div class="relative">
                <select wire:model="paqueteBId" class="w-full border-gray-300 rounded-lg shadow-sm pr-10">
                    <option value="">-- Selecciona un paquete --</option>
                    @foreach ($paquetes as $paq)
                        <option value="{{ $paq->id }}">{{ $paq->nombrepaquete }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Mostrar comparación solo cuando hay dos paquetes seleccionados -->
    @if ($paqueteA && $paqueteB)
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <!-- Resumen comparativo -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 border-b">
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Precio</h3>
                    <div class="flex justify-center items-baseline">
                        @php
                            $precioA = $paqueteA->det_paquete->first()->promos
                                ? $paqueteA->preciopaquete *
                                    (1 - $paqueteA->det_paquete->first()->promos->descuento / 100)
                                : $paqueteA->preciopaquete;

                            $precioB = $paqueteB->det_paquete->first()->promos
                                ? $paqueteB->preciopaquete *
                                    (1 - $paqueteB->det_paquete->first()->promos->descuento / 100)
                                : $paqueteB->preciopaquete;
                        @endphp

                        @if ($precioA < $precioB)
                            <span class="text-2xl font-bold text-green-600">S/.{{ number_format($precioA, 2) }}</span>
                            <span class="text-lg text-gray-500 ml-2">vs S/.{{ number_format($precioB, 2) }}</span>
                        @elseif($precioA > $precioB)
                            <span class="text-lg text-gray-500 mr-2">S/.{{ number_format($precioA, 2) }} vs</span>
                            <span class="text-2xl font-bold text-green-600">S/.{{ number_format($precioB, 2) }}</span>
                        @else
                            <span class="text-xl font-bold text-blue-600">S/.{{ number_format($precioA, 2) }}</span>
                            <span class="mx-2 text-gray-400">=</span>
                            <span class="text-xl font-bold text-blue-600">S/.{{ number_format($precioB, 2) }}</span>
                        @endif
                    </div>
                </div>

                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Duración</h3>
                    <div class="flex justify-center items-baseline">
                        @if ($paqueteA->itinerarios->count() > $paqueteB->itinerarios->count())
                            <span class="text-xl font-bold text-blue-600">{{ $paqueteA->itinerarios->count() }}
                                días</span>
                            <span class="mx-2 text-gray-400">></span>
                            <span class="text-lg text-gray-600">{{ $paqueteB->itinerarios->count() }} días</span>
                        @elseif($paqueteA->itinerarios->count() < $paqueteB->itinerarios->count())
                            <span class="text-lg text-gray-600">{{ $paqueteA->itinerarios->count() }} días</span>
                            <span class="mx-2 text-gray-400">
                                << /span>
                                    <span class="text-xl font-bold text-blue-600">{{ $paqueteB->itinerarios->count() }}
                                        días</span>
                                @else
                                    <span class="text-xl font-bold text-blue-600">{{ $paqueteA->itinerarios->count() }}
                                        días</span>
                                    <span class="mx-2 text-gray-400">=</span>
                                    <span class="text-xl font-bold text-blue-600">{{ $paqueteB->itinerarios->count() }}
                                        días</span>
                        @endif
                    </div>
                </div>

                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Servicios incluidos</h3>
                    <div class="flex justify-center items-baseline">
                        @if ($paqueteA->ser_paquete->count() > $paqueteB->ser_paquete->count())
                            <span class="text-xl font-bold text-blue-600">{{ $paqueteA->ser_paquete->count() }}</span>
                            <span class="mx-2 text-gray-400">></span>
                            <span class="text-lg text-gray-600">{{ $paqueteB->ser_paquete->count() }}</span>
                        @elseif($paqueteA->ser_paquete->count() < $paqueteB->ser_paquete->count())
                            <span class="text-lg text-gray-600">{{ $paqueteA->ser_paquete->count() }}</span>
                            <span class="mx-2 text-gray-400">
                                << /span>
                                    <span
                                        class="text-xl font-bold text-blue-600">{{ $paqueteB->ser_paquete->count() }}</span>
                                @else
                                    <span
                                        class="text-xl font-bold text-blue-600">{{ $paqueteA->ser_paquete->count() }}</span>
                                    <span class="mx-2 text-gray-400">=</span>
                                    <span
                                        class="text-xl font-bold text-blue-600">{{ $paqueteB->ser_paquete->count() }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Comparación detallada -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                <!-- Encabezados -->
                <div class="bg-gray-50 p-4 border-r">
                    <h3 class="font-bold text-gray-800">Características</h3>
                </div>
                <div class="bg-gray-50 p-4 border-r">
                    <h3 class="font-bold text-center text-gray-800">{{ $paqueteA->nombrepaquete }}</h3>
                </div>
                <div class="bg-gray-50 p-4">
                    <h3 class="font-bold text-center text-gray-800">{{ $paqueteB->nombrepaquete }}</h3>
                </div>

                <!-- Filas de comparación -->
                @foreach ($comparisonAttributes as $attribute => $label)
                    <div class="p-4 border-t border-r">
                        <span class="font-medium text-gray-700">{{ $label }}</span>
                    </div>
                    <div class="p-4 border-t border-r">
                        <span class="block text-center">
                            @if ($attribute === 'destino')
                                {{ $paqueteA->det_paquete->first()->destino->namedestino }}
                            @elseif($attribute === 'duracion')
                                {{ $paqueteA->itinerarios->count() }} días
                            @elseif($attribute === 'precio')
                                @if ($paqueteA->det_paquete->first()->promos)
                                    <span
                                        class="text-sm line-through text-gray-500">S/.{{ number_format($paqueteA->preciopaquete, 2) }}</span><br>
                                    <span
                                        class="font-bold text-blue-600">S/.{{ number_format($paqueteA->preciopaquete * (1 - $paqueteA->det_paquete->first()->promos->descuento / 100), 2) }}</span>
                                @else
                                    S/.{{ number_format($paqueteA->preciopaquete, 2) }}
                                @endif
                            @elseif($attribute === 'empresa')
                                {{ $paqueteA->empresa->nameempresa }}
                            @elseif($attribute === 'servicios')
                                <ul class="space-y-1 text-left">
                                    @foreach ($paqueteA->ser_paquete->take(3) as $servicio)
                                        <li class="flex items-center">
                                            <svg class="w-3 h-3 text-green-500 mr-1" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span
                                                class="text-sm">{{ $servicio->servicio->Det_servicio->nombreservicio }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </span>
                    </div>
                    <div class="p-4 border-t">
                        <span class="block text-center">
                            @if ($attribute === 'destino')
                                {{ $paqueteB->det_paquete->first()->destino->namedestino }}
                            @elseif($attribute === 'duracion')
                                {{ $paqueteB->itinerarios->count() }} días
                            @elseif($attribute === 'precio')
                                @if ($paqueteB->det_paquete->first()->promos)
                                    <span
                                        class="text-sm line-through text-gray-500">S/.{{ number_format($paqueteB->preciopaquete, 2) }}</span><br>
                                    <span
                                        class="font-bold text-blue-600">S/.{{ number_format($paqueteB->preciopaquete * (1 - $paqueteB->det_paquete->first()->promos->descuento / 100), 2) }}</span>
                                @else
                                    S/.{{ number_format($paqueteB->preciopaquete, 2) }}
                                @endif
                            @elseif($attribute === 'empresa')
                                {{ $paqueteB->empresa->nameempresa }}
                            @elseif($attribute === 'servicios')
                                <ul class="space-y-1 text-left">
                                    @foreach ($paqueteB->ser_paquete->take(3) as $servicio)
                                        <li class="flex items-center">
                                            <svg class="w-3 h-3 text-green-500 mr-1" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span
                                                class="text-sm">{{ $servicio->servicio->Det_servicio->nombreservicio }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tarjetas de paquetes para referencia -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @include('components.card-paquete', ['paquete' => $paqueteA])
            @include('components.card-paquete', ['paquete' => $paqueteB])
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-medium text-gray-700 mb-2">Selecciona dos paquetes para comparar</h3>
            <p class="text-gray-500">Elige dos opciones de la lista desplegable para ver una comparación detallada.</p>
        </div>
    @endif
</div>
