<x-app-layout>
    <div class="bg-gradient-to-r from-sky-200 to-blue-400 py-16 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-800 sm:text-5xl mb-4">
                Bienvenido a Mundo Literario
            </h1>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                Tu espacio para descubrir, compartir y debatir sobre las mejores reseñas de libros. Sumérgete en nuevas aventuras literarias y encuentra tu próxima lectura favorita.
            </p>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($mostLikedPosts->count())
            <section class="mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-l-4 border-blue-500 pl-4">
                    Las Reseñas Más Populares
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($mostLikedPosts as $post)
                    @include('posts.partials.post-card', ['post' => $post])
                    @endforeach
                </div>
            </section>
            @endif

            @if($latestPosts->count())
            <section>
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-l-4 border-indigo-500 pl-4">
                    Novedades: Últimas Reseñas
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($latestPosts as $post)
                    @include('posts.partials.post-card', ['post' => $post])
                    @endforeach
                </div>
            </section>
            @endif

        </div>
    </div>
</x-app-layout>