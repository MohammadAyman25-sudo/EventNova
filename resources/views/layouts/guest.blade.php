@props([
    'title',
    'paragraph'
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @include('components.theme-init')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 dark:from-gray-900 dark:via-purple-900 dark:to-gray-900 flex items-center justify-center px-4 py-12">
            <div class="max-w-lg w-full">
                <div class="text-center mb-8">
                    <div class="inline-block p-4 bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl mb-4">
                        <x-icons.calendar class="text-5xl"/>
                    </div>
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ $title??"Test" }}</h1>
                    <p class="text-gray-600 dark:text-gray-300">{{ $paragraph ?? "Lorem ipsum dolor sit amet consectetur !" }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8">
                    {{ $slot }}
                </div>
                <a href="{{ route('home') }}" class="w-full mt-6 py-3 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-semibold flex items-center justify-center gap-2 whitespace-nowrap">
                    <x-icons.arrow-left class="fill-current stroke-current" />
                    Back to Home
                </a>
            </div>
        </div>
        <script>
            function togglePassword(e) {
                console.log(e);
                const passwordField = document.getElementById(e.target.dataset.id);
                const eyes = document.getElementsByClassName('eye');
                const eyeSlashs = document.getElementsByClassName('eye-slash');
                let eye = null;
                let eyeSlash = null;
                for (let i = 0; i < eyes.length; i++) {
                    console.log(eyes[i].parentElement.dataset.id === e.target.dataset.id);
                    if (eyes[i].parentElement.dataset.id === e.target.dataset.id) {
                        eye = eyes[i];
                        break;
                    }
                }
                for (let i = 0; i < eyeSlashs.length; i++) {
                    if (eyeSlashs[i].parentElement.dataset.id === e.target.dataset.id) {
                        eyeSlash = eyeSlashs[i];
                        break;
                    }
                }

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eye.classList.remove('hidden');
                    eyeSlash.classList.add('hidden');
                } else {
                    passwordField.type = 'password';
                    eye.classList.add('hidden');
                    eyeSlash.classList.remove('hidden');
                }
            }
        </script>
    </body>
</html>
