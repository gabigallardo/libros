<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editando la Reseña: <span class="text-indigo-600">{{ $post->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Libro (Título):</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                            </div>

                            <div>
                                <label for="author_name" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Autor:</label>
                                <input type="text" name="author_name" id="author_name" value="{{ old('author_name', $post->author_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Categoría:</label>
                            <select name="category_id" id="category_id" class="shadow border rounded w-full py-2 px-3" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id', $post->category_id) == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Contenido de la Reseña:</label>
                            {{-- CORRECCIÓN AQUÍ: Usamos $post->content para rellenar con el valor actual --}}
                            <textarea name="content" id="content" rows="8" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ old('content', $post->content) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label for="poster" class="block text-gray-700 text-sm font-bold mb-2">URL de la Imagen (Poster):</label>
                                <input type="url" name="poster" id="poster" value="{{ old('poster', $post->poster) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>

                            <div>
                                <label for="stars" class="block text-gray-700 text-sm font-bold mb-2">Calificación (Estrellas):</label>
                                <select name="stars" id="stars" class="shadow border rounded w-full py-2 px-3" required>
                                    @for ($i = 0; $i <= 5; $i++)
                                        <option value="{{ $i }}" @if(old('stars', $post->stars) == $i) selected @endif>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar Reseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>