<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

       
        return view('public.checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        
        // Calculate total
        $total = 0;
        $orderItems = [];
        
        if (isset($cart['default'])) {
            // Shopping Cart package structure
            foreach ($cart['default'] as $item) {
                $itemTotal = $item->price * $item->qty;
                $total += $itemTotal;
                
                $orderItems[] = [
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                    'item_total' => $itemTotal
                ];
            }
        } else {
            // Simple array structure
            foreach ($cart as $id => $item) {
                // Handle both possible array structures
                $quantity = $item['quantity'] ?? $item['qty'] ?? 1;
                $price = $item['price'] ?? 0;
                
                $itemTotal = $price * $quantity;
                $total += $itemTotal;
                
                $orderItems[] = [
                    'product_id' => $id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'item_total' => $itemTotal
                ];
            }
        }


        // Create or find customer
        $customer = Customer::firstOrCreate(
            ['email' => $request->email],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
            ]
        );

        // Update customer address if needed
        if (!$customer->address) {
            $customer->update([
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
            ]);
        }

        // Create order
        $order = Order::create([
            'customer_id' => $customer->id,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'shipping_address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'payment_method' => $request->payment_method ?? 'cash_on_delivery',
            'status' => 'pending',
            'total_amount' => $total,
        ]);

        // Create order items
        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],               
            ]);
        }

        // Clear cart
        session()->forget('cart');

       
        return redirect()->route('checkout.confirmation', $order);
    }
    
    public function confirmation(Order $order)
    {
        return view('public.checkout.confirmation', compact('order'));
    }

    public function receipt(Order $order)
    {
        // Eager load the order items and product relationships
        $order->load(['items.product', 'customer']);
        return view('public.checkout.receipt', compact('order'));
    }
   
}