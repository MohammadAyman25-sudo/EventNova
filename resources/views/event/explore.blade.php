<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

        {{-- ── Page header ────────────────────────────────────────────────── --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('Explore Events') }}</h1>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('Discover and save events happening near you.') }}</p>
        </div>

        {{-- ── Flash messages ─────────────────────────────────────────────── --}}
        @if (session('message'))
            <div class="mb-8 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800 dark:border-green-800/50 dark:bg-green-900/20 dark:text-green-400">
                {{ session('message') }}
            </div>
        @endif

        @if ($errors->has('error'))
            <div class="mb-8 rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-medium text-red-800 dark:border-red-800/50 dark:bg-red-900/20 dark:text-red-400">
                {{ $errors->first('error') }}
            </div>
        @endif

        {{-- ── Event cards ─────────────────────────────────────────────────── --}}
        @if (isset($events) && $events->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($events as $ev)
                    @php
                        $minPrice   = $ev->relationLoaded('tickets') ? $ev->tickets->min('price') : null;
                        $priceLabel = $minPrice !== null
                            ? ($minPrice > 0 ? __('From') . ' $' . number_format($minPrice, 2) : __('Free'))
                            : null;

                        $dateLabel = $ev->start_date
                            ? $ev->start_date->format('M j, Y · g:i A')
                            : null;

                        $bannerUrl = $ev->banner_image
                            ? \Illuminate\Support\Facades\Storage::disk(config('filesystems.media_disk', 'r2'))->url($ev->banner_image)
                            : null;

                        $venue = trim(implode(', ', array_filter([$ev->venue_name, $ev->venue_address])));
                    @endphp

                    <article class="group flex flex-col bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                        {{-- ── Image / placeholder ──────────────────────── --}}
                        <div class="relative h-48 flex-shrink-0 overflow-hidden bg-gray-100 dark:bg-gray-800">
                            @if ($bannerUrl)
                                <img src="{{ $bannerUrl }}" alt="{{ $ev->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center opacity-80">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Favourite toggle --}}
                            <button
                                type="button"
                                class="absolute top-3 right-3 flex items-center justify-center w-9 h-9 rounded-full bg-white/90 dark:bg-gray-900/80 backdrop-blur shadow-sm hover:bg-white dark:hover:bg-gray-900 hover:scale-110 transition-all duration-200 z-10 text-rose-500"
                                aria-label="{{ __('Add to favourites') }}"
                                title="{{ __('Add to favourites') }}"
                                onclick="toggleFavourite(this)"
                            >
                                <svg class="w-5 h-5 transition-all duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                                </svg>
                            </button>

                            {{-- Price badge --}}
                            @if ($priceLabel)
                                <span class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-md text-white text-xs font-semibold px-3 py-1 rounded-full tracking-wide">
                                    {{ $priceLabel }}
                                </span>
                            @endif
                        </div>

                        {{-- ── Card body ─────────────────────────────────── --}}
                        <div class="flex flex-col flex-1 p-5 gap-3">
                            @if ($dateLabel)
                                <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 dark:text-indigo-400 dark:bg-indigo-900/30 px-2.5 py-1 rounded-full w-fit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $dateLabel }}
                                </div>
                            @endif

                            <h2 class="text-lg font-bold text-gray-900 dark:text-white leading-tight line-clamp-2">
                                {{ $ev->title }}
                            </h2>

                            @if ($venue)
                                <p class="flex items-start gap-1.5 text-sm text-gray-500 dark:text-gray-400 line-clamp-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $venue }}
                                </p>
                            @endif

                            <div class="flex-1"></div>

                            <a href="{{ route('event.details', $ev) }}" class="mt-2 inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-sm font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 dark:text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m6 0l-3-3m3 3l-3 3"/>
                                </svg>
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- ── Pagination ──────────────────────────────────────────────── --}}
            <div class="mt-10">{{ $events->links() }}</div>

        @else
            {{-- ── Empty state ─────────────────────────────────────────────── --}}
            <div class="flex flex-col items-center justify-center py-20 px-4 text-center text-gray-500 dark:text-gray-400">
                <div class="bg-gray-100 dark:bg-gray-800/50 p-6 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('No events found') }}</h3>
                <p class="max-w-sm">{{ __('Check back later for upcoming events or create your own.') }}</p>
            </div>
        @endif
    </div>

    {{-- ── Favourite toggle script ─────────────────────────────────────────── --}}
    <script>
        function toggleFavourite(btn) {
            const svg = btn.querySelector('svg');
            const isFav = svg.getAttribute('fill') === 'currentColor';
            
            if (isFav) {
                svg.setAttribute('fill', 'none');
                btn.setAttribute('aria-label', '{{ __('Add to favourites') }}');
                btn.setAttribute('title', '{{ __('Add to favourites') }}');
            } else {
                svg.setAttribute('fill', 'currentColor');
                btn.setAttribute('aria-label', '{{ __('Remove from favourites') }}');
                btn.setAttribute('title', '{{ __('Remove from favourites') }}');
                
                // pop animation
                btn.style.transform = 'scale(1.3)';
                setTimeout(() => {
                    btn.style.transform = '';
                }, 150);
            }
        }
    </script>
</x-app-layout>
