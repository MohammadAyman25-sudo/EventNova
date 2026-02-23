<x-app-layout>
    @include('profile.partials.user-info')
    @include('profile.partials.user-stats')
    @if (request()->user()->hasRole('attendee'))
        @include('profile.partials.attendee-user-list-window')
    @else
        @include('profile.partials.organizer-user-list-window')
    @endif
</x-app-layout>
<x-landing.sections.footer />