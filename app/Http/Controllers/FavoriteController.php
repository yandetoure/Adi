<?php declare(strict_types=1); 

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Toggle favorite status for a product
     */
    public function toggle(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté pour ajouter des favoris'
            ], 401);
        }

        $productId = $request->product_id;
        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingFavorite) {
            // Remove from favorites
            $existingFavorite->delete();
            return response()->json([
                'success' => true,
                'favorited' => false,
                'message' => 'Produit retiré des favoris'
            ]);
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId
            ]);
            return response()->json([
                'success' => true,
                'favorited' => true,
                'message' => 'Produit ajouté aux favoris'
            ]);
        }
    }

    /**
     * Get user's favorites
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $favorites = $user->favorites()->with('product')->get();
        $products = $favorites->map(function ($favorite) {
            return $favorite->product;
        })->filter();
        
        return view('products.favorites', compact('products'));
    }

    /**
     * Add a product to favorites
     */
    public function add(Product $product): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté pour ajouter des favoris'
            ], 401);
        }

        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'success' => false,
                'message' => 'Ce produit est déjà dans vos favoris'
            ]);
        }

        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté aux favoris'
        ]);
    }

    /**
     * Remove a product from favorites
     */
    public function remove(Product $product): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté pour gérer vos favoris'
            ], 401);
        }

        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if (!$favorite) {
            return response()->json([
                'success' => false,
                'message' => 'Ce produit n\'est pas dans vos favoris'
            ]);
        }

        $favorite->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produit retiré des favoris'
        ]);
    }

    /**
     * Check if a product is favorited by the current user
     */
    public function check(Request $request): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['favorited' => false]);
        }

        $productId = $request->product_id;
        $favorited = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['favorited' => $favorited]);
    }
} 