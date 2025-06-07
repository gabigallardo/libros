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
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col group">
                    <div class="aspect-[2/3] w-full overflow-hidden">
                        <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $post->poster ?? 'https://via.placeholder.com/400x600' }}" alt="Poster del libro {{ $post->title }}">
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="font-bold text-base mb-2 truncate" title="{{ $post->title }}">{{ $post->title }}</h3>
                        <p class="text-gray-600 text-xs flex-grow">
                            {{ Str::before(e($post->content), '.') }}.
                        </p>
                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center" title="{{ $post->stars }} de 5 estrellas">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <=$post->stars)
                                        <span class="text-yellow-400">★</span>
                                        @else
                                        <span class="text-gray-300">☆</span>
                                        @endif
                                        @endfor
                                </div>
                                <form action="{{ route('posts.like', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center text-gray-600 font-semibold text-sm focus:outline-none">
                                        <span class="mr-1 text-lg {{ $post->isLikedByUser(Auth::user()) ? 'text-red-500' : 'text-gray-400' }}">👍</span>
                                        <span>{{ $post->likers()->count() }}</span>
                                    </button>
                                </form>
                            </div>
                            <a href="{{ route('posts.show', $post) }}" class="block text-center mt-3 bg-indigo-500 text-white font-semibold py-2 px-3 text-sm rounded-lg hover:bg-indigo-600 w-full transition">Leer Reseña</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

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