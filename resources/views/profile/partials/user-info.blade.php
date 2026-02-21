<div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 mb-8">
    <div class="flex items-center gap-6">
        @if(Auth::user()->hasMedia('avatar'))
            <img src="{{ Auth::user()->getFirstMediaUrl('avatar', 'profile  ') }}" alt="profile" class="w-24 h-24 rounded-full">
        @else
            <div class="w-24 h-24 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white text-4xl font-bold">{{ strtoupper(Auth::user()->first_name[0]).strtoupper(Auth::user()->last_name[0]) }}</div>
        @endif
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ Auth::user()->full_name }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>
            <div class="flex gap-3 mt-3">
                <a href="" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full text-sm font-semibold hover:shadow-lg transition-all whitespace-nowrap cursor-pointer">Edit Profile</a>
            </div>
        </div>
    </div>
</div>