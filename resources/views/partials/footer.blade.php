<footer class="bg-gray-800 dark:bg-gray-900 text-white pt-12 pb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-rose-400 text-lg font-semibold mb-4">The Pulse & Co</h3>
                <p class="text-gray-300 dark:text-gray-400 mb-4">Crafting timeless watches with precision and passion since 2010.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">Home</a></li>
                    <li><a href="{{ route('shop') }}" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">Shop</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">Contact</a></li>
                    <li><a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">Blog</a></li>
                </ul>
            </div>
            
            <!-- Customer Service -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Customer Service</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">FAQs</a></li>
                    <li><a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">Shipping Policy</a></li>
                    <li><a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">Returns & Exchanges</a></li>
                    <li><a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">Warranty</a></li>
                    <li><a href="#" class="text-gray-300 dark:text-gray-400 hover:text-rose-400">Privacy Policy</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                <address class="not-italic text-gray-300 dark:text-gray-400">
                    <div class="flex items-start mb-2">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-rose-400"></i>
                        <span>123 Watch Street, Horology District, Geneva, Switzerland</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <i class="fas fa-phone-alt mr-3 text-rose-400"></i>
                        <span>+41 22 123 4567</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-rose-400"></i>
                        <span>info@thepulseandco.com</span>
                    </div>
                </address>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; {{ date('Y') }} The Pulse & Co. All rights reserved.</p>
            
        </div>
    </div>
</footer>