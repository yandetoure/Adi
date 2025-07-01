<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        $query = Product::with('category')->where('is_active', true);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sort
        switch ($request->get('sort', 'newest')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        $product->load('category');
        
        // Get related products from same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        // Check if product is in user's favorites
        $isFavorite = false;
        if (Auth::check()) {
            $isFavorite = Auth::user()->favoriteProducts()->where('product_id', $product->id)->exists();
        }

        return view('products.show', compact('product', 'relatedProducts', 'isFavorite'));
    }

    public function favorites(): View
    {
        $favorites = Auth::user()->favoriteProducts()->with('category')->paginate(12);
        return view('products.favorites', compact('favorites'));
    }

    public function addToFavorites(Product $product): RedirectResponse
    {
        $user = Auth::user();
        
        // Check if already favorited
        if ($user->favoriteProducts()->where('product_id', $product->id)->exists()) {
            return back()->with('info', 'Ce produit est déjà dans vos favoris.');
        }

        $user->favoriteProducts()->attach($product->id);

        return back()->with('success', 'Produit ajouté aux favoris.');
    }

    public function removeFromFavorites(Product $product): RedirectResponse
    {
        $user = Auth::user();
        $user->favoriteProducts()->detach($product->id);

        return back()->with('success', 'Produit retiré des favoris.');
    }

    public function myProducts(): View
    {
        $products = Auth::user()->products()->latest()->paginate(10);
        return view('products.my', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $validated['is_active'] ?? true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.my')->with('success', 'Produit créé avec succès.');
    }

    public function edit(Product $product): View
    {
        $this->authorize('update', $product);
        $categories = Category::where('is_active', true)->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.my')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);
        
        $product->delete();

        return redirect()->route('products.my')->with('success', 'Produit supprimé avec succès.');
    }
}
