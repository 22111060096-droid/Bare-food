<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', now()->toDateString())->count();
        $totalRevenue = Order::sum('total');
        $productCount = Product::count();
        $userCount = User::count();

        // Recent Orders (5 newest)
        $recentOrders = Order::with(['user', 'items.product'])->latest('created_at')->take(5)->get();

        // Chart Data: 7 days revenue
        $chartData = [];
        $maxValue = 0;
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $value = Order::whereDate('created_at', $date->toDateString())->sum('total');
            $chartData[] = [
                'day' => $date->format('D'),
                'value' => $value
            ];
            if ($value > $maxValue) $maxValue = $value;
        }

        // Recent Activities (today)
        $recentActivities = Order::with(['user'])
            ->whereDate('created_at', now()->toDateString())
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'todayOrders',
            'totalRevenue',
            'productCount',
            'userCount',
            'recentOrders',
            'chartData',
            'maxValue',
            'recentActivities'
        ));
    }
}

