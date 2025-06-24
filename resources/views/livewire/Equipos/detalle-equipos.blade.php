<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Sección principal del equipo -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        {{-- Galería lateral --}}
        <div class="col-span-1 hidden md:flex flex-col space-y-4">
            <div class="sticky top-4">
                <h3 class="font-bold text-lg mb-3 text-gray-700">Galería</h3>
                <div class="space-y-3 overflow-y-auto max-h-[450px] pr-2">
                    @foreach ($equipo->Det_equipo->imagenes as $img)
                        <img src="{{ asset('storage/' . $img->url) }}"
                            class="w-full h-24 object-cover border rounded-md cursor-pointer hover:ring-2 hover:ring-purple-500 transition-all"
                            alt="Miniatura" wire:key="image-{{ $img->id }}"
                            wire:click="cambiarImagen('{{ $img->url }}')"
                            :class="{ 'ring-2 ring-purple-500': '{{ $img->url }}'
                                === '{{ $imagenPrincipal }}' }">
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Imagen principal --}}
        <div class="col-span-1 md:col-span-1 flex justify-center items-start">
            <div class="sticky top-4 w-full">
                <img src="{{ asset('storage/' . ($imagenPrincipal ?? ($equipo->Det_equipo->imagenes->first()->url ?? 'default.jpg'))) }}"
                    alt="Imagen principal"
                    class="rounded-xl shadow-md w-full max-w-[500px] object-cover border transition-all duration-300"
                    id="imagenPrincipal">
            </div>
        </div>

        {{-- Información del equipo --}}
        <div class="col-span-1 space-y-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $equipo->Det_equipo->name_equipo }}</h1>

            {{-- Especificaciones técnicas --}}
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-lg mb-3 text-gray-700">Especificaciones técnicas</h3>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <span class="text-gray-500">Marca:</span>
                        <p class="font-medium">{{ $equipo->Det_equipo->marca->nombre ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Modelo:</span>
                        <p class="font-medium">{{ $equipo->Det_equipo->modelo->nombre ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Serie:</span>
                        <p class="font-medium">{{ $equipo->Det_equipo->serie->nombre ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Categoría:</span>
                        <p class="font-medium">{{ $equipo->Det_equipo->categoria->nombre ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Tipo:</span>
                        <p class="font-medium">{{ $equipo->Det_equipo->tipoequipo->nombre ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{-- Precio y disponibilidad --}}
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-sm text-gray-500">Precio:</span>
                    <div class="text-3xl text-green-600 font-bold">
                        S/ {{ number_format($equipo->Det_equipo->precio_equipo, 2) }}
                    </div>
                </div>
                <div class="text-sm bg-green-100 text-green-800 px-3 py-1 rounded-full">
                    <i class="fas fa-check-circle mr-1"></i>
                    Disponible ({{ $equipo->cantidadequipo }} unidades)
                </div>
            </div>

            {{-- Empresa --}}
            <div class="flex items-center space-x-4 p-3 border rounded-lg">
                <img src="{{ asset('storage/' . $equipo->empresa->logoempresa) }}"
                    class="w-12 h-12 rounded-full object-cover border" alt="Logo empresa">
                <div>
                    <h3 class="font-semibold text-gray-800">{{ $equipo->empresa->nameempresa }}</h3>
                    <div class="flex items-center text-sm text-gray-500 mt-1">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span>{{ $equipo->empresa->telefonoempresa }}</span>
                    </div>
                </div>
            </div>

            {{-- Descripción --}}
            <div class="bg-white p-4 rounded-lg border">
                <h3 class="font-semibold text-lg mb-2 text-gray-700">Descripción</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ $equipo->Det_equipo->descripcion_equipo }}
                </p>
            </div>

            {{-- Botones de acción --}}
            <div class="flex flex-col space-y-3">
                <a href="https://wa.me/{{ $equipo->empresa->telefonoempresa }}?text=Hola, estoy interesado en el equipo {{ urlencode($equipo->Det_equipo->name_equipo) }}"
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

    <!-- Equipos relacionados -->
    @if ($equiposRelacionados->count() > 0)
        <div class="mt-16 border-t pt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Equipos similares de {{ $equipo->empresa->nameempresa }}
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($equiposRelacionados as $equipoRel)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . ($equipoRel->Det_equipo->imagenes->first()->url ?? 'default.jpg')) }}"
                                alt="{{ $equipoRel->Det_equipo->name_equipo }}"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div
                                class="absolute top-2 right-2 bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded">
                                S/ {{ number_format($equipoRel->Det_equipo->precio_equipo, 2) }}
                            </div>
                            @if ($equipoRel->Det_equipo->marca)
                                <div
                                    class="absolute bottom-2 left-2 bg-white text-gray-800 text-xs font-bold px-2 py-1 rounded">
                                    {{ $equipoRel->Det_equipo->marca->nombre }}
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $equipoRel->Det_equipo->name_equipo }}
                            </h3>
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="fas fa-box-open mr-2"></i>
                                <span>{{ $equipoRel->cantidadequipo }} disponibles</span>
                            </div>
                            <a href="{{ route('detalle-equipo', $equipoRel->id) }}"
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
