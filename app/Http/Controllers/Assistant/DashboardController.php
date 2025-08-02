<?php declare(strict_types=1);

namespace App\Http\Controllers\Assistant;

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
        // Statistiques de base
        $stats = [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'processingOrders' => Order::where('status', 'processing')->count(),
            'shippedOrders' => Order::where('status', 'shipped')->count(),
            'deliveredOrders' => Order::where('status', 'delivered')->count(),
            'cancelledOrders' => Order::where('status', 'cancelled')->count(),
            'totalUsers' => User::count(),
        ];

        // Statistiques de ventes
        $salesStats = [
            'totalRevenue' => Order::whereIn('status', ['delivered', 'shipped'])->sum('total_amount'),
            'monthlyRevenue' => Order::whereIn('status', ['delivered', 'shipped'])
                ->whereMonth('created_at', now()->month)
                ->sum('total_amount'),
            'weeklyRevenue' => Order::whereIn('status', ['delivered', 'shipped'])
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->sum('total_amount'),
            'averageOrderValue' => Order::whereIn('status', ['delivered', 'shipped'])->avg('total_amount') ?? 0,
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->limit(10)
            ->get();

        $popularProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('assistant.dashboard', compact('stats', 'salesStats', 'recentOrders', 'popularProducts'));
    }
}
