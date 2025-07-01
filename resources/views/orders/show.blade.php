@extends('layouts.app')

@section('title', 'Détails de la commande')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Commande #{{ $order->id }}</h1>
            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Retour aux commandes
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Status -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Statut de la commande</h2>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
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
                        <div class="text-sm text-gray-600">
                            Passée le {{ $order->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Articles commandés</h2>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                            <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                                                            @if($item->product->getFirstMediaUrl('images') && $item->product->getFirstMediaUrl('images') !== '')
                                            <img src="{{ $item->product->getFirstMediaUrl('images') }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                    <p class="text-sm text-gray-600">Quantité: {{ $item->quantity }}</p>
                                </div>

                                <!-- Price -->
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">{{ number_format($item->price, 2) }} Fcfa</p>
                                    <p class="text-sm text-gray-600">Prix unitaire: {{ number_format($item->price / $item->quantity, 2) }} Fcfa</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="space-y-6">
                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Résumé de la commande</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sous-total:</span>
                            <span class="font-semibold">{{ number_format($order->total_amount, 2) }} Fcfa</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Frais de livraison:</span>
                            <span class="font-semibold">0 Fcfa</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-bold text-gray-900">Total:</span>
                                <span class="text-lg font-bold text-gray-900">{{ number_format($order->total_amount, 2) }} Fcfa</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                @if($order->shipping_address)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Adresse de livraison</h2>
                        <div class="text-gray-600">
                            <p>{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                @endif

                <!-- Contact Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations de contact</h2>
                    <div class="space-y-2 text-gray-600">
                        <p><strong>Nom:</strong> {{ $order->user->name }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email }}</p>
                        @if($order->phone)
                            <p><strong>Téléphone:</strong> {{ $order->phone }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 