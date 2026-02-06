@php
    $icons = config('eventnova-icons');
@endphp

<x-app-layout>
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full mb-6">
            <x-icons.heart-3 class="text-4xl fill-white"/>
        </div>
        <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">What Interests You?</h1>
        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Select your interests so we can notify you about events you'll love. Choose at least 3 categories.</p>
    </div>
    <form action="{{ route('submit.interest') }}" method="POST">
        @csrf
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 mb-8">
            @if (isset($errors))
                <div class="text-center bg-red-400/20 rounded-lg">
                    <ul class="text-md text-red-600 dark:text-red-500 space-y-1">
                        @foreach ((array) $errors->get('interests') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                Select Your Interests
                <span class="countSelectInterests ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">
                    (0 selected)
                </span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($categories as $category)
                    <x-input-category-checkbox background="linear-gradient(135deg, {{ $category->color }} 0%, {{ $category->gradient }} 100%)" category="{{ str_replace('&', 'and', $category->name) }}" icon="{{ $icons[$category->icon]['icon'] }}" categoryId="{{ $category->id }}"/>
                @endforeach
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Notification Preferences</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Choose how you'd like to recieve updates about events matching your interests.</p>
            <div class="space-y-4">
                <x-notification-option background="bg-gradient-to-br from-blue-500 to-cyan-500" icon="icons.mail" optionTitle="Email Notifications" optionDesc="Get event updates via email" value=1/>
                <x-notification-option background="bg-gradient-to-br from-purple-500 to-pink-500" icon="icons.bell" optionTitle="Push Notifications" optionDesc="Recieve instant push notifications" value=2/>
            </div>
        </div>
        <div class="flex gap-4">
            <button type="button" class="flex-1 py-4 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-semibold hover:border-purple-300 dark:hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all whitespace-nowrap cursor-pointer">Skip for Now</button>
            <button type="submit" disabled class="submit-interests flex-1 py-4 rounded-full font-semibold transtion-all whitespace-nowrap disabled:bg-gray-300 dark:disabled:bg-gray-700 disabled:text-gray-500 dark:disabled:text-gray-500 disabled:cursor-not-allowed enabled:bg-gradient-to-r enabled:from-purple-600 enabled:to-pink-600 enabled:text-white enabled:hover:shadow-lg enabled:cursor-pointer">Save Preferences</button>
        </div>
    </form>
    @push('scripts')
        <script>
            let chosenCategories = document.querySelectorAll('.interests');
            let btnSubmit = document.querySelector('.submit-interests');
            let countChoices = 0;
            chosenCategories.forEach(element => {
                element.addEventListener('change', function(){
                    if (this.checked) {
                        countChoices ++;
                    } else {
                        countChoices = Math.max(countChoices - 1, 0);
                    }
                    document.querySelector('.countSelectInterests').innerText=`(${countChoices}) selected`;
                    if (countChoices >= 3) {
                        btnSubmit.removeAttribute('disabled');
                    }
                })
            });

            btnSubmit.addEventListener('click', function(){
                btnSubmit.innerText = 'Submitting...';
                btnSubmit.addAttribute('disabled');
            });

        </script>
    @endpush
</x-app-layout>