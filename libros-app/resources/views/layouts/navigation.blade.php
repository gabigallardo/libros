<nav x-data="{ open: false }" class="bg-yellow-100 border-b border-yellow-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('/') }}">
                        <x-application-logo class="block h-10 w-10 rounded-full" />
                    </a>
                </div>

                <!-- Links -->
                <div class="hidden sm:flex sm:space-x-8 sm:ms-10">
                    <x-nav-link :href="route('/')" :active="request()->routeIs('/')" class="text-blue-600 hover:text-blue-800">
                        {{ __('home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')" class="text-blue-600 hover:text-blue-800">
                        {{ __('Posts') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Usuario -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-blue-600 bg-yellow-100 hover:text-blue-800 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburguesa -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-blue-600 hover:text-blue-800 hover:bg-yellow-200 focus:outline-none transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-yellow-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('/')" :active="request()->routeIs('/')" class="text-blue-600 hover:text-blue-800">
                {{ __('home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')" class="text-blue-600 hover:text-blue-800">
                {{ __('Posts') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-yellow-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>