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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Styles -->
    @livewireStyles
</head>

<body class="min-h-screen">
    <!-- Wrapper principal que garantiza que el footer esté visible -->
    <div class="min-h-screen flex flex-col">
        @livewire('menu-gneral')

        <!-- Contenido principal -->
        <main class="font-sans text-gray-900 antialiased flex-1">
            {{ $slot }}
        </main>

        <!-- Footer siempre al final -->
        <footer class="bg-gray-900 text-white py-8 mt-8">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-bold mb-4">
                            <i class="fas fa-mountain mr-2 text-emerald-400"></i>
                            Turismo Aventura
                        </h3>
                        <p class="text-gray-400">Descubre los mejores destinos y experiencias turísticas con nuestros
                            servicios especializados.</p>
                    </div>
                    <div>
                        <h4 class="text-md font-bold mb-4">Enlaces rápidos</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                                    <i class="fas fa-home mr-2"></i>Inicio</a></li>
                            <li><a href="#servicios"
                                    class="text-gray-400 hover:text-emerald-400 transition duration-300">
                                    <i class="fas fa-concierge-bell mr-2"></i>Servicios</a></li>
                            <li><a href="#contacto"
                                    class="text-gray-400 hover:text-emerald-400 transition duration-300">
                                    <i class="fas fa-envelope mr-2"></i>Contacto</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                                    <i class="fas fa-blog mr-2"></i>Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-md font-bold mb-4">Servicios</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                                    <i class="fas fa-suitcase mr-2"></i>Paquetes turísticos</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                                    <i class="fas fa-tools mr-2"></i>Alquiler de equipos</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                                    <i class="fas fa-user-tie mr-2"></i>Guías especializados</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                                    <i class="fas fa-bus mr-2"></i>Transporte</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-md font-bold mb-4">
                            <i class="fas fa-bell mr-2"></i>Suscríbete
                        </h4>
                        <p class="text-gray-400 mb-4">Recibe nuestras ofertas y novedades en tu correo.</p>
                        <form class="flex" onsubmit="handleSubscription(event)">
                            <input type="email" placeholder="Tu email" required
                                class="px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 text-gray-800 w-full">
                            <button type="submit"
                                class="bg-emerald-600 hover:bg-emerald-700 px-4 py-2 rounded-r-lg transition duration-300">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2025 ReservAncash - Página del Grupo de Tecnología Web. Todos los derechos reservados.</p>
                    <div class="flex justify-center space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-emerald-400 transition duration-300">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- BOTÓN FLOTANTE PARA ACTIVAR CHATBOT -->
    <button id="chatbot-toggle" onclick="toggleChatbot()"
        class="fixed bottom-5 right-5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full p-4 shadow-lg transition-all duration-300 z-[9998]">
        <i class="fas fa-comment text-xl"></i>
    </button>

    <!-- CHATBOT FLOTANTE -->
    <div id="chatbot-box"
        class="fixed bottom-24 right-5 w-80 max-h-[400px] bg-white rounded-2xl shadow-2xl hidden flex-col z-[9999] overflow-hidden border border-gray-200">
        <div id="chatbot-header" class="bg-emerald-500 text-white p-4 font-bold flex justify-between items-center">
            <span><i class="fas fa-robot mr-2"></i>Chatbot</span>
            <button onclick="toggleChatbot()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- AQUÍ VA EL COMPONENTE LIVEWIRE -->
        <div id="chatbot-body" class="p-4 h-[250px] overflow-y-auto bg-gray-50">

        </div>

        <div id="chatbot-input" class="flex border-t border-gray-300 bg-white">
            <input type="text" placeholder="Escribe tu mensaje..."
                class="flex-1 p-3 outline-none border-none text-sm" id="chatbot-message-input">
            <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 transition-colors">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    @livewireScripts
    @wireUiScripts

    <script>
        // Función para mostrar/ocultar chatbot
        function toggleChatbot() {
            const chatbot = document.getElementById('chatbot-box');
            const toggle = document.getElementById('chatbot-toggle');

            if (chatbot.classList.contains('hidden')) {
                chatbot.classList.remove('hidden');
                chatbot.classList.add('flex');
                toggle.style.transform = 'scale(0.9)';
            } else {
                chatbot.classList.add('hidden');
                chatbot.classList.remove('flex');
                toggle.style.transform = 'scale(1)';
            }
        }

        // Manejar envío de mensajes del chatbot
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('chatbot-message-input');
            const chatbotInput = document.querySelector('#chatbot-input button');

            if (input && chatbotInput) {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        sendChatMessage();
                    }
                });

                chatbotInput.addEventListener('click', sendChatMessage);
            }
        });

        function sendChatMessage() {
            const input = document.getElementById('chatbot-message-input');
            const message = input.value.trim();

            if (message) {
                // Aquí lógica de chat
                console.log('Mensaje enviado:', message);
                input.value = '';
            }
        }

        // Manejar suscripción al newsletter
        function handleSubscription(event) {
            event.preventDefault();
            const email = event.target.querySelector('input[type="email"]').value;

            // lógica de suscripción
            console.log('Email suscrito:', email);

            // Mostrar mensaje de éxito
            alert('¡Gracias por suscribirte! Recibirás nuestras novedades pronto.');
            event.target.reset();
        }

        // Animación suave al hacer scroll
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');

            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href !== '#') {
                        const target = document.querySelector(href);
                        if (target) {
                            e.preventDefault();
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        });








       // Solo mostrar menú cuando cargue
    document.addEventListener("DOMContentLoaded", function () {
        const chatbotBox = document.getElementById('chatbot-box');

        window.toggleChatbot = function () {
            chatbotBox.classList.toggle('hidden');
            if (!chatbotBox.classList.contains('hidden')) {
                mostrarMenuPrincipal();
            }
        };
    });

    function mostrarMenuPrincipal() {
        const chatbotBody = document.getElementById('chatbot-body');
        chatbotBody.innerHTML = `
            <p class="mb-2 text-gray-700">¿Qué deseas consultar?</p>
            <button onclick="mostrarPaquetes()" class="block w-full text-left p-2 mb-1 bg-emerald-100 rounded hover:bg-emerald-200 text-sm">📦 Ver paquetes turísticos</button>
            <button onclick="mostrarEmpresas()" class="block w-full text-left p-2 mb-1 bg-emerald-100 rounded hover:bg-emerald-200 text-sm">🏢 Ver empresas de turismo</button>
            <button onclick="mostrarDestinos()" class="block w-full text-left p-2 mb-1 bg-emerald-100 rounded hover:bg-emerald-200 text-sm">🗺️ Ver destinos turísticos</button>
        `;
    }

    async function mostrarPaquetes() {
        const chatbotBody = document.getElementById('chatbot-body');
        const res = await fetch('/chatbot/paquetes');
        const data = await res.json();

        chatbotBody.innerHTML = `<p class="mb-2 text-gray-700">Paquetes turísticos disponibles:</p>`;
        data.forEach(p => {
            const button = document.createElement('button');
            button.className = 'block w-full text-left p-2 mb-1 bg-gray-100 rounded hover:bg-gray-200 text-sm';
            button.innerText = `📦 ${p.nombrepaquete}`;
            button.onclick = () => mostrarDetallePaquete(p.id);
            chatbotBody.appendChild(button);
        });
    }

    async function mostrarDetallePaquete(id) {
        const chatbotBody = document.getElementById('chatbot-body');
        const res = await fetch(`/chatbot/paquete/${id}`);
        const data = await res.json();

        chatbotBody.innerHTML += `
            <div class="mb-2 text-left mt-3">
                <span class="inline-block bg-gray-200 text-black p-2 rounded-lg whitespace-pre-line">
📦 *${data.nombrepaquete}*
🗺️ Destinos: ${data.destinos}
💵 Precio base: S/. ${data.precio_base}
👥 Incluye: ${data.personas_incluidas} persona(s)
🏢 Empresa: ${data.empresa}
📞 Teléfono: ${data.telefono}
                </span>
            </div>
        `;

        setTimeout(() => mostrarMenuPrincipal(), 3000);
    }

    async function mostrarEmpresas() {
        const chatbotBody = document.getElementById('chatbot-body');
        const res = await fetch('/chatbot/empresas');
        const data = await res.json();

        chatbotBody.innerHTML = `<p class="mb-2 text-gray-700">Empresas disponibles:</p>`;
        data.forEach(e => {
            chatbotBody.innerHTML += `
                <div class="mb-2 bg-gray-100 p-2 rounded text-sm">
🏢 ${e.nameempresa}<br>
📍 Dirección: ${e.direccionempresa}<br>
📞 Teléfono: ${e.telefonoempresa}
                </div>
            `;
        });

        setTimeout(() => mostrarMenuPrincipal(), 5000);
    }

    async function mostrarDestinos() {
        const chatbotBody = document.getElementById('chatbot-body');
        const res = await fetch('/chatbot/destinos');
        const data = await res.json();

        chatbotBody.innerHTML = `<p class="mb-2 text-gray-700">Destinos disponibles:</p>`;
        data.forEach(d => {
            chatbotBody.innerHTML += `
                <div class="mb-1 bg-gray-100 p-2 rounded text-sm">
🗺️ ${d.nombredestino}
                </div>
            `;
        });

        setTimeout(() => mostrarMenuPrincipal(), 4000);
    }
    </script>
</body>

</html>
