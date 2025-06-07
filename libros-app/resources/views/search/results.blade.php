<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resultados de la búsqueda para: <span class="text-blue-600">"{{ $term }}"</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($posts->count())
            <p class="mb-6 text-gray-700">Se encontraron {{ $posts->total() }} resultados.</p>
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
                    <p class="text-lg">No se encontraron resultados para tu búsqueda.</p>
                    <p class="mt-2">Intenta con otros términos o explora nuestras <a href="{{ route('categories.index') }}" class="text-blue-500 hover:underline">categorías</a>.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>