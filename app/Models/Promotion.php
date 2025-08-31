<?php

// app/Models/Promotion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'is_active',
        'promo_code',
        'min_order_amount',
        'max_discount',
        'usage_limit',
        'apply_to_all', // Determines if promotion applies to all products
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'apply_to_all' => 'boolean',
    ];

    
     public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'promotion_product') // Explicitly set table name
            ->withPivot('custom_discount', 'is_excluded', 'start_date', 'end_date')
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    
    public function calculateDiscountForProduct(Product $product)
    {
        // Check if product is excluded from this promotion
        if ($this->products()->where('product_id', $product->id)
            ->wherePivot('is_excluded', true)->exists()) {
            return 0;
        }

        // Check if product has special discount value
        $specialDiscount = $this->products()
            ->where('product_id', $product->id)
            ->wherePivot('special_discount_value', '!=', null)
            ->value('special_discount_value');

        $discountValue = $specialDiscount ?? $this->discount_value;

        if ($this->discount_type === 'percentage') {
            $discount = $product->price * ($discountValue / 100);
            return $this->max_discount ? min($discount, $this->max_discount) : $discount;
        }

        return $discountValue;
    }
}