<?php declare(strict_types=1);

namespace App\Http\Controllers\Assistant;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(15);

        return view('assistant.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('assistant.products.create', compact('categories'));
    }

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
            'meta_title' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'secondary_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'default_image_url' => 'nullable|url|max:500',
            'mode_emploi' => 'nullable|string',
            'caracteristiques' => 'nullable|string',
            'sku' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
        ]);

        // Convertir les valeurs booléennes
        $validated['is_active'] = $request->has('is_active');

        // Debug: Afficher les données validées
        Log::info('Données validées pour la création du produit (Assistant):', $validated);

        try {
            $product = Product::create($validated);
            Log::info('Produit créé avec succès (Assistant):', ['id' => $product->id, 'name' => $product->name]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du produit (Assistant):', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Erreur lors de la création du produit: ' . $e->getMessage()]);
        }

        // Génération automatique des métadonnées SEO
        $category = Category::find($validated['category_id']);
        $categoryName = $category ? $category->name : 'produit informatique';

        // Meta Title - Nom du produit + ADI Technologies
        $validated['meta_title'] = $validated['name'] . ' - ADI Technologies Dakar';
        if (strlen($validated['meta_title']) > 60) {
            $validated['meta_title'] = substr($validated['meta_title'], 0, 57) . '...';
        }

        // Meta Description - Description complète avec prix et localisation
        $price = number_format((float) $validated['price'], 0, ',', ' ');
        $validated['meta_description'] = $validated['name'] . ' - ' . $categoryName . ' disponible chez ADI Technologies à Dakar. Prix: ' . $price . ' FCFA. Livraison gratuite Dakar. Service client exceptionnel.';
        if (strlen($validated['meta_description']) > 160) {
            $validated['meta_description'] = substr($validated['meta_description'], 0, 157) . '...';
        }

        // Meta Keywords - Mots-clés optimisés pour le référencement
        $keywords = [
            $validated['name'],
            $categoryName,
            'ADI Technologies',
            'ADI Global',
            'Dakar',
            'Sénégal',
            'informatique',
            'ordinateur',
            'imprimante',
            'scanner',
            'accessoires informatiques'
        ];

        // Ajouter des mots-clés spécifiques selon la catégorie
        if (stripos($categoryName, 'imprimante') !== false) {
            $keywords[] = 'imprimante';
            $keywords[] = 'printer';
            $keywords[] = 'cartouches';
        } elseif (stripos($categoryName, 'ordinateur') !== false) {
            $keywords[] = 'ordinateur';
            $keywords[] = 'computer';
            $keywords[] = 'laptop';
            $keywords[] = 'portable';
        } elseif (stripos($categoryName, 'scanner') !== false) {
            $keywords[] = 'scanner';
            $keywords[] = 'numérisation';
        }

        $validated['meta_keywords'] = implode(', ', array_unique($keywords));

        // Gestion des images
        if ($request->hasFile('main_image')) {
            $product->addMedia($request->file('main_image'))
                ->toMediaCollection('images', 'public');
        }

        if ($request->hasFile('secondary_images')) {
            foreach ($request->file('secondary_images') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images', 'public');
            }
        }

        return redirect()->route('assistant.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'media']);
        return view('assistant.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        $product->load('media');
        return view('assistant.products.edit', compact('product', 'categories'));
    }

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
            'meta_title' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'secondary_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'default_image_url' => 'nullable|url|max:500',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:media,id',
            'mode_emploi' => 'nullable|string',
            'caracteristiques' => 'nullable|string',
            'sku' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
        ]);

        // Génération automatique des métadonnées SEO
        $category = Category::find($validated['category_id']);
        $categoryName = $category ? $category->name : 'produit informatique';

        // Meta Title - Nom du produit + ADI Technologies
        $validated['meta_title'] = $validated['name'] . ' - ADI Technologies Dakar';
        if (strlen($validated['meta_title']) > 60) {
            $validated['meta_title'] = substr($validated['meta_title'], 0, 57) . '...';
        }

        // Meta Description - Description complète avec prix et localisation
        $price = number_format((float) $validated['price'], 0, ',', ' ');
        $validated['meta_description'] = $validated['name'] . ' - ' . $categoryName . ' disponible chez ADI Technologies à Dakar. Prix: ' . $price . ' FCFA. Livraison gratuite Dakar. Service client exceptionnel.';
        if (strlen($validated['meta_description']) > 160) {
            $validated['meta_description'] = substr($validated['meta_description'], 0, 157) . '...';
        }

        // Meta Keywords - Mots-clés optimisés pour le référencement
        $keywords = [
            $validated['name'],
            $categoryName,
            'ADI Technologies',
            'ADI Global',
            'Dakar',
            'Sénégal',
            'informatique',
            'ordinateur',
            'imprimante',
            'scanner',
            'accessoires informatiques'
        ];

        // Ajouter des mots-clés spécifiques selon la catégorie
        if (stripos($categoryName, 'imprimante') !== false) {
            $keywords[] = 'imprimante';
            $keywords[] = 'printer';
            $keywords[] = 'cartouches';
        } elseif (stripos($categoryName, 'ordinateur') !== false) {
            $keywords[] = 'ordinateur';
            $keywords[] = 'computer';
            $keywords[] = 'laptop';
            $keywords[] = 'portable';
        } elseif (stripos($categoryName, 'scanner') !== false) {
            $keywords[] = 'scanner';
            $keywords[] = 'numérisation';
        }

        $validated['meta_keywords'] = implode(', ', array_unique($keywords));

        // Convertir les valeurs booléennes
        $validated['is_active'] = $request->has('is_active');

        // Debug: Afficher les données validées
        Log::info('Données validées pour la mise à jour du produit (Assistant):', $validated);

        try {
            $product->update($validated);
            Log::info('Produit mis à jour avec succès (Assistant):', ['id' => $product->id, 'name' => $product->name]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du produit (Assistant):', [
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

        // Ajouter l'image principale
        if ($request->hasFile('main_image')) {
            // Supprimer l'ancienne image principale s'il y en a une
            $product->clearMediaCollection('images');

            $product->addMedia($request->file('main_image'))
                ->toMediaCollection('images', 'public');
        }

        // Ajouter de nouvelles images secondaires
        if ($request->hasFile('secondary_images')) {
            foreach ($request->file('secondary_images') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images', 'public');
            }
        }

        return redirect()->route('assistant.products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('assistant.products.index')
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
