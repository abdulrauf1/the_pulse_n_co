<x-public-layout>
    <!-- Hero Section -->
    <section class="relative bg-gray-100 dark:bg-gray-800 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl sm:tracking-tight lg:text-6xl">
                Our Watch Collection
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Discover the perfect timepiece that matches your style and personality.
            </p>
        </div>
    </section>

    <!-- Shop Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">All Watches</h2>
                
                <div class="mt-4 lg:mt-0 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Sort Dropdown -->
                    <div class="relative">
                        <button id="sortDropdownButton" data-dropdown-toggle="sortDropdown" class="flex items-center justify-between w-full sm:w-48 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" type="button">
                            Sort by: {{ ucfirst(str_replace('_', ' ', request('sort', 'latest'))) }}
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div id="sortDropdown" class="hidden z-10 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg">
                            <ul class="py-1" aria-labelledby="sortDropdownButton">
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Latest</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_low_high']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Price: Low to High</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_high_low']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Price: High to Low</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Name: A-Z</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Name: Z-A</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Most Popular</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Filter Button (Mobile) -->
                    <button id="mobileFilterButton" class="lg:hidden flex items-center justify-center w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-filter mr-2"></i>
                        Filters
                    </button>
                </div>
            </div>
            
            <div class="lg:flex">
                <!-- Filters Sidebar (Mobile) -->
                <div id="mobileFilters" class="lg:hidden fixed inset-0 z-40 overflow-y-auto transform translate-x-full transition-transform duration-300 ease-in-out bg-white dark:bg-gray-800 p-4">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Filters</h3>
                        <button id="closeMobileFilters" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <form id="mobileFilterForm" method="GET" action="{{ route('shop') }}">
                        <div class="space-y-6">
                            <!-- Price Range -->
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Price Range</h4>
                                <div class="flex items-center justify-between space-x-4">
                                    <div class="flex-1">
                                        <label for="minPrice" class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Min</label>
                                        <input type="number" name="min_price" id="minPrice" min="0" max="{{ $priceRange['max'] }}" value="{{ request('min_price') }}" placeholder="PKR {{ $priceRange['min'] }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="flex-1">
                                        <label for="maxPrice" class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Max</label>
                                        <input type="number" name="max_price" id="maxPrice" min="0" max="{{ $priceRange['max'] }}" value="{{ request('max_price') }}" placeholder="PKR {{ $priceRange['max'] }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Categories -->
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Categories</h4>
                                <div class="space-y-2">
                                    @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input id="filter-category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" type="checkbox" {{ in_array($category->id, (array)request('categories', [])) ? 'checked' : '' }} class="h-4 w-4 text-blue-800 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                                        <label for="filter-category-{{ $category->id }}" class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Brands -->
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Brands</h4>
                                <div class="space-y-2">
                                    @foreach($brands as $brand)
                                    <div class="flex items-center">
                                        <input id="filter-brand-{{ $brand->id }}" name="brands[]" value="{{ $brand->id }}" type="checkbox" {{ in_array($brand->id, (array)request('brands', [])) ? 'checked' : '' }} class="h-4 w-4 text-blue-800 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                                        <label for="filter-brand-{{ $brand->id }}" class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{ $brand->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('shop') }}" class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 text-center">Reset</a>
                            <button type="submit" class="flex-1 px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Apply Filters</button>
                        </div>
                    </form>
                </div>
                
                <!-- Filters Sidebar (Desktop) -->
                <div class="hidden lg:block lg:w-1/4 lg:pr-8">
                    <form method="GET" action="{{ route('shop') }}">
                        <div class="space-y-6">
                            <!-- Price Range -->
                            <div>
                                <h3 class="font-medium text-gray-900 dark:text-white mb-2">Price Range</h3>
                                <div class="flex items-center justify-between space-x-4">
                                    <div class="flex-1">
                                        <label for="minPriceDesktop" class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Min</label>
                                        <input type="number" name="min_price" id="minPriceDesktop" min="0" max="{{ $priceRange['max'] }}" value="{{ request('min_price') }}" placeholder="PKR {{ $priceRange['min'] }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="flex-1">
                                        <label for="maxPriceDesktop" class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Max</label>
                                        <input type="number" name="max_price" id="maxPriceDesktop" min="0" max="{{ $priceRange['max'] }}" value="{{ request('max_price') }}" placeholder="PKR {{ $priceRange['max'] }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Categories -->
                            <div>
                                <h3 class="font-medium text-gray-900 dark:text-white mb-2">Categories</h3>
                                <div class="space-y-2">
                                    @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input id="filter-category-desktop-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" type="checkbox" {{ in_array($category->id, (array)request('categories', [])) ? 'checked' : '' }} class="h-4 w-4 text-blue-800 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                                        <label for="filter-category-desktop-{{ $category->id }}" class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Brands -->
                            <div>
                                <h3 class="font-medium text-gray-900 dark:text-white mb-2">Brands</h3>
                                <div class="space-y-2">
                                    @foreach($brands as $brand)
                                    <div class="flex items-center">
                                        <input id="filter-brand-desktop-{{ $brand->id }}" name="brands[]" value="{{ $brand->id }}" type="checkbox" {{ in_array($brand->id, (array)request('brands', [])) ? 'checked' : '' }} class="h-4 w-4 text-blue-800 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                                        <label for="filter-brand-desktop-{{ $brand->id }}" class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{ $brand->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="pt-4">
                                <button type="submit" class="w-full px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Apply Filters</button>
                                <a href="{{ route('shop') }}" class="w-full mt-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 inline-block text-center">Reset All</a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Product Grid -->
                <div class="lg:w-3/4">
                    @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="relative">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    @if($product->images)
                                        @php 
                                            $firstImage = is_array($product->images) 
                                                ? ($product->images[0] ?? null) 
                                                : (json_decode($product->images, true)[0] ?? null); 
                                        @endphp
                                        @if($firstImage)
                                        <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                                        @else
                                        <div class="w-full h-64 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                            <span class="text-gray-500 dark:text-gray-400">No image</span>
                                        </div>
                                        @endif
                                    @else
                                    <div class="w-full h-64 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                        <span class="text-gray-500 dark:text-gray-400">No image</span>
                                    </div>
                                    @endif
                                </a>
                                @if($product->promotions->count() > 0)
                                <span class="absolute top-2 right-2 bg-rose-400 text-white text-xs font-bold px-2 py-1 rounded">Sale</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <a href="{{ route('products.show', $product->slug) }}" class="block">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        {{ $product->categories->pluck('name')->implode(', ') }}
                                    </p>
                                    
                                    @php
                                        $finalPrice = $product->price;
                                        $hasPromotion = false;
                                        if ($product->promotions->count() > 0) {
                                            $promotion = $product->promotions->first();
                                            if ($promotion->discount_type === 'percentage') {
                                                $discount = ($product->price * $promotion->discount_value) / 100;
                                                $finalPrice = $product->price - $discount;
                                            } else {
                                                $finalPrice = $product->price - $promotion->discount_value;
                                            }
                                            $hasPromotion = true;
                                        }
                                    @endphp
                                    
                                    <div class="mt-2">
                                        <p class="text-rose-400 font-bold">PKR {{ number_format($finalPrice, 2) }}</p>
                                        @if($hasPromotion)
                                        <p class="text-sm text-gray-500 dark:text-gray-400 line-through">PKR {{ number_format($product->price, 2) }}</p>
                                        @endif
                                    </div>
                                </a>
                                <button class="add-to-cart mt-4 w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-700 transition" 
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $finalPrice }}"
                                        data-image="{{ $product->images ? asset('storage/' . (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0])) : '' }}">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <nav class="mt-12 flex items-center justify-between border-t border-gray-200 dark:border-gray-700 px-4 sm:px-0">
                        <div class="-mt-px w-0 flex-1 flex">
                            @if($products->onFirstPage())
                            <span class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-300">
                                <svg class="mr-3 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Previous
                            </span>
                            @else
                            <a href="{{ $products->previousPageUrl() }}" class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Previous
                            </a>
                            @endif
                        </div>
                        
                        <div class="hidden md:-mt-px md:flex">
                            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if($page == $products->currentPage())
                                <span class="border-blue-800 text-blue-800 dark:text-blue-500 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">{{ $page }}</span>
                                @else
                                <a href="{{ $url }}" class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">{{ $page }}</a>
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="-mt-px w-0 flex-1 flex justify-end">
                            @if($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                Next
                                <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            @else
                            <span class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-300">
                                Next
                                <svg class="ml-3 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            @endif
                        </div>
                    </nav>
                    @else
                    <div class="text-center py-12">
                        <div class="text-gray-400 dark:text-gray-500 text-6xl mb-4">🔍</div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No products found</h3>
                        <p class="text-gray-500 dark:text-gray-400">Try adjusting your filters to find what you're looking for.</p>
                        <a href="{{ route('shop') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-700">
                            Clear Filters
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Mobile filters toggle
        const mobileFilterButton = document.getElementById('mobileFilterButton');
        const mobileFilters = document.getElementById('mobileFilters');
        const closeMobileFilters = document.getElementById('closeMobileFilters');
        
        if (mobileFilterButton && mobileFilters) {
            mobileFilterButton.addEventListener('click', () => {
                mobileFilters.classList.remove('translate-x-full');
                mobileFilters.classList.add('translate-x-0');
                document.body.style.overflow = 'hidden';
            });
            
            closeMobileFilters.addEventListener('click', () => {
                mobileFilters.classList.remove('translate-x-0');
                mobileFilters.classList.add('translate-x-full');
                document.body.style.overflow = '';
            });
        }
        
        // Initialize dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            // Sort dropdown
            const sortDropdownButton = document.getElementById('sortDropdownButton');
            const sortDropdown = document.getElementById('sortDropdown');
            
            if (sortDropdownButton && sortDropdown) {
                sortDropdownButton.addEventListener('click', function() {
                    sortDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!sortDropdownButton.contains(event.target) && !sortDropdown.contains(event.target)) {
                        sortDropdown.classList.add('hidden');
                    }
                });
            }
            
            // Initialize cart functionality
            initializeCartFunctionality();
        });

        // Initialize cart functionality for all products
        function initializeCartFunctionality() {
            // Add to cart buttons
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    addToCart(this);
                });
            });
        }

        // Add to cart function
        function addToCart(button) {
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const productPrice = parseFloat(button.getAttribute('data-price'));
            const productImage = button.getAttribute('data-image');
            const quantity = 1;
            
            // Validate data
            if (!productId || !productName || !productPrice) {
                showToast('Product information is missing', 'error');
                return;
            }
            
            // Get current cart from localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            // Check if product already exists in cart
            const existingItemIndex = cart.findIndex(item => item.id === productId);
            
            if (existingItemIndex > -1) {
                // Update quantity if product exists
                cart[existingItemIndex].quantity += quantity;
            } else {
                // Add new product to cart
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: quantity,
                    image: productImage
                });
            }
            
            // Save updated cart to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Update cart count
            updateCartCount();
            
            // Show success message
            showToast(`PKR {quantity} PKR {productName} added to cart!`);
        }

        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                cartCount.textContent = totalItems;
                cartCount.classList.toggle('hidden', totalItems === 0);
            }
        }

        function showToast(message, type = 'success') {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-4 py-2 rounded-md shadow-lg z-50 transform transition-transform duration-300 translate-y-0 PKR {
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            toast.textContent = message;
            
            // Add toast to document
            document.body.appendChild(toast);
            
            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-y-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Initialize cart count on page load
        updateCartCount();
    </script>
    @endpush
</x-public-layout>