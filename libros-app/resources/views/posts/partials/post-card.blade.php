<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col group">
    {{-- Imagen de la reseña --}}
    <a href="{{ route('posts.show', $post) }}" class="aspect-[2/3] w-full overflow-hidden">
        <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300"
            src="{{ $post->poster ?? 'https://via.placeholder.com/400x600' }}"
            alt="Poster del libro {{ $post->title }}">
    </a>

    <div class="p-4 flex flex-col flex-grow">
        {{-- Título y Autor --}}
        <a href="{{ route('posts.show', $post) }}">
            <h3 class="font-bold text-base mb-1 truncate group-hover:text-blue-600" title="{{ $post->title }}">
                {{ $post->title }}
            </h3>
        </a>
        <p class="text-sm text-gray-500 mb-3">por {{ $post->author_name }}</p>

        {{-- Calificación de Estrellas --}}
        <div class="flex items-center mb-4" title="{{ $post->stars }} de 5 estrellas">
            @for ($i = 1; $i <= 5; $i++)
                <span class="material-icons-outlined text-lg {{ $i <= $post->stars ? 'text-yellow-400' : 'text-gray-300' }}">star</span>
                @endfor
        </div>

        {{-- Acciones: Like y Leer Reseña --}}
        <div class="mt-auto pt-3 border-t border-gray-200 flex items-center justify-between space-x-2">
            {{-- Formulario y Botón de Like --}}
            <form action="{{ route('posts.like', $post) }}" method="POST">
                @csrf
                @if($post->isLikedByUser(Auth::user()))
                {{-- Estado: Ya le diste Me Gusta --}}
                <button type="submit"
                    class="flex items-center space-x-2 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <span class="material-icons">thumb_up</span>
                    <span>{{ $post->likers()->count() }}</span>
                </button>
                @else
                {{-- Estado: Aún no le diste Me Gusta --}}
                <button type="submit"
                    class="flex items-center space-x-2 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <span class="material-icons-outlined">thumb_up</span>
                    <span>{{ $post->likers()->count() }}</span>
                </button>
                @endif
            </form>

            {{-- Botón para Leer Reseña --}}
            <a href="{{ route('posts.show', $post) }}"
                class="flex-grow text-center bg-indigo-500 text-white font-semibold py-2 px-3 text-sm rounded-lg hover:bg-indigo-600 transition">
                Leer Reseña
            </a>
        </div>
    </div>
</div>