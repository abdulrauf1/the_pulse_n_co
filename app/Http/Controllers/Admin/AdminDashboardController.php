<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get total revenue (sum of all completed orders)
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');
        
        // Get total orders count
        $totalOrders = Order::count();
        
        // Get total customers count
        $totalCustomers = Customer::count();
        
        // Get total products count
        $totalProducts = Product::count();
        
        // Get revenue growth compared to last month
        $currentMonthRevenue = Order::where('status', 'delivered')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_amount');
            
        $lastMonthRevenue = Order::where('status', 'delivered')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->sum('total_amount');
            
        $revenueGrowth = $lastMonthRevenue > 0 
            ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;
        
        // Get orders growth compared to last month
        $currentMonthOrders = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $lastMonthOrders = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        
        $ordersGrowth = $lastMonthOrders > 0 
            ? (($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100 
            : 0;
        
        // Get customers growth compared to last month
        $currentMonthCustomers = Customer::whereMonth('created_at', Carbon::now()->month)->count();
        $lastMonthCustomers = Customer::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        
        $customersGrowth = $lastMonthCustomers > 0 
            ? (($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100 
            : 0;
        
        // Get monthly revenue data for the chart
        $monthlyRevenue = Order::where('status', 'delivered')
            ->select(
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('MONTHNAME(created_at) as month')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
        
        // Get orders by status for the chart
        $ordersByStatus = Order::select(
                'status',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('status')
            ->get();
        
        // Get recent orders
        $recentOrders = Order::with('customer')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get top selling products
        $topProducts = Product::withCount(['orderItems as total_sold' => function($query) {
                $query->select(DB::raw('SUM(quantity)'));
            }])
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'totalProducts',
            'revenueGrowth',
            'ordersGrowth',
            'customersGrowth',
            'monthlyRevenue',
            'ordersByStatus',
            'recentOrders',
            'topProducts'
        ));
    }
}