@props(['disabled' => false])
<div class="relative">
    <input @disabled($disabled)
        {{$attributes->merge(['class' => 'block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500'])}}
    >

    <button 
        type="button" 
        onclick="togglePassword(event)"
        data-id="{{$attributes['id']}}"
        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
    >
        <!-- Eye (hidden by default) -->
        <x-heroicon-o-eye-slash data-id="{{$attributes['id']}}" class="w-5 h-5 eye-slash"/>

        <!-- Eye-off (visible) -->
        <x-heroicon-o-eye data-id="{{$attributes['id']}}" class="hidden w-5 h-5 eye"/>
    </button>
</div>