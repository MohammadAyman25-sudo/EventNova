<x-app-layout>
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

        <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $event->title }}</h1>
                <p class="mt-1 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Status') }}:
                    <span @class([
                        'inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium',
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300' => $isDraft,
                        'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300'     => !$isDraft,
                    ])>
                        {{ __($statusLabel) }}
                    </span>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                {{-- Publish button — only visible when the event is a draft and the user can update it --}}
                @if ($isDraft)
                    @can('update', $event)
                        <form method="POST" action="{{ route('event.publish', $event) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600">
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
                       class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        {{ __('Edit') }}
                    </a>
                @endcan

                @can('delete', $event)
                    <form id="delete-event-form" method="POST" action="{{ route('delete.event', $event) }}"
                          data-confirm-message="{{ e(__('Delete this event? This cannot be undone.')) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-800 hover:bg-red-100 dark:border-red-900 dark:bg-red-950/40 dark:text-red-200 dark:hover:bg-red-950/60">
                            {{ __('Delete') }}
                        </button>
                    </form>
                @endcan

                {{-- Favourite button — attendees only (events.save permission) --}}
                @can('save', $event)
                    <button
                        id="fav-btn"
                        type="button"
                        onclick="toggleFavourite(this)"
                        aria-label="{{ __('Add to favourites') }}"
                        title="{{ __('Add to favourites') }}"
                        class="fav-detail-btn inline-flex items-center gap-1.5 rounded-md border border-rose-200 bg-rose-50 px-4 py-2 text-sm font-medium text-rose-700 hover:bg-rose-100 dark:border-rose-900 dark:bg-rose-950/40 dark:text-rose-300 dark:hover:bg-rose-950/60 transition-colors duration-200"
                    >
                        <svg id="fav-heart-icon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-all duration-200"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                        </svg>
                        <span id="fav-label">{{ __('Add to favourites') }}</span>
                    </button>
                @endcan
            </div>
        </div>

        @if ($event->banner_image)
            <div class="mb-8 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                <img src="{{ \Illuminate\Support\Facades\Storage::disk(config('filesystems.media_disk', 'r2'))->url($event->banner_image) }}"
                     alt=""
                     class="h-64 w-full object-cover">
            </div>
        @endif

        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Description') }}</dt>
                <dd class="mt-1 text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{{ $event->description ?: '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Starts') }}</dt>
                <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $event->start_date?->timezone(config('app.timezone'))->format('Y-m-d H:i') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Ends') }}</dt>
                <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $event->end_date?->timezone(config('app.timezone'))->format('Y-m-d H:i') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Venue') }}</dt>
                <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $event->venue_name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Address') }}</dt>
                <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $event->venue_address ?: '—' }}</dd>
            </div>
            @if ($event->online_link)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Online link') }}</dt>
                    <dd class="mt-1">
                        <a href="{{ $event->online_link }}" target="_blank" rel="noopener noreferrer"
                           class="text-indigo-600 hover:underline dark:text-indigo-400">{{ $event->online_link }}</a>
                    </dd>
                </div>
            @endif
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Capacity') }}</dt>
                <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $event->capacity }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Organizer') }}</dt>
                <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $event->organizer?->full_name ?? '—' }}</dd>
            </div>
        </dl>

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
    </div>
</x-app-layout>
