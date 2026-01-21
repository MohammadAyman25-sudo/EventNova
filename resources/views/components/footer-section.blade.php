@props([
    'title' => '',
    'links' => [['href'=>'', 'text'=>''],],
    'icons'=>[]])

<div>
    <h3 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-white mb-3 sm:mb-4">{{ $title }}</h3>
    @if(count($icons) == 0)
        <ul class="space-y-2">
            @foreach($links as $link)
                <li><a href="{{ $link['href'] }}" class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400  transition-colors cursor-pointer">{{ $link['text'] }}</a></li>
            @endforeach
        </ul>
    @else
        <div class="flex space-x-3 sm:space-x-4">
            @foreach($icons as $icon)
                <a href="#" class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-purple-600 hover:text-white dark:hover:bg-purple-600 dark:hover:text-white transition-all cursor-pointer">
                    <x-dynamic-component :component="$icon" class="text-lg sm:text-xl"/>
                </a>
            @endforeach
        </div>
    @endif
</div>