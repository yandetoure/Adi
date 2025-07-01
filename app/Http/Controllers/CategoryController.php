<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $categories = Category::withCount('products')
            ->where('is_active', true)
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category, Request $request): View
    {
        $query = $category->products()->where('is_active', true);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
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

        return view('categories.show', compact('category', 'products'));
    }

    public function myCategories(): View
    {
        $categories = Auth::user()->categories()->latest()->paginate(10);
        return view('categories.my', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $validated['is_active'] ?? true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('categories.my')->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(Category $category): View
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('categories.my')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);
        
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.my')->with('error', 'Impossible de supprimer une catégorie qui contient des produits.');
        }
        
        $category->delete();

        return redirect()->route('categories.my')->with('success', 'Catégorie supprimée avec succès.');
    }
}
