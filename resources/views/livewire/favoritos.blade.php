<div>

    <!-- destinos.blade.php -->

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Explora nuestros destinos</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @for ($i = 1; $i <= 6; $i++)
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden relative group transition duration-300 hover:scale-105">

                    <!-- Imagen -->
                    <img src="{{ 'Alpamayo en 4k.jpg' }}" class="w-full h-48 object-cover"
                        alt="Destino {{ $i }}">


                    <!-- Card 1 con imagen referencial -->
                    <a href="destino-detalle"
                        class="block border rounded-lg hover:border-green-400 transition-colors overflow-hidden">
                        <div class="relative h-40">
                            <img src="inicioarriba.jpg" alt="Laguna 69" class="w-full h-full object-cover">
                            <button onclick="toggleLike(event)"
                                class="absolute top-2 left-2 bg-white hover:bg-red-500 p-1 rounded-full shadow-md transition-colors like-btn">
                                <img src="me-gusta.png" alt="Me gusta" class="h-5 w-5">
                            </button>
                            <span
                                class="absolute top-2 right-2 bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Recomendado</span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Laguna 69</h3>
                                    <p class="text-sm text-gray-500">Empresa Aventura Total</p>
                                </div>
                                <img src="logo-Principal.png" alt="Logo empresa" class="h-12">
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">S/ 120</span>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">12 horas</span>
                            </div>
                            <!-- Corazón -->
                            <div x-data="{ favorito: false }" class="absolute top-3 right-3">
                                <button class="text-2xl transition-all duration-200 ease-in-out"
                                    :class="favorito ? 'text-red-500 scale-110' : 'text-gray-300 hover:text-red-400'">
                                    <template x-if="favorito">
                                        <span>❤️</span>
                                    </template>
                                    <template x-if="!favorito">
                                        <span>🤍</span>
                                    </template>
                                </button>
                            </div>

                            <!-- Contenido -->
                            <div class="p-4">
                                <h2 class="text-xl font-semibold text-gray-800 mb-1">Destino turístico
                                    {{ $i }}</h2>
                                <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit. Lugar
                                    hermoso.</p>
                            </div>
                        </div>
                    </a>





                </div>
            @endfor
        </div>
    </div>

    <!-- Asegúrate de tener Alpine.js cargado -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>



</div>
