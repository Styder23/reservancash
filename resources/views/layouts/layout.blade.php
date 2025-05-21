<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Inicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans bg-gray-100">
    <!-- Menú básico público -->
    <nav class="bg-teal-600 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('inicioapp') }}" class="text-lg font-bold">
                        ReservAncash
                    </a>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="{{ route('destinos') }}" class="text-gray-600 font-bold hover:text-gray-900">Destinos</a>
                    <a href="{{ route('empresas') }}" class="text-gray-600 font-bold hover:text-gray-900">Empresas</a>
                    <a href="{{ route('servicios') }}" class="text-gray-600 font-bold hover:text-gray-900">Servicios</a>
                    <a href="{{ route('equipos') }}" class="text-gray-600 font-bold hover:text-gray-900">Equipos</a>
                    <a href="{{ route('login') }}" class="text-gray-600 font-bold hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-600 font-bold hover:text-gray-900">Registro</a>
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
