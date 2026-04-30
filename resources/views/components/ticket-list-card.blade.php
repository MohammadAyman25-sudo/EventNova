@props([
    'cover',
    'title',
    'status',
    'date',
    'location'
])

<div class="flex flex-col md:flex-row gap-6 p-6 border-2 border-gray-100 dark:border-gray-700 rounded-2xl hover:border-purple-200 dark:hover:border-purple-500 hover:shadow-lg transition-all">
    <img src="{{ $cover }}" alt="{{ $title }}" class="w-full md:w-48 h-32 object-cover rounded-xl" />
    <div class="flex-1">
        <div class="flex items-start justify-between mb-3">
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $title }}</h3>
                <div class="space-y-1 text-sm text-gray-600 dark:text-gray-400">
                    <div class="flex items-center gap-2">
                        <x-icons.calendar-2 class="fill-current stroke-current"/>
                        <span>{{ $date }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-icons.map-pin class="fill-current stroke-current"/>
                        <span>{{ $location }}</span>
                    </div>
                </div>
            </div>
            <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-sm font-semibold">{{ $status }}</span>
        </div>
        <div class="flex gap-3">
            <button class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full text-sm font-semibold hover:shadow-lg transition-all whitespace-nowrap cursor-pointer">{{ __('View Ticket') }}</button>
            <button class="px-4 py-2 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm font-semibold hover:border-purple-300 dark:hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all whitespace-nowrap cursor-pointer">{{ __('Download Ticket') }}</button>
        </div>
    </div>
</div>