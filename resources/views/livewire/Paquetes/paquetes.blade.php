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
                            <div class="flex space-x-3">
                                <a href="{{ route('vistapaquete', $paquete->id) }}"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center group">
                                    <span class="mr-1">Ver más</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>

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
