<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('categories')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.products.index', compact('products'));
    }

    /**
     * Display product inventory.
     */
    public function inventory()
    {
        $products = Product::orderBy('in_stock', 'asc')
            ->orderBy('name')
            ->paginate(15);
            
        $lowStockCount = Product::where('in_stock', '<', 5)->count();
        $outOfStockCount = Product::where('in_stock', 0)->count();
            
        return view('admin.products.inventory', compact('products', 'lowStockCount', 'outOfStockCount'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        $promotions = Promotion::where('is_active', true)
            ->where('end_date', '>', now())
            ->get();
            
        return view('admin.products.create', compact('categories', 'promotions'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products,sku',
            'in_stock' => 'required|integer|min:0',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_new_arrival' => 'boolean',
            'specifications' => 'nullable|array',
        ]);

        

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
        }
        
        // Handle specifications if provided
        if ($request->has('specifications')) {
            $specs = [];
            foreach ($request->specifications as $key => $value) {
                if (!empty($key) && !empty($value)) {
                    $specs[$key] = $value;
                }
            }
            $validated['specifications'] = !empty($specs) ? $specs : null;
        }
        
        // Create the product
        $product = Product::create($validated);
        
        // Sync categories
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load('categories');

        
        
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $promotions = Promotion::where('is_active', true)
            ->where('end_date', '>', now())
            ->get();
       
        
        return view('admin.products.edit', compact('product', 'categories', 'promotions'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => ['required', 'string', Rule::unique('products')->ignore($product->id)],
            'in_stock' => 'required|integer|min:0',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_new_arrival' => 'boolean',
            'specifications' => 'nullable|array',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer',
        ]);

        // Update slug if name changed
        if ($product->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        
        // Handle image removal
        $currentImages = $product->images ?? [];
        if ($request->has('remove_images')) {
            $imagesToKeep = [];
            foreach ($currentImages as $index => $image) {
                if (!in_array($index, $request->remove_images)) {
                    $imagesToKeep[] = $image;
                } else {
                    // Delete the image file from storage
                    Storage::disk('public')->delete($image);
                }
            }
            $currentImages = $imagesToKeep;
        }
        
        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $currentImages[] = $path;
            }
        }
        $validated['images'] = $currentImages;
        
        

        // Handle specifications if provided
        if ($request->has('specifications')) {
            $specs = [];
            foreach ($request->specifications as $key => $value) {
                if (!empty($key) && !empty($value)) {
                    $specs[$key] = $value;
                }
            }
            $validated['specifications'] = !empty($specs) ? $specs : null;
        }
        
        // Update the product
        $product->update($validated);
        
        // Sync categories
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        } else {
            $product->categories()->detach();
        }
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }
    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete associated images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        // Detach categories
        $product->categories()->detach();
        
        // Delete the product
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Set an image as primary for the product.
     */
    public function setPrimaryImage(Product $product, $imageIndex)
    {
        $images = $product->images;
        
        if (isset($images[$imageIndex])) {
            // Move the selected image to the first position
            $selectedImage = $images[$imageIndex];
            unset($images[$imageIndex]);
            array_unshift($images, $selectedImage);
            
            $product->update(['images' => array_values($images)]);
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    /**
     * Delete a product image.
     */
    public function destroyImage($imagePath)
    {
        // Find product that has this image
        $product = Product::whereJsonContains('images', $imagePath)->first();
        
        if ($product) {
            $images = $product->images;
            $updatedImages = array_filter($images, function($img) use ($imagePath) {
                return $img !== $imagePath;
            });
            
            $product->update(['images' => array_values($updatedImages)]);
            
            // Delete the physical file
            Storage::disk('public')->delete($imagePath);
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }
}