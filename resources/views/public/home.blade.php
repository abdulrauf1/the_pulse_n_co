<x-public-layout>
    <!-- Sales Bar Carousel -->
    @if($promotions->count() > 0)
    <div class="bg-rose-500 text-white py-2 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="salesBarCarousel" class="relative" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-6 overflow-hidden">
                    <!-- Items -->
                    @foreach($promotions as $promotion)
                    <div class="hidden duration-1000 ease-in-out text-center font-medium" data-carousel-item>
                        <span class="inline-block animate-pulse">
                            {{ $promotion->name }} - 
                            @if($promotion->discount_type === 'percentage')
                                {{ $promotion->discount_value }}% OFF
                            @else
                                ${{ $promotion->discount_value }} OFF
                            @endif
                            @if($promotion->promo_code)
                                | Use code: {{ $promotion->promo_code }}
                            @endif
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Hero Section -->
    <section class="relative bg-gray-100 dark:bg-gray-800 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-gray-100 dark:bg-gray-800 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <div class="pt-10 sm:pt-16 lg:pt-8 lg:pb-14 lg:overflow-hidden">
                    <div class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                                <span class="block">Timeless Elegance</span>
                                <span class="block text-rose-400">With The Pulse & Co</span>
                            </h1>
                            <p class="mt-3 text-base text-gray-500 dark:text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Discover our exquisite collection of luxury watches that combine precision engineering with timeless design.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="{{ route('shop') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-800 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                                        Shop Now
                                    </a>
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <a href="{{ route('about') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-800 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 md:py-4 md:text-lg md:px-10">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($carousels->count() > 0)
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <div id="heroCarousel" class="relative h-full w-full" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full overflow-hidden">
                    @foreach($carousels as $index => $carousel)
                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                        <img class="w-full h-full object-cover transform transition-transform duration-10000 ease-linear hover:scale-110" 
                             src="{{ asset('storage/' . $carousel->image_path) }}" 
                             alt="{{ $carousel->title ?? 'Luxury Watch' }}">
                    </div>
                    @endforeach
                </div>
                <!-- Slider indicators -->
                @if($carousels->count() > 1)
                <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                    @foreach($carousels as $index => $carousel)
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                            aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endif
    </section>

    <!-- New Arrivals Carousel -->
    @if($newArrivals->count() > 0)
    <section class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">New Arrivals</h2>
                <a href="{{ route('shop') }}" class="text-rose-400 hover:text-rose-500 font-medium hidden lg:block">View All</a>
            </div>
            
            <!-- Horizontal scroll container -->
            <div class="overflow-x-auto pb-4">
                <div class="flex space-x-6 min-w-max">
                    @foreach($newArrivals as $product)
                    <div class="w-72 flex-shrink-0 bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Product Image -->
                        @if($product->images)
                            @php 
                                $firstImage = is_array($product->images) 
                                    ? ($product->images[0] ?? null) 
                                    : (json_decode($product->images, true)[0] ?? null); 
                            @endphp
                            @if($firstImage)
                            <img src="{{ asset('storage/' . $firstImage) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-48 object-cover">
                            @else
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">No image</span>
                            </div>
                            @endif
                        @else
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-500 dark:text-gray-400">No image</span>
                        </div>
                        @endif
                        
                        <!-- Product Details -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            
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
                            
                            <div class="flex items-center mt-2">
                                @if($hasPromotion)
                                    <p class="text-rose-400 font-bold text-lg">${{ number_format($finalPrice, 2) }}</p>
                                    <p class="text-gray-500 dark:text-gray-400 line-through text-sm ml-2">${{ number_format($product->price, 2) }}</p>
                                @else
                                    <p class="text-rose-400 font-bold text-lg">${{ number_format($product->price, 2) }}</p>
                                @endif
                            </div>
                            
                            <!-- Fixed Add to Cart button -->
                            <button class="add-to-cart mt-4 w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-700 transition-colors duration-200 font-medium" 
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $finalPrice }}">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- View All button -->
            <div class="mt-8 text-center">
                <a href="{{ route('shop') }}" class="inline-block bg-rose-400 text-white px-6 py-3 rounded-lg hover:bg-rose-500 transition-colors font-medium">
                    View All New Arrivals
                </a>
            </div>
        </div>
    </section>
    @endif

    
    <!-- Categories with horizontal scroll -->
    @if($categories->count() > 0)
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">Our Collections</h2>
            
            <!-- Horizontal scroll container -->
            <div class="overflow-x-auto pb-4">
                <div class="flex space-x-6 min-w-max">
                    @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" class="group relative block w-64 flex-shrink-0 overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
                        @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                        @else
                        <img src="https://source.unsplash.com/random/300x300/?watch,{{ strtolower($category->name) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-white text-xl font-bold text-center px-4">{{ $category->name }}</h3>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            
            <!-- View All Categories button -->
            <div class="text-center mt-8">
                <a href="{{ route('categories') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-700 transition-colors duration-200">
                    View All Categories
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Featured Products -->
    @if($featuredProducts->count() > 0)
    <section class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">Best Sellers</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="relative">
                        @if($product->images)
                            @php 
                                $firstImage = is_array($product->images) 
                                    ? ($product->images[0] ?? null) 
                                    : (json_decode($product->images, true)[0] ?? null); 
                            @endphp
                            @if($firstImage)
                            <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                            @else
                            <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">No image</span>
                            </div>
                            @endif
                        @else
                        <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-500 dark:text-gray-400">No image</span>
                        </div>
                        @endif
                        
                        @if($product->is_bestseller)
                        <span class="absolute top-2 right-2 bg-rose-400 text-white text-xs font-bold px-2 py-1 rounded">Bestseller</span>
                        @endif
                        
                        <!-- Quick action buttons -->
                        <div class="absolute top-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100">
                                ♡
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                            {{ $product->name }}
                        </h3>
                        
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
                        
                        <div class="flex items-center mt-2">
                            @if($hasPromotion)
                                <p class="text-rose-400 font-bold text-lg">${{ number_format($finalPrice, 2) }}</p>
                                <p class="text-gray-500 dark:text-gray-400 line-through text-sm ml-2">${{ number_format($product->price, 2) }}</p>
                            @else
                                <p class="text-rose-400 font-bold text-lg">${{ number_format($product->price, 2) }}</p>
                            @endif
                        </div>
                        
                        <!-- Rating -->
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-400 text-sm">
                                ★★★★★
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">(24)</span>
                        </div>
                        
                        <!-- Fixed Add to Cart button -->
                        <button class="add-to-cart w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-700 transition-colors duration-200 font-medium" 
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $finalPrice }}">
                            Add to Cart
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-700 transition-colors duration-200">
                    View All Products
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials -->
    @if($testimonials->count() > 0)
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">What Our Customers Say</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">"{{ $testimonial->content }}"</p>
                    <div class="flex items-center">
                        @if($testimonial->author_avatar)
                        <img src="{{ asset('storage/' . $testimonial->author_avatar) }}" alt="{{ $testimonial->author_name }}" class="w-10 h-10 rounded-full">
                        @else
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-gray-600 font-bold">{{ substr($testimonial->author_name, 0, 1) }}</span>
                        </div>
                        @endif
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $testimonial->author_name }}</h4>
                            @if($testimonial->author_position || $testimonial->author_company)
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $testimonial->author_position }}
                                @if($testimonial->author_position && $testimonial->author_company)
                                at
                                @endif
                                {{ $testimonial->author_company }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Newsletter -->
    <section class="py-12 bg-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold">Stay Updated</h2>
                    <p class="mt-2 opacity-90">Subscribe to our newsletter for the latest collections, exclusive offers, and style tips.</p>
                </div>
                <div class="md:w-1/2">
                    <form class="flex flex-col sm:flex-row gap-3">
                        <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-400">
                        <button type="submit" class="px-6 py-3 bg-rose-400 text-white font-medium rounded-md hover:bg-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-2 transition">
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
        // Initialize carousels
        document.addEventListener('DOMContentLoaded', function() {
            // Sales Bar Carousel
            const salesBarCarousel = document.getElementById('salesBarCarousel');
            if (salesBarCarousel) {
                new Carousel(salesBarCarousel, {
                    defaultPosition: 0,
                    interval: 3000,
                });
            }
            
            // Hero Carousel with zoom effect
            const heroCarousel = document.getElementById('heroCarousel');
            if (heroCarousel) {
                new Carousel(heroCarousel, {
                    defaultPosition: 0,
                    interval: 5000,
                });
                
                // Add zoom effect to hero carousel images
                const heroImages = document.querySelectorAll('#heroCarousel img');
                heroImages.forEach(img => {
                    // Start zoom animation when image becomes visible
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                img.classList.add('scale-110');
                            } else {
                                img.classList.remove('scale-110');
                            }
                        });
                    });
                    observer.observe(img);
                });
            }
            
            // Debug: Log cart button functionality
            console.log('Cart functionality loaded');
            document.querySelectorAll('.add-to-cart').forEach(button => {
                console.log('Add to cart button found:', button.getAttribute('data-name'));
            });
        });
    </script>
    @endpush
</x-public-layout>