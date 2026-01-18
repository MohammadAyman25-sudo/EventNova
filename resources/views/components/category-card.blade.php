@props([
    'background',
    'icon',
    'category'
])

@php
    $categoryMap = [
        'music' => 'heroicon-o-musical-note',
        'technology' => 'heroicon-o-code-bracket',
        'sports' => 'icons.football-line',
        ''
    ];

    $iconName = $categoryMap[$icon];
@endphp

<div class="group p-4 sm:p-6 bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl hover:scale-105 transition-all duration-300 cursor-pointer">
    <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-lg sm:rounded-xl {{ $background }} mb-3 sm:mb-4 mx-auto group-hover:scale-110 transition-transform">
        <x-dynamic-component :component="$iconName" class="" />
    </div>
    <h3 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white text-center">{{ $category }}</h3>
</div>