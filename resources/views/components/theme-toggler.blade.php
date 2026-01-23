<div class="h-fit rounded-lg">
    <!-- Light Mode -->
    <button
        type="button"
        id="theme-light"
        title="Current:light"
        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-lg transition-all whitespace-nowrap cursor-pointer text-gray-700  dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800"
        aria-label="Use light theme"
    >
        <x-icons.sun class="text-lg sm:text-xl" />
    </button>

    <!-- Dark Mode -->
    <button
        type="button"
        id="theme-dark"
        title="Current:dark"
        class="hidden w-9 h-9 sm:w-10 sm:h-10 items-center justify-center rounded-lg transition-all whitespace-nowrap cursor-pointer text-gray-700  dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800"
        aria-label="Use dark theme"
    >
        <x-icons.moon class="text-lg sm:text-xl" />
    </button>

    <!-- System Mode -->
    <button
        type="button"
        id="theme-system"
        title="Current:system"
        class="hidden w-9 h-9 sm:w-10 sm:h-10 items-center justify-center rounded-lg transition-all whitespace-nowrap cursor-pointer text-gray-700  dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800"
        aria-label="Use system theme"
    >
        <x-icons.computer class="text-lg sm:text-xl" />
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;

    const setTheme = (theme) => {
        if (theme === 'dark') {
            html.classList.add('dark');
            localStorage.theme = 'dark';
        } else if (theme === 'light') {
            html.classList.remove('dark');
            localStorage.theme = 'light';
        } else { // system
            localStorage.removeItem('theme');
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        }
    };


    // Get Buttons
    const lightBtn = document.getElementById('theme-light');
    const darkBtn = document.getElementById('theme-dark');
    const systemBtn = document.getElementById('theme-system');

    // Initial load
    if (localStorage.theme === 'dark') {
        html.classList.add('dark');
        lightBtn.classList.remove('flex');
        lightBtn.classList.add('hidden');
        systemBtn.classList.remove('flex');
        systemBtn.classList.add('hidden');
        darkBtn.classList.remove('hidden');
        darkBtn.classList.add('flex');
    } else if (localStorage.theme === 'light') {
        html.classList.remove('dark');
        lightBtn.classList.remove('hidden');
        lightBtn.classList.add('flex');
        systemBtn.classList.remove('flex');
        systemBtn.classList.add('hidden');
        darkBtn.classList.remove('flex');
        darkBtn.classList.add('add');
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        html.classList.add('dark');
        lightBtn.classList.remove('flex');
        lightBtn.classList.add('hidden');
        systemBtn.classList.remove('hidden');
        systemBtn.classList.add('flex');
        darkBtn.classList.remove('flex');
        darkBtn.classList.add('hidden');
    }

    // Button listeners
    lightBtn?.addEventListener('click', () => {setTheme('dark'); lightBtn.classList.remove('flex'); lightBtn.classList.add('hidden'); darkBtn.classList.remove('hidden'); darkBtn.classList.add('flex'); systemBtn.classList.remove('flex'); systemBtn.classList.add('hidden');});
    darkBtn?.addEventListener('click', () => {setTheme('system'); lightBtn.classList.remove('flex'); lightBtn.classList.add('hidden'); darkBtn.classList.remove('flex'); darkBtn.classList.add('hidden'); systemBtn.classList.remove('hidden'); systemBtn.classList.add('flex');});
    systemBtn?.addEventListener('click', () => {setTheme('light'); lightBtn.classList.remove('hidden'); lightBtn.classList.add('flex'); darkBtn.classList.remove('flex'); darkBtn.classList.add('hidden'); systemBtn.classList.remove('flex'); systemBtn.classList.add('hidden');});

    // Listen for system changes when in "system" mode
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!('theme' in localStorage)) {
            e.matches ? html.classList.add('dark') : html.classList.remove('dark');
        }
    });
});
</script>