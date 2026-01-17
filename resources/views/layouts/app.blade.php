<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'The Pulse and CO') }} - Admin Panel </title>

        <!-- Favicon -->
        <link rel="icon" href="{{asset('images/fav.ico')}}" type="image/x-icon">
    

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Loader CSS -->
        <style>
            #loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.8);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: opacity 0.3s ease;
            }
            
            .loader-spinner {
                width: 50px;
                height: 50px;
                border: 5px solid #f3f3f3;
                border-top: 5px solid #3498db;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            
            .loaded #loader {
                opacity: 0;
                pointer-events: none;
            }

            /* Ensure sidebar is properly positioned on mobile */
            @media (max-width: 767px) {
                #sidebar {
                    transform: translateX(-100%);
                    transition: transform 0.3s ease-in-out;
                }
                
                #sidebar.mobile-open {
                    transform: translateX(0);
                }
                
                /* Overlay for mobile */
                .sidebar-overlay {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 39;
                }
                
                .sidebar-overlay.active {
                    display: block;
                }
            }
        </style>
            
        @stack('styles')
    </head>
    <body class="font-sans antialiased"
        x-data="{ darkMode: false, mobileSidebarOpen: false }" 
        x-init="
            if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                localStorage.setItem('darkMode', JSON.stringify(true));
            }
            darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        x-cloak>
        
        <!-- Loader -->
        <div id="loader">
            <div style="text-align: center;">
                <div class="loader-spinner"></div>
                <p style="margin-top: 20px; color: #333;">Loading dashboard...</p>
            </div>
        </div>

        <!-- Mobile sidebar overlay -->
        <div class="sidebar-overlay" :class="{ 'active': mobileSidebarOpen }" @click="mobileSidebarOpen = false"></div>

            <div x-bind:class="{'dark' : darkMode === true}" class="min-h-screen bg-gray-100 dark:bg-gray-900">
                <!-- Top Navigation -->
                <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-3 py-3 lg:px-5 lg:pl-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center justify-start rtl:justify-end">
                                <!-- Mobile sidebar toggle - FIXED -->
                                <button @click="mobileSidebarOpen = !mobileSidebarOpen" type="button" 
                                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                    <span class="sr-only">Open sidebar</span>
                                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                                    </svg>
                                </button>
                                
                                <!-- Brand Logo -->
                                <a href="{{route('dashboard')}}" class="flex ms-2 md:me-24">
                                    <img src="{{asset('images/logo.png')}}" class="h-12 me-3" alt="Rim & Zeel" />
                                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white hidden md:block">Admin Panel</span>
                                </a>
                            </div>
                            
                            <!-- Right side navigation -->
                            <div class="flex items-center">
                                <!-- Dark mode toggle -->
                                <button @click="darkMode = !darkMode" type="button" 
                                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2.5">
                                    <template x-if="darkMode">
                                        <i class="fas fa-sun text-yellow-400"></i>
                                    </template>
                                    <template x-if="!darkMode">
                                        <i class="fas fa-moon"></i>
                                    </template>
                                </button>
                                
                               
                                
                                <!-- User dropdown -->
                                <div class="relative ml-2" x-data="{ open: false }">
                                    <button @click="open = !open" type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff" alt="User">
                                    </button>
                                    
                                    <div x-show="open" @click.away="open = false" 
                                        class="absolute right-0 z-20 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg dark:bg-gray-700">
                                        <div class="px-4 py-3">
                                            <p class="text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                            <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-300">{{ Auth::user()->email }}</p>
                                        </div>
                                        <ul class="py-1">
                                            <li>
                                                <a href="{{route('profile.edit')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">Profile</a>
                                            </li>
                                            <li>
                                                <a href="{{route('admin.settings')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">Settings</a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">
                                                        Sign out
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Sidebar - FIXED -->
                <aside id="sidebar" 
                    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                    :class="{ 'mobile-open': mobileSidebarOpen }">
                    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800 mt-5">
                        <ul class="space-y-2 font-medium">
                            <!-- Dashboard -->
                            <li>
                                <a href="{{route('dashboard')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <i class="fas fa-tachometer-alt text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="ms-3">Dashboard</span>
                                </a>
                            </li>
                            
                            <!-- Products -->
                            <li>
                                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" 
                                        aria-controls="products-dropdown" data-collapse-toggle="products-dropdown">
                                    <i class="fas fa-box text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Products</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul id="products-dropdown" class="hidden py-2 space-y-2">
                                    <li>
                                        <a href="{{ route('admin.products.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            All Products
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.products.create') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            Add New Product
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.products.inventory') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            Inventory Management
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Promotions  -->
                            <li>
                                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" 
                                        aria-controls="promotions-dropdown" data-collapse-toggle="promotions-dropdown">
                                    <i class="fas fa-percentage text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Promotions</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul id="promotions-dropdown" class="hidden py-2 space-y-2">
                                    <li>
                                        <a href="{{ route('admin.promotions.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            All Promotions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.promotions.create') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            Create Promotion
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- Categories -->
                            <li>
                                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" 
                                        aria-controls="categories-dropdown" data-collapse-toggle="categories-dropdown">
                                    <i class="fas fa-tags text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Categories</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul id="categories-dropdown" class="hidden py-2 space-y-2">
                                    <li>
                                        <a href="{{ route('admin.categories.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            All Categories
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.categories.create') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            Add New Category
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- Orders -->
                            <li>
                                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" 
                                        aria-controls="orders-dropdown" data-collapse-toggle="orders-dropdown">
                                    <i class="fas fa-shopping-cart text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Orders</span>
                                    <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                        {{ App\Models\Order::where('status', 'pending')->count() }}
                                    </span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul id="orders-dropdown" class="hidden py-2 space-y-2">
                                    <li>
                                        <a href="{{ route('admin.orders.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            All Orders
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            Pending Orders
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                            Completed Orders
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- Customers -->
                            <li>
                                <a href="{{ route('admin.customers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <i class="fas fa-users text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Customers</span>
                                </a>
                            </li>
                            
                            
                            <!-- Settings -->
                            <li>
                                <a href="{{ route('admin.settings') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <i class="fas fa-cog text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="p-4 sm:ml-64">
                    <div class="p-4 dark:border-gray-700 mt-14">
                        <!-- Page Header -->
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                @yield('title')
                            </h1>
                            <div class="flex space-x-2">
                                @yield('actions')
                            </div>
                        </div>
                        
                        <!-- Flash Messages -->
                        @if(session('success'))
                            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <!-- Page Content -->
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts -->

        <script>
            // Show loader when page is loading
            document.addEventListener('DOMContentLoaded', function() {
                // Hide loader when page is fully loaded
                window.addEventListener('load', function() {
                    document.body.classList.add('loaded');
                    
                    // Optional: Remove loader from DOM after fade out
                    setTimeout(function() {
                        document.getElementById('loader').remove();
                    }, 300);
                });
            });

            // Add this to your admin.js or in a script section
            document.addEventListener('DOMContentLoaded', function() {
                // Show loader before making fetch requests
                const originalFetch = window.fetch;
                window.fetch = function(...args) {
                    document.body.classList.remove('loaded');
                    document.getElementById('loader').style.display = 'flex';
                    
                    return originalFetch(...args).then(response => {
                        document.body.classList.add('loaded');
                        return response;
                    }).catch(error => {
                        document.body.classList.add('loaded');
                        throw error;
                    });
                };
            });

            // Optional: Show loader during AJAX requests
            if (typeof jQuery !== 'undefined') {
                $(document).ajaxStart(function() {
                    document.body.classList.remove('loaded');
                    document.getElementById('loader').style.display = 'flex';
                });
                
                $(document).ajaxStop(function() {
                    document.body.classList.add('loaded');
                });
            }
        </script>
        <script>
            // Simple dropdown toggle function
            function toggleDropdown(id) {
                const dropdown = document.getElementById(id);
                dropdown.classList.toggle('hidden');
            }

            // Close mobile sidebar when clicking on links
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarLinks = document.querySelectorAll('#sidebar a');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 640) {
                            // Close mobile sidebar
                            Alpine.$data(document.querySelector('[x-data]')).mobileSidebarOpen = false;
                        }
                    });
                });

                // Hide loader when page is fully loaded
                window.addEventListener('load', function() {
                    document.body.classList.add('loaded');
                    setTimeout(function() {
                        const loader = document.getElementById('loader');
                        if (loader) loader.remove();
                    }, 300);
                });
            });

            // Initialize Alpine.js if not already initialized
            if (typeof Alpine === 'undefined') {
                console.warn('Alpine.js is not loaded');
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
        @stack('scripts')
    </body>
</html>