<div class="fixed right-6 bottom-6 z-50 flex flex-col space-y-4">
    <!-- WhatsApp Button -->
    <a href="https://wa.me/1234567890" target="_blank" class="w-12 h-12 bg-green-500 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-green-600 transition transform hover:scale-110" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>
    
    <!-- Email/Contact Button -->
    <a href="mailto:info@thepulseandco.com" class="w-12 h-12 bg-blue-800 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-blue-700 transition transform hover:scale-110" aria-label="Send us an email">
        <i class="fas fa-envelope text-xl"></i>
    </a>
    
    <!-- Back to Top Button -->
    <button id="backToTop" class="w-12 h-12 bg-gray-700 dark:bg-gray-600 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-gray-600 dark:hover:bg-gray-500 transition transform hover:scale-110 opacity-0 invisible transition-all duration-300" aria-label="Go to top">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>
</div>

<script>
    // Back to Top Button
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible');
            backToTopButton.classList.add('opacity-100', 'visible');
        } else {
            backToTopButton.classList.remove('opacity-100', 'visible');
            backToTopButton.classList.add('opacity-0', 'invisible');
        }
    });
    
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>