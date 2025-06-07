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
            {{-- Usamos el nuevo parcial dentro del grid --}}
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