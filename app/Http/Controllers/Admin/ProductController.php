<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'stock_quantity' => 'required|integer|min:0',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'default_image_url' => 'nullable|url|max:500',
        ]);

                // Convertir les valeurs booléennes
        $validated['is_active'] = $request->has('is_active');

                // Debug: Afficher les données validées
        Log::info('Données validées pour la création du produit:', $validated);

        try {
            $product = Product::create($validated);
            Log::info('Produit créé avec succès:', ['id' => $product->id, 'name' => $product->name]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du produit:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Erreur lors de la création du produit: ' . $e->getMessage()]);
        }

        // Gestion des images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images', 'public');
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $product->load(['category', 'media']);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        $product->load('media');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'stock_quantity' => 'required|integer|min:0',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'default_image_url' => 'nullable|url|max:500',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:media,id',
        ]);

                // Convertir les valeurs booléennes
        $validated['is_active'] = $request->has('is_active');

        // Debug: Afficher les données validées
        Log::info('Données validées pour la mise à jour du produit:', $validated);

        try {
            $product->update($validated);
            Log::info('Produit mis à jour avec succès:', ['id' => $product->id, 'name' => $product->name]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du produit:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Erreur lors de la mise à jour du produit: ' . $e->getMessage()]);
        }

        // Supprimer les images sélectionnées
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $mediaId) {
                $media = Media::find($mediaId);
                if ($media && $media->model_id === $product->id) {
                    $media->delete();
                }
            }
        }

        // Ajouter de nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images', 'public');
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    /**
     * Delete a specific media from the product.
     */
    public function deleteMedia(Product $product, Media $media): RedirectResponse
    {
        // Vérifier que le média appartient bien au produit
        if ($media->model_id !== $product->id) {
            return redirect()->back()->with('error', 'Média non trouvé.');
        }

        $media->delete();

        return redirect()->back()->with('success', 'Image supprimée avec succès.');
    }
}
