@props([
    'title',
    'value',
    'icon',
    'icon_color',
    'icon_background',
])

<div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-600 dark:text-gray-400 mb-1">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $value }}</p>
        </div>
        <div class="w-16 h-16 bg-gradient-to-br {{ $icon_background }} rounded-2xl flex items-center justify-center">
            <x-dynamic-component :component="$icon" class="text-3xl {{$icon_color}}" />
        </div>
    </div>
</div>