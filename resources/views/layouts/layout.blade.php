<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans bg-gray-100">
    <!-- Menú público mejorado -->
<!-- Menú público mejorado y responsive -->
<nav class="bg-green-600 shadow-md text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('inicioapp') }}" class="text-2xl font-extrabold tracking-wide hover:text-white">
                Reserv<span class="text-yellow-300">Ancash</span>
            </a>

            <!-- Botón hamburguesa -->
            <div class="md:hidden">
                <button id="menu-toggle" class="focus:outline-none">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Enlaces + buscador (desktop) -->
            <div class="hidden md:flex items-center space-x-6">
                <div class="flex items-center space-x-2">
                    <input 
                        type="text" 
                        class="rounded-full px-4 py-1 text-black focus:outline-none focus:ring-2 focus:ring-yellow-300 w-64" 
                        placeholder="Buscar...">
                    <i class="fa-solid fa-magnifying-glass text-white text-lg"></i>
                </div>
                <a href="{{ route('destinos') }}" class="hover:text-yellow-300 font-semibold">Destinos</a>
                <a href="{{ route('login') }}" class="hover:text-yellow-300 font-semibold">Login</a>
                <a href="{{ route('register') }}" class="hover:text-yellow-300 font-semibold">Registro</a>
            </div>
        </div>

        <!-- Menú colapsado (móvil) -->
        <div id="mobile-menu" class="md:hidden hidden flex-col space-y-2 py-4">
            <input 
                type="text" 
                class="rounded-full px-4 py-1 text-black focus:outline-none focus:ring-2 focus:ring-yellow-300 w-full" 
                placeholder="Buscar...">
            <a href="{{ route('destinos') }}" class="block px-2 hover:text-yellow-300 font-semibold">Destinos</a>
            <a href="{{ route('login') }}" class="block px-2 hover:text-yellow-300 font-semibold">Login</a>
            <a href="{{ route('register') }}" class="block px-2 hover:text-yellow-300 font-semibold">Registro</a>
        </div>
    </div>
</nav>

<!-- Script toggle -->
<script>
    const toggleBtn = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    toggleBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>



    <!-- Contenido principal -->
    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
