<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">{{ __('Events') }}</h1>

        @if (session('message'))
            <div class="mb-6 rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                {{ session('message') }}
            </div>
        @endif

        @if ($errors->has('error'))
            <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700">{{ $errors->first('error') }}</div>
        @endif

        @if (isset($events) && $events->count())
            <ul class="divide-y divide-gray-200 rounded-lg border border-gray-200 dark:divide-gray-700 dark:border-gray-700">
                @foreach ($events as $ev)
                    <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <a href="{{ route('event.details', $ev) }}" class="font-medium text-indigo-600 hover:underline dark:text-indigo-400">
                            {{ $ev->title }}
                        </a>
                        <p class="mt-1 text-sm text-gray-500">{{ $ev->start_date?->format('Y-m-d H:i') }}</p>
                    </li>
                @endforeach
            </ul>
            <div class="mt-6">{{ $events->links() }}</div>
        @else
            <p class="text-gray-600 dark:text-gray-400">{{ __('No events yet.') }}</p>
        @endif
    </div>
</x-app-layout>
