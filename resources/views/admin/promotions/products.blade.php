<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manage Products for Promotion: ') }} {{ $promotion->name }}
            </h2>
            <div>
                <a href="{{ route('admin.promotions.edit', $promotion) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit Promotion
                </a>
                <a href="{{ route('admin.promotions.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Promotion Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Discount</p>
                            <p class="font-medium">{{ $promotion->discount_type === 'percentage' ? $promotion->discount_value . '%' : '$' . $promotion->discount_value }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Period</p>
                            <p class="font-medium">{{ $promotion->start_date->format('M d, Y') }} - {{ $promotion->end_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                            <p class="font-medium">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $promotion->is_active ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                    {{ $promotion->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Assigned Products</h3>
                    
                    @if($promotionProducts->count() > 0)
                        <form action="{{ route('admin.promotions.products.update', $promotion) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Custom Discount</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Excluded</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Start Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">End Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($promotionProducts as $product)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">SKU: {{ $product->sku }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="number" step="0.01" min="0" name="products[{{ $product->id }}][custom_discount]" value="{{ $product->pivot->custom_discount }}" class="w-24 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    <input type="hidden" name="products[{{ $product->id }}][product_id]" value="{{ $product->id }}">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="checkbox" name="products[{{ $product->id }}][is_excluded]" value="1" {{ $product->pivot->is_excluded ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="datetime-local" name="products[{{ $product->id }}][start_date]" value="{{ $product->pivot->start_date ? $product->pivot->start_date->format('Y-m-d\TH:i') : '' }}" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="datetime-local" name="products[{{ $product->id }}][end_date]" value="{{ $product->pivot->end_date ? $product->pivot->end_date->format('Y-m-d\TH:i') : '' }}" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <button type="button" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 remove-product" data-product-id="{{ $product->id }}">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Update Products
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No products assigned to this promotion yet.</p>
                    @endif
                </div>
            </div>
            
            @if($products->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium mb-4">Available Products</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($products as $product)
                                <div class="border rounded-lg p-4 dark:border-gray-700">
                                    <h4 class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">SKU: {{ $product->sku }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Price: ${{ $product->price }}</p>
                                    <div class="mt-2">
                                        <form action="{{ route('admin.promotions.products.update', $promotion) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="products[{{ $product->id }}][product_id]" value="{{ $product->id }}">
                                            <input type="hidden" name="products[{{ $product->id }}][custom_discount]" value="">
                                            <input type="hidden" name="products[{{ $product->id }}][is_excluded]" value="0">
                                            <button type="submit" class="text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                                Add to Promotion
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Remove product from promotion
            document.querySelectorAll('.remove-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    if (confirm('Are you sure you want to remove this product from the promotion?')) {
                        // Create a form to remove the product
                        const form = document.createElement('form');
                        form.action = "{{ route('admin.promotions.products.update', $promotion) }}";
                        form.method = 'POST';
                        
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = "{{ csrf_token() }}";
                        form.appendChild(csrfToken);
                        
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'PUT';
                        form.appendChild(methodField);
                        
                        // Add empty product array to remove all products
                        const productField = document.createElement('input');
                        productField.type = 'hidden';
                        productField.name = 'products';
                        productField.value = JSON.stringify({});
                        form.appendChild(productField);
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>