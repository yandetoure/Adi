<?php declare(strict_types=1);

namespace App\Http\Controllers\Assistant;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(15);
        return view('assistant.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items.product']);
        return view('assistant.orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        $order->load(['user', 'items.product']);
        return view('assistant.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'tracking_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('assistant.orders.index')
            ->with('success', 'Commande mise à jour avec succès.');
    }
}
