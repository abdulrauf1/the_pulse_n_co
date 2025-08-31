<x-public-layout>
    <!-- Breadcrumb -->
    <section class="bg-gray-100 dark:bg-gray-800 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Home</a>
                        <svg class="mx-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('shop') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Shop</a>
                        <svg class="mx-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('cart') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Cart</a>
                        <svg class="mx-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <span class="text-gray-500 dark:text-gray-400">Checkout</span>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Checkout Section -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Checkout</h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Customer Information -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold text-gray-909 dark:text-white mb-4">Customer Information</h2>
                    
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First Name</label>
                                <input type="text" id="first_name" name="first_name" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Name</label>
                                <input type="text" id="last_name" name="last_name" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-6 mb-4">Shipping Address</h2>
                        
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Street Address</label>
                            <input type="text" id="address" name="address" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                                <input type="text" id="city" name="city" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">State/Province</label>
                                <input type="text" id="state" name="state" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="zip_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ZIP/Postal Code</label>
                                <input type="text" id="zip_code" name="zip_code" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                                <input type="text" id="country" name="country" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                        
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-6 mb-4">Payment Method</h2>
                        
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md mb-6">
                            <div class="flex items-center">
                                <input type="radio" id="cash_on_delivery" name="payment_method" value="cash_on_delivery" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <label for="cash_on_delivery" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">Cash on Delivery</label>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Pay with cash when your order is delivered.</p>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md focus:outline-none focus:shadow-outline">
                            Place Order
                        </button>
                    </form>
                </div>
                
                <!-- Order Summary -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow h-fit">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h2>
                    
                    <div class="border-b border-gray-200 dark:border-gray-600 pb-4 mb-4">
                        @if(isset($cart['default']))
                            @foreach($cart['default'] as $item)
                                <div class="flex justify-between mb-2">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $item->name }} × {{ $item->qty }}</p>
                                    </div>
                                    <p class="font-medium text-gray-900 dark:text-white">${{ number_format($item->price * $item->qty, 2) }}</p>
                                </div>
                            @endforeach
                        @else
                            @foreach($cart as $id => $item)
                                <div class="flex justify-between mb-2">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $item['name'] }} × {{ $item['quantity'] }}</p>
                                    </div>
                                    <p class="font-medium text-gray-900 dark:text-white">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    @php
                        if (isset($cart['default'])) {
                            $subtotal = array_sum(array_map(function($item) { 
                                return $item->price * $item->qty; 
                            }, $cart['default']->all()));
                        } else {
                            $subtotal = array_sum(array_map(function($item) { 
                                return $item['price'] * $item['quantity']; 
                            }, $cart));
                        }
                    @endphp
                    
                    <div class="flex justify-between mb-2">
                        <p class="text-gray-600 dark:text-gray-400">Subtotal</p>
                        <p class="text-gray-900 dark:text-white">${{ number_format($subtotal, 2) }}</p>
                    </div>
                    
                    <div class="flex justify-between mb-2">
                        <p class="text-gray-600 dark:text-gray-400">Shipping</p>
                        <p class="text-gray-900 dark:text-white">Free</p>
                    </div>
                    
                    <div class="flex justify-between mb-4">
                        <p class="text-gray-600 dark:text-gray-400">Tax</p>
                        <p class="text-gray-900 dark:text-white">$0.00</p>
                    </div>
                    
                    <div class="flex justify-between border-t border-gray-200 dark:border-gray-600 pt-4 mb-4">
                        <p class="text-lg font-bold text-gray-900 dark:text-white">Total</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($subtotal, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>