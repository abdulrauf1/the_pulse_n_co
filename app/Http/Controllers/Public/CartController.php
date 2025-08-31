<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|min:1'
        ]);

        // Add item to cart with proper structure
        $cartItem = Cart::add([
            'id' => $validated['id'],
            'name' => $validated['name'],
            'qty' => $validated['quantity'],
            'price' => $validated['price'],
            'options' => [] // You can add options like color, size etc.
        ]);

        return response()->json([
            'success' => true,
            'count' => Cart::count(),
            'rowId' => $cartItem->rowId // Return rowId for future operations
        ]);
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'rowId' => 'required'
        ]);

        Cart::remove($validated['rowId']);

        return response()->json([
            'success' => true,
            'count' => Cart::count(),
            'total' => Cart::total()
        ]);
    }

    public function items()
    {
        $cartContent = Cart::content();
        
        // Convert cart content to array format
        $items = [];
        foreach ($cartContent as $item) {
            $items[] = [
                'rowId' => $item->rowId,
                'id' => $item->id,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'options' => $item->options
            ];
        }

        return response()->json([
            'items' => $items, // Ensure this is an array
            'count' => Cart::count(),
            'total' => Cart::total(),
            'subtotal' => Cart::subtotal(),
            'tax' => Cart::tax()
        ]);
    }

    // Additional useful methods
    public function update(Request $request)
    {
        $validated = $request->validate([
            'rowId' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        Cart::update($validated['rowId'], $validated['quantity']);

        return response()->json([
            'success' => true,
            'count' => Cart::count(),
            'total' => Cart::total()
        ]);
    }

    public function clear()
    {
        Cart::destroy();

        return response()->json([
            'success' => true,
            'count' => 0,
            'total' => 0
        ]);
    }
}