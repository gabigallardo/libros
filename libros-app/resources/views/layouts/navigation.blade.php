<nav x-data="{ open: false }" class="bg-yellow-100 border-b border-yellow-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-10 w-10 rounded-full" />
                </a>
            </div>

            <div class="flex-1 flex justify-center px-6">
                <form action="{{ route('search') }}" method="GET" class="w-full max-w-md">
                    <div class="relative">
                        <input
                            type="search"
                            name="search"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buscar reseñas por nombre o autor del libro..." />
                    </div>
                </form>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <a
                    href="{{ route('categories.index') }}"
                    class="text-blue-600 font-medium px-3 py-2 rounded-md text-sm
                           hover:bg-yellow-200 hover:text-blue-800
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                           transition-colors duration-200 ease-in-out">
                    Ver Categorías
                </a>

                @if (Auth::user() && Auth::user()->isAdmin())
                <a
                    href="{{ route('posts.create') }}"
                    class="ms-4 text-blue-600 font-medium px-3 py-2 rounded-md text-sm
                               hover:bg-yellow-200 hover:text-blue-700
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500
                               transition-colors duration-200 ease-in-out">
                    Crear Post
                </a>
                @endif
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700
                                           bg-yellow-100 hover:bg-yellow-200 hover:text-blue-600
                                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                                           transition-colors duration-200 ease-in-out">
                                <div>Hola! {{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Editar Perfil') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('posts.liked')">
                                {{ __('Publicaciones Likeadas') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                {{ __('Ver Categorías') }}
            </x-responsive-nav-link>

            @if (Auth::user() && Auth::user()->isAdmin())
            <x-responsive-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                {{ __('Crear Post') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Editar Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>