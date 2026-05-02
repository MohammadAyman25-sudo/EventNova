@php
    $startDefault = $event->start_date?->format('Y-m-d\TH:i');
    $endDefault = $event->end_date?->format('Y-m-d\TH:i');
    $lat = $event->location['lat'] ?? null;
    $lng = $event->location['lng'] ?? null;
@endphp
<x-app-layout>
    @push('styles')
        <x-mapbox-styles />
    @endpush
    <div class="max-w-4xl mx-auto p-6">
        <div class="mb-6 flex items-center justify-between gap-4">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Edit event') }}</h1>
            <a href="{{ route('event.details', $event) }}"
               class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                {{ __('Back to event') }}
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900 dark:bg-red-950/30 dark:text-red-200">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="event-edit-form" method="POST" action="{{ route('update.event', $event) }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- 1. Basic Information --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Basic Information') }}</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Update the title and description for this event.') }}</p>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Title') }} *</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $event->title) }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Description') }}</label>
                        <textarea id="description" name="description" rows="4" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $event->description) }}</textarea>
                    </div>
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Capacity') }} * ({{ __('min') }}: 5)</label>
                        <input id="capacity" name="capacity" type="number" min="5" value="{{ old('capacity', $event->capacity) }}" required class="w-full sm:w-1/3 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
            </div>

            {{-- 2. Date & Location --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Date & Location') }}</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Update when and where this event is taking place.') }}</p>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Start Date') }} *</label>
                            <input id="start_date" name="start_date" type="datetime-local" value="{{ old('start_date', $startDefault) }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:[color-scheme:dark]">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('End Date') }} *</label>
                            <input id="end_date" name="end_date" type="datetime-local" value="{{ old('end_date', $endDefault) }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:[color-scheme:dark]">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <label for="venue_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Venue Name') }} *</label>
                        <input id="venue_name" name="venue_name" type="text" value="{{ old('venue_name', $event->venue_name) }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="rounded-lg border border-indigo-100 bg-indigo-50/50 p-5 dark:border-indigo-900/30 dark:bg-indigo-900/10">
                        <p class="mb-4 text-sm text-gray-700 dark:text-gray-200">
                            {!! __('For an <strong>offline</strong> event, fill the venue address and leave the online link empty. For an <strong>online-only</strong> event, leave the address empty and provide the meeting or stream URL.') !!}
                        </p>
                        <div class="space-y-4">
                            <div>
                                <label for="venue_address" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Venue address') }}</label>
                                <input id="venue_address" name="venue_address" type="text" value="{{ old('venue_address', $event->venue_address) }}" autocomplete="street-address" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Required unless you provide an online link below.') }}</p>
                            </div>

                            <div>
                                <label for="online_link" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Online link') }}</label>
                                <input id="online_link" name="online_link" type="text" inputmode="url" autocomplete="url" value="{{ old('online_link', $event->online_link) }}" placeholder="https://…" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Only required when there is no venue address (virtual event).') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-900 dark:text-white">{{ __('Event Location (Map)') }}</label>
                        
                        <div id="geocoder" class="relative z-10 w-full md:w-2/3 lg:w-1/2"></div>
                        <div id="map" class="eventnova-map shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 h-80"></div>
                        
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ __('Click anywhere on the map to set the event coordinates or use the search bar to find a specific place.') }}
                        </p>

                        <input type="hidden" name="location[lat]" id="location_lat" value="{{ old('location.lat', $lat) }}">
                        <input type="hidden" name="location[lng]" id="location_lng" value="{{ old('location.lng', $lng) }}">
                    </div>
                </div>
            </div>

            {{-- 3. Media --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Media') }}</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Update the banner image for this event.') }}</p>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Banner image (leave empty to keep current)') }}</label>
                    <div class="relative w-full">
                        <input id="banner_image" name="banner_image" type="file" accept=".jpg,.jpeg,.png,.webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="document.getElementById('banner-file-name-edit').textContent = this.files[0] ? this.files[0].name : '{{ __('No file chosen') }}'">
                        <div class="flex items-center gap-3 w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300 px-3 py-1 rounded font-semibold">{{ __('Choose File') }}</span>
                            <span id="banner-file-name-edit">{{ __('No file chosen') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Refund Policy --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Ticketing & Refund Policy') }}</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Update the refund policy for this event.') }}</p>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="refund_policy" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Refund Policy') }} *</label>
                        <select id="refund_policy" name="refund_policy" required class="w-full sm:w-1/2 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">{{ __('Select policy') }}</option>
                            <option value="0" @selected(old('refund_policy', (string) $event->refund_policy) === '0')>{{ __('Full refund before event') }}</option>
                            <option value="1" @selected(old('refund_policy', (string) $event->refund_policy) === '1')>{{ __('Partial refund before event') }}</option>
                            <option value="2" @selected(old('refund_policy', (string) $event->refund_policy) === '2')>{{ __('Case by case') }}</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="refund_days_before" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Refund Days Before') }}</label>
                            <input id="refund_days_before" name="refund_days_before" type="number" min="0" value="{{ old('refund_days_before', $event->refund_days_before) }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="refund_percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Refund Percentage') }} * (0-100)</label>
                            <input id="refund_percentage" name="refund_percentage" type="number" min="0" max="100" value="{{ old('refund_percentage', $event->refund_percentage) }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="inline-flex items-center gap-3 cursor-pointer">
                            <input type="hidden" name="allow_refund_after_start" value="0">
                            <input type="checkbox" name="allow_refund_after_start" value="1" @checked(old('allow_refund_after_start', $event->allow_refunds_after_start)) class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:focus:ring-offset-gray-800">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Allow refunds after start') }} *</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-4 pb-12 flex flex-wrap items-center justify-end gap-4">
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition">
                    {{ __('Save changes') }}
                </button>
            </div>
        </form>

        <script>
            (function () {
                const form = document.getElementById('event-edit-form');
                const venue = document.getElementById('venue_address');
                const online = document.getElementById('online_link');
                if (!form || !venue || !online) return;

                function clearMutualValidity() {
                    venue.setCustomValidity('');
                    online.setCustomValidity('');
                }

                venue.addEventListener('input', clearMutualValidity);
                online.addEventListener('input', clearMutualValidity);

                form.addEventListener('submit', function (e) {
                    clearMutualValidity();
                    const hasVenue = venue.value.trim().length > 0;
                    const hasOnline = online.value.trim().length > 0;

                    if (hasVenue && !hasOnline) {
                        online.value = '';
                    }

                    if (!hasVenue && !hasOnline) {
                        e.preventDefault();
                        venue.setCustomValidity('Enter a venue address, or leave it empty and provide an online link instead.');
                        venue.reportValidity();
                        return;
                    }

                    if (hasVenue) {
                        online.setCustomValidity('');
                    }
                });
            })();
        </script>
        @push('scripts')
        <script src="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js" crossorigin></script>
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js" crossorigin></script>
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-language/v1.0.0/mapbox-gl-language.js" crossorigin></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mapboxToken = "{{ config('services.mapbox.public_key') }}";
                const initialLat = {{ old('location.lat', $lat) ?? 30.0444 }};
                const initialLng = {{ old('location.lng', $lng) ?? 31.2357 }};

                if (!mapboxToken) {
                    console.error('Mapbox public key is missing.');
                    return;
                }

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

                const mapboxMap = new mapboxgl.Map({
                    container: 'map',
                    style: mapStyle,
                    center: [initialLng, initialLat],
                    zoom: 14
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

                // Add search (Geocoder)
                const geocoder = new MapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    mapboxgl: mapboxgl,
                    placeholder: currentLocale === 'ar' ? 'البحث عن مكان...' : 'Search for a place...',
                    marker: false,
                    language: currentLocale
                });

                document.getElementById('geocoder').appendChild(geocoder.onAdd(mapboxMap));

                let marker = null;
                const latInput = document.getElementById('location_lat');
                const lngInput = document.getElementById('location_lng');

                function updateMarker(lng, lat) {
                    if (marker) marker.remove();
                    
                    marker = new mapboxgl.Marker({ color: '#8b5cf6' }) // Purple
                        .setLngLat([lng, lat])
                        .addTo(mapboxMap);
                    
                    latInput.value = lat;
                    lngInput.value = lng;
                }

                // Initialize with existing location
                if ({{ $lat ? 'true' : 'false' }} || {{ old('location.lat') ? 'true' : 'false' }}) {
                    updateMarker(initialLng, initialLat);
                }

                mapboxMap.on('click', (e) => {
                    updateMarker(e.lngLat.lng, e.lngLat.lat);
                });

                geocoder.on('result', (e) => {
                    const coords = e.result.geometry.coordinates;
                    updateMarker(coords[0], coords[1]);
                });
            });
        </script>
        @endpush
    </div>
</x-app-layout>
