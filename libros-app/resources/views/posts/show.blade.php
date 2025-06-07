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
                                <p class="flex items-center">
                                    <span class="material-icons mr-2 text-gray-500">person</span>
                                    <strong>Autor:</strong>
                                    <span class="ml-auto text-gray-700">{{ $post->author_name }}</span>
                                </p>
                                <p class="flex items-center">
                                    <span class="material-icons mr-2 text-gray-500">category</span>
                                    <strong>Categoría:</strong>
                                    <a href="{{ route('categories.show', $post->category) }}" class="ml-auto text-blue-500 hover:underline">{{ $post->category->name }}</a>
                                </p>
                                <div class="flex items-center" title="{{ $post->stars }} de 5 estrellas">
                                    <span class="material-icons mr-2 text-gray-500">grade</span>
                                    <strong class="mr-2">Calificación:</strong>
                                    <div class="ml-auto">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="text-lg {{ $i <= $post->stars ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <form action="{{ route('posts.like', $post) }}" method="POST">
                                    @csrf
                                    @if($post->isLikedByUser(Auth::user()))
                                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                        <span class="material-icons">thumb_up</span>
                                        <span class="font-semibold">Te gusta ({{ $post->likers()->count() }})</span>
                                    </button>
                                    @else
                                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                        <span class="material-icons-outlined">thumb_up</span>
                                        <span class="font-semibold">Me gusta ({{ $post->likers()->count() }})</span>
                                    </button>
                                    @endif
                                </form>
                            </div>

                            @if (Auth::user() && Auth::user()->isAdmin())
                            <div class="mt-4 pt-4 border-t border-gray-200 flex items-center space-x-2">
                                <a href="{{ route('posts.edit', $post) }}" class="flex-1 text-center px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition">
                                    Editar
                                </a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta reseña? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                            @endif
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

                    {{-- SECCIÓN DE COMENTARIOS --}}
                    <div class="mt-16">
                        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Comentarios</h2>

                            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <textarea name="content" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Escribe tu comentario aquí..."></textarea>
                                    @error('content')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                                        Publicar Comentario
                                    </button>
                                </div>
                            </form>

                            <div class="mt-8 space-y-6">
                                @forelse ($post->comments as $comment)
                                {{-- CÓDIGO ACTUALIZADO PARA CADA COMENTARIO --}}
                                <div x-data="{ editing: false }" class="flex space-x-4" id="comment-{{ $comment->id }}">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center font-bold text-gray-600">
                                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        {{-- VISTA NORMAL DEL COMENTARIO --}}
                                        <div x-show="!editing">
                                            <div class="flex justify-between items-center">
                                                <p class="font-bold text-gray-900">{{ $comment->user->name }}</p>
                                                <div class="flex items-center space-x-2 text-xs">
                                                    <p class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>

                                                    @can('update', $comment)
                                                    <button x-on:click="editing = true; $nextTick(() => $refs.editField.focus())" class="text-blue-500 hover:underline">Editar</button>
                                                    @endcan

                                                    @can('delete', $comment)
                                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('¿Estás seguro?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </div>
                                            <p class="text-gray-700 mt-1">
                                                {{ $comment->content }}
                                            </p>
                                        </div>

                                        {{-- VISTA DE EDICIÓN --}}
                                        <div x-show="editing" x-cloak style="display: none !important;">
                                            <form action="{{ route('comments.update', $comment) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="content" x-ref="editField" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3">{{ $comment->content }}</textarea>
                                                <div class="mt-2 space-x-2 text-right">
                                                    <button type="button" x-on:click="editing = false" class="text-sm text-gray-600 hover:underline">Cancelar</button>
                                                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 text-sm">Guardar Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p class="text-center text-gray-500">Aún no hay comentarios. ¡Sé el primero en opinar!</p>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>