<x-public-layout>
    <!-- Breadcrumbs -->
    <div class="bg-gray-100 dark:bg-gray-800 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-rose-400 dark:text-gray-400 dark:hover:text-white">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('shop') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-rose-400 md:ml-2 dark:text-gray-400 dark:hover:text-white">Shop</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-rose-400 md:ml-2 dark:text-gray-400">Product Name</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Product Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                <!-- Product Images -->
                <div class="mb-8 lg:mb-0">
                    <div class="mb-4">
                        <img id="mainImage" src="https://images.unsplash.com/photo-1524805444758-089113d48a6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80" alt="Premium Automatic Watch" class="w-full rounded-lg shadow-md">
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        <button class="border rounded-lg overflow-hidden focus:ring-2 focus:ring-rose-400 focus:outline-none">
                            <img src="https://images.unsplash.com/photo-1524805444758-089113d48a6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80" alt="Watch thumbnail 1" class="w-full h-20 object-cover" onclick="document.getElementById('mainImage').src=this.src">
                        </button>
                        <button class="border rounded-lg overflow-hidden focus:ring-2 focus:ring-rose-400 focus:outline-none">
                            <img src="https://images.unsplash.com/photo-1542496658-e33a6d0d50f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Watch thumbnail 2" class="w-full h-20 object-cover" onclick="document.getElementById('mainImage').src=this.src">
                        </button>
                        <button class="border rounded-lg overflow-hidden focus:ring-2 focus:ring-rose-400 focus:outline-none">
                            <img src="https://images.unsplash.com/photo-1523170335258-f5ed11844a49?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1180&q=80" alt="Watch thumbnail 3" class="w-full h-20 object-cover" onclick="document.getElementById('mainImage').src=this.src">
                        </button>
                        <button class="border rounded-lg overflow-hidden focus:ring-2 focus:ring-rose-400 focus:outline-none">
                            <img src="https://images.unsplash.com/photo-1547996160-81dfa63595aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80" alt="Watch thumbnail 4" class="w-full h-20 object-cover" onclick="document.getElementById('mainImage').src=this.src">
                        </button>
                    </div>
                </div>
                
                <!-- Product Details -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Premium Automatic Watch</h1>
                    <div class="flex items-center mb-4">
                        <div class="flex items-center">
                            @foreach(range(1, 5) as $star)
                            <svg class="w-5 h-5 {{ $star <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            @endforeach
                            <span class="text-gray-600 dark:text-gray-400 ml-2">(24 reviews)</span>
                        </div>
                        <span class="mx-4 text-gray-400">|</span>
                        <span class="text-green-500 font-medium">In Stock</span>
                    </div>
                    
                    <p class="text-rose-400 text-2xl font-bold mb-4">$899.00</p>
                    
                    <div class="mb-6">
                        <p class="text-gray-700 dark:text-gray-300 mb-4">The Premium Automatic Watch combines Swiss precision with elegant design, featuring a sapphire crystal face, stainless steel case, and genuine leather strap. Water resistant up to 50 meters.</p>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700 dark:text-gray-300">Automatic self-winding movement</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700 dark:text-gray-300">42mm stainless steel case</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700 dark:text-gray-300">Scratch-resistant sapphire crystal</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700 dark:text-gray-300">50m water resistance</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700 dark:text-gray-300">2-year international warranty</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="strap-color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Strap Color</label>
                        <div class="flex space-x-2">
                            <button class="w-8 h-8 rounded-full bg-brown-600 border-2 border-transparent hover:border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></button>
                            <button class="w-8 h-8 rounded-full bg-black border-2 border-transparent hover:border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></button>
                            <button class="w-8 h-8 rounded-full bg-blue-800 border-2 border-transparent hover:border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></button>
                            <button class="w-8 h-8 rounded-full bg-gray-300 border-2 border-transparent hover:border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></button>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                        <div class="flex">
                            <button class="bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-l-md hover:bg-gray-300 dark:hover:bg-gray-600">-</button>
                            <input type="number" id="quantity" name="quantity" min="1" value="1" class="w-16 text-center border-t border-b border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                            <button class="bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-r-md hover:bg-gray-300 dark:hover:bg-gray-600">+</button>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <button class="flex-1 bg-blue-800 text-white py-3 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                            Add to Cart
                        </button>
                        <button class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-3 px-6 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">
                            Add to Wishlist
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product Tabs -->
            <div class="mt-16">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button id="description-tab" class="border-b-2 border-blue-800 py-4 px-1 text-sm font-medium text-blue-800 dark:text-blue-500">Description</button>
                        <button id="specs-tab" class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-400">Specifications</button>
                        <button id="reviews-tab" class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-400">Reviews</button>
                        <button id="shipping-tab" class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-400">Shipping & Returns</button>
                    </nav>
                </div>
                
                <div class="py-6">
                    <div id="description-content" class="prose dark:prose-invert max-w-none">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Craftsmanship Meets Elegance</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">The Premium Automatic Watch from The Pulse & Co represents the pinnacle of watchmaking artistry. Each timepiece is meticulously assembled by our master watchmakers in Switzerland, ensuring precision and reliability that lasts a lifetime.</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">The watch features a sophisticated automatic movement that harnesses the natural motion of your wrist to power the mechanism, eliminating the need for battery replacements. The exhibition case back allows you to admire the intricate inner workings of this mechanical marvel.</p>
                        <p class="text-gray-700 dark:text-gray-300">The dial is protected by scratch-resistant sapphire crystal, renowned for its durability and clarity. The stainless steel case provides robust protection for the movement while maintaining an elegant profile that transitions seamlessly from boardroom to evening wear.</p>
                    </div>
                    
                    <div id="specs-content" class="hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Technical Specifications</h3>
                                <ul class="space-y-3">
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Movement</span>
                                        <span class="text-gray-900 dark:text-white">Automatic self-winding</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Case Material</span>
                                        <span class="text-gray-900 dark:text-white">Stainless steel 316L</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Case Diameter</span>
                                        <span class="text-gray-900 dark:text-white">42mm</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Case Thickness</span>
                                        <span class="text-gray-900 dark:text-white">11mm</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Water Resistance</span>
                                        <span class="text-gray-900 dark:text-white">50 meters / 5 ATM</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Additional Details</h3>
                                <ul class="space-y-3">
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Crystal</span>
                                        <span class="text-gray-900 dark:text-white">Scratch-resistant sapphire</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Strap Material</span>
                                        <span class="text-gray-900 dark:text-white">Genuine leather</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Strap Width</span>
                                        <span class="text-gray-900 dark:text-white">20mm</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Power Reserve</span>
                                        <span class="text-gray-900 dark:text-white">42 hours</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Warranty</span>
                                        <span class="text-gray-900 dark:text-white">2 years international</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div id="reviews-content" class="hidden">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-6">Customer Reviews</h3>
                        
                        <div class="space-y-8">
                            @foreach([1, 2, 3] as $review)
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <div class="flex items-center mb-4">
                                    <img src="https://randomuser.me/api/portraits/{{ $review % 2 == 0 ? 'women' : 'men' }}/{{ $review }}.jpg" alt="Reviewer" class="w-10 h-10 rounded-full">
                                    <div class="ml-4">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Customer {{ $review }}</h4>
                                        <div class="flex items-center mt-1">
                                            @foreach(range(1, 5) as $star)
                                            <svg class="w-4 h-4 {{ $star <= ($review == 1 ? 5 : ($review == 2 ? 4 : 3)) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">"This watch exceeded all my expectations. The craftsmanship is impeccable and it keeps perfect time. I've received numerous compliments already!"</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Reviewed on {{ date('F j, Y', strtotime("-{$review} months")) }}</p>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Write a Review</h4>
                            <form class="space-y-4">
                                <div>
                                    <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Rating</label>
                                    <div class="flex items-center">
                                        @foreach(range(1, 5) as $star)
                                        <svg id="star-{{ $star }}" class="w-8 h-8 text-gray-300 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Name</label>
                                    <input type="text" id="name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="review" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Review</label>
                                    <textarea id="review" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Submit Review</button>
                            </form>
                        </div>
                    </div>
                    
                    <div id="shipping-content" class="hidden">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Shipping Information</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">We offer worldwide shipping with various options to suit your needs. All orders are processed within 1-2 business days.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Standard Shipping</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-2">5-7 business days</p>
                                <p class="text-gray-900 dark:text-white font-medium">Free</p>
                            </div>
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Express Shipping</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-2">2-3 business days</p>
                                <p class="text-gray-900 dark:text-white font-medium">$14.99</p>
                            </div>
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Overnight Shipping</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-2">1 business day</p>
                                <p class="text-gray-900 dark:text-white font-medium">$29.99</p>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Returns & Exchanges</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">We want you to be completely satisfied with your purchase. If for any reason you're not happy with your watch, you may return it within 30 days of delivery for a full refund or exchange.</p>
                        <p class="text-gray-700 dark:text-gray-300">Items must be in their original condition with all tags and packaging intact. Please contact our customer service team to initiate a return.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">You May Also Like</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([1, 2, 3, 4] as $product)
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <a href="{{ route('product', $product) }}" class="block">
                        <img src="https://images.unsplash.com/photo-1542496658-e33a6d0d50f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Related Product {{ $product }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Classic Chronograph {{ $product }}</h3>
                            <div class="flex items-center mt-1">
                                @foreach(range(1, 5) as $star)
                                <svg class="w-4 h-4 {{ $star <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                @endforeach
                                <span class="text-gray-600 dark:text-gray-400 text-xs ml-2">(12 reviews)</span>
                            </div>
                            <p class="text-rose-400 font-bold mt-2">${{ 399 + ($product * 100) }}</p>
                        </div>
                    </a>
                    <button class="mt-4 w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-700 transition">Add to Cart</button>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Product tabs functionality
        const tabs = {
            'description-tab': 'description-content',
            'specs-tab': 'specs-content',
            'reviews-tab': 'reviews-content',
            'shipping-tab': 'shipping-content'
        };
        
        Object.entries(tabs).forEach(([tabId, contentId]) => {
            const tab = document.getElementById(tabId);
            const content = document.getElementById(contentId);
            
            if (tab && content) {
                tab.addEventListener('click', () => {
                    // Hide all content
                    Object.values(tabs).forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.add('hidden');
                    });
                    
                    // Remove active state from all tabs
                    document.querySelectorAll('[aria-label="Tabs"] button').forEach(btn => {
                        btn.classList.remove('border-blue-800', 'text-blue-800', 'dark:text-blue-500');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    // Show selected content
                    content.classList.remove('hidden');
                    
                    // Set active state on selected tab
                    tab.classList.remove('border-transparent', 'text-gray-500');
                    tab.classList.add('border-blue-800', 'text-blue-800', 'dark:text-blue-500');
                });
            }
        });
        
        // Star rating for reviews
        const stars = document.querySelectorAll('[id^="star-"]');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.id.split('-')[1]);
                
                // Update star display
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('text-yellow-400');
                        s.classList.remove('text-gray-300');
                    } else {
                        s.classList.add('text-gray-300');
                        s.classList.remove('text-yellow-400');
                    }
                });
            });
            
            star.addEventListener('mouseover', function() {
                const rating = parseInt(this.id.split('-')[1]);
                
                // Preview hover effect
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('text-yellow-300');
                    } else {
                        s.classList.remove('text-yellow-300');
                    }
                });
            });
            
            star.addEventListener('mouseout', function() {
                // Remove preview effect
                stars.forEach(s => {
                    s.classList.remove('text-yellow-300');
                });
            });
        });
        
        // Quantity selector
        const quantityInput = document.getElementById('quantity');
        document.querySelectorAll('[onclick*="quantity"]').forEach(button => {
            button.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (this.textContent === '+') {
                    quantityInput.value = value + 1;
                } else if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });
        });
    </script>
    @endpush
</x-public-layout>