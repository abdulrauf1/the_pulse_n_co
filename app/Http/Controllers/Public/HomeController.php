<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Carousel;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        
        // Get active promotions for sales bar
        $promotions = Promotion::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->take(4)
            ->get();

        // Get active carousel items for hero section
        $carousels = Carousel::where('is_active', true)
            ->orderBy('position')
            ->get();

        // Get new arrival products
        $newArrivals = Product::where('is_new_arrival', true)
            ->where('in_stock', '>', 0)
            ->with(['promotions' => function($query) {
                $query->where('is_active', true)
                    ->where('promotions.start_date', '<=', now())
                    ->where('promotions.end_date', '>=', now());
            }])
            ->take(6)
            ->get();

        // Get categories for categories section
        $categories = Category::where('is_active', true)
            ->take(4)
            ->get();
            

        // Get featured products (best sellers)
        $featuredProducts = Product::where('is_bestseller', true)
            ->where('in_stock', '>', 0)
            ->with(['promotions' => function($query) {
                $query->where('is_active', true)
                    ->where('promotions.start_date', '<=', now())
                    ->where('promotions.end_date', '>=', now());
            }])
            ->take(4)
            ->get();

        // Get approved testimonials
        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('is_featured', 'desc')
            ->take(3)
            ->get();
        

        return view('public.home', compact(
            'promotions',
            'carousels',
            'newArrivals',
            'categories',
            'featuredProducts',
            'testimonials'
        ));
    }
}