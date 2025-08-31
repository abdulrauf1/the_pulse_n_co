<nav class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{asset('images/logoLight.png')}}" class="block dark:hidden h-20 me-3" alt="The Pulse & CO" />
                    <img src="{{asset('images/logo.png')}}" class="hidden dark:block h-20 me-3" alt="The Pulse & CO" />                        
                    <!-- <span class="text-rose-400 text-2xl font-bold">The Pulse & Co</span> -->
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 px-3 py-2 text-sm font-medium transition-colors duration-200">Home</a>
                <a href="{{ route('shop') }}" class="text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 px-3 py-2 text-sm font-medium transition-colors duration-200">Shop</a>
                <a href="{{ route('categories') }}" class="text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 px-3 py-2 text-sm font-medium transition-colors duration-200">Categories</a>
                <a href="{{ route('about') }}" class="text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 px-3 py-2 text-sm font-medium transition-colors duration-200">About Us</a>
                <a href="{{ route('contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 px-3 py-2 text-sm font-medium transition-colors duration-200">Contact</a>
                
                
                
                <div class="flex items-center space-x-4">
                    <!-- Dark Mode Toggle - Fixed visibility -->
                    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2.5 transition-colors duration-200">
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                            

                    <!-- In your partials/navigation.blade.php -->
                    <a href="#" id="cart-btn" class="relative p-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span id="cart-count" class="cart-count hidden">0</span>
                    </a>
                    
                </div>
                
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-gray-300 hover:text-rose-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors duration-200">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 transition-colors duration-200">Home</a>
            <a href="{{ route('shop') }}" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 transition-colors duration-200">Shop</a>
            <a href="{{ route('categories') }}" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 transition-colors duration-200">Categories</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 transition-colors duration-200">About Us</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 transition-colors duration-200">Contact</a>
            <a href="{{ route('cart') }}" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 transition-colors duration-200">Cart</a>
            
            <button id="mobile-theme-toggle" type="button" class="w-full text-left px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-rose-400 dark:hover:text-rose-400 transition-colors duration-200 flex items-center">
                <svg id="mobile-theme-toggle-dark-icon" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="mobile-theme-toggle-light-icon" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
                <span id="mobile-theme-toggle-text">Toggle Theme</span>
            </button>            
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Theme handling
    const setInitialIcons = () => {
        const isDark = document.documentElement.classList.contains('dark');
        
        // Desktop icons
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');
        if (darkIcon && lightIcon) {
            darkIcon.classList.toggle('hidden', !isDark);
            lightIcon.classList.toggle('hidden', isDark);
        }
        
        // Mobile icons
        const mobileDarkIcon = document.getElementById('mobile-theme-toggle-dark-icon');
        const mobileLightIcon = document.getElementById('mobile-theme-toggle-light-icon');
        const mobileText = document.getElementById('mobile-theme-toggle-text');
        if (mobileDarkIcon && mobileLightIcon && mobileText) {
            mobileDarkIcon.classList.toggle('hidden', !isDark);
            mobileLightIcon.classList.toggle('hidden', isDark);
            mobileText.textContent = isDark ? 'Light Mode' : 'Dark Mode';
        }
    };

    // Set initial theme and icons
    function setTheme(isDark) {
        const html = document.documentElement;
        if (isDark) {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
        setInitialIcons();
    }

    // Toggle theme
    function toggleTheme() {
        const isDark = document.documentElement.classList.contains('dark');
        setTheme(!isDark);
    }

    // Initialize theme
    function initTheme() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            setTheme(true);
        } else {
            setTheme(false);
        }
    }

    // Set up event listeners
    document.getElementById('theme-toggle')?.addEventListener('click', toggleTheme);
    document.getElementById('mobile-theme-toggle')?.addEventListener('click', toggleTheme);

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
        initTheme();
        setInitialIcons(); // Ensure icons are properly set on load
    });

    // Watch for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('theme')) {
            setTheme(e.matches);
        }
    });
</script>