<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customer Details: ') }} {{ $customer->first_name }} {{ $customer->last_name }}
            </h2>
            <a href="{{ route('admin.customers.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Customers
            </a>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Customer Information -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex flex-col items-center mb-6">
                                <div class="h-24 w-24 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center mb-4">
                                    <span class="text-2xl text-indigo-800 dark:text-indigo-100 font-medium">
                                        {{ substr($customer->first_name, 0, 1) }}{{ substr($customer->last_name, 0, 1) }}
                                    </span>
                                </div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                </h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Customer since {{ $customer->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact Information</h3>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $customer->email }}</p>
                                    @if($customer->phone)
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $customer->phone }}</p>
                                    @endif
                                </div>
                                
                                @if($customer->address || $customer->city || $customer->state || $customer->postal_code || $customer->country)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Address</h3>
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        @if($customer->address){{ $customer->address }}<br>@endif
                                        @if($customer->city){{ $customer->city }}, @endif
                                        @if($customer->state){{ $customer->state }} @endif
                                        @if($customer->postal_code){{ $customer->postal_code }}<br>@endif
                                        @if($customer->country){{ $customer->country }}@endif
                                    </p>
                                </div>
                                @endif
                                
                                @if($customer->notes)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Notes</h3>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $customer->notes }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Customer Stats -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-medium mb-4">Customer Statistics</h3>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg text-center">
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $customer->orders()->count() }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Orders</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg text-center">
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($customer->orders()->sum('total_amount'), 2) }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Spent</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg text-center">
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($customer->orders()->avg('total_amount') ?? 0, 2) }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Average Order</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg text-center">
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $customer->orders()->where('status', 'delivered')->count() }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Completed Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order History -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-medium mb-4">Order History</h3>
                            
                            @if($orders->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order #</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Items</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->order_number }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 dark:text-white">{{ $order->created_at->format('M d, Y') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 dark:text-white">{{ $order->items_count }} items</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($order->total_amount, 2) }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100
                                                            @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100
                                                            @elseif($order->status === 'delivered') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                                            @elseif($order->status === 'refunded') bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100
                                                            @endif">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="mt-4">
                                    {{ $orders->links() }}
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No orders yet</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This customer hasn't placed any orders.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>