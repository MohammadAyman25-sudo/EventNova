<x-app-layout>
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full mb-6">
            <x-icons.heart-3 class="text-4xl fill-white"/>
        </div>
        <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">What Interests You?</h1>
        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Select your interests so we can notify you about events you'll love. Choose at least 3 categories.</p>
    </div>
    <form action="" method="POST">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                Select Your Interests
                <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">
                    (0 selected)
                </span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-input-category-checkbox background="bg-gradient-to-br from-purple-500 to-pink-500" category="Music & Concerts" icon="icons.music-note"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-blue-500 to-cyan-500" category="Technology" icon="icons.computer"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-green-500 to-teal-500" category="Sports & Fitness" icon="icons.football-line"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-orange-500 to-red-500" category="Art & Culture" icon="icons.palette"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-yellow-500 to-orange-500" category="Food & Drink" icon="icons.restaurant"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-indigo-500 to-purple-500" category="Business & Networking" icon="icons.briefcase"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-teal-500 to-green-500" category="Education & Learning" icon="icons.book"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-pink-500 to-rose-500" category="Health & Wellness" icon="icons.heart-pulse"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-violet-500 to-purple-500" category="Entertainment" icon="icons.movie"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-sky-500 to-blue-500" category="Travel & Adventure" icon="icons.plane"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-fuchsia-500 to-pink-500" category="Fashion & Beauty" icon="icons.shirt"/>
                <x-input-category-checkbox background="bg-gradient-to-br from-cyan-500 to-blue-500" category="Gaming & ESports" icon="icons.gamepad"/>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Notification Preferences</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Choose how you'd like to recieve updates about events matching your interests.</p>
            <div class="space-y-4">
                <x-notification-option background="bg-gradient-to-br from-blue-500 to-cyan-500" icon="icons.mail" optionTitle="Email Notifications" optionDesc="Get event updates via email" checked="true"/>
                <x-notification-option background="bg-gradient-to-br from-purple-500 to-pink-500" icon="icons.bell" optionTitle="Push Notifications" optionDesc="Recieve instant push notifications"/>
            </div>
        </div>
        <div class="flex gap-4">
            <button type="button" class="flex-1 py-4 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-semibold hover:border-purple-300 dark:hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all whitespace-nowrap cursor-pointer">Skip for Now</button>
            <button type="submit" disabled class="flex-1 py-4 rounded-full font-semibold transtion-all whitespace-nowrap bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-500 cursor-not-allowed">Save Preferences</button>
        </div>
    </form>
</x-app-layout>