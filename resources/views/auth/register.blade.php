<x-guest-layout title="Create Account" paragraph="Join EventNova today">
    @if (!empty($errors->get('registration_error')))
        <div class="text-center px-10 py-4 text-red-500/90 border-2 border-red-500 rounded-xl">
            {{ $errors->get('registration_error')[0] }}
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-2 md:grid-cols-2 md:gap-4 !mt-0">
            <!-- First Name -->
            <div>
                <x-input-label for="firstName" :value="__('First Name')" />
                <x-text-input id="firstName" placeholder="John" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="lastName" :value="__('Last Name')" />
                <x-text-input id="lastName" placeholder="Doe" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')"/>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-password-input id="password"
                            placeholder="Create a password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-password-input id="password_confirmation"
                            placeholder="Confirm your password"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div>
            <x-input-label :value="__('I want to')"/>
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2 md:gap-4">    
                <x-input-radio name="role" value="attendee" icon="icons.user" checked="true" text="Attend Events"/>
                <x-input-radio name="role" value="organizer" icon="icons.calendar-2" text="Create Events"/>
            </div>
        </div>

        <x-primary-button class="w-full py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full font-semibold hover:shadow-lg transition-all whitespace-nowrap">
            {{ __('Create Account') }}
        </x-primary-button>
        <x-auth.third-party-auth text="Or continue with" :thirdParties="[['icon' => 'google', 'title' => 'Google', 'color'=>'fill-red-500'], ['icon'=>'facebook', 'title'=>'Facebook', 'color' => 'text-blue-600']]"/>
        <p class="text-center text-gray-600 dark:text-gray-300 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 font-semibold">Sign In</a>
        </p>
    </form>
</x-guest-layout>
