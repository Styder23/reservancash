<div>
    <style>
        .text-pearl-100 {
            color: #f8fafc;
        }

        /* Animaciones personalizadas */
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease-out;
        }

        /* Efectos de hover mejorados */
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Backdrop blur personalizado */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
    </style>
    <div class="relative">
        <!-- Header Navigation -->
        <nav class="bg-gradient-to-r from-purple-600 via-purple-700 to-emerald-500 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">

                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="text-2xl font-bold">
                            <span class="text-purple-300">Reserv</span><span class="text-pearl-100">ancash</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center space-x-8">

                        {{-- <!-- Search Bar -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" wire:model.live="searchTerm" placeholder="Buscar opciones..."
                                class="w-64 pl-10 pr-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-300">

                            <!-- Search Results Dropdown -->
                            @if (!empty($searchTerm) && count($filteredItems) > 0)
                                <div
                                    class="absolute top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-64 overflow-y-auto">
                                    @foreach ($filteredItems as $item)
                                        <a href="{{ route($item['route']) }}"
                                            class="flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-purple-50 hover:to-emerald-50 transition-all duration-200 border-b border-gray-100 last:border-b-0"
                                            wire:click="closeMenu">
                                            <i class="{{ $item['icon'] }} text-purple-600 mr-3"></i>
                                            <span class="text-gray-800 font-medium">{{ $item['name'] }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div> --}}

                        <!-- Navigation Links -->
                        <div class="flex items-center space-x-6">
                            @foreach ($menuItems as $item)
                                <a href="{{ route($item['route']) }}"
                                    class="text-white hover:text-emerald-300 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 hover:bg-white/10 backdrop-blur-sm">
                                    <i class="{{ $item['icon'] }} mr-2"></i>
                                    {{ $item['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mobile Menu Button (RA) -->
                    <div class="lg:hidden">
                        <button wire:click="toggleMenu"
                            class="text-3xl font-bold transition-all duration-300 hover:scale-110 focus:outline-none">
                            <span class="text-purple-300">R</span><span class="text-pearl-100">A</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile Sidebar Overlay -->
        @if ($isOpen)
            <div class="fixed inset-0 z-50 lg:hidden">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" wire:click="closeMenu"></div>

                <!-- Sidebar -->
                <div
                    class="relative flex flex-col w-80 max-w-xs bg-gradient-to-b from-purple-700 via-purple-800 to-emerald-600 shadow-xl transform transition-transform duration-300 ease-in-out h-full">

                    <!-- Header -->
                    <div class="flex items-center justify-between p-6 border-b border-white/20">
                        <h2 class="text-xl font-bold">
                            <span class="text-purple-300">Reserv</span><span class="text-pearl-100">ancash</span>
                        </h2>
                        <button wire:click="closeMenu" class="text-white hover:text-emerald-300 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Mobile Search -->
                    <div class="p-4 border-b border-white/20">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" wire:model.live="searchTerm" placeholder="Buscar opciones..."
                                class="w-full pl-10 pr-4 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Navigation Items -->
                    <div class="flex-1 overflow-y-auto">
                        <nav class="p-4 space-y-2">
                            @php
                                $itemsToShow = !empty($searchTerm) ? $filteredItems : $menuItems;
                            @endphp

                            @forelse($itemsToShow as $item)
                                <a href="{{ route($item['route']) }}" wire:click="closeMenu"
                                    class="flex items-center px-4 py-3 text-white hover:bg-white/10 rounded-lg transition-all duration-300 hover:translate-x-2 group">
                                    <i
                                        class="{{ $item['icon'] }} text-emerald-300 mr-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium">{{ $item['name'] }}</span>
                                    <i
                                        class="fas fa-chevron-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                </a>
                            @empty
                                @if (!empty($searchTerm))
                                    <div class="text-center py-8 text-white/70">
                                        <i class="fas fa-search text-3xl mb-3"></i>
                                        <p>No se encontraron resultados</p>
                                    </div>
                                @endif
                            @endforelse
                        </nav>
                    </div>

                    <!-- Footer -->
                    <div class="p-4 border-t border-white/20">
                        <div class="text-center text-white/70 text-sm">
                            <p>&copy; 2024 Reservancash</p>
                            <p>Tu aventura comienza aquí</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


</div>
