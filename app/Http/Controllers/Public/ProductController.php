<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Or paginate if you have many products
        return view('shop', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}