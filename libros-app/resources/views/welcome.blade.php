<x-guest-layout>
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">¡Bienvenido a Mundo Literario!</h1>
        <p class="text-gray-600 mb-8">Leé nuestras reseñas sobre tus libros favoritos. Disfrutá como si los leyeras vos y marcá en cada opinion si te gustó.</p>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-700">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="inline-block bg-gray-200 text-gray-800 font-semibold px-6 py-2 rounded-lg hover:bg-gray-300">
                Registrarse
            </a>
        </div>
    </div>
</x-guest-layout>