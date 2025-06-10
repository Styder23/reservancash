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

    <!-- NAVBAR FIJO -->
    <nav class="fixed top-0 left-0 right-0 bg-green-500 shadow-md text-white z-50">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 ml-4">
                    <a href="{{ route('inicioapp') }}" class="text-2xl font-extrabold tracking-wide hover:text-white">
                        reserv<span class="text-white">Áncash</span>
                    </a>
                </div>

                <!-- Centro: Buscador y Enlaces -->
                <div class="flex-1 flex justify-center items-center">
                    <div class="hidden md:flex items-center space-x-8">
                        <!-- Buscador más grande -->
                        <div class="flex items-center space-x-3 bg-white rounded-full px-2 py-1">
                            <input type="text"
                                class="rounded-full px-4 py-2 text-black focus:outline-none w-32 sm:w-48 md:w-64 lg:w-80 xl:w-96 bg-transparent"
                                placeholder="Buscar destinos, actividades...">
                            <i class="fa-solid fa-magnifying-glass text-green-500 text-lg pr-2"></i>
                        </div>

                        <!-- Enlaces de navegación -->
                        <a href="{{ route('pantalladividida') }}"
                            class="flex items-center space-x-2 hover:text-yellow-300 font-semibold">
                            <img src="{{ 'me-gusta.png' }}" alt="favoritos" class="w-6 h-6">
                            <span>Favoritos</span>
                        </a>
                        <a href="{{ route('destinos') }}"
                            class="flex items-center space-x-2 hover:text-yellow-300 font-semibold">
                            <img src="{{ 'destino.png' }}" alt="destinos" class="w-6 h-6">
                            <span>Destinos</span>
                        </a>
                        <a href="{{ route('pantalladividida') }}"
                            class="flex items-center space-x-2 hover:text-yellow-300 font-semibold">
                            <img src="{{ 'pantalla-dividida.png' }}" alt="comparar" class="w-6 h-6">
                            <span>Comparar</span>
                        </a>
                        <a href="{{ route('login') }}"
                            class="flex items-center space-x-2 hover:text-yellow-300 font-semibold">
                            <img src="{{ 'usuario.png' }}" alt="login" class="w-6 h-6">
                            <span>Login</span>
                        </a>
                    </div>
                </div>


                <div id="mobile-menu" class="md:hidden hidden flex-col space-y-2 py-4">
                    <input type="text"
                        class="rounded-full px-4 py-1 text-black focus:outline-none focus:ring-2 focus:ring-yellow-300 w-full"
                        placeholder="Buscar...">
                    <a href="{{ route('destinos') }}"
                        class="block px-2 hover:text-yellow-300 font-semibold">Destinos</a>
                    <a href="{{ route('login') }}" class="block px-2 hover:text-yellow-300 font-semibold">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-2 hover:text-yellow-300 font-semibold">Registro</a>
                </div>
            </div>
        </div>
    </nav>


    <!-- CONTENIDO PRINCIPAL CON MARGEN SUPERIOR -->
    <main class="pt-16">
        {{ $slot }}
    </main>


    @livewireScripts

   



    <!-- CHATBOT FLOTANTE -->
    <div id="chatbot-box" class="fixed bottom-24 right-5 w-80 max-h-[400px] bg-white rounded-2xl shadow-2xl hidden flex-col z-[9999] overflow-hidden">
        <div id="chatbot-header" class="bg-emerald-500 text-white p-4 font-bold flex justify-between items-center">
            Chatbot
            <button onclick="toggleChatbot()" class="text-white font-bold">✖</button>
        </div>

        <!-- AQUÍ VA EL COMPONENTE LIVEWIRE -->
        <div id="chatbot-body" class="p-4 h-[250px] overflow-y-auto">
            @livewire('pantalladividida')
        </div>

        <div id="chatbot-input" class="flex border-t border-gray-300">
            <input type="text" placeholder="Escribe tu mensaje..." class="flex-1 p-2 outline-none border-none"
                disabled>
            <button class="bg-emerald-500 text-white px-4 py-2" disabled>Enviar</button>
        </div>
    </div>


    <div id="chatbot-button" onclick="toggleChatbot()"
        class="fixed bottom-5 right-5 z-[9999] bg-emerald-500 text-white rounded-full w-14 h-14 flex justify-center items-center cursor-pointer shadow-md">
        <i class="fas fa-comments text-2xl"></i>
    </div>

    <div id="chatbot-button" onclick="toggleChatbot()">
        <i class="fas fa-comments text-2xl"></i>
    </div>

    <script>
        function toggleChatbot() {
            const chatbot = document.getElementById('chatbot-box');
            chatbot.style.display = chatbot.style.display === 'flex' ? 'none' : 'flex';
        }
    </script>

</body>




<!-- Todo el pie de pagina -->
<footer class="bg-gray-900 text-white py-8 mt-8">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">Turismo Aventura</h3>
                <p class="text-gray-400">Descubre los mejores destinos y experiencias turísticas con nuestros
                    servicios especializados.</p>
            </div>
            <div>
                <h4 class="text-md font-bold mb-4">Enlaces rápidos</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Inicio</a></li>
                    <li><a href="#servicios"
                            class="text-gray-400 hover:text-white transition duration-300">Servicios</a></li>
                    <li><a href="#contacto" class="text-gray-400 hover:text-white transition duration-300">Contacto</a>
                    </li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Blog</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-md font-bold mb-4">Servicios</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Paquetes
                            turísticos</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Alquiler de
                            equipos</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Guías
                            especializados</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Transporte</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-md font-bold mb-4">Suscríbete</h4>
                <p class="text-gray-400 mb-4">Recibe nuestras ofertas y novedades en tu correo.</p>
                <form class="flex">
                    <input type="email" placeholder="Tu email"
                        class="px-4 py-2 rounded-l-lg focus:outline-none text-gray-800 w-full">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-r-lg transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 ReservAncash pagina del Grupo de tecnologia web. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

</html>
