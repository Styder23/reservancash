<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- WIRE UI -->
    <wireui:scripts />
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <!-- Responsive: Ajustar sidebar en móvil -->
    <style>
        @media (max-width: 768px) {
            .sidebar-mobile {
                position: fixed !important;
                left: -100% !important;
                transition: left 0.3s ease !important;
            }

            .sidebar-mobile.open {
                left: 0 !important;
            }

            .content-mobile {
                margin-left: 0 !important;
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">
    <x-banner />

    <div x-data="{ sidebarOpen: true }" class="flex min-h-screen">
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="bg-gray-800 text-white transition-all duration-300 flex flex-col fixed left-0 top-0 h-full z-40">

            <!-- Logo del Sidebar -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <div class="flex items-center space-x-2">
                    <template x-if="!sidebarOpen">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">RA</span>
                        </div>
                    </template>
                    <span x-show="sidebarOpen" class="text-lg font-bold">
                        Reserv<span class="text-yellow-300">Ancash</span>
                    </span>
                </div>

                <!-- Botón para colapsar -->
                <button @click="sidebarOpen = !sidebarOpen"
                    class="focus:outline-none text-white hover:text-yellow-300 transition-colors">
                    <i :class="sidebarOpen ? 'fas fa-angle-left' : 'fas fa-angle-right'" class="text-lg"></i>
                </button>
            </div>

            <!-- Navegación del Sidebar -->
            <nav class="flex-1 overflow-y-auto mt-2">
                <ul class="space-y-2 px-3">
                    @if (session('user_type') == 'cliente')
                        <!-- Menú para Cliente -->
                        <li>
                            <a href="{{ route('dashboard.cliente') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('dashboard.cliente') ? 'bg-purple-600' : '' }}">
                                <i class="fas fa-home w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Mi Dashboard</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('destinos') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('destinos') ? 'bg-purple-600' : '' }}">
                                <i class="fas fa-map-marked-alt w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Destinos</span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('paquetes') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-heart w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Paquetes Generales</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('servicios') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('servicios') ? 'bg-purple-600' : '' }}">
                                <i class="fas fa-concierge-bell w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Servicios</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('equipos') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-heart w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Equipos</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('reservacli') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-calendar-check w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Mis Reservas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('paquetecliente') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('empresas') ? 'bg-purple-600' : '' }}">
                                <i class="fas fa-building w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Mis Paquetes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('favoritos') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-heart w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Favoritos</span>
                            </a>
                        </li>
                    @elseif(session('user_type') == 'empresa')
                        <!-- Menú para Empresa -->
                        <li>
                            <a href="{{ route('dashboard.empresa') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('dashboard.empresa') ? 'bg-purple-600' : '' }}">
                                <i class="fas fa-tachometer-alt w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Mi Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('det_destinos') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-tools w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Mis Destinos</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('det_servicios') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-tools w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Mis Servicios</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('det_equipos') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-users-cog w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Mis Equipos</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('det_promociones') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-clipboard-list w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Promociones</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('det_paquetes') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-clipboard-list w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Paquetes</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-clipboard-list w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Reservas</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-clipboard-list w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Reportes</span>
                            </a>
                        </li>
                    @else
                        <!-- Menú por defecto -->
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('dashboard') ? 'bg-purple-600' : '' }}">
                                <i class="fas fa-home w-5"></i>
                                <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

        <!-- Contenido Principal -->
        <div class="flex-1 flex flex-col" :class="sidebarOpen ? 'ml-64' : 'ml-20'"
            style="transition: margin-left 0.3s ease;">

            <!-- Header Superior -->
            <header class="bg-gradient-to-r from-purple-600 via-purple-500 to-blue-500 shadow-lg">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">

                        <!-- Título de la página actual -->
                        <div class="flex items-center space-x-4">
                            <h1 class="text-2xl font-bold text-white">
                                @if (isset($header))
                                    {{ $header }}
                                @else
                                    @if (session('user_type') == 'cliente')
                                        Panel Cliente
                                    @elseif(session('user_type') == 'empresa')
                                        Panel Administrativo
                                    @else
                                        Dashboard
                                    @endif
                                @endif
                            </h1>

                            @if (session('user_type') == 'empresa')
                                <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    Datos registrados
                                </span>
                            @endif
                        </div>

                        <!-- Información del Usuario -->
                        <div class="flex items-center space-x-4">
                            <!-- Notificaciones (opcional) -->
                            <button class="relative p-2 text-white hover:bg-white/10 rounded-lg transition-colors">
                                <i class="fas fa-bell text-lg"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                            </button>

                            <!-- Dropdown del Usuario -->
                            <div class="relative" x-data="{ userMenuOpen: false }">
                                <button @click="userMenuOpen = !userMenuOpen"
                                    class="flex items-center space-x-3 text-white hover:bg-white/10 px-3 py-2 rounded-lg transition-colors">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <img class="w-8 h-8 rounded-full object-cover border-2 border-white/30"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    @else
                                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-sm"></i>
                                        </div>
                                    @endif

                                    <div class="text-left">
                                        <div class="font-medium">{{ Auth::user()->name }}</div>
                                        @if (session('user_type'))
                                            <div class="text-xs text-white/80">{{ ucfirst(session('user_type')) }}
                                            </div>
                                        @endif
                                    </div>

                                    <i class="fas fa-chevron-down text-sm" :class={'rotate-180': userMenuOpen}"></i>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">

                                    <div class="px-4 py-2 text-xs text-gray-400 border-b">
                                        Gestionar Cuenta
                                        @if (session('user_type'))
                                            <div class="text-purple-600 font-semibold">
                                                {{ ucfirst(session('user_type')) }}</div>
                                        @endif
                                    </div>

                                    <a href="{{ route('profile.show') }}"
                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user-circle mr-3"></i>
                                        Perfil
                                    </a>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <a href="{{ route('api-tokens.index') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-key mr-3"></i>
                                            API Tokens
                                        </a>
                                    @endif

                                    <div class="border-t border-gray-100 my-1"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            Cerrar Sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Contenido de la Página -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="p-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
    @wireUiScripts

    <!-- Responsive: Overlay para móvil -->
    <div x-show="sidebarOpen && window.innerWidth < 768" @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>



</body>

</html>
