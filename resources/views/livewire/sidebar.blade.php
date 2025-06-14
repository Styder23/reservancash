<div class="sidebar bg-gray-800 text-white w-64 min-h-screen p-4">
    <div class="logo mb-8">
        <h2 class="text-xl font-bold">TurismoAdmin</h2>
    </div>
    <ul class="space-y-2">
        <!-- Inicio -->
        <li>
            <a href=""
                class="block px-4 py-2 hover:bg-gray-700 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
        </li>
        <!-- Favoritos -->
        <li>
            <a href=""
                class="block px-4 py-2 hover:bg-gray-700 rounded {{ request()->routeIs('admin.destinations.*') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-heart mr-2"></i> Favoritos
            </a>
        </li>
        <!-- Destinos -->
        <li>
            <a href=""
                class="block px-4 py-2 hover:bg-gray-700 rounded {{ request()->routeIs('admin.destinations.*') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-map-marked-alt mr-2"></i> Destinos
            </a>
        </li>
        <!-- Vista Dividida -->
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fas fa-columns mr-2"></i> Vista dividida
            </a>
        </li>
        <!-- Iniciar Sesión -->
        <li x-data="{ open: false }" class="relative">
            <!-- Botón principal -->
            <a href="#" @click.prevent="open = !open" class="block px-4 py-2 hover:bg-gray-700 rounded cursor-pointer {{ request()->routeIs('login') || request()->routeIs('register') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-2"></i>
            </a>
            <!-- Menú desplegable -->
            <div x-show="open" @click.away="open = false" x-transition class="absolute left-0 mt-2 w-48 bg-gray-700 rounded shadow-lg z-50">
                @guest
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-100 hover:bg-gray-900">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-100 hover:bg-gray-900">
                        <i class="fas fa-user-plus mr-2"></i> Register
                    </a>
                @endguest

                @auth
                    <!-- Opción de salir -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-100 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Log out
                        </button>
                    </form>
                @endauth
            </div>
        </li>

    </ul>
</div>


<script src="//unpkg.com/alpinejs" defer></script>
