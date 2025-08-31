<x-public-layout>
    <!-- Hero Section -->
    <section class="relative bg-gray-100 dark:bg-gray-800 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl sm:tracking-tight lg:text-6xl">
                Your Shopping Cart
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Review your selected items before checkout
            </p>
        </div>
    </section>

    <!-- Cart Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:space-x-8">
                <!-- Cart Items -->
                <div class="lg:w-2/3">
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <!-- Cart Header -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Your Cart (3 items)</h2>
                        </div>
                        
                        <!-- Cart Items -->
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach([1, 2, 3] as $item)
                            <div class="p-6 flex flex-col sm:flex-row">
                                <div class="flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1524805444758-089113d48a6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80" alt="Product {{ $item }}" class="w-24 h-24 rounded-md object-cover">
                                </div>
                                <div class="mt-4 sm:mt-0 sm:ml-6 flex-grow">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Premium Automatic Watch {{ $item }}</h3>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Strap Color: Brown</p>
                                        </div>
                                        <p class="text-lg font-medium text-rose-400">${{ 599 + ($item * 100) }}</p>
                                    </div>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="flex items-center">
                                            <button class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">-</button>
                                            <input type="number" min="1" value="1" class="w-12 text-center border-t border-b border-gray-300 dark:border-gray-600 dark:bg-gray-700 mx-1">
                                            <button class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">+</button>
                                        </div>
                                        <button class="text-red-500 hover:text-red-700 dark:hover:text-red-400">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Cart Footer -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-200 dark:border-gray-600 flex justify-between">
                            <button class="text-blue-800 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 font-medium">
                                <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                            </button>
                            <button class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium">
                                <i class="fas fa-sync-alt mr-2"></i> Update Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Coupon Code -->
                    <div class="mt-6 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Apply Coupon Code</h3>
                            <div class="flex">
                                <input type="text" placeholder="Enter coupon code" class="flex-grow px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-l-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <button class="px-4 py-2 bg-blue-800 text-white rounded-r-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:w-1/3 mt-8 lg:mt-0">
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Order Summary</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                                    <span class="text-gray-900 dark:text-white">$1,897.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                                    <span class="text-gray-900 dark:text-white">$0.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Tax</span>
                                    <span class="text-gray-900 dark:text-white">$151.76</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Discount</span>
                                    <span class="text-green-500">-$50.00</span>
                                </div>
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 flex justify-between">
                                    <span class="text-lg font-medium text-gray-900 dark:text-white">Total</span>
                                    <span class="text-lg font-bold text-rose-400">$1,998.76</span>
                                </div>
                            </div>
                            <button class="mt-6 w-full bg-blue-800 text-white py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Proceed to Checkout
                            </button>
                            <div class="mt-4 flex items-center justify-center">
                                <span class="text-gray-600 dark:text-gray-400 mr-2">or</span>
                                <a href="{{ route('shop') }}" class="text-blue-800 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 font-medium">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Methods -->
                    <div class="mt-6 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">We Accept</h3>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-md flex items-center justify-center">
                                    <img src="https://via.placeholder.com/40x25?text=Visa" alt="Visa" class="h-6">
                                </div>
                                <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-md flex items-center justify-center">
                                    <img src="https://via.placeholder.com/40x25?text=MC" alt="Mastercard" class="h-6">
                                </div>
                                <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-md flex items-center justify-center">
                                    <img src="https://via.placeholder.com/40x25?text=Amex" alt="American Express" class="h-6">
                                </div>
                                <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-md flex items-center justify-center">
                                    <img src="https://via.placeholder.com/40x25?text=PayPal" alt="PayPal" class="h-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recently Viewed -->
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">Recently Viewed</h2>
            
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach([1, 2, 3, 4] as $product)
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1524805444758-089113d48a6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80" 
                             alt="Product {{ $product }}" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="bg-white dark:bg-gray-800 p-2 rounded-full shadow-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="far fa-heart text-gray-700 dark:text-gray-300"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Luxury Watch {{ $product }}</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                @foreach(range(1, 5) as $star)
                                    <i class="fas fa-star"></i>
                                @endforeach
                            </div>
                            <span class="text-gray-600 dark:text-gray-400 text-sm ml-2">({{ rand(10, 100) }})</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-rose-400">${{ 399 + ($product * 50) }}</span>
                            <button class="bg-blue-800 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition-colors duration-300">
                                <i class="fas fa-shopping-cart mr-1"></i> Add
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Security Badges -->
    <section class="py-8 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="flex flex-col items-center">
                    <i class="fas fa-shield-alt text-3xl text-blue-800 dark:text-blue-500 mb-2"></i>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Secure Payment</span>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fas fa-truck text-3xl text-blue-800 dark:text-blue-500 mb-2"></i>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Free Shipping</span>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fas fa-undo-alt text-3xl text-blue-800 dark:text-blue-500 mb-2"></i>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">30-Day Returns</span>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fas fa-headset text-3xl text-blue-800 dark:text-blue-500 mb-2"></i>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">24/7 Support</span>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>