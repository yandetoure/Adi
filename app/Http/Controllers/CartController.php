<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $validated['quantity']
            ]);
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        // Update cart count in session
        $cartCount = CartItem::where('user_id', auth()->id())->sum('quantity');
        session(['cart_count' => $cartCount]);

        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cartItem->update(['quantity' => $validated['quantity']]);

        // Update cart count in session
        $cartCount = CartItem::where('user_id', auth()->id())->sum('quantity');
        session(['cart_count' => $cartCount]);

        return redirect()->route('cart.index')->with('success', 'Panier mis à jour.');
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        $cartItem->delete();

        // Update cart count in session
        $cartCount = CartItem::where('user_id', auth()->id())->sum('quantity');
        session(['cart_count' => $cartCount]);

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
    }

    public function clear(): RedirectResponse
    {
        CartItem::where('user_id', auth()->id())->delete();
        session(['cart_count' => $cartCount]);

        return redirect()->route('cart.index')->with('success', 'Panier vidé.');
    }
}
