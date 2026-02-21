@php
    $activeTab = request('tab', 'tickets');
@endphp
<div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden">
    <div class="flex border-b border-gray-200 dark:border-gray-700">
        <a href="?tab=tickets" class="flex-1 flex items-center justify-center py-4 px-6 font-semibold transition-all {{ $activeTab === 'tickets'?'text-purple-600 dark:text-purple-400 border-b-2 border-purple-600 dark:border-purple-400 bg-purple-50 dark:bg-purple-900/20': 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
            <x-icons.ticket class="stroke-current fill-current mr-2"/>My Tickets</a>
        <a href="?tab=events" class="flex-1 flex items-center justify-center py-4 px-6 font-semibold transition-all {{ $activeTab === 'events'?'text-purple-600 dark:text-purple-400 border-b-2 border-purple-600 dark:border-purple-400 bg-purple-50 dark:bg-purple-900/20': 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
            <x-icons.heart-3 class="fill-current stroke-current mr-2"/>Saved Events</a>
    </div>
    <div class="p-8">
        @if ($activeTab === 'tickets')
            <div class="space-y-6">
                <x-ticket-list-card cover="https://readdy.ai/api/search-image?query=vibrant%20outdoor%20summer%20music%20festival%20with%20large%20stage%20colorful%20lights%20and%20excited%20crowd%20dancing%20under%20sunset%20sky%20with%20simple%20clean%20gradient%20background%20professional%20photography&width=800&height=1000&seq=evt001&orientation=portrait" title="Summer Music Festival 2024" date="MAR 15" location="Central Park, New York" status="Confirmed"/>
                <x-ticket-list-card cover="https://readdy.ai/api/search-image?query=modern%20technology%20conference%20with%20futuristic%20holographic%20displays%20and%20professional%20attendees%20in%20bright%20spacious%20venue%20with%20clean%20white%20background&width=600&height=400&seq=evt002&orientation=landscape" title="Tech Innovation Summit" date="MAR 20" location="Convension Center, San Francisco" status="Confirmed"/>
                <x-ticket-list-card cover="https://readdy.ai/api/search-image?query=elegant%20wine%20tasting%20event%20with%20gourmet%20food%20platters%20and%20wine%20glasses%20on%20wooden%20table%20with%20soft%20lighting%20and%20simple%20neutral%20background&width=600&height=400&seq=evt003&orientation=landscape" title="Food & Wine Tasting Experience" date="MAR 22" location="Riverside Restraunt, Chicago" status="Confirmed"/>
            </div>
        @else
        @endif
    </div>
</div>