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


            <div class="flex items-center space-x-4 mb-6 pb-4 border-b">
                <span class="font-semibold text-gray-700">Ordenar por:</span>
                <a href="{{ route('categories.show', $category) }}"
                    class="px-4 py-2 text-sm font-medium rounded-md {{ !request()->query('sort') ? 'bg-blue-400 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                    Más Recientes
                </a>
                <a href="{{ route('categories.show', ['category' => $category, 'sort' => 'stars']) }}"
                    class="px-4 py-2 text-sm font-medium rounded-md {{ request()->query('sort') == 'stars' ? 'bg-blue-400 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                    Mejor Calificados
                </a>
                <a href="{{ route('categories.show', ['category' => $category, 'sort' => 'likes']) }}"
                    class="px-4 py-2 text-sm font-medium rounded-md {{ request()->query('sort') == 'likes' ? 'bg-blue-400 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                    Más Likeados
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                @include('posts.partials.post-card', ['post' => $post])
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