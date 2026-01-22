<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Get saved preference (highest priority)
    let theme = localStorage.getItem('theme');

    // 2. If no saved preference → respect system preference
    if (!theme) {
        theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    // 3. Apply it
    applyTheme(theme);

    // Optional: listen for system changes (nice to have)
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('theme')) {  // only if user didn't override
            applyTheme(e.matches ? 'dark' : 'light');
        }
    });
});

function applyTheme(theme) {
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    // Optional: also save it (in case it was set from system)
    localStorage.setItem('theme', theme);
}
</script>