@php
    $allowedTabs = ['upcoming-events', 'past-events', 'draft-events'];
    $initialTab = request()->query('tab', 'upcoming-events');
    if (! in_array($initialTab, $allowedTabs)) {
        $initialTab = 'upcoming-events';
    }
@endphp

<div x-data="tabs()" class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden">
    <div role="tablist" class="flex border-b border-gray-200 dark:border-gray-700">
        <button role="tab" @click="setTab('upcoming-events')" :class="{'text-purple-600 dark:text-purple-400 border-b-2 border-purple-600 dark:border-purple-400 bg-purple-50 dark:bg-purple-900/20':activeTab === 'upcoming-events', 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50':activeTab !== 'upcoming-events'}" class="flex-1 flex items-center justify-center py-4 px-6 font-semibold transition-all">
            <x-icons.calendar-event class="stroke-current fill-current mr-2"/>Upcoming Events</button>
        <button role="tab" @click="setTab('past-events')" :class="{'text-purple-600 dark:text-purple-400 border-b-2 border-purple-600 dark:border-purple-400 bg-purple-50 dark:bg-purple-900/20':activeTab === 'past-events', 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50':activeTab !== 'past-events'}" class="flex-1 flex items-center justify-center py-4 px-6 font-semibold transition-all">
            <x-icons.history class="fill-current stroke-current mr-2"/>Past Events</button>
        <button role="tab" @click="setTab('draft-events')" :class="{'text-purple-600 dark:text-purple-400 border-b-2 border-purple-600 dark:border-purple-400 bg-purple-50 dark:bg-purple-900/20':activeTab === 'draft-events', 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50':activeTab !== 'draft-events'}" class="flex-1 flex items-center justify-center py-4 px-6 font-semibold transition-all">
            <x-icons.draft class="fill-current stroke-current mr-2"/>Draft Events</button>
    </div>
    <div class="p-8">
        <div x-show="activeTab==='upcoming-events'" class="space-y-6" x-transition>
            <x-ticket-list-card cover="https://readdy.ai/api/search-image?query=vibrant%20outdoor%20summer%20music%20festival%20with%20large%20stage%20colorful%20lights%20and%20excited%20crowd%20dancing%20under%20sunset%20sky%20with%20simple%20clean%20gradient%20background%20professional%20photography&width=800&height=1000&seq=evt001&orientation=portrait" title="Summer Music Festival 2024" date="MAR 15" location="Central Park, New York" status="Confirmed"/>
            <x-ticket-list-card cover="https://readdy.ai/api/search-image?query=modern%20technology%20conference%20with%20futuristic%20holographic%20displays%20and%20professional%20attendees%20in%20bright%20spacious%20venue%20with%20clean%20white%20background&width=600&height=400&seq=evt002&orientation=landscape" title="Tech Innovation Summit" date="MAR 20" location="Convension Center, San Francisco" status="Confirmed"/>
            <x-ticket-list-card cover="https://readdy.ai/api/search-image?query=elegant%20wine%20tasting%20event%20with%20gourmet%20food%20platters%20and%20wine%20glasses%20on%20wooden%20table%20with%20soft%20lighting%20and%20simple%20neutral%20background&width=600&height=400&seq=evt003&orientation=landscape" title="Food & Wine Tasting Experience" date="MAR 22" location="Riverside Restraunt, Chicago" status="Confirmed"/>
        </div>
        <div x-show="activeTab==='past-events'" class="grid grid-cols-1 md:grid-cols-2 gap-6" x-transition>
            <x-saved-event-card cover="https://readdy.ai/api/search-image?query=marathon%20runners%20in%20colorful%20athletic%20wear%20running%20through%20city%20streets%20with%20cheering%20crowds%20and%20simple%20clean%20background&width=600&height=400&seq=evt004&orientation=landscape" date="MAR 25" location="Downtown, Boston" title="Marathon City Run 2024"/>
            <x-saved-event-card cover="https://readdy.ai/api/search-image?query=modern%20art%20gallery%20with%20colorful%20abstract%20paintings%20on%20white%20walls%20and%20visitors%20admiring%20artwork%20in%20bright%20spacious%20room&width=600&height=400&seq=evt005&orientation=landscape" date="MAR 28" location="Modern Art Gallery, Los Angelos" title="Contemporary Art Exhibition"/>
            <x-saved-event-card cover="https://readdy.ai/api/search-image?query=elegant%20jazz%20band%20performing%20on%20rooftop%20venue%20at%20night%20with%20city%20lights%20and%20starry%20sky%20simple%20background&width=600&height=400&seq=evt006&orientation=landscape" date="APR 02" location="Rooftop Lounge, Miami" title="Jazz Night Under The Stars"/>
        </div>
        <div x-show="activeTab==='draft-events'" class="grid grid-cols-1 md:grid-cols-2 gap-6" x-transition>
            <x-saved-event-card cover="https://readdy.ai/api/search-image?query=marathon%20runners%20in%20colorful%20athletic%20wear%20running%20through%20city%20streets%20with%20cheering%20crowds%20and%20simple%20clean%20background&width=600&height=400&seq=evt004&orientation=landscape" date="MAR 25" location="Downtown, Boston" title="Marathon City Run 2024"/>
            <x-saved-event-card cover="https://readdy.ai/api/search-image?query=modern%20art%20gallery%20with%20colorful%20abstract%20paintings%20on%20white%20walls%20and%20visitors%20admiring%20artwork%20in%20bright%20spacious%20room&width=600&height=400&seq=evt005&orientation=landscape" date="MAR 28" location="Modern Art Gallery, Los Angelos" title="Contemporary Art Exhibition"/>
            <x-saved-event-card cover="https://readdy.ai/api/search-image?query=elegant%20jazz%20band%20performing%20on%20rooftop%20venue%20at%20night%20with%20city%20lights%20and%20starry%20sky%20simple%20background&width=600&height=400&seq=evt006&orientation=landscape" date="APR 02" location="Rooftop Lounge, Miami" title="Jazz Night Under The Stars"/>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function tabs(){
            return {
                allowedTabs: ['upcoming-events', 'past-events', 'draft-events'],
                activeTab: '{{ $initialTab }}',

                init() {
                    window.addEventListener('popstate', () => {
                        const tab = new URLSearchParams(window.location.search).get('tab');
                        this.activeTab = this.allowedTabs.includes(tab) ? tab : 'upcoming-tab';
                    });
                },

                setTab(tab) {
                    if (! this.allowedTabs.includes(tab)) return;

                    this.activeTab = tab;

                    const url = new URL(window.location);
                    url.searchParams.set('tab', tab);
                    window.history.pushState({}, '', url);
                }
            };
        }
    </script>
@endpush