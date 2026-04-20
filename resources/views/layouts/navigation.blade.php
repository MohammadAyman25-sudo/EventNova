<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}">
                        <x-application-logo class="text-white text-lg sm:text-xl w-5 h-5" />
                    </a>
                </div>
            </div>
            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
                @if(!auth()->check() || !auth()->user()->hasAnyRole(['organizer', 'super-admin']))
                    <x-nav-link :href="route('dashboard', ['locale' => app()->getLocale()])" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard', ['locale' => app()->getLocale()])" :active="request()->routeIs('dashboard')">
                        {{ __('My Tickets') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard', ['locale' => app()->getLocale()])" :active="request()->routeIs('dashboard')">
                        {{ __('Browse Events') }}
                    </x-nav-link>
                @elseif(auth()->user()->hasRole('organizer'))
                    <x-nav-link :href="route('dashboard', ['locale' => app()->getLocale()])" :active="request()->routeIs('dashboard')">
                        {{ __('Organizer') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard', ['locale' => app()->getLocale()])" :active="request()->routeIs('dashboard')">
                        {{ __('My Events') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard', ['locale' => app()->getLocale()])" :active="request()->routeIs('dashboard')">
                        {{ __('New Event') }}
                    </x-nav-link>
                @endif
            </div>

            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-theme-toggler />
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-br from-purple-600 to-pink-600">
                                @if (Auth::user()->hasMedia('avatar'))
                                    <img src="{{ Auth::user()->getFirstMediaUrl('avatar', 'thumb') }}" alt="Profile Picture" class="rounded-full">
                                @else
                                    <span class="text-white font-black text-xl">{{ strtoupper(Auth::user()->first_name[0].Auth::user()->last_name[0]) }}</span>
                                @endif
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('public.profile', ['locale' => app()->getLocale()])">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}">
                            @csrf

                            <x-dropdown-link :href="route('logout', ['locale' => app()->getLocale()])"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
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

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard', ['locale' => app()->getLocale()])" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('public.profile', ['locale' => app()->getLocale()])">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout', ['locale' => app()->getLocale()])"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
