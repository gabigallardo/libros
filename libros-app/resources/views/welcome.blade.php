<x-guest-layout>
    <div class="bg-gradient-to-r from-sky-200 to-blue-400 py-16 shadow-lg mb-12 text-center -mt-8 -mx-8">
        <h1 class="text-4xl font-bold text-gray-800 sm:text-5xl mb-4">
            Bienvenido a Mundo Literario
        </h1>
        <p class="text-xl text-gray-700 max-w-3xl mx-auto px-4">
            Explora las reseñas más populares, descubre nuevos libros y únete a la conversación.
        </p>
        <div class="mt-8 space-x-4">
            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 shadow-md">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="inline-block bg-white text-gray-800 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 shadow-md">
                Registrarse
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if($mostLikedPosts->count())
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 border-l-4 border-blue-500 pl-4">
                Las Reseñas Más Populares
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($mostLikedPosts as $post)
                @include('posts.partials.post-card-guest', ['post' => $post])
                @endforeach
            </div>
        </section>
        @endif

        @if($latestPosts->count())
        <section>
            <h2 class="text-3xl font-bold text-gray-800 mb-6 border-l-4 border-indigo-500 pl-4">
                Novedades: Últimas Reseñas
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($latestPosts as $post)
                @include('posts.partials.post-card-guest', ['post' => $post])
                @endforeach
            </div>
        </section>
        @endif

    </div>
</x-guest-layout>