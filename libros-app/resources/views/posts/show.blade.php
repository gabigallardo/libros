<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $post->title }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                por {{ $post->author_name }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

                <div class="md:col-span-4">
                    <div class="md:sticky md:top-8 space-y-6">
                        <img class="w-full rounded-lg shadow-lg aspect-[2/3] object-cover" src="{{ $post->poster ?? 'https://via.placeholder.com/400x600' }}" alt="Portada de {{ $post->title }}">

                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h3 class="font-bold text-gray-800 text-lg border-b pb-2 mb-3">Detalles de la Reseña</h3>
                            <div class="space-y-3 text-sm">
                                <p class="flex items-center"><span class="material-icons mr-2 text-gray-500">person</span><strong>Autor:</strong><span class="ml-auto text-gray-700">{{ $post->author_name }}</span></p>
                                <p class="flex items-center"><span class="material-icons mr-2 text-gray-500">category</span><strong>Categoría:</strong><a href="{{ route('categories.show', $post->category) }}" class="ml-auto text-blue-500 hover:underline">{{ $post->category->name }}</a></p>
                                <div class="flex items-center" title="{{ $post->stars }} de 5 estrellas">
                                    <span class="material-icons mr-2 text-gray-500">grade</span><strong class="mr-2">Calificación:</strong>
                                    <div class="ml-auto">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="text-lg {{ $i <= $post->stars ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                            @endfor
                                    </div>
                                </div>
                                <form action="{{ route('posts.like', $post) }}" method="POST">
                                    @csrf
                                    @if($post->isLikedByUser(Auth::user()))
                                    {{-- Estado: Ya le diste Me Gusta --}}
                                    <button type="submit"
                                        class="w-full flex items-center justify-center space-x-2 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                        <span class="material-icons">thumb_up</span>
                                        <span class="font-semibold">Te gusta ({{ $post->likers()->count() }})</span>
                                    </button>
                                    @else
                                    {{-- Estado: Aún no le diste Me Gusta --}}
                                    <button type="submit"
                                        class="w-full flex items-center justify-center space-x-2 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                        <span class="material-icons-outlined">thumb_up</span>
                                        <span class="font-semibold">Me gusta ({{ $post->likers()->count() }})</span>
                                    </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:p-8">
                        <div class="prose prose-lg max-w-none text-gray-800">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>

                    @if($relatedPosts->count())
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Otras reseñas que podrían interesarte</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($relatedPosts as $related)
                            <a href="{{ route('posts.show', $related) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg group">
                                <div class="aspect-[2/3] w-full overflow-hidden">
                                    <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $related->poster ?? 'https://via.placeholder.com/400x600' }}" alt="Poster de {{ $related->title }}">
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-sm truncate group-hover:text-blue-500">{{ $related->title }}</h4>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>