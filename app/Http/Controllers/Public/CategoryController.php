<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display all categories
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 9);
        
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->paginate($perPage);

        return view('public.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Display products for a specific category
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        // Get ALL products in the category with their active promotions
        $products = $category->products()
            ->with(['promotions' => function($query) {
                $query->where('promotions.is_active', true)
                    ->where('promotions.start_date', '<=', now())
                    ->where('promotions.end_date', '>=', now());
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        // Pre-calculate hasActivePromotion for each product to avoid N+1 queries
        $products->getCollection()->transform(function ($product) {
            $product->has_active_promotion = $product->promotions->isNotEmpty();
            
            if ($product->has_active_promotion) {
                $activePromotion = $product->promotions->first();
                if ($activePromotion->discount_type === 'percentage') {
                    $product->discounted_price = $product->price * (1 - ($activePromotion->discount_value / 100));
                } else {
                    $product->discounted_price = max(0, $product->price - $activePromotion->discount_value);
                }
            } else {
                $product->discounted_price = $product->price;
            }
            
            return $product;
        });
        
        // Get related categories
        $relatedCategories = Category::where('id', '!=', $category->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('public.categories.show', [
            'category' => $category,
            'products' => $products,
            'relatedCategories' => $relatedCategories
        ]);
    }
}   