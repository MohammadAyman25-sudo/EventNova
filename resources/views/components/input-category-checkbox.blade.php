@props([
    "background",
    "icon",
    "category",
    "categoryId",
])

<label class="flex items-center justify-between relative p-6 rounded-2xl border-2 transition-all
                 cursor-pointer group border-gray-200 dark:border-gray-700 has-[:checked]:border-purple-500 
                 dark:has-[:checked]:border-purple-400  hover:border-purple-300 dark:hover:border-purple-500 
                 bg-white dark:bg-gray-700 has-[:checked]:bg-gradient-to-br has-[:checked]:from-purple-50 has-[:checked]:to-pink-50
                 dark:has-[:checked]:from-purple-900/30 dark:has-[:checked]:to-pink-900/30 has-[:checked]:shadow-lg">
    <input type="checkbox" class="hidden peer interests" name="interests[]" value="{{ $categoryId }}">
    <div class="flex items-center space-x-4">
        <div class="w-12 h-12 flex items-center justify-center rounded-xl flex-shrink-0" style="background: {{ $background }}">
            <x-dynamic-component :component="$icon" class="text-2xl fill-white" />
        </div>
        <div class="flex-1 text-left">
            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $category }}</h3>
        </div>
    </div>
    <div class="ml-2 w-6 h-6 hidden peer-checked:flex items-center justify-center bg-purple-500 rounded-full flex-shrink-0">
        <x-icons.check class="text-sm fill-white"/>
    </div>
</label>