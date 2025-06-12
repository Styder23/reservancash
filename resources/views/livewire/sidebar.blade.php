<div class="sidebar bg-gray-800 text-white w-64 min-h-screen p-4">
    <div class="logo mb-8">
        <h2 class="text-xl font-bold">TurismoAdmin</h2>
    </div>
    <ul class="space-y-2">
        <li>
            <a href=""
                class="block px-4 py-2 hover:bg-gray-700 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href=""
                class="block px-4 py-2 hover:bg-gray-700 rounded {{ request()->routeIs('admin.destinations.*') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-map-marked-alt mr-2"></i> Destinos
            </a>
        </li>
        <!-- Más opciones -->
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fas fa-box-open mr-2"></i> Paquetes
            </a>
        </li>
    </ul>
</div>
