<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }

    public function assistant(): View
    {
        $stats = [
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'processingOrders' => Order::where('status', 'processing')->count(),
            'totalOrders' => Order::whereIn('status', ['pending', 'processing'])->count(),
        ];

        $recentOrders = Order::with('user')
            ->whereIn('status', ['pending', 'processing'])
            ->latest()
            ->limit(5)
            ->get();

        return view('assistant.dashboard', compact('stats', 'recentOrders'));
    }
}
