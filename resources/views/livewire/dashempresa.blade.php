<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    {{-- <x-application-logo class="block h-12 w-auto" /> --}}
                    <a href="{{ route('inicioapp') }}" class="text-2xl font-extrabold tracking-wide hover:text-white">
                        Reserv<span class="text-yellow-300">Ancash</span>
                    </a>
                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        ¡Bienvenido al Panel de Empresa!
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Desde aquí puedes gestionar tus servicios, equipos, reservas y más.
                    </p>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 lg:p-8">
                    {{-- Card 1: Gestionar Servicios --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Mis Servicios</h3>
                                <p class="text-sm text-gray-600">Gestiona tus servicios</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-concierge-bell text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Ver servicios
                                →</a>
                        </div>
                    </div>

                    {{-- Card 2: Gestionar Equipos --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Mis Equipos</h3>
                                <p class="text-sm text-gray-600">Administra tu flota</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-bus text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-green-600 hover:text-green-800 font-medium">Ver equipos
                                →</a>
                        </div>
                    </div>

                    {{-- Card 3: Reservas --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Reservas</h3>
                                <p class="text-sm text-gray-600">Gestionar reservas</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-calendar-check text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-yellow-600 hover:text-yellow-800 font-medium">Ver reservas
                                →</a>
                        </div>
                    </div>

                    {{-- Card 4: Estadísticas --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Estadísticas</h3>
                                <p class="text-sm text-gray-600">Reportes y análisis</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Ver
                                estadísticas →</a>
                        </div>
                    </div>

                    {{-- Card 5: Configuración --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Configuración</h3>
                                <p class="text-sm text-gray-600">Ajustes de empresa</p>
                            </div>
                            <div class="bg-gray-100 p-3 rounded-full">
                                <i class="fas fa-cogs text-gray-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-gray-600 hover:text-gray-800 font-medium">Configurar →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
