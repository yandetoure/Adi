<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== auth()->user()->id) {
            abort(403);
        }

        $order->load(['items.product']);
        return view('orders.show', compact('order'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Create order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total' => $total,
            'status' => 'pending',
            'shipping_address' => $validated['shipping_address'],
            'billing_address' => $validated['billing_address'],
            'notes' => $validated['notes'] ?? null,
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // Clear cart
        CartItem::where('user_id', auth()->user()->id)->delete();
        session(['cart_count' => 0]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Commande passée avec succès !');
    }
}
