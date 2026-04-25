<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">{{ __('Create Event') }}</h1>

        @if ($errors->any())
            <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="event-create-form" method="POST" action="{{ route('create.event', []) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium mb-1">Title *</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required class="w-full rounded border-gray-300">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-1">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full rounded border-gray-300">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium mb-1">Start Date *</label>
                    <input id="start_date" name="start_date" type="datetime-local" value="{{ old('start_date') }}" required class="w-full rounded border-gray-300">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium mb-1">End Date *</label>
                    <input id="end_date" name="end_date" type="datetime-local" value="{{ old('end_date') }}" required class="w-full rounded border-gray-300">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="venue_name" class="block text-sm font-medium mb-1">Venue Name *</label>
                    <input id="venue_name" name="venue_name" type="text" value="{{ old('venue_name') }}" required class="w-full rounded border-gray-300">
                </div>
                <div>
                    <label for="capacity" class="block text-sm font-medium mb-1">Capacity * (min: 5)</label>
                    <input id="capacity" name="capacity" type="number" min="5" value="{{ old('capacity', 5) }}" required class="w-full rounded border-gray-300">
                </div>
            </div>

            <div class="rounded-md border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/40">
                <p class="mb-3 text-sm text-gray-700 dark:text-gray-300">
                    For an <strong>offline</strong> event, fill the venue address and leave the online link empty.
                    For an <strong>online-only</strong> event, leave the address empty and provide the meeting or stream URL.
                </p>
                <div class="space-y-4">
                    <div>
                        <label for="venue_address" class="block text-sm font-medium mb-1">Venue address</label>
                        <input id="venue_address" name="venue_address" type="text" value="{{ old('venue_address') }}" autocomplete="street-address" class="w-full rounded border-gray-300">
                        <p class="mt-1 text-xs text-gray-500">Required unless you provide an online link below.</p>
                    </div>

                    <div>
                        <label for="online_link" class="block text-sm font-medium mb-1">Online link</label>
                        <input id="online_link" name="online_link" type="url" value="{{ old('online_link') }}" placeholder="https://…" class="w-full rounded border-gray-300">
                        <p class="mt-1 text-xs text-gray-500">Only required when there is no venue address (virtual event).</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="location_lat" class="block text-sm font-medium mb-1">Location Latitude</label>
                    <input id="location_lat" name="location[lat]" type="number" step="any" value="{{ old('location.lat') }}" class="w-full rounded border-gray-300">
                </div>
                <div>
                    <label for="location_lng" class="block text-sm font-medium mb-1">Location Longitude</label>
                    <input id="location_lng" name="location[lng]" type="number" step="any" value="{{ old('location.lng') }}" class="w-full rounded border-gray-300">
                </div>
            </div>

            <div>
                <label for="banner_image" class="block text-sm font-medium mb-1">Banner Image * (jpg, jpeg, png, webp)</label>
                <input id="banner_image" name="banner_image" type="file" accept=".jpg,.jpeg,.png,.webp" required class="w-full rounded border-gray-300">
            </div>

            <div>
                <label for="refund_policy" class="block text-sm font-medium mb-1">Refund Policy *</label>
                <select id="refund_policy" name="refund_policy" required class="w-full rounded border-gray-300">
                    <option value="">Select policy</option>
                    <option value="0" @selected(old('refund_policy') === '0')>Full refund before event</option>
                    <option value="1" @selected(old('refund_policy') === '1')>Partial refund before event</option>
                    <option value="2" @selected(old('refund_policy') === '2')>Case by case</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="refund_days_before" class="block text-sm font-medium mb-1">Refund Days Before</label>
                    <input id="refund_days_before" name="refund_days_before" type="number" min="0" value="{{ old('refund_days_before') }}" class="w-full rounded border-gray-300">
                </div>
                <div>
                    <label for="refund_percentage" class="block text-sm font-medium mb-1">Refund Percentage * (0-100)</label>
                    <input id="refund_percentage" name="refund_percentage" type="number" min="0" max="100" value="{{ old('refund_percentage', 100) }}" required class="w-full rounded border-gray-300">
                </div>
            </div>

            <div>
                <label class="inline-flex items-center gap-2">
                    <input type="hidden" name="allow_refund_after_start" value="0">
                    <input type="checkbox" name="allow_refund_after_start" value="1" @checked(old('allow_refund_after_start')) class="rounded border-gray-300">
                    <span class="text-sm">Allow refunds after start *</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    Create Event
                </button>
            </div>
        </form>

        <script>
            (function () {
                const form = document.getElementById('event-create-form');
                const venue = document.getElementById('venue_address');
                const online = document.getElementById('online_link');
                if (!form || !venue || !online) return;

                function syncVenueOnlineConstraint() {
                    const hasVenue = venue.value.trim().length > 0;
                    online.required = !hasVenue;
                    venue.required = !online.value.trim();
                }

                venue.addEventListener('input', syncVenueOnlineConstraint);
                online.addEventListener('input', syncVenueOnlineConstraint);
                syncVenueOnlineConstraint();

                form.addEventListener('submit', function (e) {
                    const hasVenue = venue.value.trim().length > 0;
                    const hasOnline = online.value.trim().length > 0;
                    if (!hasVenue && !hasOnline) {
                        e.preventDefault();
                        online.setCustomValidity('Provide an online link when there is no venue address.');
                        online.reportValidity();
                        return;
                    }
                    online.setCustomValidity('');
                });
            })();
        </script>
    </div>
</x-app-layout>
