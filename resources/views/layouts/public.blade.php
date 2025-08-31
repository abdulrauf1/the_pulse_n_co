<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'The Pulse and CO') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{asset('images/fav.ico')}}" type="image/x-icon">
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .cart-count {
                position: absolute;
                top: -8px;
                right: -8px;
                background-color: #ef4444;
                color: white;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: bold;
            }
            .cart-item {
                transition: all 0.3s ease;
            }
            .cart-item-removed {
                opacity: 0;
                transform: translateX(100%);
            }
            .cart-preview {
                max-height: 400px;
                overflow-y: auto;
            }
        </style>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <!-- Navigation -->
    @include('partials.navigation')
    
    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Floating Action Buttons -->
    @include('partials.floating-buttons')
    
    <!-- Shopping Cart Sidebar -->
    <div id="cart-sidebar" class="fixed top-0 right-0 z-50 h-full w-80 bg-white dark:bg-gray-800 shadow-lg transform transition-transform duration-300 translate-x-full">
        <div class="p-4 border-b dark:border-gray-700 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Your Cart</h2>
            <button id="close-cart" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="cart-preview p-4">
            <!-- Cart items will be loaded here via AJAX -->
            <div class="text-center py-8 text-gray-500 dark:text-gray-400" id="empty-cart-message">
                Your cart is empty
            </div>
            <div id="cart-items-container"></div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t dark:border-gray-700 bg-white dark:bg-gray-800">
            <div class="flex justify-between mb-4">
                <span class="font-semibold">Total:</span>
                <span id="cart-total" class="font-bold">$0.00</span>
            </div>
            <button id="checkout-btn" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-center block disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                disabled>
                    Checkout
            </button>
        </div>
    </div>
    <div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
    // Cart management functions
    document.addEventListener('DOMContentLoaded', function() {
        const cartSidebar = document.getElementById('cart-sidebar');
        const cartOverlay = document.getElementById('cart-overlay');
        const cartBtn = document.getElementById('cart-btn');
        const closeCart = document.getElementById('close-cart');
        const cartCount = document.getElementById('cart-count');
        const checkoutBtn = document.getElementById('checkout-btn');
        
        // Add event listener to checkout button
        checkoutBtn.addEventListener('click', function() {
            window.location.href = '{{ route("checkout") }}';
        });
        
        // Toggle cart sidebar
        if (cartBtn) {
            cartBtn.addEventListener('click', function() {
                cartSidebar.classList.remove('translate-x-full');
                cartOverlay.classList.remove('hidden');
                loadCartItems();
            });
        }
        
        if (closeCart) {
            closeCart.addEventListener('click', function() {
                cartSidebar.classList.add('translate-x-full');
                cartOverlay.classList.add('hidden');
            });
        }
        
        cartOverlay.addEventListener('click', function() {
            cartSidebar.classList.add('translate-x-full');
            cartOverlay.classList.add('hidden');
        });
        
        // Load cart items
        function loadCartItems() {
            fetch('{{ route("cart.items") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Cart data:', data); // Debug log
                updateCartUI(data);
            })
            .catch(error => console.error('Error:', error));
        }
        
        function updateCartUI(data) {
            const cartItemsContainer = document.getElementById('cart-items-container');
            const emptyCartMessage = document.getElementById('empty-cart-message');
            const cartTotal = document.getElementById('cart-total');
            
            // Check if cart has items - handle different response structures
            const hasItems = data.count > 0 || (data.items && Object.keys(data.items).length > 0);
            
            if (hasItems) {
                emptyCartMessage.classList.add('hidden');
                cartItemsContainer.innerHTML = '';
                
                let html = '';
                let itemsArray = [];
                
                // Handle different response structures
                if (Array.isArray(data.items)) {
                    itemsArray = data.items;
                } else if (typeof data.items === 'object' && data.items !== null) {
                    // Convert object to array
                    itemsArray = Object.values(data.items);
                } else if (data.content) {
                    // Alternative structure some cart packages use
                    itemsArray = Object.values(data.content);
                }
                
                itemsArray.forEach(item => {
                    html += `
                    <div class="cart-item mb-4 p-4 border rounded-lg dark:border-gray-700" id="cart-item-${item.rowId || item.id}">
                        <div class="flex justify-between">
                            <div class="flex-1">
                                <h3 class="font-medium">${item.name}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">$${item.price} x ${item.qty || item.quantity}</p>
                            </div>
                            <div class="flex items-center">
                                <span class="font-bold mr-2">$${item.subtotal || (item.price * (item.qty || item.quantity)).toFixed(2)}</span>
                                <button class="remove-from-cart text-red-500 hover:text-red-700" data-rowid="${item.rowId || item.id}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    `;
                });
                
                cartItemsContainer.innerHTML = html;
                cartTotal.textContent = `$${data.total || '0.00'}`;
                
                // Enable checkout button
                checkoutBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
                checkoutBtn.removeAttribute('disabled');
                
                // Add event listeners to remove buttons
                document.querySelectorAll('.remove-from-cart').forEach(button => {
                    button.addEventListener('click', function() {
                        const rowId = this.getAttribute('data-rowid');
                        removeFromCart(rowId);
                    });
                });
            } else {
                emptyCartMessage.classList.remove('hidden');
                cartItemsContainer.innerHTML = '';
                cartTotal.textContent = '$0.00';
                
                // Disable checkout button
                checkoutBtn.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
                checkoutBtn.setAttribute('disabled', 'disabled');
            }
            
            // Update cart count
            if (cartCount) {
                const count = data.count || (data.items ? Object.keys(data.items).length : 0);
                cartCount.textContent = count;
                if (count > 0) {
                    cartCount.classList.remove('hidden');
                } else {
                    cartCount.classList.add('hidden');
                }
            }
        }
        
        function removeFromCart(rowId) {
            fetch('{{ route("cart.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ rowId: rowId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const itemElement = document.getElementById(`cart-item-${rowId}`);
                    if (itemElement) {
                        itemElement.classList.add('cart-item-removed');
                        setTimeout(() => {
                            loadCartItems();
                        }, 300);
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
        
        // Add to cart buttons
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const productName = this.getAttribute('data-name');
                const productPrice = this.getAttribute('data-price');
                
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
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Add to cart response:', data); // Debug log
                    if (data.success) {
                        // Show notification
                        const notification = document.createElement('div');
                        notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg';
                        notification.textContent = 'Product added to cart!';
                        document.body.appendChild(notification);
                        
                        setTimeout(() => {
                            notification.remove();
                        }, 3000);
                        
                        // Update cart count
                        if (cartCount) {
                            const count = data.count || (data.items ? Object.keys(data.items).length : 0);
                            cartCount.textContent = count;
                            if (count > 0) {
                                cartCount.classList.remove('hidden');
                            }
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
        
        // Initial cart count load
        loadCartItems();
    });
</script>
    @stack('scripts')
</body>
</html>