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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <img class="h-48 w-full object-cover" src="{{ $post->poster ?? 'https://via.placeholder.com/400x300' }}" alt="Poster del post">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-700 text-base mb-4">
                            {{ Str::limit($post->content, 100) }}
                        </p>
                        <a href="{{ route('posts.show', $post) }}" class="text-indigo-500 hover:text-indigo-700 font-semibold">Leer más...</a>
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