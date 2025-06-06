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
                        {{-- Botón de Crear solo para administradores --}}
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

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($categories as $category)
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold text-lg flex items-center">
                                <span class="material-icons mr-2">{{ $category->icon }}</span>
                                {{ $category->name }}
                            </h2>
                            <p class="text-gray-600">{{ $category->description }}</p>
                            <div class="mt-4 flex justify-end space-x-2">
                                <a href="{{ route('categories.show', $category) }}" class="text-blue-500 hover:underline">Ver</a>

                                {{-- Controles solo para administradores --}}
                                @if(Auth::user()->isAdmin())
                                <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500 hover:underline">Editar</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta categoría?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>