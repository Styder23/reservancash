<div class="bg-purple-300">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-4">
            <span class="text-purple-600">Empresas asociadas</span> Descubre las opciones
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($empresas as $empresa)
                <div class="bg-white shadow rounded-2xl overflow-hidden border border-gray-200">
                    <!-- Imagen/logo -->
                    <div class="h-40 bg-gray-100 flex items-center justify-center">
                        @if ($empresa->logoempresa)
                            <img src="{{ asset('storage/' . $empresa->logoempresa) }}" alt="Logo" class="h-24">
                        @else
                            <span class="text-gray-400">Sin logo</span>
                        @endif
                    </div>

                    <!-- Info principal -->
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $empresa->nameempresa }}</h2>
                        <p class="text-sm text-gray-600">{{ $empresa->razonsocial }}</p>
                        <p class="text-sm text-gray-500 mt-1"><strong>RUC:</strong> {{ $empresa->rucempresa }}</p>
                        <p class="text-sm text-gray-500"><strong>Dirección:</strong> {{ $empresa->direccionempresa }}
                        </p>
                        <p class="text-sm text-gray-500"><strong>Teléfono:</strong> {{ $empresa->telefonoempresa }}</p>

                        <!-- Representante Legal -->
                        @php
                            $rep = $empresa->replegal->first();
                            $persona = $rep?->persona;
                        @endphp
                        @if ($persona)
                            <p class="text-sm text-gray-500 mt-2"><strong>Representante:</strong> {{ $persona->nombre }}
                                {{ $persona->apellidos }}</p>
                        @endif

                        <!-- Botón ver más -->
                        <div class="mt-4">
                            <a href="{{ route('vistaempresa', $empresa->id) }}"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg shadow transition">
                                Ver más
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
