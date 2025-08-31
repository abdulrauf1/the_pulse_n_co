<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::withCount('products')->latest()->paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'promo_code' => 'nullable|string|unique:promotions,promo_code',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'apply_to_all' => 'boolean'
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($request->name) . '-' . time();
        
        // Set default values
        $validated['is_active'] = $request->has('is_active');
        $validated['apply_to_all'] = $request->has('apply_to_all');

        Promotion::create($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'promo_code' => [
                'nullable',
                'string',
                Rule::unique('promotions')->ignore($promotion->id)
            ],
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'apply_to_all' => 'boolean'
        ]);

        // Update slug if name changed
        if ($promotion->name !== $request->name) {
            $validated['slug'] = Str::slug($request->name) . '-' . time();
        }
        
        // Set boolean values
        $validated['is_active'] = $request->has('is_active');
        $validated['apply_to_all'] = $request->has('apply_to_all');

        $promotion->update($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion deleted successfully.');
    }

    /**
     * Show the form for managing promotion products.
     */
    public function manageProducts(Promotion $promotion)
    {
        $products = Product::whereNotIn('id', $promotion->products()->pluck('id'))
            ->latest()
            ->paginate(12);
            
        $promotionProducts = $promotion->products()
            ->withPivot('custom_discount', 'is_excluded', 'start_date', 'end_date')
            ->get();
            
        return view('admin.promotions.products', compact('promotion', 'products', 'promotionProducts'));
    }

    /**
     * Update the promotion products.
     */
    public function updateProducts(Request $request, Promotion $promotion)
    {
        $request->validate([
            'products' => 'nullable|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.custom_discount' => 'nullable|numeric|min:0',
            'products.*.is_excluded' => 'boolean',
            'products.*.start_date' => 'nullable|date',
            'products.*.end_date' => 'nullable|date|after_or_equal:products.*.start_date',
        ]);

        // Sync products with pivot data
        $productsData = [];
        if ($request->has('products')) {
            foreach ($request->products as $product) {
                $productsData[$product['product_id']] = [
                    'custom_discount' => $product['custom_discount'] ?? null,
                    'is_excluded' => $product['is_excluded'] ?? false,
                    'start_date' => $product['start_date'] ?? null,
                    'end_date' => $product['end_date'] ?? null,
                ];
            }
        }
        
        $promotion->products()->sync($productsData);

        return redirect()->route('admin.promotions.products', $promotion)
            ->with('success', 'Promotion products updated successfully.');
    }
}