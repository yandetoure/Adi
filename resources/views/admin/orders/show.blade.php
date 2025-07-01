@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Détails de la Commande #{{ $order->id }}</h1>
                    <p class="text-gray-600">
                        @if(auth()->user()->hasRole('assistant'))
                            Assistant - Consultation de la commande
                        @else
                            Administration - Détails de la commande
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.orders.index') : route('admin.orders.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                        Retour à la liste
                    </a>
                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.orders.edit', $order) : route('admin.orders.edit', $order) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Order Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations de la commande</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Numéro de commande</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">#{{ $order->id }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Statut</label>
                        <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status === 'completed') bg-green-100 text-green-800
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Montant total</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            {{ number_format($order->total, 0, ',', ' ') }} FCFA
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date de commande</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dernière modification</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    @if($order->notes)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Notes</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations client</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->user->name ?? 'Client inconnu' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->user->email ?? 'Email inconnu' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->user->phone ?? 'Non renseigné' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date d'inscription</label>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $order->user->created_at ? $order->user->created_at->format('d/m/Y') : 'Non disponible' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Articles commandés</h2>
            
            @if($order->items->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Produit
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prix unitaire
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantité
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                                                        @if($item->product->getFirstMediaUrl('images') && $item->product->getFirstMediaUrl('images') !== '')
                                            <img class="h-10 w-10 rounded object-cover" 
                                                 src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $item->product->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-image text-xs text-gray-400"></i>
                                            </div>
                                        @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->product->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    SKU: {{ $item->product->sku }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($item->price, 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-shopping-cart text-3xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Aucun article dans cette commande</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 