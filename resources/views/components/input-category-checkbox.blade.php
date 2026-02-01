@props([
    "background",
    "icon",
    "category",
])

<button type="button" class="relative p-6 rounded-2xl border-2 transition-all cursor-pointer group border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-500 bg-white dark:bg-gray-700">
    <div class="flex items-center space-x-4">
        <div class="w-12 h-12 flex items-center justify-center rounded-xl flex-shrink-0 {{ $background }}">
            <x-dynamic-component :component="$icon" class="text-2xl fill-white" />
        </div>
        <div class="flex-1 text-left">
            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $category }}</h3>
        </div>
    </div>
</button>