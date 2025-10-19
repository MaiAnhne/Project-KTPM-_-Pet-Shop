<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        
        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        $bestSellingProducts = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'product' => Product::find($item->product_id),
                    'total_sold' => $item->total_sold,
                ];
            });
            
        return view('admin.pages.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'bestSellingProducts'
        ));
    }
}