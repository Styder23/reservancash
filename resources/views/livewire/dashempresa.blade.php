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
                        ¡Bienvenido {{ Auth::user()->name }}!
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Explora destinos increíbles, reserva tus viajes y gestiona tus reservas desde aquí.
                    </p>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 lg:p-8">
                    {{-- Card 1: Explorar Destinos --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Explorar Destinos</h3>
                                <p class="text-sm text-gray-600">Descubre lugares increíbles</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-map-marked-alt text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('destinos') }}" class="text-blue-600 hover:text-blue-800 font-medium">Ver
                                destinos →</a>
                        </div>
                    </div>

                    {{-- Card 2: Mis Reservas --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Mis Reservas</h3>
                                <p class="text-sm text-gray-600">Gestiona tus viajes</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-ticket-alt text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-green-600 hover:text-green-800 font-medium">Ver reservas
                                →</a>
                        </div>
                    </div>

                    {{-- Card 3: Servicios Disponibles --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Servicios</h3>
                                <p class="text-sm text-gray-600">Explora nuestros servicios</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-concierge-bell text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('servicios') }}"
                                class="text-yellow-600 hover:text-yellow-800 font-medium">Ver servicios →</a>
                        </div>
                    </div>

                    {{-- Card 4: Empresas Asociadas --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Empresas</h3>
                                <p class="text-sm text-gray-600">Conoce nuestros socios</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-building text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('empresas') }}"
                                class="text-purple-600 hover:text-purple-800 font-medium">Ver empresas →</a>
                        </div>
                    </div>

                    {{-- Card 5: Mi Perfil --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Mi Perfil</h3>
                                <p class="text-sm text-gray-600">Gestiona tu cuenta</p>
                            </div>
                            <div class="bg-gray-100 p-3 rounded-full">
                                <i class="fas fa-user text-gray-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('profile.show') }}"
                                class="text-gray-600 hover:text-gray-800 font-medium">Ver perfil →</a>
                        </div>
                    </div>

                    {{-- Card 6: Favoritos --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Favoritos</h3>
                                <p class="text-sm text-gray-600">Tus destinos favoritos</p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <i class="fas fa-heart text-red-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-red-600 hover:text-red-800 font-medium">Ver favoritos
                                →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
