<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Product') }}: {{ $product->name }}
            </h2>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 flex items-center">
                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Products
            </a>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.products.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

    <style>
        .checkbox-card {
            border: 2px solid transparent;
            border-radius: 0.5rem; /* Rounded corners */
            padding: 1rem;
            cursor: pointer;
            transition: border-color 0.3s, background-color 0.3s, box-shadow 0.3s, transform 0.3s;
        }
        
        .checkbox-card:hover {
            border-color: #3b82f6; /* Tailwind's blue-500 */
            background-color: rgba(59, 130, 246, 0.05); /* Light blue background on hover */    
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

</style>
