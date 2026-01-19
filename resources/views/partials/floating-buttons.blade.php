<div class="fixed right-6 bottom-6 z-50 flex flex-col space-y-4">
    <!-- WhatsApp Button -->
    <a href="https://wa.me/923104973013" target="_blank"
       class="w-12 h-12 bg-green-500 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-green-600 transition transform hover:scale-110"
       aria-label="Chat on WhatsApp">

        <!-- WhatsApp SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current"
             viewBox="0 0 24 24">
            <path d="M20.52 3.48A11.9 11.9 0 0 0 12.06 0C5.5 0 .18 5.32.18 11.88c0 2.1.55 4.15 1.6 5.96L0 24l6.33-1.66a11.8 11.8 0 0 0 5.73 1.46h.01c6.56 0 11.88-5.32 11.88-11.88 0-3.17-1.24-6.15-3.43-8.34ZM12.07 21.6h-.01a9.7 9.7 0 0 1-4.94-1.36l-.35-.2-3.75.98 1-3.65-.23-.38a9.7 9.7 0 1 1 8.28 4.61Zm5.62-7.7c-.3-.15-1.78-.88-2.06-.98-.28-.1-.48-.15-.68.15-.2.3-.78.98-.96 1.18-.18.2-.35.23-.65.08-.3-.15-1.26-.46-2.4-1.48-.89-.8-1.5-1.78-1.68-2.08-.18-.3-.02-.46.13-.61.13-.13.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.03-.53-.08-.15-.68-1.65-.93-2.26-.24-.58-.49-.5-.68-.51h-.58c-.2 0-.53.08-.8.38-.28.3-1.05 1.03-1.05 2.5s1.08 2.9 1.23 3.1c.15.2 2.12 3.24 5.13 4.55.72.31 1.28.5 1.72.64.72.23 1.37.2 1.89.12.58-.09 1.78-.73 2.03-1.43.25-.7.25-1.3.18-1.43-.08-.13-.28-.2-.58-.35Z"/>
        </svg>
    </a>

    <!-- Email Button -->
    <a href="mailto:thepulseandco.pk@gmail.com"
       class="w-12 h-12 bg-blue-800 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-blue-700 transition transform hover:scale-110"
       aria-label="Send us an email">

        <!-- Mail SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current"
             viewBox="0 0 24 24">
            <path d="M2 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H2Zm0 2 10 6 10-6v2l-10 6L2 8V6Z"/>
        </svg>
    </a>

    <!-- Back to Top Button -->
    <button id="backToTop"
            class="w-12 h-12 bg-gray-700 dark:bg-gray-600 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-gray-600 dark:hover:bg-gray-500 transform hover:scale-110 opacity-0 invisible transition-all duration-300"
            aria-label="Go to top">

        <!-- Arrow Up SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current"
             viewBox="0 0 24 24">
            <path d="M12 4l-8 8h5v8h6v-8h5z"/>
        </svg>
    </button>
</div>

<script>
    const backToTopButton = document.getElementById('backToTop');

    window.addEventListener('scroll', function () {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible');
            backToTopButton.classList.add('opacity-100', 'visible');
        } else {
            backToTopButton.classList.remove('opacity-100', 'visible');
            backToTopButton.classList.add('opacity-0', 'invisible');
        }
    });

    backToTopButton.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
