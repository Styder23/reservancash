<!-- resources/views/layouts/app.blade.php o similar -->

<!-- AlpineJS ya debe estar cargado -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ sidebarOpen: true }" class="flex min-h-screen bg-gray-100 ">
    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="bg-gray-800 text-white transition-all duration-300 flex flex-col">
        <!-- Encabezado con botón -->
        <div class="flex items-center justify-between p-4 border-b border-gray-700">
            <div class="flex items-center space-x-2">
                <!-- Icono/logo -->
                <template x-if="!sidebarOpen">
                    <img src="{{ asset('Sin título.png') }}" alt="Logo" class="w-6 h-4" />
                </template>
                <span x-show="sidebarOpen" class="text-lg font-bold">
                    <h2 class="text-xl font-bold">reservÁncash</h2>
                </span>
            </div>

            <!-- Botón para colapsar -->
            <button @click="sidebarOpen = !sidebarOpen" class="focus:outline-none text-white">
                <i :class="sidebarOpen ? 'fas fa-angle-left' : 'fas fa-angle-right'"></i>
            </button>
        </div>

        <!-- Navegación -->
        <nav class="flex-1 overflow-y-auto mt-2">
            <ul>
                <!-- Inicio -->
                <li class="p-4 hover:bg-gray-700">
                    <a href="{{ route('inicioapp') }}" class="flex items-center">
                        <i class="fas fa-home mr-2"></i>
                        <span x-show="sidebarOpen">Inicio</span>
                    </a>
                </li>
                <!-- Favoritos -->
                <li class="p-4 hover:bg-gray-700">
                    <a href="{{ route('favoritos') }}" class="flex items-center">
                        <i class="fas fa-heart mr-2"></i>
                        <span x-show="sidebarOpen">Favoritos</span>
                    </a>
                </li>
                <!-- Destinos -->
                <li class="p-4 hover:bg-gray-700">
                    <a href="{{ route('destinos') }}" class="flex items-center">
                        <i class="fas fa-map-marked mr-2"></i>
                        <span x-show="sidebarOpen">Destinos</span>
                    </a>
                </li>
                <!-- Vista Dividida -->
                <li class="p-4 hover:bg-gray-700">
                    <a href="{{ route('pantalladividida') }}" class="flex items-center">
                        <i class="fas fa-columns mr-2"></i>
                        <span x-show="sidebarOpen">Vista Dividida</span>
                    </a>
                </li>
                <!-- Iniciar Sesión -->
                <li x-data="{ open: false }" @mouseleave="open = false" class="p-4 hover:bg-gray-700 relative">

                    <!-- Botón principal -->
                    <a href="#" @click.prevent="open = !open" class="flex items-center justify-between w-full">
                        <div class="flex items-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            <span x-show="sidebarOpen">Iniciar Sesión</span>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" x-show="sidebarOpen"></i>
                    </a>

                    <!-- Menú desplegable vertical -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="mt-2 w-full bg-gray-700 rounded shadow-lg z-50" x-cloak>

                        @guest
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-100 hover:bg-gray-900">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-100 hover:bg-gray-900">
                                <i class="fas fa-user-plus mr-2"></i> Register
                            </a>
                        @endguest

                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-100 hover:bg-gray-900">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Log out
                                </button>
                            </form>
                        @endauth
                    </div>
                </li>

            </ul>
        </nav>
    </div>
</div>


<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="//unpkg.com/alpinejs" defer></script>
