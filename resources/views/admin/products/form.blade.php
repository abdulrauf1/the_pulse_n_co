<div class="grid grid-cols-1 gap-8 md:grid-cols-3">
    <!-- Left Column - Basic Info -->
    <div class="md:col-span-2 space-y-6">
        <div class="form-group">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Product Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3 @error('name') error-input @enderror" 
                    placeholder="e.g., Luxury Chronograph Watch">
            @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description *</label>
            <textarea name="description" id="description" rows="6" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3 @error('description') error-input @enderror" 
                        placeholder="Describe your product in detail">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SKU *</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku ?? '') }}" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3 @error('sku') error-input @enderror" 
                        placeholder="e.g., WCH-001">
                @error('sku')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="in_stock" class="block text-sm font-medium text-gray-70 dark:text-gray-300 mb-1">Stock Quantity *</label>
                <input type="number" name="in_stock" id="in_stock" value="{{ old('in_stock', $product->in_stock ?? 0) }}" min="0" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3 @error('in_stock') error-input @enderror">
                @error('in_stock')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Price (PKR) *</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 dark:text-gray-400">PKR</span>
                    </div>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" 
                            class="pl-12 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3 @error('price') error-input @enderror" 
                            placeholder="0.00">
                </div>
                @error('price')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="sale_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sale Price (PKR)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 dark:text-gray-400">PKR</span>
                    </div>
                    <input type="number" step="0.01" name="sale_price" id="sale_price" value="{{ old('sale_price', $product->sale_price ?? '') }}" 
                            class="pl-12 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3 @error('sale_price') error-input @enderror" 
                            placeholder="0.00">
                </div>
                @error('sale_price')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Specifications</label>
            <div id="specifications-container" class="space-y-3">
                @php
    $specifications = old('specifications', $product->specifications ?? []);
@endphp

@if(
    isset($specifications['key'], $specifications['value']) &&
    is_array($specifications['key']) &&
    is_array($specifications['value'])
)
    @foreach($specifications['key'] as $index => $specKey)
        <div class="flex gap-3 specification-row items-start">
            <div class="flex-1">
                <input type="text"
                       name="specifications[key][]"
                       value="{{ $specKey }}"
                       placeholder="Specification name"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5">
            </div>

            <div class="flex-1">
                <input type="text"
                       name="specifications[value][]"
                       value="{{ $specifications['value'][$index] ?? '' }}"
                       placeholder="Specification value"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5">
            </div>

            <button type="button"
                    class="remove-specification bg-rose-100 text-rose-700 px-3 py-2.5 rounded-md hover:bg-rose-200 dark:bg-rose-900/30 dark:text-rose-300 dark:hover:bg-rose-900/50 remove-btn">
                Remove
            </button>
        </div>
    @endforeach
@else
    {{-- Empty row for new product --}}
    <div class="flex gap-3 specification-row items-start">
        <div class="flex-1">
            <input type="text" name="specifications[key][]" placeholder="Specification name"
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5">
        </div>
        <div class="flex-1">
            <input type="text" name="specifications[value][]" placeholder="Specification value"
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5">
        </div>
        <button type="button"
                class="remove-specification bg-rose-100 text-rose-700 px-3 py-2.5 rounded-md hover:bg-rose-200 dark:bg-rose-900/30 dark:text-rose-300 dark:hover:bg-rose-900/50 remove-btn">
            Remove
        </button>
    </div>
