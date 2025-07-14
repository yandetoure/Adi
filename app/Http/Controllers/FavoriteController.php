<?php declare(strict_types=1); 

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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

        $user = auth()->user();
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
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $favorites = $user->favorites()->with('product')->get();
        
        return view('products.favorites', compact('favorites'));
    }

    /**
     * Check if a product is favorited by the current user
     */
    public function check(Request $request): JsonResponse
    {
        $user = auth()->user();
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