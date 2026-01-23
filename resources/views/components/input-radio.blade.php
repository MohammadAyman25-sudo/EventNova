@props([
    'active',
    'value',
    'name',
    'icon',
    'text',
])

@php
    $classes = 'flex items-center justify-center gap-2 p-4 border-2 rounded-xl cursor-pointer transition-all';
    $classes .= $active ? ' border-purple-400 bg-purple-50 dark:bg-purple-900/30'
                        : ' border-gray-200 dark:border-gray-600 hover:border-purple-200 dark:hover:border-purple-700';
@endphp

<label :class="$classes">
                    <input class="hidden" type="radio" :value="$value" :name="$name">
                    <x-dynamic-component :component="$icon" class="text-xl dark:fill-white"/>
                    <span class="font-semibold dark:text-white">{{ __($text) }}</span>
                </label>