<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        @if (session('success'))
            <div class="mb-6 rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $event->title }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Status') }}:
                    @php
                        $status = \App\Enums\Event\EventStatusEnum::tryFrom((int) $event->status);
                    @endphp
                    {{ $status ? str_replace('_', ' ', $status->name) : $event->status }}
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
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
            </div>
        </div>

        @if ($event->banner_image)
            <div class="mb-8 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($event->banner_image) }}"
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
