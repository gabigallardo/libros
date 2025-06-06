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

                    <div class="space-y-4">
                        @foreach ($categories as $category)
                        <a href="{{ route('categories.show', $category) }}" class="block">
                            <div class="bg-blue-400 hover:bg-blue-500 text-white border border-blue-400 p-6 rounded-md shadow-md hover:shadow-lg transition duration-200 cursor-pointer">
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
                                    <div class="flex flex-col items-end space-y-1 ml-4">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="text-sm text-yellow-100 hover:text-yellow-300 underline">Editar</a>

                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta categoría?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-100 hover:text-red-300 underline">Eliminar</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>