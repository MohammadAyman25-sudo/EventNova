<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-7 h-7 fill-current text-gray-100" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <script>
            function togglePassword(e) {
                console.log(e);
                const passwordField = document.getElementById(e.target.dataset.id);
                const eyes = document.getElementsByClassName('eye');
                const eyeSlashs = document.getElementsByClassName('eye-slash');
                console.log(eyes, eyeSlashs);
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

                console.log(eye, eyeSlash);

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
