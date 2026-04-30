<section id="features" class="py-12 sm:py-20 px-4 bg-white dark:bg-gray-900 scroll-mt-5">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-3 sm:mb-4">
                {{ __('Everything You Need') }}
            </h2>
            <p class="text-base sm:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto px-4">
                {{ __('Powerful features designed to make event discovery and management effortless') }}
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-8">
            <x-feature-card icon="discover" title="{{ __('Discover Events') }}" description="Find amazing events happing near you, from concert to workshops and everything in between." background="bg-gradient-to-br from-purple-500 to-pink-500"/>
            <x-feature-card icon="book" title="{{ __('Easy Booking') }}" description="Book tickets instantly with our seamless checkout process. No hassie, just pure excitement." background="bg-gradient-to-br from-blue-500 to-cyan-500"/>
            <x-feature-card icon="create-events" title="{{ __('Create Events') }}" description="Host your own events and reach thousands of potential attendees with our powerful platform." background="bg-gradient-to-br from-orange-500 to-red-500"/>
            <x-feature-card icon="notification" title="{{ __('Smart Notifications') }}" description="Never miss an event with personalized notifications based on your interests and preferences." background="bg-gradient-to-br from-green-500 to-teal-500"/>
        </div>
    </div>
</section>