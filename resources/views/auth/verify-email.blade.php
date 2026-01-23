<x-guest-layout :title="__('Verification Email Sent')" :paragraph="__('Check your email to verify your EventNova account')">
<div class="space-y-8 text-center">

            <!-- Icon -->
            <div class="mx-auto h-24 w-24 text-purple-600 dark:text-purple-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <!-- Title -->
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                {{ __('Verification Email Sent!') }}
            </h2>

            <!-- Email sent message -->
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">
                {{ __('We\'ve sent a verification link to') }}
                <span class="font-medium text-purple-600 dark:text-purple-400">{{ $email }}</span>
            </p>

            <!-- Info box -->
            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ __('Please check your inbox (and spam/junk folder) and click the verification link to activate your account.') }}
                </p>

                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('The link will expire in :minutes minutes for security reasons.', ['minutes' => 60]) }}
                </p>
            </div>

            <!-- Resend form -->
            <div class="mt-10">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors font-medium">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Already verified?') }}
                    <a href="{{ route('login') }}"
                       class="font-medium text-purple-600 hover:text-purple-500 dark:text-purple-400 dark:hover:text-purple-300">
                        {{ __('Sign in here') }}
                    </a>
                </p>
            </div>

            <!-- Troubleshooting tips -->
            <div class="mt-12 text-sm text-gray-500 dark:text-gray-400">
                <p>{{ __('Didn\'t receive the email?') }}</p>
                <ul class="mt-2 space-y-1 list-disc list-inside text-left rtl:text-right">
                    <li>{{ __('Check your spam or promotions folder') }}</li>
                    <li>{{ __('Make sure the email address above is correct') }}</li>
                    <li>{{ __('Try resending using the button above') }}</li>
                </ul>
            </div>
        </div>
</x-guest-layout>