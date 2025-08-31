<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product Details') }}: {{ $product->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-md">
                    Edit Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md">
                    Back to Products
                </a>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Product Information</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">SKU</p>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->sku }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Sale Price</p>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                @if($product->sale_price)
                                                    ${{ number_format($product->sale_price, 2) }}
                                                @else
                                                    <span class="text-gray-400">—</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Stock</p>
                                            <p class="text-sm font-medium @if($product->in_stock == 0) text-red-600 dark:text-red-400 @elseif($product->in_stock < 5) text-yellow-600 dark:text-yellow-400 @else text-green-600 dark:text-green-400 @endif">
                                                {{ $product->in_stock }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                            <div class="flex space-x-1">
                                                @if($product->is_featured)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-100 text-primary-800 dark:bg-primary-800 dark:text-primary-100">
                                                        Featured
                                                    </span>
                                                @endif
                                                @if($product->is_bestseller)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                        Bestseller
                                                    </span>
                                                @endif
                                                @if($product->is_new_arrival)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                        New
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Description</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $product->description }}</p>
                                </div>
                            </div>

                            @if($product->specifications)
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Specifications</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                                    <dl class="divide-y divide-gray-200 dark:divide-gray-600">
                                        @foreach($product->specifications as $key => $value)
                                        <div class="py-2 grid grid-cols-3 gap-4">
                                            <dt class="text-sm font-medium text-gray-900 dark:text-white">{{ $key }}</dt>
                                            <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $value }}</dd>
                                        </div>
                                        @endforeach
                                    </dl>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div>
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Categories</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                                    @if($product->categories->count() > 0)
                                        <ul class="space-y-1">
                                            @foreach($product->categories as $category)
                                                <li class="text-sm text-gray-900 dark:text-white">{{ $category->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-sm text-gray-500 dark:text-gray-400">No categories assigned</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Product Images</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                                    @if($product->images && count($product->images) > 0)
                                        <div class="grid grid-cols-2 gap-2">
                                            @foreach($product->images as $index => $image)
                                                <div class="relative">
                                                    <img src="{{ Storage::url($image) }}" alt="Product image {{ $index + 1 }}" class="w-full h-24 object-cover rounded-md">
                                                    @if($index === 0)
                                                        <div class="absolute top-1 left-1 bg-primary-500 text-white text-xs px-1 py-0.5 rounded-full">
                                                            Primary
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500 dark:text-gray-400">No images uploaded</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>