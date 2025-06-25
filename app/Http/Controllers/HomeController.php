<?php declare(strict_types=1); 

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $featuredProducts = Product::active()
            ->featured()
            ->with('category')
            ->take(8)
            ->get();

        $onSaleProducts = Product::active()
            ->onSale()
            ->with('category')
            ->take(8)
            ->get();

        $categories = Category::active()
            ->withCount('products')
            ->take(6)
            ->get();

        return view('home', compact('featuredProducts', 'onSaleProducts', 'categories'));
    }
}
