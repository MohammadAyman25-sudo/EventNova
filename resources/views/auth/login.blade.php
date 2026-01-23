<x-guest-layout title="Welcome Back" paragraph="Sign in to continue to EventNova">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email"  placeholder="Enter your email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-password-input id="password" placeholder="Enter your password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 text-purple-600 rounded" name="remember">
                <span class="text-sm text-gray-600 dark:text-gray-300">{{ __('Remember me') }}</span>
            </label>
            {{-- <button class="text-sm text-purple-600 hover:text-purple-700 font-semibold">Forgot Password?</button> --}}
            @if (Route::has('password.request'))
                <a class="text-sm text-purple-600 hover:text-purple-700 font-semibold" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full font-semibold hover:shadow-lg transition-all whitespace-nowrap">
            {{ __('Sign In') }}
        </x-primary-button>
    </form>
    <x-auth.third-party-auth text="Or continue with" :thirdParties="[['icon' => 'google', 'title' => 'Google', 'color'=>'fill-red-500'], ['icon'=>'facebook', 'title'=>'Facebook', 'color' => 'text-blue-600']]"/>
    <p class="text-center text-gray-600 dark:text-gray-300 mt-6">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 font-semibold">Sign Up</a>
    </p>
</x-guest-layout>
