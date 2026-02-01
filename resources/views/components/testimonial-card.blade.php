@props([
    'quote',
    'authorName',
    'authorTitle',
    'authorImage',
])

<div class="p-6 sm:p-8 bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-2xl sm:rounded-3xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
    <div class="flex items-center mb-3 sm:mb-4">
        @for ($i=0; $i<5; $i++)
            <x-icons.star class="fill-yellow-500"/>
        @endfor
    </div>
    <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 mb-4 sm:mb-6 leading-relaxed">
        "{{ $quote }}"
    </p>
    <div class="flex items-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full overflow-hidden mr-3 sm:mr-4 flex-shrink-0">
            <img src="{{ $authorImage }}" alt="{{ $authorName }}" class="w-full h-full object-cover">
        </div>
        <div>
            <h4 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-white">{{ $authorName }}</h4>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">{{ $authorTitle }}</p>
        </div>
    </div>
</div>