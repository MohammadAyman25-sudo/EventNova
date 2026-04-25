<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a>
                        <x-application-logo class="text-white text-lg sm:text-xl w-5 h-5" />
                    </a>
                </div>
            </div>
            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
                <x-nav-link :href="'#features'" >
                        {{__('Features')}}
                </x-nav-link>
                <x-nav-link :href="'#categories'" >
                    {{__('Categories')}}
                </x-nav-link>
                <x-nav-link :href="'#testimonials'" >
                    {{__('Testimonials')}}
                </x-nav-link>
            </div>

            
            <!-- Settings Dropdown -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <x-theme-toggler />
                <a href="{{ route('login', []) }}" class="hidden sm:inline-block px-4 lg:px-5 py-2 sm:py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all whitespace-nowrap cursor-pointer capitalize">Sign in</a>
                <a href="{{ route('register', []) }}" class="px-3 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg hover:shadow-lg transition-all whitespace-nowrap cursor-pointer">Get Started</a>
                <!-- Hamburger -->
                <button @click="open = ! open" class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg transition-colors cursor-pointer text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <x-icons.menu x-show="!open" class="text-xl" aria-hidden="true"/>
                    <x-icons.close x-show="open" class="text-xl" aria-hidden="true"/>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 shadow-lg">
        <div class="px-4 py-4 space-y-3">
            <x-responsive-nav-link :href="'#features'" >
                    {{__('Features')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="'#categories'" >
                {{__('Categories')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="'#testimonials'" >
                {{__('Testimonials')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('login', [])" class="text-center">{{ __('Sign In') }}</x-responsive-nav-link>
        </div>
    </div>
</nav>
