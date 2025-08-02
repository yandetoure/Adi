<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create(): View|RedirectResponse
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('orders.create', compact('cartItems', 'total'));
    }

    public function show(Order $order): View
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== Auth::user()->id) {
            abort(403);
        }

        $order->load(['orderItems.product']);
        return view('orders.show', compact('order'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Generate unique order number
        $orderNumber = 'ADI-' . date('Ymd') . '-' . strtoupper(uniqid());

        // Get user information
        $user = Auth::user();

        // Create order with proper address fields
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => $orderNumber,
            'subtotal' => $total,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
            'notes' => $validated['notes'] ?? null,
            
            // Billing address (using user info)
            'billing_first_name' => $user->first_name ?? $user->name,
            'billing_last_name' => $user->last_name ?? '',
            'billing_email' => $user->email,
            'billing_phone' => $validated['phone'],
            'billing_address' => $validated['shipping_address'],
            'billing_city' => 'Dakar', // Default value
            'billing_state' => 'Dakar', // Default value
            'billing_postal_code' => '00000', // Default value
            'billing_country' => 'Sénégal', // Default value
            
            // Shipping address (using provided info)
            'shipping_first_name' => $user->first_name ?? $user->name,
            'shipping_last_name' => $user->last_name ?? '',
            'shipping_email' => $user->email,
            'shipping_phone' => $validated['phone'],
            'shipping_address' => $validated['shipping_address'],
            'shipping_city' => 'Dakar', // Default value
            'shipping_state' => 'Dakar', // Default value
            'shipping_postal_code' => '00000', // Default value
            'shipping_country' => 'Sénégal', // Default value
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->product->price,
                'total_price' => $cartItem->quantity * $cartItem->product->price,
            ]);
        }

        // Clear cart
        CartItem::where('user_id', Auth::user()->id)->delete();
        session(['cart_count' => 0]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Commande passée avec succès !');
    }
}
