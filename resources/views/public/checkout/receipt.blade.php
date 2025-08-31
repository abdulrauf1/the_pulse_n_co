<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt - {{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
            @page {
                margin: 0.5in;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto bg-white p-8 shadow-md">
        <!-- Header -->
        <div class="text-center mb-8 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Order Receipt</h1>
            <p class="text-gray-600">Order #: {{ $order->order_number }}</p>
            <p class="text-gray-600">Date: {{ $order->created_at->format('F j, Y, g:i a') }}</p>
        </div>
        
        <!-- Order Details -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Order Details</h2>
            <table class="w-full mb-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-left py-2 px-4">Product</th>
                        <th class="text-right py-2 px-4">Qty</th>
                        <th class="text-right py-2 px-4">Price</th>
                        <th class="text-right py-2 px-4">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->items as $item)
                    <tr class="border-b">
                        <td class="py-2 px-4">
                            @if($item->product && $item->product->name)
                                {{ $item->product->name }}
                            @else
                                Product #{{ $item->product_id }}
                            @endif
                        </td>
                        <td class="text-right py-2 px-4">{{ $item->quantity }}</td>
                        <td class="text-right py-2 px-4">${{ number_format($item->unit_price, 2) }}</td>
                        <td class="text-right py-2 px-4">${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">No order items found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Totals -->
        <div class="mb-6 border-t pt-4">
            <div class="flex justify-between mb-2">
                <span class="font-medium">Subtotal:</span>
                <span>${{ number_format($order->total_amount, 2) }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="font-medium">Shipping:</span>
                <span>Free</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="font-medium">Tax:</span>
                <span>$0.00</span>
            </div>
            <div class="flex justify-between border-t pt-2 font-bold text-lg">
                <span>Total:</span>
                <span>${{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
        
        <!-- Customer Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 border-t pt-4">
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Shipping Address</h3>
                <p class="mb-1">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
                <p class="mb-1">{{ $order->shipping_address }}</p>
                <p class="mb-1">{{ $order->customer->city }}, {{ $order->customer->state }} {{ $order->customer->zip_code }}</p>
                <p>{{ $order->customer->country }}</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Contact Information</h3>
                <p class="mb-1">{{ $order->customer->email }}</p>
                <p class="mb-4">{{ $order->customer->phone }}</p>
                
                <h3 class="font-semibold text-gray-800 mb-2">Payment Method</h3>
                <p>{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
                
                <h3 class="font-semibold text-gray-800 mt-4 mb-2">Order Status</h3>
                <p class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">{{ ucfirst($order->status) }}</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-center text-gray-600 text-sm mt-8 border-t pt-4">
            <p class="mb-1">Thank you for your order!</p>
            <p>Your order will be processed and shipped soon.</p>
        </div>

        <!-- Print Button (hidden when printing) -->
        <div class="text-center mt-6 no-print">
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Print Receipt
            </button>
            <button onclick="window.history.back()" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                Go Back
            </button>
        </div>
    </div>
    
    <script>
        // Optional: Auto print when the page loads
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>