@endif

            </div>
            <button type="button" id="add-specification" class="mt-3 bg-blue-100 text-blue-700 px-4 py-2 rounded-md hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50">
                + Add Specification
            </button>
        </div>
    </div>

    
    <!-- Right Column - Media & Options -->
    <div class="space-y-6">
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Product Images</label>
            
            <!-- Existing Images -->
            @if(isset($product->images) && count($product->images) > 0)
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Existing Images</h4>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($product->images as $index => $image)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $image) }}" class="w-full h-24 object-cover rounded-md" alt="Product Image">
                                <label class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 cursor-pointer">
                                    <input type="checkbox" name="remove_images[]" value="{{ $index }}" class="hidden">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- New Image Upload -->
            <div class="upload-area relative border-2 border-dashed rounded-lg p-6 text-center cursor-pointer" id="upload-area">
                <input type="file" name="images[]" id="images" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="mt-4 flex text-sm text-gray-600 dark:text-gray-400">
                    <p class="pl-1">Drag & drop images or <span class="text-blue-600 dark:text-blue-400 font-medium">browse</span></p>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">PNG, JPG, GIF up to 2MB</p>
            </div>
            <div id="image-previews" class="mt-4 grid grid-cols-2 gap-3 hidden">
                <!-- Image previews will be added here -->
            </div>
            @error('images.*')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Categories</label>
            <div class="space-y-2 max-h-60 overflow-y-auto p-1">
                @foreach($categories as $category)
                    <label class="checkbox-card flex items-start p-3 border rounded-md cursor-pointer hover:border-blue-300 dark:hover:border-blue-600 
                                {{ in_array($category->id, old('categories', isset($product) ? $product->categories->pluck('id')->toArray() : [])) ? 'selected border-blue-500 bg-blue-50 dark:bg-blue-900/20' : '' }}">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-0.5"
                                        {{ in_array($category->id, old('categories', isset($product) ? $product->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                                <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                            </label>
                @endforeach
            </div>
            @error('categories')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Product Flags</label>
            <div class="space-y-3">
                <label class="flex items-center p-3 border rounded-md cursor-pointer hover:border-blue-300 dark:hover:border-blue-600">
                    <input type="checkbox" name="is_featured" value="1" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                    <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Featured Product</span>
                </label>
                <label class="flex items-center p-3 border rounded-md cursor-pointer hover:border-blue-300 dark:hover:border-blue-600">
                    <input type="checkbox" name="is_bestseller" value="1" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('is_bestseller', $product->is_bestseller ?? false) ? 'checked' : '' }}>
                    <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Bestseller</span>
                </label>
                <label class="flex items-center p-3 border rounded-md cursor-pointer hover:border-blue-300 dark:hover:border-blue-600">
                    <input type="checkbox" name="is_new_arrival" value="1" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('is_new_arrival', $product->is_new_arrival ?? false) ? 'checked' : '' }}>
                    <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">New Arrival</span>
                </label>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg mt-6">
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Form Tips</h3>
            <ul class="text-xs text-gray-500 dark:text-gray-400 space-y-1">
                <li>• Fields marked with * are required</li>
                <li>• SKU must be unique across all products</li>
                <li>• First image will be used as the primary image</li>
                <li>• Use specifications for technical details</li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
        Cancel
    </a>
    <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        {{ isset($product) ? 'Update Product' : 'Create Product' }}
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add specification field
        document.getElementById('add-specification').addEventListener('click', function() {
            const container = document.getElementById('specifications-container');
            const newRow = document.createElement('div');
            newRow.className = 'flex gap-3 specification-row items-start';
            newRow.innerHTML = `
                <div class="flex-1">
                    <input type="text" name="specifications[key][]" placeholder="Specification name" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5">
                </div>
                <div class="flex-1">
                    <input type="text" name="specifications[value][]" placeholder="Specification value" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5">
                </div>
                <button type="button" class="remove-specification bg-rose-100 text-rose-700 px-3 py-2.5 rounded-md hover:bg-rose-200 dark:bg-rose-900/30 dark:text-rose-300 dark:hover:bg-rose-900/50 remove-btn">
                    Remove
                </button>
            `;
            container.appendChild(newRow);
            
            // Add event listener to the new remove button
            newRow.querySelector('.remove-specification').addEventListener('click', function() {
                newRow.remove();
            });
        });
        
        // Remove specification field
        document.querySelectorAll('.remove-specification').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.specification-row').remove();
            });
        });
        
        // Image upload handling
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('images');
        const imagePreviews = document.getElementById('image-previews');
        
        // Drag and drop handling
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            uploadArea.classList.add('drag-over');
        }
        
        function unhighlight() {
            uploadArea.classList.remove('drag-over');
        }
        
        uploadArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            handleFiles(files);
        }
        
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });
        
        function handleFiles(files) {
            if (files.length > 0) {
                imagePreviews.classList.remove('hidden');
                imagePreviews.innerHTML = '';
                
                Array.from(files).forEach(file => {
                    if (!file.type.match('image.*')) return;
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.createElement('div');
                        preview.className = 'relative image-preview';
                        preview.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-24 object-cover rounded-md" alt="Preview">
                            <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 remove-image">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        `;
                        imagePreviews.appendChild(preview);
                        
                        // Add event listener to remove button
                        preview.querySelector('.remove-image').addEventListener('click', function() {
                            preview.remove();
                            if (imagePreviews.children.length === 0) {
                                imagePreviews.classList.add('hidden');
                            }
                        });
                    };
                    reader.readAsDataURL(file);
                });
            }
        }
        
        // Checkbox card selection
        document.querySelectorAll('.checkbox-card').forEach(card => {
            const checkbox = card.querySelector('input[type="checkbox"]');
            
            card.addEventListener('click', function(e) {
                if (e.target !== checkbox) {
                    checkbox.checked = !checkbox.checked;
                    updateCardSelection(card, checkbox.checked);
                }
            });
            
            checkbox.addEventListener('change', function() {
                updateCardSelection(card, this.checked);
            });
            
            // Initialize selection state
            updateCardSelection(card, checkbox.checked);
        });
        
        function updateCardSelection(card, isSelected) {
            if (isSelected) {
                card.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
            } else {
                card.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
            }
        }
        
        // Add error styling to fields with errors
        document.querySelectorAll('.error-input').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.remove('error-input');
                }
            });
        });
        
        // Handle existing image removal
        document.querySelectorAll('input[name="remove_images[]"]').forEach(checkbox => {
            const parent = checkbox.closest('.relative');
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    parent.classList.add('opacity-50', 'border-2', 'border-red-500');
                } else {
                    parent.classList.remove('opacity-50', 'border-2', 'border-red-500');
                }
            });
        });
    });
</script>

<style>
    .drag-over {
        border-color: #3b82f6;
        background-color: rgba(59, 130, 246, 0.05);
    }
    .error-input {
        border-color: #ef4444;
    }
    body {
        font-family: 'Inter', sans-serif;
    }
</style>