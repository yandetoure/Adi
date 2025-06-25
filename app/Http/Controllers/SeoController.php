<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Générer le sitemap XML
     */
    public function sitemap(): Response
    {
        $products = Product::active()->get();
        $categories = Category::all();
        
        return response()->view('sitemap', compact('products', 'categories'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Générer le robots.txt
     */
    public function robots(): Response
    {
        return response()->view('robots')
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Page d'accueil avec métadonnées optimisées
     */
    public function home(): View
    {
        $featuredProducts = Product::active()->featured()->take(8)->get();
        $popularCategories = Category::withCount('products')->orderBy('products_count', 'desc')->take(6)->get();
        
        return view('home', compact('featuredProducts', 'popularCategories'));
    }

    /**
     * Page produit avec métadonnées optimisées
     */
    public function product(Product $product): View
    {
        // Incrémenter le compteur de vues
        $product->incrementViewCount();
        
        // Charger les relations
        $product->load(['category', 'media']);
        
        // Produits similaires
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Page catégorie avec métadonnées optimisées
     */
    public function category(Category $category): View
    {
        $products = Product::active()
            ->where('category_id', $category->id)
            ->paginate(12);
        
        return view('categories.show', compact('category', 'products'));
    }

    /**
     * Liste des produits avec métadonnées optimisées
     */
    public function products(Request $request): View
    {
        $query = Product::active()->with('category');
        
        // Filtres
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Tri
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
        }
        
        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }
} 