@props([
    'checked' => null,
    'value',
    'name',
    'icon',
    'text',
])

<label class="flex items-center justify-center gap-2 p-4 border-2 rounded-xl cursor-pointer transition-all border-gray-200 dark:border-gray-600 hover:border-purple-200 dark:hover:border-purple-700 has-[:checked]:border-purple-400 has-[:checked]:bg-purple-50 dark:has-[:checked]:bg-purple-900/30">
    <input class="hidden" type="radio" {{ $checked?"checked":"" }} value="{{$value}}" name="{{$name}}">
    <x-dynamic-component :component="$icon" class="text-xl dark:fill-white"/>
    <span class="font-semibold dark:text-white">{{ __($text) }}</span>
</label>