<?php
// app/Models/Testimonial.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'author_name',
        'author_position',
        'author_company',
        'author_avatar',
        'content',
        'rating',
        'is_approved',
        'is_featured',
        'approved_at',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'rating' => 'integer',
        'approved_at' => 'datetime',
    ];

    /**
     * Relationship with User model (if testimonial is from a registered user)
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Scope for approved testimonials
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope for featured testimonials
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for testimonials with minimum rating
     */
    public function scopeWithRating($query, $minRating = 4)
    {
        return $query->where('rating', '>=', $minRating);
    }

    /**
     * Approve the testimonial
     */
    public function approve(): void
    {
        $this->update([
            'is_approved' => true,
            'approved_at' => now(),
        ]);
    }

    /**
     * Get the author's full information
     */
    public function getAuthorAttribute(): string
    {
        $author = $this->author_name;
        
        if ($this->author_position) {
            $author .= ', ' . $this->author_position;
        }
        
        if ($this->author_company) {
            $author .= ' at ' . $this->author_company;
        }
        
        return $author;
    }

    /**
     * Get the avatar URL or default avatar
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->author_avatar) {
            return asset('storage/' . $this->author_avatar);
        }
        
        // Default avatar using UI Avatars API or local default
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->author_name) . '&color=7F9CF5&background=EBF4FF';
    }
}