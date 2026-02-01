@props([
    "background",
    "icon",
    "optionTitle",
    "optionDesc",
    "checked" => null
])

<label class="flex items-center justify-between p-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-500 transition-all cursor-pointer">
    <div class="flex items-center space-x-4">
        <div class="w-12 h-12 flex items-center justify-center rounded-xl {{ $background }}">
            <x-dynamic-component :component="$icon" class="text-2xl fill-white"/>
        </div>
        <div>
            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $optionTitle }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $optionDesc }}</p>
        </div>
    </div>
    <input class="w-6 h-6 text-purple-600 rounded focus:ring-purple-500 cursor-pointer" type="checkbox" {{ $checked?"checked":"" }}>
</label>