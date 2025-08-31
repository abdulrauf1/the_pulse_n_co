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
                        <span class="text-gray-500 dark:text-gray-400">{{ $product->name }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Details -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-12 lg:items-start">
                <!-- Product Images -->
                <div class="flex flex-col-reverse">
                    <!-- Image Gallery -->
                    <div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                        <div class="grid grid-cols-4 gap-6">
                            @if($product->images && count($product->images) > 0)
                                @foreach($product->images as $index => $image)
                                <div class="relative flex cursor-pointer items-center justify-center rounded-md bg-white dark:bg-gray-700 text-sm font-medium uppercase text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4 {{ $index === 0 ? 'ring-2 ring-blue-500' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }} - Image {{ $index + 1 }}" class="h-20 w-full object-cover rounded-md">
                                </div>
                                @endforeach
                            @else
                                <div class="col-span-4 bg-gray-200 dark:bg-gray-600 h-20 rounded-md flex items-center justify-center">
                                    <span class="text-gray-500 dark:text-gray-400">No images available</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Main Image -->
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        @if($product->images && count($product->images) > 0)
                            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="h-96 w-full object-cover object-center sm:rounded-lg">
                        @else
                            <div class="h-96 w-full bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400 text-lg">No image available</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        @php
                            $finalPrice = $product->price;
                            $hasPromotion = false;
                            $promotion = null;
                            
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

                        <div class="flex items-center">
                            <p class="text-3xl text-rose-400 font-bold">${{ number_format($finalPrice, 2) }}</p>
                            @if($hasPromotion)
                                <p class="ml-3 text-xl text-gray-500 dark:text-gray-400 line-through">${{ number_format($product->price, 2) }}</p>
                                <span class="ml-3 bg-rose-100 text-rose-800 text-sm font-medium px-2.5 py-0.5 rounded">Save {{ $promotion->discount_type === 'percentage' ? $promotion->discount_value . '%' : '$' . number_format($promotion->discount_value, 2) }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Reviews -->
                    <div class="mt-3">
                        <div class="flex items-center">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="ml-2 text-sm text-gray-500 dark:text-gray-400">Based on 24 reviews</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="text-base text-gray-700 dark:text-gray-300 space-y-4">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    <!-- Specifications -->
                    @if($product->specifications && count($product->specifications) > 0)
                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">Specifications</h3>
                            <div class="mt-4">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                    @foreach($product->specifications as $key => $value)
                                        @if(!empty($key) && !empty($value))
                                        <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                                            <dt class="font-medium text-gray-900 dark:text-white">{{ $key }}</dt>
                                            <dd class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                {{-- Handle both string and array values --}}
                                                @if(is_array($value))
                                                    {{ implode(', ', array_filter($value, function($item) { return !is_array($item); })) }}
                                                @elseif(is_string($value) || is_numeric($value))
                                                    {{ $value }}
                                                @else
                                                    {{ json_encode($value) }}
                                                @endif
                                            </dd>
                                        </div>
                                        @endif
                                    @endforeach
                                </dl>
                            </div>
                        </div>
                    @endif

                    <!-- Add to Cart Section -->
                    <div class="mt-10">
                        @if($product->in_stock > 0)
                        <div class="flex items-center space-x-4 mb-4">
                            <!-- Quantity Selector -->
                            <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md">
                                <button type="button" class="quantity-decrease px-3 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200" onclick="decreaseQuantity()">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <input type="number" id="quantity" value="1" min="1" max="{{ $product->in_stock }}" class="w-16 text-center border-0 bg-transparent text-gray-900 dark:text-white focus:ring-0 focus:outline-none">
                                <button type="button" class="quantity-increase px-3 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200" onclick="increaseQuantity()">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Add to Cart Button -->
                            <button class="add-to-cart w-full bg-blue-800 text-white px-8 py-3 rounded-md hover:bg-blue-700 transition flex-1 flex items-center justify-center"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $finalPrice }}"
                                    data-image="{{ $product->images && count($product->images) > 0 ? asset('storage/' . $product->images[0]) : '' }}">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
                                </svg>
                                Add to Cart
                            </button>

                            <!-- Wishlist Button -->
                            <button type="button" class="p-3 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-md">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>

                        <p class="text-sm text-green-600 dark:text-green-400 mb-4">
                            {{ $product->in_stock }} available in stock
                        </p>
                        @else
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md">
                            <p class="text-rose-600 dark:text-rose-400 font-medium">Out of Stock</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">This product is currently unavailable</p>
                        </div>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="mt-8 border-t border-gray-200 dark:border-gray-600 pt-8">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white">Product Details</h3>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">SKU</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->sku }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Category</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $product->categories->pluck('name')->implode(', ') }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Brand</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->brand->name ?? 'No Brand' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Stock</span>
                                <span class="text-sm font-medium {{ $product->in_stock > 0 ? 'text-green-600' : 'text-rose-600' }}">
                                    {{ $product->in_stock > 0 ? 'In Stock (' . $product->in_stock . ')' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
            <section class="mt-16 border-t border-gray-200 dark:border-gray-600 pt-16">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}">
                                @if($relatedProduct->images && count($relatedProduct->images) > 0)
                                    <img src="{{ asset('storage/' . $relatedProduct->images[0]) }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                        <span class="text-gray-500 dark:text-gray-400">No image</span>
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="block">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $relatedProduct->name }}</h3>
                                
                                @php
                                    $relatedFinalPrice = $relatedProduct->price;
                                    $relatedHasPromotion = false;
                                    if ($relatedProduct->promotions->count() > 0) {
                                        $relatedPromotion = $relatedProduct->promotions->first();
                                        if ($relatedPromotion->discount_type === 'percentage') {
                                            $discount = ($relatedProduct->price * $relatedPromotion->discount_value) / 100;
                                            $relatedFinalPrice = $relatedProduct->price - $discount;
                                        } else {
                                            $relatedFinalPrice = $relatedProduct->price - $relatedPromotion->discount_value;
                                        }
                                        $relatedHasPromotion = true;
                                    }
                                @endphp
                                
                                <div class="mt-2">
                                    <p class="text-rose-400 font-bold">${{ number_format($relatedFinalPrice, 2) }}</p>
                                    @if($relatedHasPromotion)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 line-through">${{ number_format($relatedProduct->price, 2) }}</p>
                                    @endif
                                </div>
                            </a>
                            <!-- Add to Cart button for related products -->
                            <button class="add-to-cart mt-4 w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-700 transition-colors duration-200 font-medium" 
                                    data-id="{{ $relatedProduct->id }}"
                                    data-name="{{ $relatedProduct->name }}"
                                    data-price="{{ $relatedFinalPrice }}"
                                    data-image="{{ $relatedProduct->images && count($relatedProduct->images) > 0 ? asset('storage/' . $relatedProduct->images[0]) : '' }}">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        </div>
    </section>

    @push('scripts')
    <script>
        // Image gallery functionality
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.grid-cols-4 > div');
            const mainImage = document.querySelector('.aspect-w-1 img');
            
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    // Remove active class from all thumbnails
                    thumbnails.forEach(t => t.classList.remove('ring-2', 'ring-blue-500'));
                    
                    // Add active class to clicked thumbnail
                    this.classList.add('ring-2', 'ring-blue-500');
                    
                    // Update main image
                    const thumbImg = this.querySelector('img');
                    if (thumbImg && mainImage) {
                        mainImage.src = thumbImg.src;
                    }
                });
            });

            // Initialize add to cart functionality for all products
            initializeCartFunctionality();
        });

        // Quantity control functions
        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
            }
        }

        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            const maxStock = parseInt(quantityInput.max);
            let quantity = parseInt(quantityInput.value);
            if (quantity < maxStock) {
                quantityInput.value = quantity + 1;
            }
        }

        // Validate quantity on input
        document.getElementById('quantity').addEventListener('input', function() {
            const maxStock = parseInt(this.max);
            let quantity = parseInt(this.value);
            
            if (isNaN(quantity) || quantity < 1) {
                this.value = 1;
            } else if (quantity > maxStock) {
                this.value = maxStock;
            }
        });

        // Initialize cart functionality for all products
        function initializeCartFunctionality() {
            // Main product add to cart
            const mainAddToCartBtn = document.querySelector('.add-to-cart[data-id="{{ $product->id }}"]');
            if (mainAddToCartBtn) {
                mainAddToCartBtn.addEventListener('click', function() {
                    addToCart(this);
                });
            }

            // Related products add to cart
            document.querySelectorAll('.add-to-cart').forEach(button => {
                if (!button.closest('.mt-10')) { // Exclude main product button
                    button.addEventListener('click', function() {
                        addToCart(this);
                    });
                }
            });
        }

        // Add to cart function
        function addToCart(button) {
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const productPrice = parseFloat(button.getAttribute('data-price'));
            const productImage = button.getAttribute('data-image');
            
            // Check if this is the main product or a related product
            let quantity = 1;
            
            // If it's the main product, get the quantity from the input field
            if (button.closest('.mt-10') || productId === "{{ $product->id }}") {
                const quantityInput = document.getElementById('quantity');
                quantity = parseInt(quantityInput.value) || 1;
            }
            
            // Validate quantity
            if (quantity < 1) {
                showToast('Please select a valid quantity', 'error');
                return;
            }
            
            // Send AJAX request to add to cart
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: quantity,
                    image: productImage
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Add to cart response:', data);
                if (data.success) {
                    // Show success notification
                    showToast(`${quantity} ${productName} added to cart!`);
                    
                    // Update cart count
                    updateCartCount();
                    
                    // Reset quantity to 1 after adding to cart for main product
                    if (button.closest('.mt-10') || productId === "{{ $product->id }}") {
                        document.getElementById('quantity').value = 1;
                    }
                } else {
                    showToast('Failed to add product to cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred while adding to cart', 'error');
            });
        }

        function updateCartCount() {
            fetch('{{ route("cart.items") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                const cartCount = document.querySelector('.cart-count');
                if (cartCount) {
                    const count = data.count || (data.items ? Object.keys(data.items).length : 0);
                    cartCount.textContent = count;
                    if (count > 0) {
                        cartCount.classList.remove('hidden');
                    } else {
                        cartCount.classList.add('hidden');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function showToast(message, type = 'success') {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `fixed bottom-4 right-4 px-4 py-2 rounded-lg shadow-lg z-50 transform transition-transform duration-300 translate-y-0 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            toast.textContent = message;
            
            // Add toast to document
            document.body.appendChild(toast);
            
            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-y-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Initialize cart count on page load
        updateCartCount();
    </script>
    @endpush
</x-public-layout>  