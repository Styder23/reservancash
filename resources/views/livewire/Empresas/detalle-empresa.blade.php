<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-2xl p-6 space-y-6">

        <!-- Encabezado -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $empresa->logoempresa) }}" alt="Logo Empresa"
                    class="w-24 h-24 rounded-full object-cover">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $empresa->nameempresa }}</h1>
                    <p class="text-gray-500">{{ $empresa->razonsocial }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-400">RUC: {{ $empresa->rucempresa }}</p>
                <p class="text-sm text-gray-400">Teléfono: {{ $empresa->telefonoempresa }}</p>
            </div>
        </div>

        <!-- Dirección -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Dirección</h2>
            <p class="text-gray-700 mt-2">{{ $empresa->direccionempresa }}</p>
        </div>

        <!-- Representante legal -->
        @php
            $rep = $empresa->replegal->first()?->persona;
        @endphp
        @if ($rep)
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Representante Legal</h2>
                <p class="text-gray-700 mt-2">
                    {{ $rep->nombre }} {{ $rep->apellidos }} <br>
                    DNI: {{ $rep->dni }} <br>
                    Email: {{ $rep->email }} <br>
                    Teléfono: {{ $rep->telefono }}
                </p>
            </div>
        @endif

        <!-- Galería de imágenes (placeholder) -->
        {{-- <div>
            <h2 class="text-xl font-semibold text-gray-800">Galería</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                @for ($i = 0; $i < 4; $i++)
                    <img src="{{ asset('images/empresa-placeholder.jpg') }}"
                        class="rounded-xl object-cover h-40 w-full" alt="Galería">
                @endfor
            </div>
        </div> --}}

        <!-- Video institucional (opcional) -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Video Institucional</h2>
            <div class="aspect-w-16 aspect-h-9 mt-4">
                <iframe class="rounded-xl w-full h-96" src="https://www.youtube.com/embed/uT1USSrmN7c" frameborder="0"
                    allowfullscreen></iframe>
            </div>
        </div>

        <!-- Equipo de trabajo (solo nombres si no tienes roles) -->
        @if ($empresa->equipo->count())
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Equipo de Trabajo</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @foreach ($empresa->equipo as $item)
                        <div class="bg-gray-50 rounded-xl p-4 shadow">
                            <img src="{{ asset('images/default-user.png') }}"
                                class="w-20 h-20 rounded-full mx-auto object-cover" alt="">
                            <div class="text-center mt-2">
                                <h3 class="font-semibold text-lg">Miembro N°{{ $loop->iteration }}</h3>
                                <p class="text-gray-500 text-sm">Rol no definido</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Paquetes turísticos -->
        @if ($ultimos_paquetes->count())
            <div class="mb-12">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Paquetes Turísticos</h2>
                    <a href="{{ route('paquetes', $empresa->id) }}"
                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center">
                        Ver todos
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($ultimos_paquetes as $paquete)
                        <div
                            class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 group border border-gray-200">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $paquete->imagen_principal) }}"
                                    alt="{{ $paquete->nombrepaquete }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">

                                <div
                                    class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                    {{ $paquete->estado ?? 'Disponible' }}
                                </div>
                            </div>
                            <div class="p-4 space-y-3">
                                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M3 10h11M9 21V3M16 17l5-5-5-5" />
                                    </svg>
                                    {{ $paquete->nombrepaquete }}
                                </h3>
                                <p class="text-gray-600 text-sm">{{ Str::limit($paquete->descripcion, 90) }}</p>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-lg font-bold text-green-600">S/
                                            {{ number_format($paquete->preciopaquete, 2) }}</span>
                                        <span class="text-sm text-gray-500 block">por persona</span>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M3 3h18M3 12h18M3 21h18" />
                                            </svg>
                                            {{ $paquete->cantidadpaquete }} cupos
                                        </span>
                                    </div>
                                </div>

                                <a href="{{ route('vistapaquete', $paquete->id) }}"
                                    class="mt-3 inline-block w-full bg-blue-600 hover:bg-blue-700 text-white text-center text-sm font-semibold px-4 py-2 rounded-lg transition">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
