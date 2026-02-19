<button {{ $attributes->merge(['type' => 'submit',]) }} class="w-full py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full font-semibold hover:shadow-lg transition-all whitespace-nowrap">
    {{ $slot }}
</button>
