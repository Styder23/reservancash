<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Sección principal del servicio -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        {{-- Galería lateral --}}
        <div class="col-span-1 hidden md:flex flex-col space-y-4">
            <div class="sticky top-4">
                <h3 class="font-bold text-lg mb-3 text-gray-700">Galería</h3>
                <div class="space-y-3 overflow-y-auto max-h-[450px] pr-2">
                    @foreach ($servicio->Det_servicio->imagenes as $img)
                        <img src="{{ asset('storage/' . $img->url) }}"
                            class="w-full h-24 object-cover border rounded-md cursor-pointer hover:ring-2 hover:ring-purple-500 transition-all"
                            alt="Miniatura" wire:key="image-{{ $img->id }}"
                            wire:click="$set('imagenPrincipal', '{{ $img->url }}')"
                            :class="{ 'ring-2 ring-purple-500': '{{ $img->url }}' === imagenPrincipal }">
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Imagen principal (ahora interactiva) --}}
        <div class="col-span-1 md:col-span-1 flex justify-center items-start">
            <div class="sticky top-4 w-full">
                <img src="{{ asset('storage/' . ($imagenPrincipal ?? ($servicio->Det_servicio->imagenPrincipal->url ?? 'default.jpg'))) }}"
                    alt="Imagen principal"
                    class="rounded-xl shadow-md w-full max-w-[500px] object-cover border transition-all duration-300"
                    id="imagenPrincipal">
                @if ($servicio->Det_servicio->tiposervicio)
                    <div class="mt-3 text-center">
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $servicio->Det_servicio->tiposervicio->nombre }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Información del servicio --}}
        <div class="col-span-1 space-y-6">
            {{-- Badge destacado --}}
            @if ($servicio->es_destacado)
                <span class="inline-block bg-orange-500 text-white px-3 py-1 text-sm font-semibold rounded">
                    Servicio destacado
                </span>
            @endif

            <h1 class="text-3xl font-bold text-gray-800">{{ $servicio->Det_servicio->nombreservicio }}</h1>

            {{-- Empresa --}}
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $servicio->empresa->logoempresa) }}"
                        class="w-12 h-12 rounded-full object-cover border" alt="Logo empresa">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $servicio->empresa->nameempresa }}</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <i class="fas fa-phone-alt mr-2"></i>
                            <span>{{ $servicio->empresa->telefonoempresa }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $servicio->empresa->direccionempresa }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Precio y disponibilidad --}}
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-sm text-gray-500">Precio:</span>
                    <div class="text-3xl text-green-600 font-bold">
                        S/ {{ number_format($servicio->Det_servicio->precioservicio, 2) }}
                    </div>
                </div>
                <div class="text-sm bg-green-100 text-green-800 px-3 py-1 rounded-full">
                    <i class="fas fa-check-circle mr-1"></i>
                    Disponible ({{ $servicio->cantidadservicio }} unidades)
                </div>
            </div>

            {{-- Descripción completa --}}
            <div class="bg-white p-4 rounded-lg border">
                <h3 class="font-semibold text-lg mb-2 text-gray-700">Descripción del servicio</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ $servicio->Det_servicio->descripcionservicio }}
                </p>
            </div>

            {{-- Botones de acción --}}
            <div class="flex flex-col space-y-3">
                <a href="https://wa.me/{{ $servicio->empresa->telefonoempresa }}?text=Hola, deseo alquilar el servicio {{ urlencode($servicio->Det_servicio->nombreservicio) }}"
                    target="_blank"
                    class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition text-lg font-medium">
                    <i class="fab fa-whatsapp mr-2 text-xl"></i> Contactar por WhatsApp
                </a>

                <button
                    class="inline-flex items-center justify-center px-6 py-3 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700 transition text-lg font-medium">
                    <i class="fas fa-shopping-cart mr-2"></i> Agregar al carrito
                </button>
            </div>
        </div>
    </div>

    <!-- Servicios relacionados de la misma empresa -->
    @if ($serviciosRelacionados->count() > 0)
        <div class="mt-16 border-t pt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Otros servicios de {{ $servicio->empresa->nameempresa }}
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($serviciosRelacionados as $servicioRel)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . ($servicioRel->Det_servicio->imagenPrincipal->url ?? 'default.jpg')) }}"
                                alt="{{ $servicioRel->Det_servicio->nombreservicio }}"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div
                                class="absolute top-2 right-2 bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded">
                                S/ {{ number_format($servicioRel->Det_servicio->precioservicio, 2) }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">
                                {{ $servicioRel->Det_servicio->nombreservicio }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $servicioRel->Det_servicio->descripcionservicio }}
                            </p>
                            <a href="{{ route('vistaservicio', $servicioRel->id) }}"
                                class="inline-block w-full text-center bg-purple-100 text-purple-800 hover:bg-purple-200 px-4 py-2 rounded-md font-medium transition">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
