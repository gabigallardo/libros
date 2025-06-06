<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><strong>Descripción:</strong> {{ $category->description }}</p>
                    <p><strong>Slug:</strong> {{ $category->slug }}</p>
                    <p><strong>Icono:</strong> <span class="material-icons">{{ $category->icon }}</span></p>
                    <div class="mt-4">
                        <a href="{{ route('categories.index') }}" class="text-blue-500 hover:underline">Volver al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>