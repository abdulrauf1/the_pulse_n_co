<x-public-layout>
    <!-- Hero Section -->
    <section class="relative bg-gray-100 dark:bg-gray-800 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                Watch Categories
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Explore our exquisite collections of timeless timepieces
            </p>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 sm:mb-8">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4 sm:mb-0">Our Collections</h2>
                
                <!-- Search -->
                <div class="relative w-full sm:w-64">
                    <input type="text" placeholder="Search categories..." class="w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Categories Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                <div class="group relative block overflow-hidden rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <div class="aspect-w-3 aspect-h-2">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-64 sm:h-72 object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">No image</span>
                            </div>
                        @endif
                        
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-bold text-white">{{ $category->name }}</h3>
                        <p class="mt-1 text-sm text-gray-300">{{ $category->description ?? 'Explore our collection' }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <a href="{{ route('shop.category', $category->slug) }}" class="inline-flex items-center text-sm font-medium text-white group-hover:text-blue-300 transition">
                                View Collection
                                <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <span class="bg-white/20 text-white text-xs font-medium px-2.5 py-0.5 rounded-full backdrop-blur-sm">
                                {{ $category->products_count }} models
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 dark:text-gray-400">No categories found.</p>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination (if needed) -->
            @if($categories->hasPages())
            <nav class="mt-10 flex items-center justify-between border-t border-gray-200 dark:border-gray-700 px-4 sm:px-0">
                <div class="-mt-px w-0 flex-1 flex">
                    @if($categories->onFirstPage())
                    <span class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-400">
                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Previous
                    </span>
                    @else
                    <a href="{{ $categories->previousPageUrl() }}" class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Previous
                    </a>
                    @endif
                </div>
                <div class="hidden md:-mt-px md:flex">
                    @foreach(range(1, $categories->lastPage()) as $page)
                        @if($page == $categories->currentPage())
                        <span class="border-blue-800 text-blue-800 dark:text-blue-500 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">{{ $page }}</span>
                        @else
                        <a href="{{ $categories->url($page) }}" class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>
                <div class="-mt-px w-0 flex-1 flex justify-end">
                    @if($categories->hasMorePages())
                    <a href="{{ $categories->nextPageUrl() }}" class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        Next
                        <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    @else
                    <span class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-400">
                        Next
                        <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    @endif
                </div>
            </nav>
            @endif
        </div>
    </section>

    <!-- Featured Collections -->
    <section class="py-12 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-6 sm:mb-8">Featured Collections</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach([
                    [
                        'name' => 'New Arrivals',
                        'desc' => 'Discover our latest additions',
                        'image' => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80'
                    ],
                    [
                        'name' => 'Limited Editions',
                        'desc' => 'Exclusive numbered pieces',
                        'image' => 'https://images.unsplash.com/photo-1542496658-e33a6d0d50f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'
                    ]
                ] as $collection)
                <div class="relative rounded-xl shadow-md overflow-hidden group h-64 sm:h-80">
                    <img src="{{ $collection['image'] }}" alt="{{ $collection['name'] }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-900/60 via-gray-900/30 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center p-6 sm:p-8">
                        <div>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white">{{ $collection['name'] }}</h3>
                            <p class="mt-2 text-gray-300">{{ $collection['desc'] }}</p>
                            <a href="#" class="mt-4 inline-flex items-center px-4 py-2 bg-white/10 text-white rounded-md hover:bg-white/20 backdrop-blur-sm transition border border-white/20">
                                Explore Now
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
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

    <!-- Newsletter -->
    <section class="bg-blue-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold">Join Our Community</h2>
                    <p class="mt-2 opacity-90">Subscribe for exclusive access to new collections and special offers.</p>
                </div>
                <div class="md:w-1/2">
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
        // Enhanced search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[type="text"]');
            const categoryCards = document.querySelectorAll('.group.relative.block');
            
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    
                    categoryCards.forEach(card => {
                        const title = card.querySelector('h3').textContent.toLowerCase();
                        const description = card.querySelector('p').textContent.toLowerCase();
                        
                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = 'block';
                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            }, 50);
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            }
        });
    </script>
    @endpush
</x-public-layout>