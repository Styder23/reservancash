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
    <!-- Menú básico público -->
    <nav class="bg-green-500 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 gap-4">
                <div class="flex items-center">
                    <a href="{{ route('inicioapp') }}" class="text-lg font-bold">
                        ReservAncash
                    </a>
                </div>
                <div class="justify-between px-6 mt-3">
                    <input type="text" class="rounded-lg px-2 border-none w-[300px]" placeholder="Buscar...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="flex items-center space-x-8">

                    <a href="{{ route('destinos') }}" class="text-gray-900 font-bold hover:text-gray-500">Destinos</a>
                    <a href="{{ route('empresas') }}" class="text-gray-900 font-bold hover:text-gray-500">Empresas</a>
                    <a href="{{ route('servicios') }}" class="text-gray-900 font-bold hover:text-gray-500">Servicios</a>
                    <a href="{{ route('equipos') }}" class="text-gray-900 font-bold hover:text-gray-500">Equipos</a>
                    <a href="{{ route('login') }}" class="text-gray-900 font-bold hover:text-gray-500">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-900 font-bold hover:text-gray-500">Registro</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
