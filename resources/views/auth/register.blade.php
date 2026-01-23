<x-guest-layout title="Create Account" paragraph="Join EventNova today">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <!-- First Name -->
            <div>
                <x-input-label for="firstName" :value="__('First Name')" />
                <x-text-input id="firstName" placeholder="John" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="lastName" :value="__('Last Name')" />
                <x-text-input id="lastName" placeholder="Doe" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="Enter your email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-password-input id="password" class="block mt-1 w-full"
                            placeholder="Create a password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-password-input id="password_confirmation" class="block mt-1 w-full"
                            placeholder="Confirm your password"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label :value="__('I want to')"/>
            <div class="grid grid-cols-2 gap-4">
                <label class="flex items-center justify-center gap-2 p-4 border-2 rounded-xl cursor-pointer transition-all border-purple-400 bg-purple-50 dark:bg-purple-900/30">
                    <input class="hidden" type="radio" value="attendee" checked name="role">
                    <x-icons.user class="text-xl dark:fill-white"/>
                    <span class="font-semibold dark:text-white">{{ __('Attend Events') }}</span>
                </label>
                <label class="flex items-center justify-center gap-2 p-4 border-2 rounded-xl cursor-pointer transition-all border-purple-400 bg-purple-50 dark:bg-purple-900/30">
                    <input class="hidden" type="radio" value="organizer" name="role">
                    <x-icons.calendar-2 class="text-xl dark:fill-white"/>
                    <span class="font-semibold dark:text-white">{{ __('Create Events') }}</span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
