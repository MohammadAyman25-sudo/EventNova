<x-app-layout>
    {{-- ── Page styles ─────────────────────────────────────────────────────── --}}
    <style>
        /* Card grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* Card */
        .event-card {
            display: flex;
            flex-direction: column;
            border-radius: 1rem;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
            transition: box-shadow .25s ease, transform .25s ease;
        }
        .dark .event-card {
            background: #1e2235;
            border-color: #2d3350;
            box-shadow: 0 2px 12px rgba(0,0,0,.35);
        }
        .event-card:hover {
            box-shadow: 0 8px 28px rgba(0,0,0,.12);
            transform: translateY(-3px);
        }
        .dark .event-card:hover {
            box-shadow: 0 8px 28px rgba(0,0,0,.5);
        }

        /* Banner image area */
        .event-card__image-wrap {
            position: relative;
            height: 180px;
            flex-shrink: 0;
            overflow: hidden;
        }
        .event-card__image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }
        .event-card:hover .event-card__image-wrap img {
            transform: scale(1.05);
        }
        /* Gradient placeholder when no banner */
        .event-card__image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .event-card__image-placeholder svg {
            width: 56px;
            height: 56px;
            color: rgba(255,255,255,.55);
        }

        /* Price badge overlaid on image */
        .event-card__price-badge {
            position: absolute;
            bottom: .65rem;
            left: .75rem;
            background: rgba(0,0,0,.55);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            color: #fff;
            font-size: .75rem;
            font-weight: 600;
            padding: .25rem .6rem;
            border-radius: 999px;
            letter-spacing: .02em;
        }

        /* Favourite button overlaid on image */
        .event-card__fav-btn {
            position: absolute;
            top: .65rem;
            right: .75rem;
            width: 2.15rem;
            height: 2.15rem;
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .2s, transform .2s;
            z-index: 10;
        }
        .event-card__fav-btn:hover {
            background: #fff;
            transform: scale(1.12);
        }
        .dark .event-card__fav-btn {
            background: rgba(30,34,53,.85);
        }
        .dark .event-card__fav-btn:hover {
            background: rgba(30,34,53,1);
        }
        .event-card__fav-btn svg {
            width: 1.1rem;
            height: 1.1rem;
            transition: fill .2s, stroke .2s;
        }
        /* Default: outline heart */
        .event-card__fav-btn .heart-icon {
            fill: none;
            stroke: #e11d48;
            stroke-width: 2;
        }
        /* Active: filled heart */
        .event-card__fav-btn.is-fav .heart-icon {
            fill: #e11d48;
            stroke: #e11d48;
        }
        /* Pop animation */
        .event-card__fav-btn.pop {
            animation: heartPop .3s ease;
        }
        @keyframes heartPop {
            0%   { transform: scale(1); }
            50%  { transform: scale(1.35); }
            100% { transform: scale(1); }
        }

        /* Card body */
        .event-card__body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 1rem 1.1rem 1.1rem;
            gap: .45rem;
        }

        /* Date chip */
        .event-card__date {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            font-size: .72rem;
            font-weight: 500;
            color: #6366f1;
            background: #eef2ff;
            border-radius: 999px;
            padding: .2rem .65rem;
            width: fit-content;
        }
        .dark .event-card__date {
            color: #a5b4fc;
            background: rgba(99,102,241,.15);
        }

        /* Title */
        .event-card__title {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin: .1rem 0;
        }
        .dark .event-card__title {
            color: #f1f5f9;
        }

        /* Venue */
        .event-card__venue {
            font-size: .78rem;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: .35rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dark .event-card__venue {
            color: #9ca3af;
        }

        /* Spacer */
        .event-card__spacer { flex: 1; }

        /* CTA button */
        .event-card__cta {
            margin-top: .75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            width: 100%;
            padding: .6rem 1rem;
            border-radius: .6rem;
            font-size: .85rem;
            font-weight: 600;
            letter-spacing: .02em;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: opacity .2s, transform .15s;
        }
        .event-card__cta:hover {
            opacity: .9;
            transform: translateY(-1px);
        }
        .event-card__cta:active {
            transform: translateY(0);
        }

        /* Empty state */
        .events-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            padding: 4rem 1rem;
            text-align: center;
            color: #6b7280;
        }
        .dark .events-empty {
            color: #9ca3af;
        }
        .events-empty svg {
            width: 64px;
            height: 64px;
            opacity: .4;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

        {{-- ── Page header ────────────────────────────────────────────────── --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('Explore Events') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Discover and save events happening near you.') }}</p>
        </div>

        {{-- ── Flash messages ─────────────────────────────────────────────── --}}
        @if (session('message'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-950/40 dark:text-green-300">
                {{ session('message') }}
            </div>
        @endif

        @if ($errors->has('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-950/40 dark:text-red-300">
                {{ $errors->first('error') }}
            </div>
        @endif

        {{-- ── Event cards ─────────────────────────────────────────────────── --}}
        @if (isset($events) && $events->count())
            <div class="events-grid">
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

                    <article class="event-card">

                        {{-- ── Image / placeholder ──────────────────────── --}}
                        <div class="event-card__image-wrap">

                            @if ($bannerUrl)
                                <img src="{{ $bannerUrl }}" alt="{{ $ev->title }}">
                            @else
                                <div class="event-card__image-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Favourite toggle --}}
                            <button
                                type="button"
                                class="event-card__fav-btn"
                                aria-label="{{ __('Add to favourites') }}"
                                title="{{ __('Add to favourites') }}"
                                onclick="toggleFavourite(this)"
                            >
                                <svg class="heart-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                                </svg>
                            </button>

                            {{-- Price badge --}}
                            @if ($priceLabel)
                                <span class="event-card__price-badge">{{ $priceLabel }}</span>
                            @endif

                        </div>

                        {{-- ── Card body ─────────────────────────────────── --}}
                        <div class="event-card__body">

                            @if ($dateLabel)
                                <span class="event-card__date">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $dateLabel }}
                                </span>
                            @endif

                            <h2 class="event-card__title">{{ $ev->title }}</h2>

                            @if ($venue)
                                <p class="event-card__venue">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $venue }}
                                </p>
                            @endif

                            <div class="event-card__spacer"></div>

                            <a href="{{ route('event.details', $ev) }}" class="event-card__cta">
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
            <div class="mt-8">{{ $events->links() }}</div>

        @else
            {{-- ── Empty state ─────────────────────────────────────────────── --}}
            <div class="events-empty">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-lg font-semibold">{{ __('No events found') }}</p>
                <p class="text-sm">{{ __('Check back later or create the first one!') }}</p>
            </div>
        @endif
    </div>

    {{-- ── Favourite toggle script ─────────────────────────────────────────── --}}
    <script>
        function toggleFavourite(btn) {
            btn.classList.toggle('is-fav');

            // Trigger pop animation
            btn.classList.remove('pop');
            void btn.offsetWidth; // reflow
            btn.classList.add('pop');

            const label = btn.classList.contains('is-fav')
                ? '{{ __('Remove from favourites') }}'
                : '{{ __('Add to favourites') }}';
            btn.setAttribute('aria-label', label);
            btn.setAttribute('title', label);
        }
    </script>
</x-app-layout>
