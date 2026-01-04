<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order Details: ') }} {{ $order->order_number }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Orders
            </a>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Order Summary -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-medium mb-4">Order Summary</h3>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">SKU: {{ $item->product->sku }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                    PKR {{ number_format($item->unit_price, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                                    PKR {{ number_format($item->unit_price * $item->quantity, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900 dark:text-white">Subtotal</td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">PKR {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900 dark:text-white">Total</td>
                                            <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">PKR {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Shipping & Billing Address -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Shipping Address -->
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-lg font-medium mb-4">Shipping Address</h3>
                                <div class="text-sm text-gray-900 dark:text-white whitespace-pre-line">{{ $order->shipping_address }}</div>
                            </div>
                        </div>
                        
                        <!-- Billing Address -->
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-lg font-medium mb-4">Billing Address</h3>
                                <div class="text-sm text-gray-900 dark:text-white whitespace-pre-line">{{ $order->billing_address }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Details & Status Update -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-medium mb-4">Order Information</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Order Number</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->order_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Order Date</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Payment Method</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ $order->payment_method }}</p>
                                </div>
                                @if($order->transaction_id)
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Transaction ID</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->transaction_id }}</p>
                                </div>
                                @endif
                                @if($order->notes)
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Order Notes</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->notes }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Customer Information -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-medium mb-4">Customer Information</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->customer->email }}</p>
                                </div>
                                @if($order->customer->phone)
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->customer->phone }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Status Update -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-medium mb-4">Update Order Status</h3>
                            
                            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="refunded" {{ $order->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>