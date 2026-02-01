@props([
    'icon',
    'title',
    'description',
    'background' => 'bg-purple-100 dark:bg-purple-900/30',
])

@php
    $iconMap = [
        'discover' => 'icons.search',
        'book' => 'icons.ticket',
        'create-events' => 'icons.calendar',
        'notification' => 'icons.bell',
    ];

    $iconName = $iconMap[$icon];
@endphp

<div class="group p-6 sm:p-8 bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-2xl sm:rounded-3xl border border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-600 hover:shadow-2xl transition-all duration-300 cursor-pointer">
    <div class="w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center rounded-xl sm:rounded-2xl {{ $background }} mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
        <x-dynamic-component :component="$iconName" class="w-6 h-6 fill-white"/>
    </div>
    <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">{{ $title }}</h3>
    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 leading-relaxed">{{ $description }}</p>
</div>