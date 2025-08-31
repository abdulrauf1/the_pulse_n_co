<x-public-layout>
    <!-- Breadcrumb -->
    <nav class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Home</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('categories') }}" class="ml-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Categories</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 text-gray-500 dark:text-gray-400">{{ $category->name }}</span>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Category Header -->
    <section class="relative py-8 md:py-12 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex-1">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">{{ $category->name }}</h1>
                    <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">{{ $category->description ?? 'Explore our collection of premium timepieces' }}</p>
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">{{ $products->total() }} {{ $products->total() == 1 ? 'product' : 'products' }} available</p>
                </div>
                <div class="w-full md:w-auto">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full md:w-64 h-48 object-cover rounded-lg shadow-md">
                    @else
                        <div class="w-full md:w-64 h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-lg">
                            <span class="text-gray-500 dark:text-gray-400">No image</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-8 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 sm:mb-0">{{ $category->name }} Collection</h2>
                
                <!-- Sort and Filter Options -->
                <div class="flex flex-wrap gap-3">
                    <select class="px-3 py-2 text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Sort by: Newest</option>
                        <option>Sort by: Price: Low to High</option>
                        <option>Sort by: Price: High to Low</option>
                        <option>Sort by: Name</option>
                    </select>
                    
                    <button class="px-3 py-2 text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center">
                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filter
                    </button>
                </div>
            </div>
            
            <!-- Products Grid -->
            @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition duration-300">
                    <div class="relative overflow-hidden">
                        @php
                            $firstImage = null;
                            if ($product->images) {
                                $images = is_array($product->images) 
                                    ? $product->images 
                                    : json_decode($product->images, true);
                                $firstImage = $images[0] ?? null;
                            }
                        @endphp
                        
                        @if($firstImage)
                            <img src="{{ asset('storage/' . $firstImage) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-56 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">No image</span>
                            </div>
                        @endif
                        
                        <!-- Promotional badge -->
                        @if($product->has_active_promotion)
                            <div class="absolute top-2 right-2">
                                <span class="bg-rose-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Sale
                                </span>
                            </div>
                        @endif
                        
                        <!-- Quick actions -->
                        <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <button class="bg-white text-gray-900 rounded-full p-2 shadow-md mx-1 hover:bg-gray-100 transition">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                            <a href="{{ route('products.show', $product->slug) }}" class="bg-white text-gray-900 rounded-full p-2 shadow-md mx-1 hover:bg-gray-100 transition">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $product->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300 truncate">{{ $product->short_description ?? 'Premium quality timepiece' }}</p>
                        
                        <div class="mt-3 flex items-center justify-between">
                            <div>
                                @if($product->has_active_promotion)
                                    <div class="flex items-center">
                                        <span class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($product->discounted_price, 2) }}</span>
                                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 line-through">${{ number_format($product->price, 2) }}</span>
                                    </div>
                                @else
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            
                            
                        </div>
                        
                        <a href="{{ route('products.show', $product->slug) }}" class="mt-4 block text-center bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-white py-2 rounded-md text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-500 transition">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No products found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">There are currently no products in this category.</p>
                <div class="mt-6">
                    <a href="{{ route('categories') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Browse Other Categories
                    </a>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Related Categories -->
    @if($relatedCategories->count() > 0)
    <section class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">You Might Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedCategories as $relatedCategory)
                <div class="group relative block overflow-hidden rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <div class="aspect-w-3 aspect-h-2">
                        <img src="{{ $relatedCategory->image ? asset('storage/' . $relatedCategory->image) : 'https://images.unsplash.com/photo-1548179905-03c708a6ffe9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" 
                             alt="{{ $relatedCategory->name }}" 
                             class="w-full h-48 object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-4">
                        <h3 class="text-lg font-bold text-white">{{ $relatedCategory->name }}</h3>
                        <p class="mt-1 text-sm text-gray-300">{{ $relatedCategory->products_count ?? 0 }} {{ ($relatedCategory->products_count ?? 0) == 1 ? 'model' : 'models' }}</p>
                        <div class="mt-4">
                            <a href="{{ route('categories.show', $relatedCategory->slug) }}" class="inline-flex items-center text-sm font-medium text-white group-hover:text-blue-300 transition">
                                View Collection
                                <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Newsletter -->
    <section class="bg-blue-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold">Never Miss New Arrivals</h2>
                    <p class="mt-2 opacity-90">Subscribe to get notified about new products in this category.</p>
                </div>
                <div class="md+w-1/2">
                    <form class="flex flex-col sm:flex-row gap-3">
                        <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="px-6 py-3 bg-rose-500 text-white font-medium rounded-md hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition">
                            Subscribe
                        </button>
                    </form>
                    <p class="mt-2 text-sm opacity-80">We respect your privacy. Unsubscribe at any time.</p>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Add to cart functionality
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-product-id');
                    const productName = this.getAttribute('data-product-name');
                    
                    // Here you would typically make an AJAX request to add to cart
                    // For now, we'll just show the notification
                    
                    showNotification(`${productName} added to cart!`);
                });
            });
            
            function showNotification(message) {
                // Show notification
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg z-50 transition transform -translate-y-2 opacity-0';
                notification.innerHTML = `
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        ${message}
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                // Animate in
                setTimeout(() => {
                    notification.classList.remove('-translate-y-2', 'opacity-0');
                    notification.classList.add('translate-y-0', 'opacity-100');
                }, 10);
                
                // Animate out and remove after 3 seconds
                setTimeout(() => {
                    notification.classList.remove('translate-y-0', 'opacity-100');
                    notification.classList.add('-translate-y-2', 'opacity-0');
                    
                    setTimeout(() => {
                        if (document.body.contains(notification)) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }, 3000);
            }
        });
    </script>
    @endpush
</x-public-layout>