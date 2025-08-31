<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'sku',
        'in_stock',
        'is_active',
        'is_featured',
        'is_bestseller',
        'is_new_arrival',
        'images',
        'specifications',
    ];

    protected $casts = [
        'images' => 'array',
        'specifications' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_new_arrival' => 'boolean',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    // In your Product model (app/Models/Product.php)
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_product')
            ->withTimestamps();
    }

    /**
     * Check if product has any active promotions
     */
    public function hasActivePromotion()
    {
        return $this->promotions()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->exists();
    }

    /**
     * Get the discounted price if there's an active promotion
     */
    public function getDiscountedPrice()
    {
        if (!$this->hasActivePromotion()) {
            return $this->price;
        }

        $activePromotion = $this->promotions()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if ($activePromotion->discount_type === 'percentage') {
            return $this->price * (1 - ($activePromotion->discount_value / 100));
        } else {
            return max(0, $this->price - $activePromotion->discount_value);
        }
    }

    public function orderItems()
    {
        // You'll need to create an OrderItem model if you don't have one
        return $this->hasMany(OrderItem::class);
    }

    public function getDiscountPriceAttribute()
    {
        if ($this->activePromotions->isEmpty()) {
            return $this->sale_price ?? $this->price;
        }

        $discountedPrice = $this->price;
        
        foreach ($this->activePromotions as $promotion) {
            $discount = $promotion->calculateDiscountForProduct($this);
            $discountedPrice -= $discount;
        }

        return max($discountedPrice, 0); // Ensure price doesn't go negative
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function getActivePromotion()
    {
        return $this->promotions()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }

}