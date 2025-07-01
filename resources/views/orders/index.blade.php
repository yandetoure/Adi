@extends('layouts.app')

@section('title', 'Mes Commandes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mes Commandes</h1>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Retour aux produits
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Commande #{{ $order->id }}</h3>
                                    <p class="text-sm text-gray-600">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                        @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                        @endif">
                                        @switch($order->status)
                                            @case('pending')
                                                En attente
                                                @break
                                            @case('processing')
                                                En cours de traitement
                                                @break
                                            @case('shipped')
                                                Expédiée
                                                @break
                                            @case('delivered')
                                                Livrée
                                                @break
                                            @case('cancelled')
                                                Annulée
                                                @break
                                            @default
                                                {{ ucfirst($order->status) }}
                                        @endswitch
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0">
                                            @if($item->product->getFirstMediaUrl())
                                                <img src="{{ $item->product->getFirstMediaUrl() }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900">{{ $item->product->name }}</h4>
                                            <p class="text-sm text-gray-600">Quantité: {{ $item->quantity }}</p>
                                        </div>

                                        <!-- Price -->
                                        <div class="text-right">
                                            <p class="font-semibold text-gray-900">{{ number_format($item->price, 2) }} Fcfa</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-lg font-bold text-gray-900">Total: {{ number_format($order->total_amount, 2) }} Fcfa</p>
                                        <p class="text-sm text-gray-600">{{ $order->orderItems->count() }} article(s)</p>
                                    </div>
                                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Voir les détails →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune commande</h3>
                <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore passé de commande.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Découvrir nos produits
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 