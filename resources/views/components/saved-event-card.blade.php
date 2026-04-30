@props([
    'cover',
    'title',
    'date',
    'location'
])

<div class="bg-white dark:bg-gray-700 border-2 border-gray-100 dark:border-gray-600 rounded-2xl overflow-hidden hover:border-purple-200 dark:hover:border-purple-500 hover:shadow-lg transition-all cursor-point group">
    <div class="relative h-40 overflow-hidden">
        <img src="{{ $cover }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"/>
    </div>
    <div class="p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">{{ $title }}</h3>
        <div class="space-y-1 text-sm text-gray-600 dark:text-gray-400 mb-4">
            <div class="flex items-center gap-2">
                <x-icons.calendar-2 class="fill-current stroke-current"/>
                <span>{{ $date }}</span>
            </div>
            <div class="flex items-center gap-2">
                <x-icons.map-pin class="fill-current stroke-current"/>
                <span>{{ $location }}</span>
            </div>
        </div>
        <button class="w-full py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full text-sm font-semibold hover:shadow-lg transition-all whitespace-nowrap">{{ __('Register Now') }}</button>
    </div>
</div>