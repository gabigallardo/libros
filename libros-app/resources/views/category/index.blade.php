<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorías') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold">Listado de categorías</h1>
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear Categoría
                        </a>
                        @endif
                    </div>

                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    <div class="flex items-center space-x-4 mb-6 pb-4 border-b">
                        <span class="font-semibold text-gray-700">Ordenar por:</span>
                        <a href="{{ route('categories.index') }}"
                            class="px-4 py-2 text-sm font-medium rounded-md {{ !request()->query('sort') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                            Por defecto
                        </a>
                        <a href="{{ route('categories.index', ['sort' => 'posts_count']) }}"
                            class="px-4 py-2 text-sm font-medium rounded-md {{ request()->query('sort') == 'posts_count' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                            Más Posts
                        </a>
                        <a href="{{ route('categories.index', ['sort' => 'likes']) }}"
                            class="px-4 py-2 text-sm font-medium rounded-md {{ request()->query('sort') == 'likes' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                            Más Populares (Likes)
                        </a>
                    </div>


                    <div class="space-y-4">
                        @foreach ($categories as $category)
                        <div class="relative bg-blue-400 text-white border border-blue-400 p-6 rounded-md shadow-md hover:bg-blue-500 hover:shadow-lg transition duration-200">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h2 class="text-xl font-semibold flex items-center">
                                        @if($category->icon)
                                        <span class="material-icons mr-2">{{ $category->icon }}</span>
                                        @endif
                                        {{ $category->name }}
                                    </h2>
                                    <p class="mt-1">{{ $category->description ?? 'Sin descripción' }}</p>
                                </div>

                                @if(Auth::user()->isAdmin())
                                <div class="relative z-10 flex items-center space-x-4 ml-4">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-sm text-yellow-100 hover:text-yellow-300 underline">Editar</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-100 hover:text-red-300 underline">Eliminar</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                            <a href="{{ route('categories.show', $category) }}" class="absolute inset-0" aria-label="Ver categoría {{ $category->name }}"></a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>