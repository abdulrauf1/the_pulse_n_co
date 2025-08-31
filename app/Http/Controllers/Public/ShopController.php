<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Start with all products
        $query = Product::with(['categories', 'brand', 'promotions'])
            ->where('is_active', true);

        // Apply filters
        $query = $this->applyFilters($query, $request);

        // Get filter options
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();

        // Get min and max prices for filter range
        $priceRange = [
            'min' => Product::min('price'),
            'max' => Product::max('price')
        ];

        // Get products with pagination
        $products = $query->paginate(12);

        return view('public.shop.index', compact('products', 'categories', 'brands', 'priceRange'));
    }

    private function applyFilters($query, Request $request)
    {
        // Category filter (updated for many-to-many relationship)
        if ($request->has('categories') && !empty($request->categories)) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->whereIn('categories.id', $request->categories);
            });
        }

        // Brand filter
        if ($request->has('brands') && !empty($request->brands)) {
            $query->whereIn('brand_id', $request->brands);
        }

        // Price range filter
        if ($request->has('min_price') && $request->min_price !== '') {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price !== '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort options
        switch ($request->get('sort', 'latest')) {
            case 'price_low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query;
    }

    public function show(Product $product)
    {
        // Check if product is active
        if (!$product->is_active) {
            abort(404);
        }

       
        // Load relationships
        $product->load(['categories', 'brand', 'promotions']);

        // Load related products - using the first category for related products
        $categoryIds = $product->categories->pluck('id');
        
        $relatedProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->whereHas('categories', function($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->with(['promotions'])
            ->take(4)
            ->get();

        return view('public.shop.show', compact('product', 'relatedProducts'));
    }
}