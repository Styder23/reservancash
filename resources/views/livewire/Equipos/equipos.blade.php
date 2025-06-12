<div>
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            <span class="text-purple-600">Nuestros Equipos</span> para tu Aventura
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($equipos as $equipo)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $equipo->imagen) }}" alt="{{ $equipo->nombre }}"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $equipo->nombre }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($equipo->descripcion, 100) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-teal-600 font-bold text-lg">S/{{ $equipo->precio }}</span>
                            <button
                                class="bg-purple-600 text-white text-sm px-4 py-2 rounded-full hover:bg-purple-700 transition">
                                Reservar
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No hay equipos disponibles por ahora.
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        {{-- <div class="mt-8">
            {{ $equipos->links() }}
        </div> --}}
    </div>
</div>
