@props(['disabled' => false])
<div class="relative">
    <input @disabled($disabled)
        {{$attributes->merge(['class' => 'w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:border-purple-400 dark:focus:border-purple-500 focus:outline-none'])}}
    >

    <button 
        type="button" 
        onclick="togglePassword(event)"
        data-id="{{$attributes['id']}}"
        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:text-white dark:hover:text-gray-300"
    >
        <!-- Eye (hidden by default) -->
        <x-heroicon-o-eye-slash data-id="{{$attributes['id']}}" class="w-5 h-5 eye-slash"/>

        <!-- Eye-off (visible) -->
        <x-heroicon-o-eye data-id="{{$attributes['id']}}" class="hidden w-5 h-5 eye"/>
    </button>
</div>