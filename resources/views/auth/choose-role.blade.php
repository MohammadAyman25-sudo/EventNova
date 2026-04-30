<x-guest-layout title="{{ __('Complete Registeration') }}" paragraph="Choose your role">
    <form method="POST" action="{{ route('register.assign-role', []) }}" class="space-y-6">
        @csrf
        <div>
            <x-input-label :value="__('I want to')"/>
            <x-input-error :messages="$errors->get('role')" />
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2 md:gap-4">    
                <x-input-radio name="role" value="attendee" icon="icons.user" text="Attend Events"/>
                <x-input-radio name="role" value="organizer" icon="icons.calendar-2" text="Create Events"/>
            </div>
        </div>
        <x-primary-button type="submit" class="w-full py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full font-semibold hover:shadow-lg transition-all whitespace-nowrap">
            Continue
        </x-primary-button>
    </form>
</x-guest-layout>