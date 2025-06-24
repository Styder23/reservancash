<div>
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            <span class="text-purple-600">Los paquetes Turisticos</span> para tu Aventura
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($paquetes as $paquete)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="{{ Storage::url($paquete->imagen_principal) }}" alt="{{ $paquete->nombrepaquete }}"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $paquete->nombrepaquete }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($paquete->descripcion, 100) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-teal-600 font-bold text-lg">S/{{ $paquete->preciopaquete }}</span>
                            <button
                                class="bg-purple-600 text-white text-sm px-4 py-2 rounded-full hover:bg-purple-700 transition">
                                Reservar
                            </button>
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
