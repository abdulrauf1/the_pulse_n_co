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
                        <a href="{{ route('checkout') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Checkout</a>
                        <svg class="mx-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <span class="text-gray-500 dark:text-gray-400">Confirmation</span>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Confirmation Section -->
    <section class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Order Confirmed!</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Thank you for your order. Your order number is: <span class="font-semibold text-gray-900 dark:text-white">{{ $order->order_number }}</span></p>
                
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg mb-6 text-left">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Order Date</p>
                            <p class="text-gray-900 dark:text-white">{{ $order->created_at->format('F j, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Payment Method</p>
                            <p class="text-gray-900 dark:text-white">Cash on Delivery</p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Shipping Address</p>
                        <p class="text-gray-900 dark:text-white">
                            {{ $order->first_name }} {{ $order->last_name }}<br>
                            {{ $order->address }}<br>
                            {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}<br>
                            {{ $order->country }}
                        </p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Contact Information</p>
                        <p class="text-gray-900 dark:text-white">{{ $order->email }}</p>
                        <p class="text-gray-900 dark:text-white">{{ $order->phone }}</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('checkout.receipt', $order) }}" target="_blank" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Print Receipt
                    </a>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-5 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>