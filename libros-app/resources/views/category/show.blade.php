<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <span class="material-icons mr-2">{{ $category->icon }}</span>
            {{ $category->name }}
        </h2>
        <p class="text-gray-600 text-sm mt-1">{{ $category->description }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($posts->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                    <img class="h-48 w-full object-cover" src="{{ $post->poster ?? 'https://via.placeholder.com/400x300' }}" alt="Poster del post">
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="font-bold text-lg mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-600 text-sm flex-grow">
                            {{-- Tomamos solo la primera oración del contenido --}}
                            {{ Str::before(e($post->content), '.') }}.
                        </p>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                {{-- Estrellas con emojis --}}
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <=$post->stars)
                                        <span class="text-yellow-400">⭐</span>
                                        @else
                                        <span class="text-gray-300">⭐</span>
                                        @endif
                                        @endfor
                                </div>
                                {{-- Likes con emoji y contador --}}
                                <div class="flex items-center text-gray-500">
                                    <span class="mr-1">👍</span>
                                    <span>{{ $post->likes }}</span>
                                </div>
                            </div>
                            <a href="{{ route('posts.show', $post) }}" class="block text-center mt-4 bg-indigo-500 text-white font-semibold py-2 rounded-lg hover:bg-indigo-600 w-full">Leer Reseña</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Links de paginación --}}
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-gray-500">
                    No hay posts en esta categoría todavía.
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>