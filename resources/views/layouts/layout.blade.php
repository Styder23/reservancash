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
    <nav class="bg-green-500 shadow-md text-white">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('inicioapp') }}" class="text-2xl font-extrabold tracking-wide hover:text-white">
                    reserv<span class="text-yellow-300">Áncash</span>
                </a>

                <!-- Botón hamburguesa -->
                <div class="">
                    <img src="{{ 'menu.png' }}" alt="botonmenu" class="w-10 h-10 mr-1">
                </div>

                <!-- Enlaces + buscador (desktop) -->
                <div class="flex justify-between items-center h-16">
                    <!-- Enlaces + buscador (desktop) -->
                    <div class="hidden md:flex items-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <input type="text"
                                class="rounded-full px-4 py-1 text-black focus:outline-none focus:ring-2 focus:ring-yellow-300 w-64"
                                placeholder="Buscar...">
                            <i class="fa-solid fa-magnifying-glass text-white text-lg"></i>
                        </div>
                        <a href="{{ route('pantalladividida') }}"
                            class="hover:text-yellow-300 font-semibold items-center object-contain align-middle">
                            <img src="{{ 'me-gusta.png' }}" alt="destinos" class="w-8 h-8 ml-0 md:ml-4 ">
                            Favoritos
                        </a>
                        <a href="{{ route('destinos') }}" class="hover:text-yellow-300 font-semibold items-center">
                            <img src="{{ 'destino.png' }}" alt="destinos" class="w-8 h-8 ml-0 md:ml-4">
                            Destinos
                        </a>
                        <a href="{{ route('pantalladividida') }}"
                            class="hover:text-yellow-300 font-semibold  items-center">
                            <img src="{{ 'pantalla-dividida.png' }}" alt="destinos" class="w-8 h-8 ml-0 md:ml-5">
                            Comparar
                        </a>
                        <a href="{{ route('login') }}" class="hover:text-yellow-300 font-semibold  items-center">
                            <img src="{{ 'usuario.png' }}" alt="login" class="w-8 h-8 ml-0 md:ml-1">
                            Login
                        </a>
                        <!--a href="{{ route('register') }}"
                            class="hover:text-yellow-300 font-semibold  items-center">
                            <img src="{{ 'me-gusta.png' }}" alt="registro" class="w-8 h-8 mr-1">
                            Registro
                        </a-->
                    </div>
                </div>

                <!-- Menú colapsado (móvil) -->
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


<footer class="bg-gray-500 text-white py-4 mt-8">
    <!-- Es el div principal -->
    <div class="container mx-auto px-6">
        <!-- Div para las 4 columnas de letras -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">

            <!-- 1ª Columna -> Te ayudamos -->
            <div>
                <h3 class="text-lg font-semibold mb-6">Te ayudamos</h3>
                <ul class="space-y-2">
                    <li class="flex items-center gap-3"><a href="#" class="text-gray-300 hover:text-white transition-colors">Libro de Reclamaciones</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Atención por WhatsApp</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Centro de ayuda</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Política de prevención de delitos</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Textos legales</a></li>
                </ul>
            </div>

            <!-- 2ª Columna -> Nuestras empresas -->
            <div>
                <h3 class="text-lg font-semibold mb-6">Nuestras empresas</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Nuestra empresa</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Social Media -->
        <!--div class="flex gap-3 mb-8">
            <a href="#"
                class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center hover:bg-gray-500 transition-colors">
                <i class="fab fa-facebook-f text-white"></i>
            </a>
            <a href="#"
                class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center hover:bg-gray-500 transition-colors">
                <i class="fab fa-instagram text-white"></i>
            </a>
        </div-->

        <!-- Legal Links -->
        <div class="border-t border-gray-600 pt-6 mb-6">
            <div class="flex flex-wrap gap-6 text-sm">
                <a href="#" class="text-gray-300 hover:text-white transition-colors">Términos y condiciones</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors">Política de cookies</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors">Política de privacidad</a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-sm text-gray-400">
            <p class="mb-1">© TODOS LOS DERECHOS RESERVADOS</p>
            <p>@ reservÁncash</p>
        </div>
    </div>

</footer>


</html>
