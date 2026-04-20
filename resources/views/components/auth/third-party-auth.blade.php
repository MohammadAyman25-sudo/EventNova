@props([
    'text',
    'thirdParties' => [
        ['icon',
        'title',
        'color',]
    ],
])

<div class="mt-6">
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200 dark:border-gray-600"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">{{ $text }}</span>
        </div>
    </div>
    <div class="mt-6 grid grid-cols-2 gap-4">
        @foreach ($thirdParties as $thirdParty)
            <a href="{{ route('social.redirect', ['provider'=>strtolower($thirdParty['title']), 'locale' => app()->getLocale()]) }}" class="flex items-center justify-center gap-2 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl hover:border-purple-300 dark:hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all whitespace-nowrap">
                <x-dynamic-component :component="'icons.'.$thirdParty['icon']" :class="'text-xl '.$thirdParty['color']"/>
                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $thirdParty['title'] }}</span>
            </a>
        @endforeach
    </div>
</div>