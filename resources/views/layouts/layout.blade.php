<!DOCTYPE html>
<html lang="es">

<head>
    @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    [x-cloak] { display: none !important; }
</style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        @include('livewire.sidebar')
        <div class="flex-1 p-8">
            {{ $slot }}
        </div>
    </div>
    @livewireScripts

    <!-- CHATBOT FLOTANTE -->
    <div id="chatbot-box"
        class="fixed bottom-24 right-5 w-80 max-h-[400px] bg-white rounded-2xl shadow-2xl hidden flex-col z-[9999] overflow-hidden">
        <div id="chatbot-header" class="bg-gray-800 text-white p-4 font-bold flex justify-between items-center">
            Chatbot
            <button onclick="toggleChatbot()" class="text-white font-bold ">✖</button>
        </div>

        <!-- AQUÍ VA EL COMPONENTE LIVEWIRE -->
        <div id="chatbot-body" class="p-4 h-[250px] overflow-y-auto">
            @livewire('promociones')
        </div>

        <div id="chatbot-input" class="flex border-t border-gray-300">
            <input type="text" placeholder="Escribe tu mensaje..." class="flex-1 p-2 outline-none border-none"
                disabled>
            <button class="bg-gray-800 text-white px-4 py-2" disabled>Enviar</button>
        </div>
    </div>


    <div id="chatbot-button" onclick="toggleChatbot()"
        class="fixed bottom-5 right-5 z-[9999] bg-gray-800 text-white rounded-full w-14 h-14 flex justify-center items-center cursor-pointer shadow-md">
        <i class="fas fa-comments text-2xl"></i>
    </div>

    <script>
        function toggleChatbot() {
            const chatbot = document.getElementById('chatbot-box');
            chatbot.style.display = chatbot.style.display === 'flex' ? 'none' : 'flex';
        }
    </script>

<script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
@push('scripts')
<script>
window.lightbox = function() {
    return {
        lightboxOpen: false,
        lightboxIndex: 0,
        lightboxImages: [],
        openLightbox(index) {
            this.lightboxIndex = index;
            this.lightboxOpen = true;
        }
    }
}
</script>
@endpush