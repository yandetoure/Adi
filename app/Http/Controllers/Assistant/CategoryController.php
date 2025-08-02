<?php declare(strict_types=1);

namespace App\Http\Controllers\Assistant;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->paginate(15);
        return view('assistant.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('assistant.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Category::create($validated);

        return redirect()->route('assistant.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function show(Category $category): View
    {
        $category->load(['products' => function ($query) {
            $query->latest()->limit(10);
        }]);

        return view('assistant.categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('assistant.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $category->update($validated);

        return redirect()->route('assistant.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('assistant.categories.index')
                ->with('error', 'Impossible de supprimer une catégorie qui contient des produits.');
        }

        $category->delete();

        return redirect()->route('assistant.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
