<section class="py-12 sm:py-20 px-4 bg-gradient-to-r from-purple-600 to-pink-600">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4 sm:mb-6 px-4">Ready to Get Started?</h2>
        <p class="text-base sm:text-xl text-white/90 mb-8 sm:mb-10 max-w-2xl mx-auto px-4">Join thousands of event enthusiasts and start discovering amazing experiences today</p>
        <a href={{ route('register', ['locale' => app()->getLocale()]) }} class="inline-flex items-center px-8 sm:px-10 py-4 sm:py-5 text-base sm:text-lg font-semibold text-purple-600 bg-white rounded-xl hover:shadow-2xl hover:scale-105 trasition-all whitespace-nowrap cursor-pointer">
            Create Free Account
            <x-icons.arrow-right class="fill-current w-4 h-4 stroke-current ml-2" />
        </a>
    </div>
</section>