<footer class="py-8 sm:py-12 px-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto">
        <div class="grid gird-cols-2 md:grid-cols-4 gap-6 sm:gap-8 mb-6 sm:mb-8">
            <x-footer-section title="Product" :links="[['text'=>'Features', 'href'=>'#features'],['text'=>'Categories', 'href'=>'#categories'],['text'=>'Browse Events', 'href'=>'#'],]"/>
            <x-footer-section title="Company" :links="[['text'=>'About Us', 'href'=>'#'],['text'=>'Careers', 'href'=>'#'],['text'=>'Contact', 'href'=>'#'],]"/>
            <x-footer-section title="Support" :links="[['text'=>'Help Center', 'href'=>'#'],['text'=>'Terms of Service', 'href'=>'#'],['text'=>'Privacy Policy', 'href'=>'#'],]"/>
            <x-footer-section title="Connect" :links="[['text'=>'Features', 'href'=>'#features'],['text'=>'Categories', 'href'=>'#categories'],['text'=>'Browse Events', 'href'=>'#'],]" :icons="['icons.facebook', 'icons.twitter', 'icons.instagram']"/>
        </div>
        <div class="pt-6 sm:pt-8 border-t border-gray-200 dark:border-gray-700 text-center">
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 px-4">
                &copy; {{ date('Y') }} EventNova. All rights reserved.
            </p>
        </div>
    </div>
</footer>