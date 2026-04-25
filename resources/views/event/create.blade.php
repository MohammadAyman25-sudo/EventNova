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

            {{-- Hidden status field – toggled by the submit buttons --}}
            <input type="hidden" name="status" id="event-status-input" value="{{ old('status', \App\Enums\Event\EventStatusEnum::DRAFT->value) }}">

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

                <div id="banner-preview-wrapper" class="hidden mt-3 relative w-full overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/40" style="aspect-ratio: 16/5;">
                    <img id="banner-preview" src="#" alt="Banner preview" class="w-full h-full object-cover">
                    <button type="button" id="banner-remove" title="Remove image" class="absolute top-2 right-2 flex items-center justify-center w-7 h-7 rounded-full bg-black/50 text-white hover:bg-black/75 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
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

            {{-- Action buttons --}}
            <div class="pt-2 flex flex-wrap items-center gap-3">
                <button
                    type="submit"
                    id="btn-draft"
                    class="inline-flex items-center gap-2 rounded border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                    {{ __('Save as DRAFT') }}
                </button>

                <button
                    type="submit"
                    id="btn-publish"
                    class="inline-flex items-center gap-2 rounded bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                    </svg>
                    {{ __('Publish Event') }}
                </button>
            </div>
        </form>

        <script>
            (function () {
                // ── Venue / online-link constraint ──────────────────────────────
                const form   = document.getElementById('event-create-form');
                const venue  = document.getElementById('venue_address');
                const online = document.getElementById('online_link');
                if (!form || !venue || !online) return;

                function syncVenueOnlineConstraint() {
                    const hasVenue = venue.value.trim().length > 0;
                    online.required = !hasVenue;
                    venue.required  = !online.value.trim();
                }

                venue.addEventListener('input', syncVenueOnlineConstraint);
                online.addEventListener('input', syncVenueOnlineConstraint);
                syncVenueOnlineConstraint();

                form.addEventListener('submit', function (e) {
                    const hasVenue  = venue.value.trim().length > 0;
                    const hasOnline = online.value.trim().length > 0;
                    if (!hasVenue && !hasOnline) {
                        e.preventDefault();
                        online.setCustomValidity('Provide an online link when there is no venue address.');
                        online.reportValidity();
                        return;
                    }
                    online.setCustomValidity('');
                });

                // ── DRAFT / Publish status toggle ───────────────────────────────
                const statusInput  = document.getElementById('event-status-input');
                const draftValue   = '{{ \App\Enums\Event\EventStatusEnum::DRAFT->value }}';
                const publishValue = '{{ \App\Enums\Event\EventStatusEnum::PUBLISHED->value }}';

                document.getElementById('btn-draft').addEventListener('click', function () {
                    statusInput.value = draftValue;
                });

                document.getElementById('btn-publish').addEventListener('click', function () {
                    statusInput.value = publishValue;
                });

                // ── Banner image preview ────────────────────────────────────────
                const bannerInput    = document.getElementById('banner_image');
                const previewWrapper = document.getElementById('banner-preview-wrapper');
                const previewImg     = document.getElementById('banner-preview');
                const removeBtn      = document.getElementById('banner-remove');

                bannerInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        previewWrapper.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                });

                removeBtn.addEventListener('click', function () {
                    bannerInput.value = '';
                    previewImg.src = '#';
                    previewWrapper.classList.add('hidden');
                });
            })();
        </script>
    </div>
</x-app-layout>