<x-app-layout>
    @push('styles')
        <x-mapbox-styles />
    @endpush
    <div class="max-w-4xl mx-auto p-6">
        @if (session('success'))
            <div class="mb-6 rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @php
            $status        = \App\Enums\Event\EventStatusEnum::tryFrom((int) $event->status);
            $isDraft       = $status === \App\Enums\Event\EventStatusEnum::DRAFT;
            $statusLabel   = $status ? str_replace('_', ' ', $status->name) : $event->status;
        @endphp

        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 mb-8">
            @if ($event->banner_image)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk(config('filesystems.media_disk', 'r2'))->url($event->banner_image) }}"
                     alt="{{ $event->title }}"
                     class="h-64 sm:h-80 w-full object-cover">
            @endif
            <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $event->title }}</h1>
                        <div class="mt-3 flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ __('Status') }}:</span>
                            <span @class([
                                'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold uppercase tracking-wider',
                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300' => $isDraft,
                                'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300'     => !$isDraft,
                            ])>
                                {{ __($statusLabel) }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        @if ($isDraft)
                            @can('update', $event)
                                <form method="POST" action="{{ route('event.publish', $event) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Publish') }}
                                    </button>
                                </form>
                            @endcan
                        @endif

                        @can('update', $event)
                            <a href="{{ route('event.edit', $event) }}"
                               class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-5 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                {{ __('Edit Event') }}
                            </a>
                        @endcan

                        @can('delete', $event)
                            <form id="delete-event-form" method="POST" action="{{ route('delete.event', $event) }}"
                                  data-confirm-message="{{ e(__('Delete this event? This cannot be undone.')) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-5 py-2 text-sm font-semibold text-red-800 shadow-sm hover:bg-red-100 transition dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/40">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endcan

                        @can('save', $event)
                            <button
                                id="fav-btn"
                                type="button"
                                onclick="toggleFavourite(this)"
                                aria-label="{{ __('Add to favourites') }}"
                                title="{{ __('Add to favourites') }}"
                                class="fav-detail-btn inline-flex items-center gap-1.5 rounded-lg border border-rose-200 bg-rose-50 px-5 py-2 text-sm font-semibold text-rose-700 shadow-sm hover:bg-rose-100 transition dark:border-rose-900/50 dark:bg-rose-900/20 dark:text-rose-400 dark:hover:bg-rose-900/40"
                            >
                                <svg id="fav-heart-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                                </svg>
                                <span id="fav-label">{{ __('Favourite') }}</span>
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
            {{-- Left Column (Main Content) --}}
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6 md:p-8 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('About this event') }}</h3>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed">
                        {!! nl2br(e($event->description ?: 'No description provided.')) !!}
                    </div>
                </div>

                @if (isset($event->location['lat']) && isset($event->location['lng']))
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                        <div class="px-6 md:px-8 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('Location Map') }}</h3>
                        </div>
                        <div id="map" class="eventnova-map-readonly h-[400px] w-full"></div>
                    </div>
                @endif
            </div>

            {{-- Right Column (Metadata Sidebar) --}}
            <div class="space-y-6">
                {{-- Date & Time --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">{{ __('Date & Time') }}</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Starts') }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->start_date?->timezone(config('app.timezone'))->format('D, M j, Y g:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mt-0.5 opacity-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Ends') }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->end_date?->timezone(config('app.timezone'))->format('D, M j, Y g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Venue --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">{{ __('Location details') }}</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $event->venue_name ?: '—' }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->venue_address ?: 'No address specified' }}</p>
                            </div>
                        </div>
                        @if ($event->online_link)
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Online Event') }}</p>
                                    <a href="{{ $event->online_link }}" target="_blank" rel="noopener noreferrer" class="text-sm text-indigo-600 hover:text-indigo-500 hover:underline dark:text-indigo-400">Join Link</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Organization --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">{{ __('Event Info') }}</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Organizer') }}</p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $event->organizer?->full_name ?? '—' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Capacity') }}</p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $event->capacity }} {{ __('attendees') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @can('delete', $event)
            <script>
                (function () {
                    var form = document.getElementById('delete-event-form');
                    if (!form) return;
                    form.addEventListener('submit', function (e) {
                        var msg = form.getAttribute('data-confirm-message');
                        if (msg && !window.confirm(msg)) {
                            e.preventDefault();
                        }
                    });
                })();
            </script>
        @endcan
        @if (isset($event->location['lat']) && isset($event->location['lng']))
            @push('scripts')
            <script src="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js" crossorigin></script>
            <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-language/v1.0.0/mapbox-gl-language.js" crossorigin></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const mapboxToken = "{{ config('services.mapbox.public_key') }}";
                    if (!mapboxToken) return;

                    mapboxgl.accessToken = mapboxToken;
                    
                    const isDarkMode = document.documentElement.classList.contains('dark');
                    const currentLocale = "{{ app()->getLocale() }}";
                    
                    // Set RTL text plugin for Arabic support
                    if (currentLocale === 'ar' && mapboxgl.getRTLTextPluginStatus() === 'unavailable') {
                        mapboxgl.setRTLTextPlugin(
                            'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js',
                            null,
                            true // Lazy load the plugin
                        );
                    }

                    const mapStyle = isDarkMode 
                        ? 'mapbox://styles/mapbox/dark-v10' 
                        : 'mapbox://styles/mapbox/streets-v11';

                    const lat = {{ $event->location['lat'] }};
                    const lng = {{ $event->location['lng'] }};

                    const mapboxMap = new mapboxgl.Map({
                        container: 'map',
                        style: mapStyle,
                        center: [lng, lat],
                        zoom: 14,
                        interactive: true // Attendees might want to zoom/pan
                    });

                    // Observe theme changes
                    const observer = new MutationObserver((mutations) => {
                        mutations.forEach((mutation) => {
                            if (mutation.attributeName === 'class') {
                                const isDarkNow = document.documentElement.classList.contains('dark');
                                const newStyle = isDarkNow 
                                    ? 'mapbox://styles/mapbox/dark-v10' 
                                    : 'mapbox://styles/mapbox/streets-v11';
                                mapboxMap.setStyle(newStyle);
                            }
                        });
                    });
                    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

                    // Add language support
                    mapboxMap.on('style.load', () => {
                        // Initialize the language plugin
                        const LanguageControl = window.MapboxLanguage || (window.mapboxgl && window.mapboxgl.MapboxLanguage);
                        if (LanguageControl) {
                            const language = new LanguageControl({ defaultLanguage: currentLocale });
                            mapboxMap.addControl(language);
                        }

                        // Manual fallback: Force Arabic/English labels on all layers that support them
                        const layers = mapboxMap.getStyle().layers;
                        layers.forEach(layer => {
                            if (layer.layout && layer.layout['text-field']) {
                                mapboxMap.setLayoutProperty(layer.id, 'text-field', [
                                    'coalesce',
                                    ['get', 'name_' + currentLocale],
                                    ['get', 'name']
                                ]);
                            }
                        });
                    });

                    // Add marker
                    new mapboxgl.Marker({ color: '#8b5cf6' })
                        .setLngLat([lng, lat])
                        .addTo(mapboxMap);

                    // Add navigation controls (zoom in/out)
                    mapboxMap.addControl(new mapboxgl.NavigationControl(), 'top-right');
                });
            </script>
            @endpush
        @endif
    </div>
</x-app-layout>
