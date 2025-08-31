<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::withCount('orders')
            ->withSum('orders', 'total_amount')
            ->latest()
            ->paginate(10);
            
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customer->load(['orders' => function($query) {
            $query->latest()->withCount('items');
        }]);
        
        $orders = $customer->orders()->paginate(5);
        
        return view('admin.customers.show', compact('customer', 'orders'));
    }
}